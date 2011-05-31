<?php
class Fb_profile extends AppModel
{
	var $name = 'Fb_profile';

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