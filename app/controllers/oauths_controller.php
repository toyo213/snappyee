<?php

App::import('Vendor', 'oauth', array('file' => 'OAuth' . DS . 'oauth_consumer.php'));

class OauthsController extends AppController {
    var $helpers = array('Form', 'Html', 'Javascript', 'Time', 'Thgoogle');
    //var $name = array('Users','Oauths');
    //var $uses = array('User', 'People', 'PeopleFind');
    public $uses = array();

    public function twitter() {
        $consumer = $this->createConsumer();
        $requestToken = $consumer->getRequestToken('http://twitter.com/oauth/request_token', 'http://ck.soogle.me/users/input');
        $this->Session->write('twitter_request_token', $requestToken);
        $this->redirect('http://twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
    }

    public function twitter_callback() {
        $requestToken = $this->Session->read('twitter_request_token');
        $consumer = $this->createConsumer();
        $accessToken = $consumer->getAccessToken('http://twitter.com/oauth/access_token', $requestToken);
        $consumer->post($accessToken->key, $accessToken->secret,
                'http://twitter.com/statuses/update.json', array('status' => 'hello world!'));
    }

    private function createConsumer() {
        return new OAuth_Consumer('5iekEteCNEWBT6gVmMdhQQ', '0uOugCmbFgFtIbCpyHC4fWDTnExSMhyN9pwteXp98');
    }

}

