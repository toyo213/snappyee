<?php
class User extends AppModel{
		var $name = 'User';
		var $validate = array(
         'email' => array(
     		'rule'=>array('email',true),
            'message'=>'<span style=color:red>please provide correct email address 正しいEmailアドレスを入力してください</span>'
            )
        );
    
}
?>