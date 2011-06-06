<?php
class PhotosController extends AppController {

    var $helpers = array('Form', 'Html', 'Javascript', 'Time', 'Session', 'Facebook.Facebook');
    var $name = 'Photos';
    var $uses = array('User','Photo' ,'People', 'PeopleFind');
    // アクセストークン
    var $ac = '';
    var $needAuth = true;

    // ログイン必須のフラグ
    var $components = array('Auth','Facebook.Connect');

    function beforeFilter() {
        // ユーザー画面用
        if ($this->name == "Users" || $this->name =='Photos') {
            // 認証通ってればセッション保持
            if ($this->Auth->user()) {
               $this->Session->write('auth',$this->Auth->user());
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
        $this->set('fbuser',$this->Connect->user());
        
        $this->fbuser = $this->Connect->user();
        App::import('Lib', 'Facebook.FB');
        $Facebook = new FB();
        $this->fb = $Facebook;
        
        $this->ac = $this->fb->getAccessToken();
        $this->set('ac', $this->ac);

    }
    
    function main() {
        $list     = $this->Photo->find('all');
        $this->set('list',$list);
    }
    
    
}