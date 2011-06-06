<?php
class UsersController extends AppController {

    var $helpers = array('Form', 'Html', 'Javascript', 'Time', 'Session', 'Facebook.Facebook');
    var $name = 'Users';
    var $uses = array('User', 'People', 'PeopleFind');
    
    var $needAuth = true;
      // ログイン必須のフラグ
    var $components = array('Auth','Facebook.Connect');

    function beforeFilter() {

        // FB
        $this->Auth->allow('*');
        $this->set('user', $this->Auth->user());
        $this->set('fbuser',$this->Connect->user());
        //pr($this->Session->read('auth'));
        //pr($this->Facebook->getAccessToken());
        //pr($this->Connect->user());
        //pr($this->Auth->user());
        App::import('Lib', 'Facebook.FB');
        $Facebook = new FB();
        //pr($Facebook->api('/me'));
        //pr($Facebook->getAccessToken());
        $ac_tk = $Facebook->getAccessToken();
        $friends = $Facebook->api('/me/friends','GET',array('access_token'=>$ac_tk),array('fields'=>'id,name,picture'));
        //pr($friends);
        foreach ($friends['data'] as $key => $val) {
             $pt ='<img src="https://graph.facebook.com/%s/picture" alt="profile" />';
             echo sprintf($pt,$val['id']);
        }

        $this->Auth->allow('people', 'index', 'add', 'fbtry');
        // ユーザー画面用
        if ($this->name == "Users") {
            // セッションから取り出したログイン情報をセット
            $auth = $this->Session->read('auth');
            $this->set('auth', $auth);
            // ログイン必須の機能でログインされていない場合はログイン画面へ転送
            if ($this->needAuth && $this->action != 'login') {
                if (empty($auth)) {

                    //     $this->redirect('/users/login/');
                    //     exit;
                }
            }
        }
    }

    //Add an email field to be saved along with creation.
    function beforeFacebookSave() {
        var_dump($this->Connect);
        $this->Connect->authUser['User']['email'] = $this->Connect->user('email');
        return true; //Must return true or will not save.
    }

    function fbtest() {

    }

    function twitter() {
        $options['fields'] = array('people.name', 
                                   'PeopleFind.comment',
                                   'PeopleFind.ido',
                                   'PeopleFind.kdo',
                                   'PeopleFind.spot_name',
                                   'PeopleFind.ts');
        $options['order'] = array('PeopleFind.ts DESC');
        $options['joins'] = array(
            array(
                'table' => 'people',
                'alias' => '',
                'type' => 'LEFT',
                'conditions' => array(
                    'people.id = PeopleFind.id',
                )
            )
        );

        $list = $this->PeopleFind->find('all', $options);

        //$list = $this->PeopleFind->findAll();
        $this->set('list', $list);
    }

    function map() {
    } 

    function home() {


    } 

    function login()
    {

        // ページタイトルの設定
        $this->pageTitle = 'Web-local.community「local.SNS」';
        // データが送られてきたら
        if (!empty($this->data)) {
            // パスワードを暗号化
            $this->data['User']['password'] = md5($this->params['form']['password']);
//var_dump(md5("test"));
//var_dump($this->params['form']['password']);
            // 入力された[id]と[pwd]がデータベースにある場合のみ[$user_data]に値が入る
            $user_data = $this->User->findByUsernameAndPassword($this->data['User']['username'], $this->data['User']['password']);
            ##$user_data = $this->User->findByPassword($this->data['User']['password']);


            // [$user_data]が空じゃなければ
            if (!empty($user_data)) {
                // 値をセッションに格納
                $this->Session->write('auth', $user_data['User']);
//var_dump($user_data);
                // リダイレクトする
                $this->redirect('/users/people');
                exit;
            } else { // [$user_data]が空ならログイン画面へ
                // エラーメッセージをビューに渡す
                $this->set('login_error', 'ログインできませんでした・・・');
                // ログイン画面の呼出
                $this->render('login');
            }
        }
    }

    function add() {
        // $this->dataが空でなければ
        if(!empty($this->data)) {
            if($this->data) {
                // ユーザレコードにユーザ情報を保存する
                $this->User->create();

                $data = array();
                $data['User']['password']  = md5($this->params['form']['password']);
                $data['User']['username']  = $this->data['User']['username'];
                $this->User->save($data);
                // 保存したらLoginページにリダイレクト
                $this->redirect(array('action' => 'login'));
            }
        }
    }

    /*
     * ログアウト処理
     */
    function logout()
    {
        // セッションを破棄してログイン画面へ
        $this->Session->delete('auth');
        $this->Session->delete('fbsession');
        $this->redirect('/users/login');
        exit;
    }

    function people_add()
    {
         $name = $this->params['named']['name'];
//var_dump($this->params);
         $list = $this->People->findAll(array('name' => $name));
         $this->set('name',$name);
         $this->set('list',$list);
    }

    function fbtry()
    {
    }


    function people_confirm()
    {
        var_dump($this->data);
        var_dump($this->PeopleFind->save($this->data));
    }



    function people($name = NULL ,$selectname =NULL)
    {

        $fn = 'あ';
        $selectname=isset($this->params['url']['fn'])?$this->params['url']['fn']:$fn;
        $likename = sprintf('%s%%',$selectname);
        if (!is_null($selectname)) {
            $list = $this->People->find('all',array('name_kana LIKE' => $likename));
            $this->set('list',$list); 
            $this->set('fn',isset($this->params['url']['fn'])?$this->params['url']['fn']:$fn); 
        }
    }

    function fblogin() {
            require('/home/soogle/cake_module/app/plugins/fb/facebook.php');
            $facebook = new Facebook(array(
                        'appId' => '102978646442980',
                        'secret' => 'b926e265f482ae97e91e75872000ecd2',
                        'cookie' => true,
                    ));

            $session = $facebook->getSession();
            var_dump($session);
            if (!$session) {
                $url = $facebook->getLoginUrl(array(
                            'canvas' => 1,
                            'fbconnect' => 0,
                            'req_perms' => 'status_update,publish_stream' // ステータス更新とフィードへの書き込み許可
                        ));

                print $url;
                exit;
                // アプリ未登録ユーザーなら facebook の認証ページへ遷移
                echo "<script type='text/javascript'>top.location.href = '$url';</script>";
            } else {
                try {
                    $me = $facebook->api('/me'); // 自分の情報を取得
                    $uid = $facebook->getUser(); // 自分のユーザー ID を取得
                } catch (FacebookApiException $e) {
                    $error = "Error : something is wrong, please try again later.";
                    exit();
                }
            }
            $this->set('uid', $uid);
            $this->set('me', $me);
        }

}
