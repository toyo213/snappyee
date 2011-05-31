<?php
class UsersController extends AppController {
	var $name = 'Users';
   // var $components = array("Auth");
    var $uses = array('User', 'Fb_profile');
    
	function beforeFilter() { 
	//$this->Auth->allow('index');
	}
	
	
	function index() {
		$this->set('Users', $this->Users->find('all'));
	}
 
	function view($id = NULL) {
		if (empty($id)) {
			$myid = $this->Session->read('myid');
			$id = $myid;
		}
		
		$this->User->id = $id;
		$this->set('User', $this->User->read()) ;
		$data = $this -> User ->data;
		var_dump($this->Session->read('myid'));
		$fb_id= $data["User"]["fb_id"];
		
    		
		$this->Fb_profile ->id = $fb_id;
		$this -> Fb_profile->read();
		//var_dump($this->Fb_profile);
		print($this->Fb_profile->data['xf_profile']['name']);

		$this->set('Fb_profile', $this->Fb_profile->data['Fb_profile']);
		//$this->set('jobposts', $this->Jobpost->find('all'));
	}
	
	function fb_login(){ require("../vendors/facebook/facebook.php");
		 // Create our Application instance (replace this with your appId and secret).
		$facebook = new Facebook(array(
  		'appId'  => '105889496138624',
  		'secret' => '4c79ae3dea214d17ebdab77bed748173',
  		'cookie' => true,


		));

		// We may or may not have this data based on a $_GET or $_COOKIE based session.
		//
		// If we get a session here, it means we found a correctly signed session using
		// the Application Secret only Facebook and the Application know. We dont know
		// if it is still valid until we make an API call using the session. A session
		// can become invalid if it has already expired (should not be getting the
		// session back in this case) or if the user logged out of Facebook.
		$session = $facebook->getSession();

		$me = null;
		// Session based API call.
		
		$uid = null;
		if ($session) {
			try {
				$uid = $facebook->getUser();
				$me = $facebook->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
			}
		}

		// login or logout url will be needed depending on current user state.
		
		$loginUrl = null;
		$logoutUrl =null;
		if ($me) {
			$logoutUrl = $facebook->getLogoutUrl();
		} else {
			$loginUrl = $facebook->getLoginUrl();
		}

		$this->data = array("Fb_profile" =>
							array("name" => $me["name"],"fb_is"=>$me["id"]));
		
		$this->User->fb_id = $me["id"];
		
		$this->User->find('first', array('conditions' => array('User.fb_id' => $me["id"])));
		
		$hoge = $this->User->find('first', array('conditions' => array('User.fb_id' => $me["id"])));
		var_dump($hoge);
		
		//$this->User->read('fb_id',$me["id"]) ;
	
		var_dump($this->User);
		$id =  $this->User->myid;
	    $this->Session->write('myid', $this->User->myid);
	    $this->flash('The post with id: '.$id.' has been deleted.', '/user_home'.$id);
	    
	}

	function add() {
		if (!empty($this->data)) {
			if ($this->Jobpost->save($this->data)) {
				$this->flash('Your post has been saved.','/posts');
			pr($this->data);
			}
		}
	}
	
function delete($id) {
	$this->Jobpost->del($id);
	$this->flash('The post with id: '.$id.' has been deleted.', '/posts');
}
	
	function edit($id = null) {
	$this->Jobpost->id = $id;
	if (empty($this->data)) {
		$this->data = $this->Jobpost->read();
	} else {
		if ($this->Jobpost->save($this->data['Jobpost'])) {
			$this->flash ('Your post has been updated.','/posts');
		}
	}
}
}
?>