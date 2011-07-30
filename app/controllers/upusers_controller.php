<?php 
class UpusersController extends AppController {

	var $helpers = array('Form', 'Html', 'Javascript', 'Time', 'Session', 'Facebook.Facebook');
	var $name = 'Users';
	var $uses = array('User','Photo','Photo_like_log');
	//var $uses = array('User','Photo' ,'Photo_like');

        // 言語判定
        var $isJpn = false;

        
	// アクセストークン
	var $ac = '';
	var $needAuth = true;

	// ログイン必須のフラグ
	var $components = array('Auth','Facebook.Connect');

        function main() {
            var_dump('aaa');
            var_dump($this->params);exit;
        }
        
        
}