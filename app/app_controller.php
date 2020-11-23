<?php
class AppController extends Controller {

	var $helpers = array('Html', 'Form', 'Javascript', 'Number', 'Time', 'Fck', 'Text', 'Utility', 'Xml','Session');

	var $components = array('Email', 'Captcha', 'File', 'Image','Session','Cookie');
	var $uses	=	  array('Locale','Siteadminlang');
	//var $uses = array('Country', 'City');
	function beforeFilter(){
		//pr($_SESSION);
		
		error_reporting(E_ALL ^ E_STRICT);
		$layout = Configure::read('Routing.admin');
		if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin')
		{
			 $layout = $this->params['prefix'];
		}
		$locale=$this->getLanguage();
		Configure::write('App.encoding', 'UTF-8');
	    Configure::write('Config.language', $this->Session->read('Locale.locale_folder'));
		
		/*if(isset($this->data['Siteadminlang']['id'])){
			$locale = $this->Siteadminlang->find('first', array('conditions' => array('Siteadminlang.id'=>$this->data['Siteadminlang']['id'])));
			$this->Session->write('Siteadminlang',$locale['Siteadminlang']);
			$this->set('locale',$this->Session->read('Siteadminlang'));
	    }
	   if($this->Session->read('Siteadminlang.id')=='')
			{
		   
				$locale = $this->Siteadminlang->find('first', array('conditions' => array('Siteadminlang.default'=>'1')));
				$this->Session->write('Siteadminlang',$locale['Siteadminlang']);
				$this->set('locale',$this->Session->read('Siteadminlang'));
	   }*/

		$user_session = $this->Session->read('UserDetail');
		if(!empty($user_session['User']['id']))
		{
			$this->set('UserId',$user_session['User']['id']);
		}
		$doctor_session = $this->Session->read('DoctorDetail');
		if(!empty($doctor_session['Doctor']['id']))
		{
			$this->set('DoctorId',$doctor_session['Doctor']['id']);
		}
		$cart_test = $this->Session->read('session_test');
		if(!empty($cart_test))
		{
			$this->set('test_cart_count',count($cart_test));
		}
		else
		{
			$this->set('test_cart_count','0');
		}
		
    	
	    //echo "<pre>"; print_r(); exit;
		/*$this->set('localelist',$this->Siteadminlang->find('all', array('conditions' => array('Siteadminlang.status'=>'1'))));*/
	    
		/*$this->set('locale',$this->Siteadminlang->find('list', array('conditions' => array('Siteadminlang.status'=>'1'))));*/

		
		

		if(isset($this->params['prefix']) && trim($this->params['prefix']) == $layout){
			if(trim($this->params['action']) != 'admin_login' && trim($this->params['action']) != 'admin_logout' && trim($this->params['action']) != 'admin_forgotpassword'){
				$this->checkLogin();
			}
			$this->layout = $layout.'/default';
		}
		// setting controller for global scope
		Configure::write('App.controller', $this);
	
		$this->set('currentAction',$this->params['url']['url']);
		
		if($this->Session->check('User')){
		$User = $this->Session->read('User');
		$this->set('userLoginStatus',$User);
		//print_r($User);
		
		}
	}
	
	function getLanguage()
	{
	//echo "<pre>"; print_r($this->data); exit;
	
	if(isset($this->data['Locale']['id'])){
			$locale = $this->Siteadminlang->find('first', array('conditions' => array('Siteadminlang.id'=>$this->data['Locale']['id'])));
			$this->Session->write('Locale',$locale['Siteadminlang']);
			$this->set('locale',$this->Session->read('Locale'));
			
			return $locale;
			
	    }
	   if($this->Session->read('Locale.id')=='')
		{
		   		$locale = $this->Siteadminlang->find('first', array('conditions' => array('Siteadminlang.default'=>'1')));
				$this->Session->write('Locale',$locale['Siteadminlang']);
				$this->set('locale',$this->Session->read('Locale'));
				return $locale;
				
	   }
		
	
	
	}



	/**

	* function to check member login

	**/

	function checkUserLogin(){

		if(!$this->Session->check('userid')){

			$this->redirect('/members/login');

		}

	}
	
	


	/**

	* function to check admin login

	**/

	function checkLogin(){
		if(!$this->Session->check('Admin.id')){

			$this->redirect('/admin/admins/login');

		}

	}



	/*

	* getting company information on basis of server host

	*/

	//function 



	

	/**

	* function to create captcha

	**/

	function create(){

		$this->Captcha->create();

		exit;

	}



	/**

	* function to generate random number

	* @param $length integer

	* @return string

	**/

	function generateCode($length = 6) {

		/* list all possible characters, similar looking characters and vowels have been removed */

		$possible = '0123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$code = '';

		$i = 0;

		while ($i < $length) { 

			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);

			$i++;

		}

		return $code;

	}



	/**

	* function to generate number list as per offset

	* @return array

	**/

	function _generateList(){		

		// creating range for notice period range

		$range = array();

		$start = 1;

		$end = $start + LIST_OFFSET;

		for($ctr=$start;$ctr<$end;$ctr++){

			$range[$ctr] = $ctr;

		}

		return $range;

	}

	

	

	function random_string($type = 'alnum', $len = 32)

		{

			switch($type)

			{

				case 'alnum' :

				case 'numeric' :

				case 'nozero' :

	

				switch ($type)

				{

					case 'alnum' : $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

					break;

					case 'numeric' : $pool = '0123456789';

					break;

					case 'nozero' : $pool = '123456789';

					break;

				}



				$str = '';

				for ($i=0; $i < $len; $i++)

				{

					$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);

				}

				return $str;

				break;

				case 'unique' : return md5(uniqid(mt_rand()));

				break;

			}

		}
		
		function draw_links($id=NULL)
		{
			$parent=$this->Link->find('all',array('fields'=>array(''),'conditions'=>array('Link.parent_id'=>NULL,'Link.section_id'=>$id,'Link.status'=>1)));
			$all_links=array();
			//pr($parent);	
			foreach($parent as $key=>$pa)
			{
				$k1['link_id']=$pa['Link']['id'];
				$k1['page_id']=$pa['Link']['page_id'];
				$k1['title']=$pa['Link']['title'];
				$k1['url_disabled']=$pa['Link']['url_disabled'];
				//pr($k1);
				$k=$this->tep_get_menu($pa['Link']['id']);
				$all_links[$key][0]=$k1;
				$all_links[$key][1]=$k;
			}
			//pr($all_links);die;
			return $all_links;
			

		}
		function tep_get_menu($id=NULL , $url=NULL){
			$string='';
			$links=array();
		 // $categories_query = mysql_query("select * from website_pages where parent_id = '" . (int)$id . "' ");
		  $categories_query =$this->Link->find('all',array('conditions'=>array('Link.parent_id'=>$id)));
		// pr($categories_query);die;
			  if (count($categories_query)) {
					foreach ($categories_query as $key=>$row) {
					$links[$key]['link_id']=$row['Link']['id'];
					$links[$key]['page_id']=$row['Link']['page_id'];
					$links[$key]['title']=$row['Link']['title'];
					$links[$key]['url_disabled']=$row['Link']['url_disabled'];
					$links[$key]['seo_title']=$row['Page']['seo_title'];
					//$string=$string.'<li><a href="'.$url.'?page_id='.$row['Link']['page_id'].'">'.$row['Link']['title'].'</a>';
					//$categories_query_sub = mysql_query("select * from website_pages where parent_id = '" . $row['page_id'] . "' ");
					$categories_query_sub =$this->Link->find('all',array('conditions'=>array('Link.parent_id'=>$row['Link']['id'])));
			}
		   }
		//   pr($links);
		   return $links;
		}
		
		function __sms_message($number=NULL,$smsmessage=NULL)
		{
			$messageurl =  urlencode($smsmessage);
			//$url_sms='http://api.unicel.in/SendSMS/sendmsg.php?uname=Lotus&pass=r2u2C4l7&send=NHCare&dest=91'.$number.'&msg='.$messageurl.'&concat=1';
			//$url_sms='http://49.50.77.216/API/SMSHttp.aspx?UserId=sanjeev.malhotra@niramayahealthcare.com&pwd=pwd2016&Message='.$messageurl.'&Contacts='.$number.'&SenderId=NHCare';
			//$url_sms='http://49.50.77.216/API/SMSHttp.aspx?UserId=sanjeev.malhotra@niramayahealthcare.com&pwd=sms@npl2017&Message='.$messageurl.'&Contacts='.$number.'&SenderId=NHCare';



			 $url_sms1='http://103.233.79.246//submitsms.jsp?user=nirAmaya&key=e2ceeba388XX&mobile='.$number.'&message='.$messageurl.'&senderid=NHCare&accusage=1';


			 $ch_sms = curl_init();
			curl_setopt($ch_sms, CURLOPT_URL, $url_sms1);
			curl_setopt($ch_sms, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch_sms, CURLOPT_MAXREDIRS, 3);
			curl_setopt($ch_sms, CURLOPT_RETURNTRANSFER, TRUE);
			$data_sms = curl_exec($ch_sms);
			//echo "<pre>"; print_r($data_sms); die; 
            

		//$url_sms='https://control.msg91.com/api/sendhttp.php?authkey=152774Atw33DpkkDm591c4e8e&mobiles='.$number.'&message='.$messageurl.'&sender=NHCare&route=4&country=0';
		

	//	$url_sms='http://103.233.79.246//submitsms.jsp?user=nirAmaya&key=e2ceeba388XX&mobile='.$number.'&message='.$smsmessage.'&senderid=NHCare&accusage=1';

			

			
		/*	$ch_sms = curl_init();
			curl_setopt($ch_sms, CURLOPT_URL, $url_sms);
			curl_setopt($ch_sms, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch_sms, CURLOPT_MAXREDIRS, 3);
			curl_setopt($ch_sms, CURLOPT_RETURNTRANSFER, TRUE);
			$data_sms = curl_exec($ch_sms);
			  if($_SERVER['REMOTE_ADDR'] == '172.31.39.64'){
			    echo "<pre>"; print_r($data_sms); die; 
			  }*/
		}
		
		
		function getstatecities($state_id){
		Configure::write('debug',0);
		$this->layout = false;
		$cities = array();
		$cities = $this->City->getList(array('City.state_id' => $state_id), 'City.name ASC', null, 'id', 'name');
		$this->set('cities', $cities);
	}

        function _getProfitCategory()
        {
            $array= array();
            foreach(Configure::read('Profit.Category') as $key=>$value)
            {
                $array[$value['title']] = $value['title'].'-'.$value['desc'];
            }
            return $array;
        }

        function integrateApiCall($event=null, $request_id=null,$report_type=null)
        {
            $labstreet_lab_id = 16;
            $url="";
            $http_header = array();
            
            $post_fields = array();
            $this->Health = ClassRegistry::init('Health');
            $data = $this->Health->find('first',array('conditions'=>array('Health.id'=>$request_id,'Health.created_by'=>$labstreet_lab_id)));
            
            if(isset($data['Health']['id']) && !empty($data['Health']['id']))
            {
                //finding order id
                $this->Billing = ClassRegistry::init('Billing');
                $order_id = $this->Billing->find('first',array('fields'=>array('Billing.order_id'),'conditions'=>array('Billing.request_id'=>$request_id)));
                
                if($event == 'SentToLab')
                {
                    $post_fields = json_encode(array("requestId"=>$order_id['Billing']['order_id'],"event"=>"SentToLab"));
                    $url = "http://www.labstreet.in/api/v0/niramaya/orders/events?authorization=bmlyYW1heWFoZWFsdGhjYXJlOmxhYnN0cmVldA==";
                    $http_header = array("cache-control: no-cache","content-type: application/json");
                }
                else
                {
                    if($report_type == 'full')
                        $report_type = 'Complete';
                    else
                        $report_type = 'Partial';

                    $file_name_with_full_path = realpath("files/reports/".$data['Health']['patient_report']); 
                    $post_fields = array("requestId"=>$order_id['Billing']['order_id'],"reportType"=>$report_type,"reportFile"=>"@".$file_name_with_full_path);
                    $url = "http://www.labstreet.in/api/v0/niramaya/orders/reports?authorization=bmlyYW1heWFoZWFsdGhjYXJlOmxhYnN0cmVldA==";
                    $http_header = array("cache-control: no-cache","content-type: multipart/form-data");
                }

                $ch = curl_init();
                curl_setopt_array($ch, array(
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => $post_fields,
                  CURLOPT_HTTPHEADER => $http_header,
                ));

                $response = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);

                /*@@@@@@@@@@@@@@@@@@@@@@@@@writing error log*/
                file_put_contents("labstreet_upload.log", 'report submitted on '.date("Y-m-d H:i:s").' '.$event.' '.$report_type.' '."\r\n",FILE_APPEND | LOCK_EX);

		file_put_contents($response."\r\n",FILE_APPEND | LOCK_EX);
                /*@@@@@@@@@@@@@@@@@@@@@@@@*/

                /*if ($err) {
                  echo "cURL Error #:" . $err;
                } else {
                  echo $response;
                } */
                
                
            }
        }
}
?>