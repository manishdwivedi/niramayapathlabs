<?php
class BookAppointment extends AppModel {
	
    var $name = 'BookAppointment';
    var $useTable='book_appointment';
	
	var $belongsTo = array(
				'ClinicTime' => array(
				'className' => 'ClinicTime',
				'foreignKey' => 'clinic_time_id',
				'conditions' => array(
					'BookAppointment.status' => 1
				)
				)
		);
}
?>