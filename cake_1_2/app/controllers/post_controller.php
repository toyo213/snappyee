<?php
class PostController extends AppController {

	var $name = 'Posts';

	function index() {
		$this->set('posts', $this->Post->find('all'));
	}
}
?>