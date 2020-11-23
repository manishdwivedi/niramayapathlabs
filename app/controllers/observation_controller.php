<?php

class ObservationController extends AppController {
	
	var $name = "Observation";

	var $breadcrumb = array();

	var $uses=array('Observation','Samplemaster');

	var $helpers = array('Form','Html','Javascript', 'Ajax','Utility');

	public $components = array('RequestHandler','Cookie','Utility');

	public $paginate = array('maxLimit' => 10);

	function admin_index()
	{
		$this->Observation = ClassRegistry::init("Observation");
		if($this->data)
		{
			$conditions = array();
			$conditions['Observation.observation_name LIKE'] =  "%".$this->data['Filter']['title']."%";
			$this->paginate = array('Observation' => array('limit' =>'20','order'=>array('Observation.observation_name'=>'ASC'),'conditions'=>$conditions));
		}
		else
		{
			$this->paginate = array('Observation' => array('limit' =>'20','order'=>array('Observation.observation_name'=>'ASC')));
		}
		$this->Samplemaster = ClassRegistry::init("Samplemaster");
		$sampletype = $this->Samplemaster->find('list',array('fields'=>array('Samplemaster.sample_id','Samplemaster.type')));
		
		$observationlist=$this->paginate('Observation');
		//print_R($observationlist);
		$gender = array("F"=>"Female","M"=>"Male","B"=>"Both");
		
		$observation = array();
		$count = 0;
		foreach($observationlist as $val)
		{
			//print_R($val);echo "<br><br>";
			$observation[$count]['Observation']['id'] = $val['Observation']['observation_id'];
			$observation[$count]['Observation']['name'] = $val['Observation']['observation_name'];
			$observation[$count]['Observation']['method'] = $val['Observation']['method'];
			$observation[$count]['Observation']['machine'] = $val['Observation']['machine'];
			$observation[$count]['Observation']['gender'] = $gender[$val['Observation']['gender']];
			$observation[$count]['Observation']['os_inhouse'] = $val['Observation']['os_inhouse'];
			$observation[$count]['Observation']['department'] = $val['Observation']['department'];
			$observation[$count]['Observation']['sample_type'] = $sampletype[$val['Observation']['sample_type']];
			$count++;
		}
		//print_R($observation);die;
		$this->set('observation',$observation);
	}
	
	function admin_add_observation()
	{
		$this->Observation = ClassRegistry::init("Observation");
		$this->set('title_for_layout', 'Add Observation');
		
		$this->Samplemaster = ClassRegistry::init("Samplemaster");
		
		$machine = $this->Observation->find('list',array('fields'=>array('Observation.machine','Observation.machine')));
		$gender = array("F"=>"Female","M"=>"Male","B"=>"Both");
		$os_inhouse = $this->Observation->find('list',array('fields'=>array('Observation.os_inhouse','Observation.os_inhouse')));
		$department = $this->Observation->find('list',array('fields'=>array('Observation.department','Observation.department')));
		
		$machinelist = array();
		
		if($this->data)
		{
			if(isset($this->data['Observation']['customselectmachine']) && $this->data['Observation']['customselectmachine']!="")
				$this->data['Observation']['machine'] = $this->data['Observation']['customselectmachine'];
			
			if(isset($this->data['Observation']['customselectosinhouse']) && $this->data['Observation']['customselectosinhouse']!="")
				$this->data['Observation']['os_inhouse'] = $this->data['Observation']['customselectosinhouse'];
			
			if(isset($this->data['Observation']['customselectdepartment']) && $this->data['Observation']['customselectdepartment'])
				$this->data['Observation']['department'] = $this->data['Observation']['customselectdepartment'];
			
			$this->data['Observation']['active'] = '1';

			$this->Observation->create();
			$this->Observation->save($this->data);
			$this->Session->setFlash('Observation Successfully Saved','flash_success');
			$this->redirect('/admin/observation/index/');
		}
		
		foreach($machine as $val)
		{
			$macArray = explode(",",$val);
			foreach($macArray as $val1)
			{
				$macData = strtoupper(trim($val1));
				if(count($machinelist)==0)
					$machinelist[$macData] = $macData;
				else
				{
					if(!in_array($macData,$machinelist))
					{
						$machinelist[$macData] = $macData;
					}
				}
			}
		}
		
		$sampletype = $this->Samplemaster->find('list',array('fields'=>array('Samplemaster.sample_id','Samplemaster.type')));
		
		$machinelist = array_filter($machinelist);
		unset($machinelist['?']);
		$os_inhouse = array_filter($os_inhouse);
		unset($os_inhouse['?']);
		$department = array_filter($department);
		
		$machinelist['Others'] = "Others";
		$os_inhouse['Others'] = "Others";
		$department['Others'] = "Others";
				
		$this->set('machinelist',$machinelist);
		$this->set('gender',$gender);
		$this->set('os_inhouse',$os_inhouse);
		$this->set('department',$department);
		$this->set('sampletype',$sampletype);
		
		/*print_R($machinelist);
		echo "<br><br><br>";
		print_R($gender);
		echo "<br><br><br>";
		print_R($os_inhouse);
		echo "<br><br><br>";
		print_R($department);
		echo "<br><br><br>";*/
		//print_R($sampletype);
		//die;
	}
	
	function admin_edit_observation($obs_id=null)
	{

		$dec_obs_id = base64_decode($obs_id);
		$this->Observation = ClassRegistry::init("Observation");
		$observation = $this->Observation->find('first',array('conditions'=>array('Observation.observation_id'=>$dec_obs_id)));
		$this->Samplemaster = ClassRegistry::init("Samplemaster");
		$sampletype = $this->Samplemaster->find('list',array('fields'=>array('Samplemaster.sample_id','Samplemaster.type')));
		
		$machine = $this->Observation->find('list',array('fields'=>array('Observation.machine','Observation.machine')));
		$gender = array("F"=>"Female","M"=>"Male","B"=>"Both");
		$os_inhouse = $this->Observation->find('list',array('fields'=>array('Observation.os_inhouse','Observation.os_inhouse')));
		$department = $this->Observation->find('list',array('fields'=>array('Observation.department','Observation.department')));
		
		foreach($machine as $val)
		{
			$macArray = explode(",",$val);
			foreach($macArray as $val1)
			{
				$macData = strtoupper(trim($val1));
				if(count($machinelist)==0)
					$machinelist[$macData] = $macData;
				else
				{
					if(!in_array($macData,$machinelist))
					{
						$machinelist[$macData] = $macData;
					}
				}
			}
		}
		
		if($this->data)
		{
			
			//$this->data['Observation']['observation_id'] = $dec_obs_id;
			if(isset($this->data['Observation']['customselectmachine']) && $this->data['Observation']['customselectmachine']!="")
				$this->data['Observation']['machine'] = $this->data['Observation']['customselectmachine'];
			
			if(isset($this->data['Observation']['customselectosinhouse']) && $this->data['Observation']['customselectosinhouse']!="")
				$this->data['Observation']['os_inhouse'] = $this->data['Observation']['customselectosinhouse'];
			
			if(isset($this->data['Observation']['customselectdepartment']) && $this->data['Observation']['customselectdepartment'])
				$this->data['Observation']['department'] = $this->data['Observation']['customselectdepartment'];
			
			//$this->Observation->create();
			$this->Observation->query("update observations set 
										observation_name='".$this->data['Observation']['observation_name']."', 
										method='".$this->data['Observation']['method']."', 
										machine='".$this->data['Observation']['machine']."', 
										os_inhouse='".$this->data['Observation']['os_inhouse']."', 
										department='".$this->data['Observation']['department']."',
										nabl ='".$this->data['Observation']['nabl']."',
										gender='".$this->data['Observation']['gender']."',
										active='1',
										sample_type='".$this->data['Observation']['sample_type']."' where observation_id='".$this->data['Observation']['observation_id']."'");
			//$this->Observation->observation_id = $dec_obs_id;
			//$this->Observation->save($this->data);
			$this->Session->setFlash('Observation Successfully Updated','flash_success');
			$this->redirect('/admin/observation/index/');
		}
		
		$sampletype = $this->Samplemaster->find('list',array('fields'=>array('Samplemaster.sample_id','Samplemaster.type')));
		
		$machinelist = array_filter($machinelist);
		unset($machinelist['?']);
		$os_inhouse = array_filter($os_inhouse);
		unset($os_inhouse['?']);
		$department = array_filter($department);
		
		$machinelist['Others'] = "Others";
		$os_inhouse['Others'] = "Others";
		$department['Others'] = "Others";
		
		$this->set('title_for_layout', 'Edit Observation');
		$this->set('machinelist',$machinelist);
		$this->set('gender',$gender);
		$this->set('os_inhouse',$os_inhouse);
		$this->set('department',$department);
		$this->set('sampletype',$sampletype);
		$this->data = $observation;
	}
}