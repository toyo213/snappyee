<?php
class PostsController extends AppController {
	// auth
	var $components = array('Auth');
    var $name = 'Posts';

    function beforeFilter() {
    	$this->Auth->authError = "ゆるされていません。";
        $this->Auth->allow('index','view');
		$this->Auth->logoutRedirect = array(Configure::read('Routing.admin') => false, 'controller' => 'posts', 'action' => 'index');//logout後のページ指定
		$this->set('user',$this->Auth->user()); // ctpで$userを使えるようにする
    }

    function index() {
    	$this->set('posts', $this->Post->find('all'));
    }
	function view($id = null) {
		$this->Post->id = $id;
		$this->set('post', $this->Post->read());
	}
	function add() {
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->flash('Your post has been saved.','/posts');
			}
		}
	}
	function delete($id) {
		$this->Post->del($id);
		$this->flash('The post with id: '.$id.' has been deleted.', '/posts');
	}
	function edit($id = null) {
		$this->Post->id = $id;
		if (empty($this->data)) {
			$this->data = $this->Post->read();
		} else {
			if ($this->Post->save($this->data['Post'])) {
				$this->flash('Your post has been updated.','/posts');
			}
		}
	}

    function logout() {
    	$this->Session->setFlash('ログアウトしました。');
        $this->redirect($this->Auth->logout());
    }
}
?>