<?php
class JobpostsController extends AppController {
	var $name = 'Jobposts';
   // var $components = array("Auth");
    
    
	function beforeFilter() { 
	//$this->Auth->allow('index');
	}
	
	function index() {
		$this->set('jobposts', $this->Jobpost->find('all'));
	}

	function view($id) {
		$this->Jobpost->id = $id;
		$this->set('jobpost', $this->Jobpost->read());

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
