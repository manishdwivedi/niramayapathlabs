<?php

class ActivityLog extends AppModel {

	public $actsAs = array('Containable');
    
	public $belongsTo = array('Admin');

    var $name = 'ActivityLog';

    var $useTable='activity_log';




/*$options=array(             
        'joins' =>
                  array(
                    array(
                        'table' => 'admins',
                        'alias' => 'Admin',
                        'type' => 'inner',
                        'foreignKey' => false,
                        'conditions'=> array('Admin.id = ActivityLog.admin_id')
                    )            
     )  
);*/
}
//$this->recursive = -1;
//$activity = $this->ActivityLog->find('all', $options);

?>