<?php
App::import('Vendor','oauth',array('file'=>'OAuth'.DS.'oauth_consumer.php'));

class ExamplesController extends AppController {
  public $autoRender=FALSE;
  public $name='Examples';
  public $uses=NULL;

  public function index() {
    $consumer=new OAuth_Consumer(
                                 'EyD1YKCi9ZzkXONqIzEGQ',
                                 'DsdFBmrAbDkox8ocEvDmXXfmRZgwpfRrRPG1K8lHV4');


    // 認証後、「http://localhost/examples/exMain」にリダイレクトする
    $requestToken=$consumer->getRequestToken(
                               'http://twitter.com/oauth/request_token',
                               'http://job-tiger.com/twitter/exMain');


    // 認証後、アクセストークンを取得する際に必要なので保存
    $this->Session->write('request_token',$requestToken);


    // Twitterの認証ページにリダイレクト // this has been changed from autorize to authenticate
    //authenticate skip the login process in case you already signin w/ twitter n jobtiger
    $this->redirect('http://twitter.com/oauth/authenticate?oauth_token='
                      .$requestToken->key);
  	echo "abc";
  }     
	
  // 認証後、このアクションが呼ばれる
  public function exMain() {
  	echo "def";
    // 認証を拒否したかどうか調べる
    if (isset($this->params['url']['denied'])) {
      echo 'access denied';
      return;
    }

	
    $consumer=new OAuth_Consumer(
                                 'EyD1YKCi9ZzkXONqIzEGQ',
                                 'DsdFBmrAbDkox8ocEvDmXXfmRZgwpfRrRPG1K8lHV4');
    $requestToken=$this->Session->read('request_token');
    $accessToken=$consumer->getAccessToken(
                              'http://twitter.com/oauth/access_token',
                              $requestToken);


    // 自分のつぶやきを一つ取得
    $tweet=$consumer->get(
                          $accessToken->key,
                          $accessToken->secret,
                          'http://api.twitter.com/1/statuses/user_timeline.xml',
                          array('count'=>1));

	
    echo $tweet;
    echo "http://api.twitter.com/1/users/show/id.xml";
 
  }
}
?>