<?php
class PackagelistsController extends AppController
{

	var $name = "Packagelists";

	var $breadcrumb = array();

	var $uses=array('PackageList','PackageListTest','PackageListTestItem');

	var $helpers = array('Form','Html','Javascript', 'Ajax');


	// Function Used to show all package list
	function package()
	{


		$this->layout = 'tests';

		$this->set('title_for_layout','Preventive Health Checkups, Pathology Lab in Delhi, NCR, Top Ten Labs in Noida, Checkup for Executive');
		$this->set('page_description','Niramaya Path Lab offers Executive health check up buy programs and Pre-Employment Health Check-ups and Preventive/buy executive with wholebody Health check-ups. Niramaya Path Lab basic provides a wide range of health screening solutions along with value added services.');
		$this->set('page_keyword','Executive Health Check Up, Health Checkup packages, Buy Executive Health Check Up, Niramaya Basic Health Check Up, Wholebody Health Check Up');

		
		// To get all package List
		$packageList = $this->PackageList->find('all',array('conditions'=>array('PackageList.status'=>1),'order'=>array('PackageList.id'=>'ASC')));
		$packageListId=array();
		foreach($packageList as $key=>$value)
		{
			$packageListId[]=$value['PackageList']['id']; 
		}
		// To get all package Test
		$packageListTest=$this->PackageListTest->find('all',array('conditions'=>array('PackageListTest.status'=>1),'order'=>array('PackageListTest.sr_no'=>'ASC')));
		$packageListTestId=array();
		foreach($packageListTest as $key=>$value)
		{
			$packageListTestId[]=$value['PackageListTest']['id'];
		}
		// To get all package List Test Item
		$packageListTestItem=$this->PackageListTestItem->find('all',array('conditions'=>array('PackageListTestItem.package_id'=>$packageListId,'PackageListTestItem.package_test_id'=>$packageListTestId)));
		
		$this->set('packageList',$packageList);
		$this->set('packageListTest',$packageListTest);
		$this->set('packageListTestItem',$packageListTestItem);

	}
}
?>