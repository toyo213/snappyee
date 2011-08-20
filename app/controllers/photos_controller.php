<?php

class PhotosController extends AppController {

    var $helpers = array('Form', 'Html', 'Javascript', 'Time', 'Session', 'Facebook.Facebook');
    var $name = 'Photos';
    var $uses = array('User', 'Photo','Photo_pv');
    // アクセストークン
    var $ac = '';
    var $needAuth = true;
    // ログイン必須のフラグ
    var $components = array('Auth', 'Facebook.Connect');

    function beforeFilter() {
        // ユーザー画面用
        if ($this->name == "Users" || $this->name == 'Photos') {
            // 認証通ってればセッション保持
            if ($this->Auth->user()) {
                $this->Session->write('auth', $this->Auth->user());
            }

            //var_dump($this->Auth->user());
            //var_dump($this->Session->read('auth'));
            //
            // ログイン必須の機能でログインされていない場合はログイン画面へ転送
            if ($this->needAuth && $this->action != 'login') {
                if (!$this->Session->read('auth')) {
                    $this->redirect('/users/login/');
                    exit;
                }
            }
        }
        // 初回来訪ユーザなら、直接アクセスしてきたページにリダイレクト TODO
        // FB基本設定
        $this->Auth->allow('*');
        $this->set('user', $this->Auth->user());
        $this->set('fbuser', $this->Connect->user());

        $this->fbuser = $this->Connect->user();

        App::import('Lib', 'Facebook.FB');
        $Facebook = new FB();
        $this->fb = $Facebook;

        $this->ac = $this->fb->getAccessToken();
        $this->set('ac', $this->ac);
        
        
        $this->set('user', $this->Session->read('user'));
        $this->layout = "default.bak0602";
    }

    function main() {
        $photo_list = $this->Photo->find('all',array('conditions' => array('Photo.fb_id' =>$this->fbuser['id'])));
     
        $pid = $this->params['pass']['2'];
	$photo_pv = $this->Photo_pv->find('all',array('conditions' => array('Photo_pv.pid' =>$pid)));
	    
        // データ集計
        // ほかのユーザからは見えないようにする
        $this->set('list', $photo_list);
        $this->set('pv', $photo_pv);
        $this->set('pid', $pid);        
   }

}