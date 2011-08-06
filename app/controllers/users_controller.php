<?php
class UsersController extends AppController {

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
        

        
        function beforeFilter() {

		Configure::load('messages');
		preg_match(('/.*(ja|jp).*/'),$_SERVER['HTTP_ACCEPT_LANGUAGE'],$match);
                if(count($match) > 0 ) {
                    $this->isJpn = true;
                    $this->set('category',Configure::read('category.jpn'));
		} else {
			$this->set('category',Configure::read('category.en'));
		}

		$this->Auth->allow('regist','regist_end');

		$list = $this->Photo->find('all',array('order' => array('Photo.id DESC'),
                                              'conditions' => array(),
                                    'limit' => '20'));

                $this->set('list', $list);

                // 初回来訪ユーザなら、直接アクセスしてきたページにリダイレクト TODO
		// ユーザDBに登録がない場合は、遷移してニックネームの登録をうながす
		$this->fbuser = $this->Connect->user();
        
		// fbに登録していないユーザはFBログインをうながす

                $user_data = array();
		$user_data = $this->Connect->user();
		$this->set('fbuser',$user_data);

                if($this->action == 'howto') {
                        
                }elseif (is_null($user_data)&& $this->action =='firstlogin') {
	                $this->render('/users/firstlogin', 'default.bak0602');                    
                }elseif (is_null($user_data) && $this->action !='login') {
                   // facebookにログインしてねページ！
                   $this->redirect('/users/firstlogin/');
                } elseif (!is_null($user_data)&& $this->action =='firstlogin') {
                   // facebookにログインしてねページ！
                   $this->redirect('/');                    
                }

                //TODO 毎回DB接続もやなので、一度認証したら、SELECTしないようにする
		$user_list = $this->User->findByFbId($user_data['id']);

		// FBにログインがあってかつDBに登録がないユーザは初回登録が必要
		if (empty($user_list) && $this->Connect->user()) {
			if ($this->params['action'] == 'regist_end') {
				$this->render('/users/regist_end', 'default.bak0602');
			} else {
				//$this->redirect('/users/login/');
				//$this->redirect(array('action' => 'regist'));
				//$this->render('/users/regist', 'default.bak0602');
				//$this->redirect('/users/regist/');
				$this->super_render();			
			}
		}else {
			// FB基本設定
			$this->Session->write('auth','111');
			$this->Session->write('user',$user_list);
			//$this->Auth->login($this->Connect->user());
			//$this->set('user', $this->Auth->user());
		}

		// TODO ユーザデータ登録
		// TODO 認証済みのユーザはログインボタンは出さない
		//
		// ユーザー画面用
		if ($this->name == "Users") {
			// 認証通ってればセッション保持
			if ($this->Auth->user()) {
				$this->Session->write('auth',$this->Auth->user());
			}

			// ログイン必須の機能でログインされていない場合はログイン画面へ転送
			if ($this->needAuth && $this->action != 'login' ) {
				if (!$this->Session->read('auth') && $this->action != 'regist_end' ) {
					exit;$this->redirect('/users/login/');
					exit;
				}
			}
		}

		$this->Auth->allow('*');
		App::import('Lib', 'Facebook.FB');
		$Facebook = new FB();
		$this->fb = $Facebook;
		$this->ac = $this->fb->getAccessToken();
		$this->set('ac', $this->ac);
		$this->set('user', $this->Session->read('user'));
		$this->layout = "default.bak0602";
	}
	
		function super_render(){
        	$this->render('/users/regist','default.bak0602');
        	Configure::load('magazines');
        	$mag = Configure::read('magazines.name1');
            var_dump($mag);
        	$this->set('magazines',$mag);
        }
        
	//Add an email field to be saved along with creation.
	function beforeFacebookSave() {
		$this->Connect->authUser['User']['email'] = $this->Connect->user('email');
		return true; //Must return true or will not save.
	}

	function regist() {
		Configure::load('magazines');
        $mag = Configure::read('magazines.name1');
        //var_dump($mag);
        $this->set('magazines',$mag);
	}

	function regist_end() {		
            $data['User']['nickname'] = $this->params['data']['User']['nickname'];
            $data['User']['blogurl'] = $this->params['data']['User']['blogurl'];
            $data['User']['fb_id'] = $this->fbuser['id'];
            $data['User']['email'] = $this->fbuser['email'];
            $data['User']['location'] = $this->fbuser['location']['name'];
            $data['User']['last_name'] = $this->fbuser['last_name'];
            $data['User']['first_name'] = $this->fbuser['first_name'];
            
            
            $work = end($this->fbuser['work']);
            $edu = end($this->fbuser['education']);
            //$magazines = array_values($this->params['data']['User']['magazines']);
                             
            $data['User']['work'] = $work['employer']['name'];
            $data['User']['education'] = $edu['school']['name'];
			$data['User']['magazines'] = $this->params['data']['User']['magazines'];        
            
			var_dump($this->params);

            // TODOエラーハンドリング
            $data = $this->User->save($data);

            // 登録に成功したら値をセッションに格納
            if ($data)
                $this->Session->write('auth', $data['User']);
			//FB wall post
			/*
            $feed = $this->fb->api('/me/feed/', 'post', array('access_token' => $this->ac,
                    'message' => ($this->isJpn == true) ? 'ファッション写真共有サービスGee Geeを使い始めました！' :
                            "Start using Gee Gee where you can upload your fashion photos in style and share it with the world.",
                    'name' => 'Gee Gee',
                    'caption' => 'Fashion Photo Sharing.',
                    'link' => 'http://gee-gee.me/',
                    'picture' => 'http://' . $_SERVER['SERVER_NAME'] . '/img/geegee_title_pink.png'
                        )
            );
            */    
    }

    function signup(){

	}

	function howto(){
		$this->layout = "default";
	}

        // ランキングを取得する 
        function getRank($category_id = NULL,$fb_id = NULL) 
        {
           if ($fb_id) {
              $conditions = array('Photo.fb_id' =>$fb_id );            
           } elseif($category_id) {
              $conditions = array('Photo.category_id' =>$category_id );
           } else {
              $conditions = array();              
           }
            $list = $this->Photo->find('all',array('order' => array('Photo.cnt DESC'),
              'conditions' =>$conditions,
               'limit' => '10')
              );
            return $list;
        }

	function fbphoto_upload() {

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
        $albums = $this->fb->api($fql_query, array('access_token' => $this->ac));
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
        $this->set('prm', $this->params['url']);
        $this->set('friends', $friends);
        $this->set('albums', $albums);
    }

    // ユーザがuploadした画像を表示する
	function upict_up($fb_id) {
		$path = sprintf('/home/soogle/tmp/pict/%s/%s', $this->fbuser['id'], $img_name);
	}


	// ユーザがuploadした画像を表示する
	function upict_add() {
	}

	function fbpict_like() {
          
        $pid = $this->params['pass'][0];
        // ロギング
        CakeLog::write('fbpict_like', sprintf("%s %s",$this->fbuser['id'],(int)$pid));

        // Likeボタン用
        $res = $this->Photo_like_log->findByPhotoIdAndFbId($pid, $this->fbuser['id']);
        // Likeユーザを表示
        $logres = $this->Photo_like_log->find('all',array('conditions'=> array('Photo_like_log.photo_id'=>$pid),
                                                 'fields' => array('Photo_like_log.fb_id'))
                                           ); 

        
        $result = $this->Photo->findById($pid);
        $album = $this->Photo->find('all',array('conditions'=> array('Photo.fb_id'=>$result['Photo']['fb_id'])));
        
        $this->set('isLike', $res);
        $list = $this->Photo->find('first', array('fields' => array('Photo.*', 'User.*'),
                    'conditions' => array('Photo.id' => $this->params['pass'][0]),
                    'joins' => array(array(
                            'table' => 'users',
                            'alias' => 'User',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'Photo.fb_id = User.fb_id'
                            )
                        )
                        )));
        $this->set('likeuser', $logres);
        $this->set('album', $album);
        $this->set('result', $result);
        $this->set('lists', $list);

        // ランキング
        $this->set('rank', $this->getRank(NULL, $list['User']['fb_id']));
    }

    function top() {
        Configure::load('messages');
        $junle_param = 'junle.' . $this->params['pass']['0'];
        $junle = Configure::read($junle_param);
        $list = $this->Photo->find('all', array('conditions' => array('Photo.category_id' => $junle),
                    'order' => array('Photo.id DESC'),
                    'limit' => '20'
                ));

        // ランキング
       $this->set('rank',$this->getRank($junle)); 
        
        $this->set('list', $list);
        foreach ($list as $key => $val) {
                    $data[] = $val['Photo']['id'];
        }
        $result = $this->Photo_like_log->find('all',array('conditions' =>
                                                         array('Photo_like_log.fb_id'=>$this->fbuser['id'],
                                                               'Photo_like_log.photo_id'=> $data)
                                                         )
                                              );
        $userIsLike = array();
	foreach ( $result as $key => $val) {
            $userIsLike[$val['Photo_like_log']['photo_id']]++;
        }

        $this->set('userIsLike', $userIsLike);
        // pager
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
		$this->set('albums',$albums);
	}

	function fbpict_add() {
		// validate
		// sazz
		// redirect
		$data['Photo']['category_id']  = $this->params['data']['users']['category_id'];
		$data['Photo']['fbpath']  = $this->params['data']['Photo']['fb_path'];
		$data['Photo']['comment']  = $this->params['data']['Photo']['comment'];
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

        function firstlogin()
	{
            $this->set('rank',$this->getRank());
        }
        
	function login()
	{
            $this->set('rank',$this->getRank());
		//pr($this->params);exit;

		//        // ページタイトルの設定
		//        $this->pageTitle = 'Web-local.community「local.SNS」';
		//        // データが送られてきたら
		//        if (!empty($this->data)) {
		//            // パスワードを暗号化
		//            $this->data['User']['password'] = md5($this->params['form']['password']);
		//
		//            // 入力された[id]と[pwd]がデータベースにある場合のみ[$user_data]に値が入る
		//            $user_data = $this->User->findByUsernameAndPassword($this->data['User']['username'], $this->data['User']['password']);
		//            ##$user_data = $this->User->findByPassword($this->data['User']['password']);
		//
		//
		//            // [$user_data]が空じゃなければ
		//            if (!empty($user_data)) {
		//                // 値をセッションに格納
		//                $this->Session->write('auth', $user_data['User']);
		//
		//                // リダイレクトする
		//                $this->redirect('/users/people');
		//                exit;
		//            } else { // [$user_data]が空ならログイン画面へ
		//                // エラーメッセージをビューに渡す
		//                $this->set('login_error', 'ログインできませんでした・・・');
		//                // ログイン画面の呼出
		//                $this->render('login');
		//            }
		//       }
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
			$list = $this->People->findAll(array('name' => $name));
			$this->set('name',$name);
			$this->set('list',$list);
		}

		function photo_upload() {

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

            $create_album = $this->fb->api('/' . $album_uid . '/photos', 'post', $photo_details);

            // 直近のupした画像のURLを取得する
            $url = sprintf('https://graph.facebook.com/%s?access_token=%s&fields=picture,name',
                               $create_album['id'],
                               $this->ac);
            $url = file_get_contents($url);
	    $json_data = (json_decode($url,true));

            // DB保存
            $data['Photo']['path'] = $path;
            $data['Photo']['fb_id'] = $this->fbuser['id'];
            $data['Photo']['fbpath'] = $json_data['picture'];

            $this->Photo->save($data);
            $l_id = $this->Photo->getLastInsertID();
            //$this->Photo->findById($l_id);
            $this->set('img_path', sprintf('http://%s/users/uphoto/id/%s', $_SERVER['HTTP_HOST'], $l_id));
            $this->set('l_id', $l_id);
            }

		/*-- Author Toyo --*/
		function profile(){
			/* others view someones profile from fb_pict like*/
			if(!empty($_GET['pid'])){
				$pid = $_GET['pid'];
				$photo = $this->Photo->find('first',array('conditions' => array('Photo.id' =>$pid)));
				$fb_id = $photo['Photo']['fb_id'];
				$photo_list = $this->Photo->find('all',array('conditions' => array('Photo.fb_id' => $fb_id)));
				$u = $this->User->find('first',array('conditions' => array('User.fb_id' =>$fb_id)));
				$this->set('photo_list',$photo_list);
				$this->set('u',$u);
				$this->set('fb_id',$fb_id);

		        // ranking
        		$this->set('rank', $this->getRank(NULL, $u['User']['fb_id']));
			}else{
				$fb_id = $this->fbuser['id'];
				$u = $this->User->find('first',array('conditions' => array('User.fb_id' =>$fb_id)));
				$photo_list = $this->Photo->find('all',array('conditions' => array('Photo.fb_id' => $fb_id)));
				$this->set('photo_list',$photo_list);
				$this->set('u',$u);
				$this->set('fb_id',$fb_id);

		        // ranking
        		$this->set('rank', $this->getRank(NULL, $u['User']['fb_id']));
			}
		}

		function edit_profile(){
			if(!empty($_GET['uid'])){
				$uid = $_GET['uid'];
				$u = $this->User->find('first',array('conditions' => array('User.id' =>$uid)));
				$this->set('u',$u);
			}

			$d = $this->data;

			if(!empty($d)){
				$id = $d['User']['id'];
				$name = $d['User']['nickname'];
				$location = $d['User']['location'];
				$profile = $d['User']['profile'];
				$blogurl = $d['User']['blogurl'];

				$this->User->id = $id;
				$this->User->saveField('nickname',$name);
				$this->User->saveField('location',$location);
				$this->User->saveField('profile',$profile);
				$this->User->saveField('blogurl',$blogurl);

				//$this->Session->setFlash(__('プロフィールがアップデートされました', true));
				$this->Session->setFlash($this->isJpn == true ? 'アップデートされました！':'Updated!', true);
				$this->redirect(array('action'=>'profile'));

			}
		}

		function like() {
			// validate
			$pid = $this->params['pass'][0];
			$data['Photo_like_log']['fb_id'] = $this->fbuser['id'];
			$data['Photo_like_log']['photo_id'] = $pid;
			$data_like['Photo']['fb_id'] = $this->fbuser['id'];
			$data_like['Photo']['id'] = $pid;
			$data_like['Photo']['cnt'] = 1;

			$res = $this->Photo_like_log->findByPhotoIDAndFbId($pid, $this->fbuser['id']);

			if ($res == false) {
				// ログ保存
				$this->Photo_like_log->save($data);
				$p_res = $this->Photo->findById($pid);
				// countup
				if ($p_res !== false) {
					$this->Photo->updateAll(array('cnt' => 'cnt + 1'), array('id' => $pid));
				} else {
					$this->Photo->save($data_like); // 新規登録
				}
			}

			$this->set('p_res',$p_res);
			$this->set('pid',$pid);
			$this->layout = false;
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

		function uphoto() {
			$this->layout = false;
			$this->autoRender = false;
			//pr($this->params);
			if (isset($this->params['pass'][1])) {
				$data = $this->Photo->findById($this->params['pass'][1]);
			}
			$file = $data['Photo']['path'];
			if (is_null($file )) {
				return;
			}

			Configure::write('debug', 0);

			if ($img = @imagecreatefromjpeg($file)) {
				header('Content-type: image/jpeg');
				imagejpeg($img, null, 100);
				imagedestroy($img);
			} else {
				$this->cakeError('error404');
			}
		}

		function photo_update() {
			// validate
			// save
			// redirect
			pr($this->params);
			$data['Photo']['category_id'] = $this->params['data']['users']['category_id'];
			$data['Photo']['id'] = $this->params['data']['Photo']['id'];
			$data['Photo']['fb_id'] = $this->fbuser['id'];
			$this->Photo->save($data);
		}

		function tc(){
				
	
		}

                function tc_jp(){			
		}

                
}
