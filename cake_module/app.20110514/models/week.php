<?php
class Week extends AppModel
{
	var $name = 'Week';

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
