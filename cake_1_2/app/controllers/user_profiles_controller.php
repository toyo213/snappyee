<?php
class UserProfilesController extends AppController {
	var $name = 'UserProfiles';
	var $uses = array('User', 'Fb_profile', 'Fb_connection','Jobpost','User_profile','Career_orientation','Pics');
	// when you want to use models besides Users you have to define as $uses = array (xxxx)
   // var $components = array("Auth");
   
	function index(){
	  
	}

	function add() {  
  	if (!empty($this->data)) {
	//$t = $this ->data;	
	//$pic_a = array("name" => $t["Users"]["image"]["name"],"image" =>  );
    $this->User_profile->create();
    //var_dump($this->data);  
    if ($this->User_profile->save($this->data)) {  
      $this->Session->setFlash(__('The User has been saved', true));  
      $this->redirect(array('action'=>'index'));  
    		} else {  
      $this->Session->setFlash(__('The User could not be saved. Please, try again.', true));  
    		}  
  		}  
	}  
	
}
?>