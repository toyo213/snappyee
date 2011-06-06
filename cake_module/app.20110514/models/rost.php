<?php
class Rost extends AppModel
{
	var $name = 'Rost';

	var $validate = array(
		'title' => array(
			'rule' => array('minLength', 1),
                'required' => true,
                'message' => 'ここは必須だお'
		),
		'body' => array(
			'rule' => array('minLength', 1)
		)
	);
}
?>
