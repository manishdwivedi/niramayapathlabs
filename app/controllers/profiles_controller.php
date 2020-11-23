<?php
class ProfilesController extends AppController
{
	var $name = "Profiles";
	var $breadcrumb = array();
	var $uses=array('PackageType','Page','Pagelocale','Locale','Test','City','Sample','Time','Timelab','Gender','Speciality','Disease','Speciality','Symptoms','Siteadminlang','AgeGroup');
	var $helpers = array('Form','Html','Javascript', 'Ajax');
	public $paginate = array('maxLimit' => 10);
	public $components = array('Email');
	
	function admin_index()
	{
		$this->set('title_for_layout','Manage Profile(s)');
		if(isset($this->params['named']['testcode']) && $this->params['named']['testcode']!='')
		{
			$this->data['FilterTest']['test_code'] = $this->params['named']['testcode'];
			$options['testcode'] = $this->params['named']['testcode'];
		}
		if(isset($this->params['named']['testparam']) && $this->params['named']['testparam']!='')
		{
			$this->data['FilterTest']['test_parameter'] = $this->params['named']['testparam'];
			$options['testparam'] = $this->params['named']['testparam'];
		}
		if(isset($this->data) && !empty($this->data))
		{
			$test_code = $this->data['FilterTest']['test_code'];
			$test_param = $this->data['FilterTest']['test_parameter'];
			if(!empty($test_code) && $test_code != '')
			{
				$conditions['Test.testcode LIKE'] = '%'.$test_code.'%';
				$options['testcode'] = $test_code;
			}
			if(!empty($test_param) && $test_param != '')
			{
				$conditions['test_parameter LIKE'] = '%'.$test_param.'%';
				$options['testparam'] = $test_param;
			}
			$conditions['Test.type'] = 'PROFILE';
			$this->paginate = array('Test' => array('limit' =>'30','order'=>array('Test.add_date'=>'DESC'),'conditions'=>$conditions));
			$profilelist=$this->paginate('Test');
			
		}
		else
		{
			$this->paginate = array('Test' => array('limit' =>'30','order'=>array('Test.add_date'=>'DESC'),'conditions'=>array('Test.type'=>'PROFILE')));
			$profilelist=$this->paginate('Test');
		}
		$k=0;
		foreach($profilelist as $key=>$val)
		{
			//echo $val['Test']['sample'];
			$samplename = $this->Sample->query("select * from sample_type_master where sample_id in (".$val['Test']['sample'].")");
			$samples = array();
			if(!empty($samplename)){
				foreach($samplename as $val1)
				{
					array_push($samples,$val1['sample_type_master']['type']);
				}
				$profilelist[$k]['Test']['sample'] = implode(',',$samples);
			}
			
			$k++;
		}
		//die;
		$this->set('profilelist',$profilelist);
	}
	
	function admin_add_profile()
	{
		$this->set('title_for_layout', 'Add profile');
		if(!empty($this->data))
		{
			//print_R($this->data);die;
			if(!empty($this->data['Test']['description_pdf']['name']))
			{
				$hfile = $this->File->uploadFile($this->data['Test']['description_pdf'], TEST_PDF_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG','PDF','pdf'));
				$this->data['Test']['file_name'] = $hfile['name'];
			}
			
			$this->data['Test']['type'] = 'PROFILE';
			$this->data['Test']['add_date'] = date('Y-m-d H:i:s');
			$this->data['Test']['status'] = 1;
			$this->data['Test']['observation_id'] = $this->data['PackageType']['observation_ids'];
			
			if($this->Test->create($this->data))
			{
				if($this->Test->save($this->data,false))
				{
					$last_insert_id = $this->Test->getLastInsertId();
					$this->redirect(array('controller'=>'profiles','action'=>'add_spec_dis',base64_encode($last_insert_id)));	
				}
			}
		}
		$package_type = $this->PackageType->find('all',array('conditions'=>array('PackageType.status'=>1),'fields'=>array('id','name'),'order'=>array('PackageType.id ASC')));
		$speciality = $this->Speciality->find('all',array('conditions'=>array('Speciality.status'=>1),'fields'=>array('id','name'),'order'=>array('Speciality.name ASC')));
		$disease = $this->Disease->find('all',array('conditions'=>array('Disease.status'=>1),'fields'=>array('id','name'),'order'=>array('Disease.name ASC')));
		$p_type = array();
		foreach($package_type as $val)
		{
			$p_type[$val['PackageType']['id']] = $val['PackageType']['name'];
		}
		$this->set('package_type',$p_type);
		$this->set('speciality',$speciality);
		$this->set('disease',$disease);
        $this->set('profit_category',$this->_getProfitCategory());
	}
	
	public function obstest()
	{
		$this->layout="";
		$this->Observation = ClassRegistry::init('Observation');
		$this->Observation = ClassRegistry::init('Observation');
		$observations = $this->Test->query("Select * from tests where id in (".$_POST['codes'].")");
		$sampleList = array();
		$sample_id=array();
		$observationId = array();
		$observationList = array();
		foreach($observations as $val)
		{
			$obsList = $this->Observation->query("Select GROUP_CONCAT( observation_name ) as obsname from observations where observation_id in (".$val['tests']['observation_id'].")");
			array_push($observationList,$obsList[0][0]['obsname']);
			array_push($observationId,$val['tests']['observation_id']);
			$samplename = $this->Sample->query("select * from sample_type_master where sample_id=".$val['tests']['sample']." or type like '".$val['tests']['sample']."'");
			array_push($sampleList,$samplename[0]['sample_type_master']['type']); 
			array_push($sample_id,$samplename[0]['sample_type_master']['sample_id']); 
		}
		print_R(implode(",",$sampleList)."@@@@@@@".implode(",",$observationList)."@@@@@@@".implode(",",$observationId)."@@@@@@@".$sample_id);
		$this->render(false);
	}
	
	public function searchtest()
	{
		$this->layout="";
		$this->Test = ClassRegistry::init('Test');
		$observations = $this->Test->query("Select * from tests where test_parameter Like '%".$_POST['search']."%' and type in ('TEST','SERVICE')");
		$content="";
		foreach($observations as $val)
		{
			$content .= "<option value='".$val['tests']['id']."'>".$val['tests']['test_parameter']."</option>";
		}
		print_R($content);
		$this->render(false);
	}
	
	public function gettest()
	{
		$this->layout="";
		$this->Test = ClassRegistry::init('Test');
		$this->Observation = ClassRegistry::init('Observation');
		$this->Sample = ClassRegistry::init('Sample');
		$observations = $this->Test->query("Select * from tests where id in (".$_POST['id'].")");
		$content="";
		$obscontent="";
		$observartion_name = "";
		$observation_list = "";
		$count = 0;
		$sample_name=array();
		$sample_id=array();
		foreach($observations as $val)
		{
			$count++;
			$content .= "<div id='test".$val['tests']['id']."'>".$val['tests']['test_parameter']."<a href='javascript:void(0);' onclick='delete_obs(".$val['tests']['id'].")' style='font-weight:bold; color:#FF0000; text-decoration:none;'>[X]</a></div>";
			$samplename = $this->Sample->query("select * from sample_type_master where sample_id=".$val['tests']['sample']." or type like '".$val['tests']['sample']."'");
			if(!in_array($samplename[0]['sample_type_master']['type'],$sample_name))
			{
				array_push($sample_name,$samplename[0]['sample_type_master']['type']);
				array_push($sample_id,$samplename[0]['sample_type_master']['sample_id']);
			}
			
			if(empty($observation_list))
				$observation_list = $val['tests']['observation_id'];
			else
				$observation_list = $observation_list.",".$val['tests']['observation_id'];
		}
		
		$testlist = explode(',',$observation_list);
		$testlist = implode(",",array_unique($testlist));
		
		$obsList = $this->Observation->query("Select GROUP_CONCAT( observation_name ) as obsname from observations where observation_id in (".$testlist.")");		
		
		$obscontent = implode(",",array_filter($sample_name));
		$sampleid= implode(",",$sample_id);
		print_R($content."@@@@@@@@".$obscontent."@@@@@@@@".$testlist."@@@@@@@@".$obsList[0][0]['obsname']."@@@@@@@@".$sampleid);
		$this->render(false);
	}
	
	function admin_add_spec_dis($profile_id=NULL)
	{
		$profile_id_dec = base64_decode($profile_id);
		
		if(!empty($this->data))
		{
		    $this->data['Test']['gender'] = implode(',',$this->data['Test']['gender']);
		    $this->data['Test']['age_group'] = implode(',',$this->data['Test']['age_group']);
		    $this->data['Test']['symptoms'] = implode(',',$this->data['Test']['symptoms']);
			$this->data['Test']['speciality'] = implode(',',$this->data['Test']['speciality']);
			$this->data['Test']['disease'] = implode(',',$this->data['Test']['disease']);
			if($this->Test->create($this->data))
			{
				$update_spec_disease = $this->Test->query("UPDATE tests SET gender ='".$this->data['Test']['gender']."', age_group ='".$this->data['Test']['age_group']."', symptoms ='".$this->data['Test']['symptoms']."', speciality='".$this->data['Test']['speciality']."',disease='".$this->data['Test']['disease']."' WHERE id='".$this->data['Test']['insert_id']."'");
				$this->Session->setFlash('Test saved successfully','flash_success');
				$this->redirect(array('controller'=>'profiles','action'=>'index'));
			}
		}
		$profile_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$profile_id_dec)));
		$speciality = $this->Speciality->find('all',array('conditions'=>array('Speciality.status'=>1),'fields'=>array('id','name'),'order'=>array('Speciality.name ASC')));
		$disease = $this->Disease->find('all',array('conditions'=>array('Disease.status'=>1),'fields'=>array('id','name'),'order'=>array('Disease.name ASC')));
		$symptoms = $this->Symptoms->find('all',array('conditions'=>array('Symptoms.status'=>1),'fields'=>array('id','name')));
		
		$agegroup = $this->AgeGroup->find('all',array('conditions'=>array('AgeGroup.status'=>1),'fields'=>array('id','name','category')));
		//print_R($profile_id_dec);die;
		$gender = $this->Gender->find('all',array('conditions'=>array('Gender.status'=>1),'fields'=>array('id','name')));
		
		$speciality = $this->Speciality->find('all',array('conditions'=>array('Speciality.status'=>1),'fields'=>array('id','name'),'order'=>array('Speciality.name ASC')));
		$disease = $this->Disease->find('all',array('conditions'=>array('Disease.status'=>1),'fields'=>array('id','name'),'order'=>array('Disease.name ASC')));
		
		
		
		$this->set('symptoms',$symptoms);
		$this->set('agegroup',$agegroup);
		$this->set('gender',$gender);
		$this->set('speciality',$speciality);
		$this->set('disease',$disease);
		$this->set('test_id_dec',$profile_id_dec);
		$this->set('testParam',$profile_detail['Test']['test_parameter']);
		$this->set('testCode',$profile_detail['Test']['testcode']);
	}
	
	function admin_edit_profile($profileId=NULL)
	{
		$this->set('title_for_layout', 'Edit Profile');
		$profile_id = base64_decode($profileId);
		if(!empty($this->data))
		{
			if(!empty($this->data['Test']['description_pdf']['name']))
			{
				$hfile = $this->File->uploadFile($this->data['Test']['description_pdf'], TEST_PDF_STORE_PATH, true,array('jpg','jpe','jpeg','gif','png','JPG','JPE','JPEG','GIF','PNG','PDF','pdf'));
				$this->data['Test']['file_name'] = $hfile['name'];
				$this->File->deleteFile(TEST_PDF_STORE_PATH.$this->data['Test']['old_file_name']);
			}
			if(empty($this->data['Test']['description_pdf']['name']))
			{
				$this->data['Test']['file_name'] = $this->data['Test']['old_file_name'];
			}
			if($this->Test->create($this->data))
			{
				if($this->Test->save($this->data,false))
				{
					if(!empty($this->data['Test']['submit_type']) && $this->data['Test']['submit_type'] == 'using_link')
					{
						$this->redirect(array('controller'=>'profiles','action'=>'edit_spec_dise',$profileId));
					}
					else
					{
						$this->Session->setFlash('Profile updated successfully','flash_success');
						$this->redirect(array('controller'=>'profiles','action'=>'index'));	
					}
				}
			}
		}
		else
		{
			$profile_detail = $this->Test->find('first',array('conditions'=>array('Test.id'=>$profile_id)));
			$explode_speciality = explode(',',$profile_detail['Test']['speciality']);
			$explode_disease = explode(',',$profile_detail['Test']['disease']);
			
			$profile_detail['Test']['speciality_name'] = array();
			$profile_detail['Test']['disease_name'] = array();
			if(!empty($profile_detail['Test']['speciality']) && $profile_detail['Test']['speciality'] != '')
			{
				foreach($explode_speciality as $key => $val)
				{
					$speciality_name = $this->Speciality->find('first',array('conditions'=>array('Speciality.id'=>$val)));
					$profile_detail['Test']['speciality_name'][] = $speciality_name['Speciality']['name'];
				}
			}
			else
			{
				$profile_detail['Test']['speciality_name'] = '';
			}
			if(!empty($profile_detail['Test']['disease']) && $profile_detail['Test']['disease'] != '')
			{
				foreach($explode_disease as $key => $val)
				{
					$speciality_name = $this->Disease->find('first',array('conditions'=>array('Disease.id'=>$val)));
					$profile_detail['Test']['disease_name'][] = $speciality_name['Disease']['name'];
				}
			}
			else
			{
				$profile_detail['Test']['disease_name'] = '';
			}
			$this->data=$profile_detail;
		}
		$package_type = $this->PackageType->find('all',array('conditions'=>array('PackageType.status'=>1),'fields'=>array('id','name'),'order'=>array('PackageType.id ASC')));
		$speciality = $this->Speciality->find('all',array('conditions'=>array('Speciality.status'=>1),'fields'=>array('id','name'),'order'=>array('Speciality.name ASC')));
		$disease = $this->Disease->find('all',array('conditions'=>array('Disease.status'=>1),'fields'=>array('id','name'),'order'=>array('Disease.name ASC')));
		$p_type = array();
		foreach($package_type as $val)
		{
			$p_type[$val['PackageType']['id']] = $val['PackageType']['name'];
		}
		$this->set('package_type',$p_type);
		$this->set('speciality',$speciality);
		$this->set('disease',$disease);
                $this->set('profit_category',$this->_getProfitCategory());
	}
	function admin_edit_spec_dise($profile_id=NULL)
	{
		$dec_profile_id = base64_decode($profile_id);
		if(!empty($this->data))
		{
		    $this->data['Test']['gender'] = implode(',',$this->data['Test']['gender']);
		    $this->data['Test']['age_group'] = implode(',',$this->data['Test']['age_group']);
		    $this->data['Test']['symptoms'] = implode(',',$this->data['Test']['symptoms']);
			$this->data['Test']['speciality'] = implode(',',$this->data['Test']['speciality']);
			$this->data['Test']['disease'] = implode(',',$this->data['Test']['disease']);
			if($this->Test->create($this->data))
			{
				$update_spec_disease = $this->Test->query("UPDATE tests SET gender ='".$this->data['Test']['gender']."', age_group ='".$this->data['Test']['age_group']."', symptoms ='".$this->data['Test']['symptoms']."', speciality='".$this->data['Test']['speciality']."',disease='".$this->data['Test']['disease']."' WHERE id='".$this->data['Test']['insert_id']."'");
				$this->Session->setFlash('Profile updated successfully','flash_success');
				$this->redirect(array('controller'=>'profiles','action'=>'index'));
			}
		}
		$profile_info = $this->Test->find('first',array('conditions'=>array('Test.id'=>$dec_profile_id)));
		$explode_gender = explode(',',$test_info['Test']['gender']);
		$explode_agegroup = explode(',',$test_info['Test']['age_group']);
		$explode_symptoms = explode(',',$test_info['Test']['symptoms']);
		$explode_speciality = explode(',',$profile_info['Test']['speciality']);
		$explode_disease = explode(',',$profile_info['Test']['disease']);
		$profile_info['Test']['gender']=array();
		$profile_info['Test']['age_group']=array();
		$profile_info['Test']['symptoms']=array();
		$profile_info['Test']['speciality'] = array();
		$profile_info['Test']['disease'] = array();
		
		foreach($explode_gender as $key => $val)
		{
			$test_info['Test']['gender'][] = $val;
		}
		foreach($explode_agegroup as $key => $val)
		{
			$test_info['Test']['age_group'][] = $val;
		}
		foreach($explode_symptoms as $key => $val)
		{
			$test_info['Test']['symptoms'][] = $val;
		}
		foreach($explode_speciality as $key => $val)
		{
			$profile_info['Test']['speciality'][] = $val;
		}
		foreach($explode_disease as $key => $val)
		{
			$profile_info['Test']['disease'][] = $val;
		}	
		$this->data=$profile_info;	
		$symptoms = $this->Symptoms->find('all',array('conditions'=>array('Symptoms.status'=>1),'fields'=>array('id','name')));
		$agegroup = $this->AgeGroup->find('all',array('conditions'=>array('AgeGroup.status'=>1),'fields'=>array('id','name','category')));
		$gender = $this->Gender->find('all',array('conditions'=>array('Gender.status'=>1),'fields'=>array('id','name')));
		$speciality = $this->Speciality->find('all',array('conditions'=>array('Speciality.status'=>1),'fields'=>array('id','name'),'order'=>array('Speciality.name ASC')));
		$disease = $this->Disease->find('all',array('conditions'=>array('Disease.status'=>1),'fields'=>array('id','name'),'order'=>array('Disease.name ASC')));
		$this->set('symptoms',$symptoms);
		$this->set('agegroup',$agegroup);
		$this->set('gender',$gender);
		$this->set('speciality',$speciality);
		$this->set('disease',$disease);
		$this->set('dec_test_id',$dec_profile_id);
		$this->set('testParam',$profile_info['Test']['test_parameter']);
		$this->set('testCode',$profile_info['Test']['testcode']);
	}
	
	function update_mode($data, $mode){
		switch($mode){
			case 'activate':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Test->id = $data[$ctr];
						$this->Test->saveField('status', '1');
					}
				}
				// set message
				$this->Session->setFlash('Profile(s) have been activated','flash_success');
				$this->redirect(array('controller'=>'profiles','action'=>'index'));
				break;
				case 'deactivate':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Test->id = $data[$ctr];
						$this->Test->saveField('status', '0');
					}
				}
				// set message
				$this->Session->setFlash('Profile(s) have been deactivated','flash_success');
				$this->redirect(array('controller'=>'profiles','action'=>'index'));
				break;
				case 'delete':
				$countRecords = count($data);
				for($ctr=0;$ctr<$countRecords;$ctr++){
					if($data[$ctr]){
						$this->Test->delete($data[$ctr]);
					}
				}
				// set message
				$this->Session->setFlash('Profile(s) have been deleted','flash_success');
				$this->redirect(array('controller'=>'profiles','action'=>'index'));
				break;
			break;
		}
	}
}
?>