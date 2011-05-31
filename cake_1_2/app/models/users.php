<?php
class User extends AppModel
{
	var $name = 'User';

	var $validate = array(
		'id' => array(
			'rule' => array('minLength', 1)
		),
		'fbid' => array(
			'rule' => array('minLength', 1)
		)
	);
}
?>