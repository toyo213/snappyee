<?php
class Upload extends AppModel{
	
	var $name = 'Upload';

	var $validate = array(
		'title' => array(
			'rule' => array('minLength', 1)
		),
		'body' => array(
			'rule' => array('minLength', 1)
		)
	);
}
?>