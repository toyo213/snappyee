<?php
class Fb_connection extends AppModel
{
	var $name = 'Fb_connection';

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