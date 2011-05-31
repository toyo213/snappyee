<?php
class Employer extends AppModel
{
	//   function beforeValidate() {
	//     debug($this->data);
	//  }
	var $name = 'Employer';
	var $validate = array(
            'T&C' => array(
               'rule' => array('comparison', '>', 0), 
               'message' => '<span style=color:red>Please fill out the T&C check box　利用規約に同意してください </span>'
               ),
         'email' => array(
     		'rule'=>array('email',true),
            'message'=>'<span style=color:red>please provide correct email address 正しいEmailアドレスを入力してください</span>'
            ),
         'username' => array(
            'alphanumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => '<span style=color:red>  Alphabets and numbers only アルファベットと数字の組み合わせのみです。 </span>'
                )),
         'passwd'=>array(
            	'alphanumeric' => array(
                'rule' => 'alphaNumeric',    
                'required' => true,
                'message' => '<span style=color:red> Password: Alphabets and numbers only パスワードはアルファベットと数字の組み合わせのみです。 </span>'
                			))
                );
                /*
                 var $validate = array(
                 'username' => array(
                 'alphanumeric' => array(
                 'rule' => 'alphaNumeric',
                 'required' => true,
                 'message' => 'Alphabets and numbers only'
                 ),
                 'between' => array(
                 'rule' => array('between', 5, 15),
                 'message' => 'Between 5 to 15 characters'
                 )
                 ),
                 'passwd' => array(
                 'rule' => array('minLength', '5'),
                 'message' => 'Mimimum 5 characters long'
                 ),
                 'email' => 'email'
                 );
                 */

}
?>
