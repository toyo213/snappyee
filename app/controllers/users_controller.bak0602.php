<?php
class UsersController extends AppController {

    var $helpers = array('Form', 'Html', 'Javascript', 'Time', 'Session', 'Facebook.Facebook');
    var $name = 'Users';
    var $uses = array('User','Photo' ,'People', 'PeopleFind');
    // アクセストークン
    var $ac = '';
    var $needAuth = true;

    // ログイン必須のフラグ
    var $components = array('Auth','Facebook.Connect');

    function beforeFilter() {

        // ユーザー画面用
        if ($this->name == "Users") {
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

    //Add an email field to be saved along with creation.
    function beforeFacebookSave() {
        $this->Connect->authUser['User']['email'] = $this->Connect->user('email');
        return true; //Must return true or will not save.
    }

    function fbtest() {
                      
        if (isset($this->params['url']['aid'])) {
            $fql_query = array(
                'method' => 'fql.query',
                'query' => sprintf('SELECT src,src_big,pid,aid,src_small  FROM photo WHERE aid IN  ( SELECT aid FROM album WHERE aid = %s )', $this->params['url']['aid']
                )
            );
        } elseif (isset($this->params['url']['pid'])) {
            $fql_query = array(
                'method' => 'fql.query',
                'query' => sprintf('SELECT src,src_big,pid,aid  FROM photo WHERE pid =%s )', $this->params['url']['pid']
                )
            );
        } else {
            // TODO visibleがeveryone or custmor のものだけ表示させる
            $fql_query = array(
                'method' => 'fql.query',
                'query' => sprintf('SELECT src,src_big,src_small,pid,aid  FROM photo WHERE pid IN ( SELECT cover_pid FROM album WHERE owner=%s )',
                        //$this->params['url']['aid'],
                        $this->fbuser['id']
                )
            );
        }
        
        //pr($fql_query);
        $albums =  $this->fb->api($fql_query, array('access_token' => $this->ac));   
        //var_dump($albums);
        $friends = $this->fb->api('/me/friends', 'GET', array('access_token' => $this->ac), array('fields' => 'id,name,picture'));
        // facebook album一覧を取得する
        // album一覧からalbumの中身をみる
        // 選んだ写真を投票する(DBにいれる)
        // ユーザが投稿した写真を一覧で表示
        // ユーザがいいね写真を投票できる
        // 投票データを集計する
        // ランキングを一覧で表示する
        // 写真に似ている洋服名をタグ付けできる
        //$albums = $this->fb->api('/me/albums', 'GET', array('access_token' => $this->ac), array('fields' => 'id,aid,name,location,description'));
        //$url = file_get_contents('https://graph.facebook.com/1713040105885/photos?access_token=' . $this->ac);
        //$data = (json_decode($url));
        $this->set('prm',$this->params['url']);
        $this->set('friends',$friends);
        $this->set('albums',$albums);
    }
    
    function fbpict_up() {
        if (isset($this->params['url']['pid'])) {
            $fql_query = array(
                'method' => 'fql.query',
                'query' => sprintf('SELECT pid,aid,src,src_big  FROM photo WHERE pid IN (%s)', $this->params['url']['pid']),
                'access_token' => $this->ac
            );
        }
        $albums =  $this->fb->api($fql_query);   
        var_dump($albums);
        $this->set('albums',$albums);
   }

    function fbpict_add() {
    // validate
    // save 
    // redirect
                pr($this->params);
                $data['Photo']['category_id']  = $this->params['data']['users']['category_id'][0];
                $data['Photo']['fbpath']  = $this->params['data']['Photo']['fb_path'];
                $data['Photo']['fb_id']  =  $this->fbuser['id'];
                $this->Photo->save($data);
        
        
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

        //$list     = $this->PeopleFind->findAll();
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

            // 入力された[id]と[pwd]がデータベースにある場合のみ[$user_data]に値が入る
            $user_data = $this->User->findByUsernameAndPassword($this->data['User']['username'], $this->data['User']['password']);
            ##$user_data = $this->User->findByPassword($this->data['User']['password']);


            // [$user_data]が空じゃなければ
            if (!empty($user_data)) {
                // 値をセッションに格納
                $this->Session->write('auth', $user_data['User']);

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
        // 強制ログアウト
        $this->Auth->logout();
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

    function fbtry() {

    }
    
    function photo_up() {
        $img_name = $_FILES["img_path"]["name"];
        $img_size = $_FILES["img_path"]["size"];
        $img_type = $_FILES["img_path"]["type"];
        $img_tmp = $_FILES["img_path"]["tmp_name"];

        //At the timpre of writing it is necessary to enable upload support in the Facebook SDK, you do this with the line:
        $this->fb->setFileUploadSupport(true);

        $albums = $this->fb->api('/me/albums', 'GET', array('access_token' => $this->ac), array('fields' => 'id,name,location,description'));
        $alb = array();

        foreach ($albums['data'] as $key => $val) {
            $alb[$val['name']] = $val['id'];
        }
        //Create an album
        $album_details = array(
            'message' => 'junle',
            'name' => 'geegee'
        );

        if (!isset($alb['geegee'])) {
            $create_album = $this->fb->api('/me/albums', 'post', $album_details);
            //Get album ID of the album you've just created
            $album_uid = $create_album['id'];
        } else {
            $album_uid = $alb['geegee'];
            //$album_uid = '205722169464685';
            // ここをfanpageのalbumidにすれば動くはずなのだが。。ｓ
        }

        //Upload a photo to album of ID...
        $photo_details = array(
            'message' => 'Photo message'
        );

        $photo_details['image'] = $img_tmp . '/' . $img_name;

        if (is_uploaded_file($img_tmp)) {
            if (!is_dir(sprintf('/home/soogle/tmp/pict/%s', $this->fbuser['id']))) {
                mkdir(sprintf('/home/soogle/tmp/pict/%s', $this->fbuser['id']), 0777);
            }
            $path = sprintf('/home/soogle/tmp/pict/%s/%s', $this->fbuser['id'], $img_name);
            copy($img_tmp, $path);
        }
        $photo_details['image'] = '@' . $path;
        $photo_details['access_token'] = $this->ac;
        
        $this->fb->api('/' . $album_uid . '/photos', 'post',$photo_details);
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
