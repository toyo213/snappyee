<?php
App::import('Vendor','oauth',array('file'=>'OAuth'.DS.'oauth_consumer.php'));
App::import('Xml'); 

class TwittersController extends AppController {
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
                               'http://job-tiger.com/users/index');


    // 認証後、アクセストークンを取得する際に必要なので保存
    $this->Session->write('request_token',$requestToken);


    // Twitterの認証ページにリダイレクト // this has been changed from autorize to authenticate
    //authenticate skip the login process in case you already signin w/ twitter n jobtiger
    $this->redirect('http://twitter.com/oauth/authenticate?oauth_token='.$requestToken->key);
  	
  }     
	
  // 認証後、このアクションが呼ばれる
  public function exMain() {
  	
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
                          array('count'=>0)
                          );
	 
	
    //echo $tweet;
    $xml = new Xml($tweet);
    //print_r($xml->Body);
    //pr($xml);
    //echo $xml->children[0]->children[0]->name;
    
    //name
    echo "<br/> name";
    echo $xml->children[0]->children[0]->children[11]->children[1]->children[0]->value;
    //location
    echo "<br/>location";
    echo $xml->children[0]->children[0]->children[11]->children[3]->children[0]->value;
    //bio
    echo "<br/>bio";
    echo $xml->children[0]->children[0]->children[11]->children[4]->children[0]->value;
	//img url
	echo "<br/>";
	echo $xml->children[0]->children[0]->children[11]->children[5]->children[0]->value;
    echo "<br/>URL";
	echo $xml->children[0]->children[0]->children[11]->children[6]->children[0]->value;
    
    echo  "<br/># of followers";
    echo $xml->children[0]->children[0]->children[11]->children[8]->children[0]->value;
    
    echo  "<br/># of followings";
    echo $xml->children[0]->children[0]->children[11]->children[14]->children[0]->value;
    
    echo  "<br/>";
    echo  $xml->children[0]->children[0]->children[11]->children[26]->children[0]->value;
    echo "tweets";
    
    $user=$consumer->get(
                          $accessToken->key,
                          $accessToken->secret,
                          //'http://api.twitter.com/1/user_id/show.xml'
                          "http://api.twitter.com/1/users/show.xml"
 						);
 	
 	//echo $user;
  }
}
?>
