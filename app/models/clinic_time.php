<?php
class ClinicTime extends AppModel {
	
    var $name = 'ClinicTime';
    var $useTable='clinic_time';
	
	var $hasMany = array(
			'BookAppointment' => array(
				'className'  => 'BookAppointment',
				'foreignKey'  => 'clinic_time_id'
			)
		);
}
?>