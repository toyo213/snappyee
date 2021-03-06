<?php 
// app/controllers/example_controller.php
class ExampleController extends AppController {
    public $uses = array();
    public $components = array('OauthConsumer');

    public function twitter() {
        $requestToken = $this->OauthConsumer->getRequestToken('Twitter', 'http://twitter.com/oauth/request_token', 'http://test.localhost/example/twitter_callback');
        $this->Session->write('twitter_request_token', $requestToken);
        $this->redirect('http://twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
    }

    public function twitter_callback() {
        $requestToken = $this->Session->read('twitter_request_token');
        $accessToken = $this->OauthConsumer->getAccessToken('jobtiger411', 'http://twitter.com/oauth/access_token', $requestToken);

        $this->OauthConsumer->post('Twitter', $accessToken->key, $accessToken->secret, 'http://twitter.com/statuses/update.json', array('status' => 'hello world!'));
    }
}

?>