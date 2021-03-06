<?php
require("../vendors/facebook/facebook.php");
App::import('Vendor','oauth',array('file'=>'OAuth'.DS.'oauth_consumer.php'));
App::import('Xml');

class UsersController extends AppController {
	var $name = 'Users';
        var $paginate = array();
	var $uses = array('User', 'Fb_profile', 'Fb_connection','Jobpost','User_profile','User_save_job','User_applicant','Career_orientation','Pics','Corp_profile','Corp_culture','Ctob_wink', 'Btoc_wink','Job_history','Edu_history',
	'User_message','Employer_message','FileHandler','FileUpload','Employer','CtobWink');
	// when you want to use models besides Users you have to define as $uses = array (xxxx)
	var $components = array("Auth");
	//to use Auth method,

	function beforeFilter() {

		$this->Auth->allow('index','fb_profile','login','signup','FB_linkedin_login','fb_login','home','stats','profile','logout','jobpostview','corp_profile_view','add',
	'pic_upload','ctobWink','ctobComment', 'ctobWinklist', 'btocWink', 'btocComment', 'btocWinklist','user_resume','user_applicant', 'user_save_job','jobpost','index_test','upload','create_profile','edit_profile','fb_home','r_message','create_message','view_message','reply_message','jobtiger','twitter','twitter_profile','direct_msg','user_profile_view','allusers','alljobs','allhotjobs');
	}
	// will delete later 'ctobWink','ctobComment', 'ctobWinklist', 'btocWink', 'btocComment', 'btocWinklist','user_resume', 'user_applicant', 'user_save_job'

	function index() {
		$facebook = new Facebook(array(
  		'appId'  => '105889496138624',
  		'secret' => '4c79ae3dea214d17ebdab77bed748173',
  		'cookie' => true,
		));

		$id=$this->Session->read('id');
		
		$employer_id = $this->Session->read('employer_id');
		$em = $this->Employer->find('first', array('conditions' => array('Employer.employer_id' => $employer_id)));
		
		
		
		$this->set('employer_id',$employer_id);
		$this->set('employer',$em["Employer"]["username"]);
		
		$_insql = '';
		$hotjobkey=$this->Ctob_wink->query("select ctob_winks.jobpost_id,count(*) as cnt from ctob_winks as ctob_winks , jobposts as j where ctob_winks.jobpost_id = j.id and j.delete_flg =0 group by ctob_winks.jobpost_id order by cnt desc limit 5");
		foreach ($hotjobkey as $key => $val) { $_insql .=$val['ctob_winks']['jobpost_id'].',';}
		$insql = sprintf('select * from jobposts where id in (%s) and delete_flg =0',trim($_insql,','));
		$hotjobs=$this->Ctob_wink->query($insql);

		foreach ( $hotjobs as $key => $val ) {
			$_hotjobs[$val['jobposts']['id']] = $val['jobposts'];
		}

		//$users = $this->User->find('all');
		$new_user=$this->User->query("SELECT u.* FROM users u order by u.id desc limit 5");
		
		//$new_user = array_slice($users,0,5);
		
		//var_dump($new_user);
		/*
		 $new_user_job=array();
		 foreach($new_user as $item){
		 $new_job = $this->Job_history->find('first', array('conditions' => array('Job_history.user_id' => $item["User"]["myid"])));
		 array_push($new_user_job,$new_job);
		 }
		 */

   $conditions = array(
           'conditions' => array('delete_flg' => 0),
           'order' => array('employer_id asc'),
           'group' => array('id'),
           'limit' => 3,//int
           'page' => isset($this->params['named']['page'])?$this->params['named']['page']:1
         );
$pjobpost = $this->Jobpost->find("all",$conditions);
$this->paginate['limit'] = 3;
$this->paginate['conditions']['delete_flg'] = 0;
$this->paginate['order']['Jobpost.employer_id'] = 'ASC';
$this->set('pagedata', $this->paginate('Jobpost'));
$this->set('jobpost', $pjobpost);

		$this->set('loginUrl', $facebook->getLoginUrl(array("next"=>"http://job-tiger.com/users/fb_login")));
		//$this->set('jobpost', $this->Jobpost->find('all'));
		$this->set('hotjob',$_hotjobs);
		$this->set('hotjobkey',$hotjobkey);
		$this->set('new_user',$new_user);
		
        if(!empty($id)){
        	$this->redirect(array('action'=>'twitter'));
        }
        		
	}

	function twitter(){
		App::import('Vendor','oauth',array('file'=>'OAuth'.DS.'oauth_consumer.php'));

		$consumer=new OAuth_Consumer(
                                 'EyD1YKCi9ZzkXONqIzEGQ',
                                 'DsdFBmrAbDkox8ocEvDmXXfmRZgwpfRrRPG1K8lHV4');


var_dump($requestToken);exit;
		// redirect to twitter_profile after authentication
		$requestToken=$consumer->getRequestToken(
                               'http://twitter.com/oauth/request_token',
                               'http://job-tiger.com/users/twitter_profile');


		// 認証後、アクセストークンを取得する際に必要なので保存
		$this->Session->write('request_token',$requestToken);

		// Twitterの認証ページにリダイレクト // this has been changed from autorize to authenticate
		//authenticate skip the login process in case you already signin w/ twitter n jobtiger
		$this->redirect('http://twitter.com/oauth/authenticate?oauth_token='
		.$requestToken->key);




	}

	function twitter_profile(){
		if (isset($this->params['url']['denied'])) {
			echo 'access denied';
			return;
		}
		$consumer=new OAuth_Consumer(
                                 'EyD1YKCi9ZzkXONqIzEGQ',
                                 'DsdFBmrAbDkox8ocEvDmXXfmRZgwpfRrRPG1K8lHV4');
		$requestToken=$this->Session->read('request_token');
		
               
	$ac = array(); 
               if ( $this->Session->read('accessToken')) {
                   $ac = $this->Session->read('accessToken'); 
                } else {
		    $accessToken=$consumer->getAccessToken(
                              'http://twitter.com/oauth/access_token',
		    $requestToken);
		    $this->Session->write('accessToken',$accessToken);
                }
		// 自分のつぶやきを一つ取得
		
                
		$tweet=$consumer->get(
	          $ac!=null?$ac->key:$accessToken->key,
	          //$accessToken->key,
		  //$accessToken->secret,
		  $ac!=null?$ac->secret:$accessToken->secret,
                  'http://api.twitter.com/1/statuses/user_timeline.xml',
	          array('count'=>1)
		);


		//echo $tweet;
		$xml = new Xml($tweet);
		//print_r($xml->Body);
		//echo $tweet;
		//echo $xml->children[0]->children[0]->name;
		
		
		//name

		$name=$xml->children[0]->children[0]->children[11]->children[1]->children[0]->value;
		$screen_name=$xml->children[0]->children[0]->children[11]->children[2]->children[0]->value;
		$location=$xml->children[0]->children[0]->children[11]->children[3]->children[0]->value;
		$bio=$xml->children[0]->children[0]->children[11]->children[4]->children[0]->value;
		$image=$xml->children[0]->children[0]->children[11]->children[5]->children[0]->value;
		$url=$xml->children[0]->children[0]->children[11]->children[6]->children[0]->value;
		$followers=$xml->children[0]->children[0]->children[11]->children[8]->children[0]->value;
		$followings=$xml->children[0]->children[0]->children[11]->children[14]->children[0]->value;
		$tweets=$xml->children[0]->children[0]->children[11]->children[26]->children[0]->value;

		//



		$this->set('image',$image);
		$this->set('name',$name);
		$this->set('screen_name',$screen_name);
		$this->set('location',$location);
		$this->set('url',$url);
		$this->set('bio',$bio);
		$this->set('followers',$followers);
		$this->set('followings',$followings);
		$this->set('tweets',$tweets);
		$this->set('xml',$xml);


		$user = $this->User->find('first', array('conditions' => array('User.twitter_id' => $screen_name)));
		$new_user=$this->User->query("SELECT u.* FROM users u order by u.id desc limit 5");
		$this->set('new_user',$new_user);
		if(!empty($user)){
			$id = $user["User"]["id"];
			
			$this->Session->write('id',$id);
			$this->User->id=$id;
			$this->User->saveField("images",$image);
			
			$this->User->saveField("name",$name);
			$this->User->saveField("location",$location);
			$this->User->saveField("url",$url);
			$this->User->saveField("bio",$bio);
			$this->User->saveField("followers",$followers);
			$this->User->saveField("followings",$followings);
			
			//$d = $this->User->findByTwitterId($screen_name);
			
			//var_dump($d);
		
			
		}else{
			
			$this->User->saveField('twitter_id',$screen_name);
			
			$user = $this->User->find('first', array('conditions' => array('User.twitter_id' => $screen_name)));
			$id = $user["User"]["id"];
			$this->Session->write('id',$id);
			
			$this->User->id=$id;
			$this->User->saveField('images',$image); 
			$this->User->saveField("name",$name);
			$this->User->saveField("location",$location);
			$this->User->saveField("url",$url);
			$this->User->saveField("bio",$bio);
			$this->User->saveField("followers",$followers);
			$this->User->saveField("followings",$followings);
		
			//var_dump($screen_name);
		}

		//$this->Session->write('id', $id);

		//index
		$facebook = new Facebook(array(
  		'appId'  => '105889496138624',
  		'secret' => '4c79ae3dea214d17ebdab77bed748173',
  		'cookie' => true,
		));

		$this->Session->read('id');
		$_insql = '';
		$hotjobkey=$this->Ctob_wink->query("select jobpost_id,count(*) as cnt from ctob_winks group by jobpost_id order by cnt desc limit 5");
		foreach ($hotjobkey as $key => $val) { $_insql .=$val['ctob_winks']['jobpost_id'].',';}
		$insql = sprintf('select * from jobposts where id in (%s)',trim($_insql,','));
		$hotjobs=$this->Ctob_wink->query($insql);

		foreach ( $hotjobs as $key => $val ) {
			$_hotjobs[$val['jobposts']['id']] = $val['jobposts'];
		}

		$jobs = $this->Job_history->find('all');

		$new_jobs = array_slice($jobs,0,5);

		/*
		 $new_user_job=array();
		 foreach($new_user as $item){
		 $new_job = $this->Job_history->find('first', array('conditions' => array('Job_history.user_id' => $item["User"]["myid"])));
		 array_push($new_user_job,$new_job);
		 }
		 */
		$this->set('loginUrl', $facebook->getLoginUrl(array("next"=>"http://job-tiger.com/users/fb_login")));
		//$this->set('jobpost', $this->Jobpost->find('all'));
                // pager

   $conditions = array( 
           'order' => array('employer_id asc'), 
           'group' => array('id'), 
           'limit' => 3,//int 
           'page' => isset($this->params['named']['page'])?$this->params['named']['page']:1
         ); 
$pjobpost = $this->Jobpost->find("all",$conditions);
$this->paginate['limit'] = 3;
$this->paginate['order']['Jobpost.employer_id'] = 'ASC';
$this->set('pagedata', $this->paginate('Jobpost'));                
		$this->set('jobpost', $pjobpost);
		$this->set('hotjob',$_hotjobs);
		$this->set('hotjobkey',$hotjobkey);
		$this->set('new_jobs',$new_jobs);

	}

	function direct_msg(){
		$accessToken=$this->Session->read('accessToken');
		$id=$this->Session->read('id');
		$user=$this->User->find('first', array('conditions' => array('User.id' => $id)));
		$this->set('user',$user);


		if(!empty($_GET['jid'])){
			$jid=(int)$_GET['jid'];
			$jobpost = $this->Jobpost->find('first', array('conditions' => array('Jobpost.id' => $jid)));
			$this->set('jobpost',$jobpost);

			//var_dump($jobpost);

			$consumer=new OAuth_Consumer(
                                 'EyD1YKCi9ZzkXONqIzEGQ',
                                 'DsdFBmrAbDkox8ocEvDmXXfmRZgwpfRrRPG1K8lHV4');



			$prof=$consumer->get(
			$accessToken->key,
			$accessToken->secret,
		"http://api.twitter.com/1/statuses/followers.json",array('screen_name'=>$user["User"]["twitter_id"],'cursor'=>-1)
			);

			$profall[]=$prof;
			$result=json_decode($prof);
			$next_cursor=$result->next_cursor_str;

			while (true){
				if($next_cursor == 0){
					break;
				}
				$_prof=$consumer->get(
				$accessToken->key,
				$accessToken->secret,
			"http://api.twitter.com/1/statuses/followers.json",array('screen_name'=>$user["User"]["twitter_id"],'cursor'=>$next_cursor)
				);
				$_result=json_decode($_prof);
				$resultall[]=$_result;
				$next_cursor=$_result->next_cursor_str;
			}
			 
			$_result= '';
			$_prof= '';

			$_image = array();

			foreach($resultall as $key => $_item){
				$i=0;
				foreach($_item as $key2 => $item){
					if ($key2 == "users") {
						while ( $i < 100) {
							if (isset($item[$i]->profile_image_url)){
								$url[(string)$item[$i]->screen_name]=(string)$item[$i]->profile_image_url;
							}else {
								$item[$i]->profile_image_url = '';
							}
			    $i++;
						}
					}
				}
			}


			$this->set('image',$url);


			//bitly
			$long = "http://job-tiger.com/users/jobpostview/".$jobpost["Jobpost"]["id"]."?hid=".$user["User"]["twitter_id"];
			$username = 'jobtiger411';
			$apiKey = 'R_de6a849703aa6a1ca1185d870ed7794f';
			//$client =& new HTTP_Client();
			$bitlyUrl = 'http://api.bit.ly/shorten?version=2.0.1&login='.$username.'&apiKey='.$apiKey.'&longUrl='.$long;
			//$http_sta = $client->get($bitlyUrl);
			$_result = (file_get_contents($bitlyUrl));

			$json = json_decode($_result, true);
			if($json['statusCode'] == 'OK') {
				$surl = $json['results'][urldecode($long)]['shortUrl'];
				$this->set('surl',$surl);
			}

		}

		$d=$this->data;

		if(!empty($d)){


			$to=$d["User"]["to"];
			$msg=$d["User"]["msg"];


			$consumer=new OAuth_Consumer(
                                 'EyD1YKCi9ZzkXONqIzEGQ',
                                 'DsdFBmrAbDkox8ocEvDmXXfmRZgwpfRrRPG1K8lHV4');


			//var_dump($accessToken);
			$dm=$consumer->post(
			$accessToken->key,
			$accessToken->secret,
                          'http://api.twitter.com/1/direct_messages/new.json', array('screen_name'=>$to, 'text'=>$msg)
			);
			$this->Session->setFlash(__('ダイレクトメッセージが送信されました。Your Direct Message has been sent', true));
			$this->redirect(array('action'=>'twitter'));
		}
		//sample


	}



	function create_profile(){

		$id=$this->Session->read('id');

		var_dump($id);

		$d = $this ->data;
		//var_dump($d);

		if(!empty($d)){
			$this->User_profile->saveField('id', $id);
			$this->Career_orientation->saveField('id', $id);
			$this->Job_history->saveField('user_id', $id);
			$this->Edu_history->saveField('user_id', $id);

			$this->User_profile->saveField('name', $d["User"]["name"]);
			$this->User_profile->saveField('email', $d["User"]["email"]);
			$this->User_profile->saveField('phone', $d["User"]["phone"]);

			//job history save
			$this->Job_history->saveField('industry',$d["User"]["industry"]);
			$this->Job_history->saveField('corporation',$d["User"]["corporation"]);
			$this->Job_history->saveField('job_title',$d["User"]["job_title"]);
			$this->Job_history->saveField('location',$d["User"]["location"]);
			$this->Job_history->saveField('current',$d["User"]["current"]);
			$this->Job_history->saveField('start_year',$d["User"]["job_start_date"]["year"]);
			$this->Job_history->saveField('start_month',$d["User"]["job_start_date"]["month"]);
			$this->Job_history->saveField('end_year',$d["User"]["job_end_date"]["year"]);
			$this->Job_history->saveField('end_month',$d["User"]["job_end_date"]["month"]);
			$this->Job_history->saveField('summary',$d["User"]["summary"]);

			//Edu history save
			$this->Edu_history->saveField('school',$d["User"]["school"]);
			$this->Edu_history->saveField('degree',$d["User"]["degree"]);
			$this->Edu_history->saveField('location',$d["User"]["location"]);
			$this->Edu_history->saveField('fields_of_study',$d["User"]["fields_of_study"]);
			$this->Edu_history->saveField('start_year',$d["User"]["edu_start_date"]["year"]);
			$this->Edu_history->saveField('start_month',$d["User"]["edu_start_date"]["month"]);
			$this->Edu_history->saveField('end_year',$d["User"]["edu_end_date"]["year"]);
			$this->Edu_history->saveField('end_month',$d["User"]["edu_end_date"]["month"]);
			$this->Edu_history->saveField('summary',$d["User"]["summary"]);

			//Twitter
			$this->User_profile->saveField('twitter',$d["User"]["twitter"]);

			//Career orientation
			$this->Career_orientation->saveField('culture',($d["User"]["culture"]+1)*10);
			$this->Career_orientation->saveField('salary',($d["User"]["culture"]+1)*10);
			$this->Career_orientation->saveField('responsibility',($d["User"]["responsibility"]+1)*10);
			$this->Career_orientation->saveField('compassion',($d["User"]["compassion"]+1)*10);
			$this->Career_orientation->saveField('sense_of_humor',($d["User"]["sense_of_humor"]+1)*10);
			$this->Career_orientation->saveField('perfectionism',($d["User"]["perfectionism"]+1)*10);
			//$this->Job_history->saveField('end_date',$end_date);
			//$this->Job_history->saveField('summary',$summary);

			$this->flash('Your Profile has been created', './profile');
			//$this->Session->setFlash(__('Your Profile has been created', true));
			//$this->redirect(array('action'=>'home'));
			//somehow Header information can not modify and got error message. so leave it as flash
		}
	}

	function profile(){
		$id = $this->Session->read('id');
		$prof = $this->User->find('first', array('conditions' => array('User.id' => $id)));
		
		$career_orientation = $this->Career_orientation->find('first', array('conditions' => array('Career_orientation.id' => $id)));
		
		/*
		$job_history = $this->Job_history->find('all', array('conditions' => array('Job_history.user_id' => $id)));
		$edu_history = $this->Edu_history->find('all', array('conditions' => array('Edu_history.user_id' => $id)));
		$this->set('job_history',$job_history);
		$this->set('edu_history',$edu_history);
		*/

		$this->set('prof',$prof);
		$this->set('career_orientation',$career_orientation);
		//var_dump($prof);
		//var_dump($job_history);
		
		
		//set chart value
		$this -> set('culture', $career_orientation["Career_orientation"]["culture"]);
		$this -> set('salary', $career_orientation["Career_orientation"]["salary"]);
		$this -> set('responsibility', $career_orientation["Career_orientation"]["responsibility"]);
		$this -> set('compassion', $career_orientation["Career_orientation"]["compassion"]);
		$this -> set('sense_of_humor', $career_orientation["Career_orientation"]["sense_of_humor"]);
		$this -> set('perfectionism', $career_orientation["Career_orientation"]["perfectionism"]);

		//set selecter value
		$this -> set('e_culture', ($career_orientation["Career_orientation"]["culture"]/10)-1);
		$this -> set('e_salary', ($career_orientation["Career_orientation"]["salary"]/10)-1);
		$this -> set('e_responsibility', ($career_orientation["Career_orientation"]["responsibility"]/10)-1);
		$this -> set('e_compassion', ($career_orientation["Career_orientation"]["compassion"]/10)-1);
		$this -> set('e_sense_of_humor', ($career_orientation["Career_orientation"]["sense_of_humor"]/10)-1);
		$this -> set('e_perfectionism', ($career_orientation["Career_orientation"]["perfectionism"]/10)-1);
		
		
	}

	function edit_profile(){
		$id = $this->Session->read('id');
		
		$career_orientation = $this->Career_orientation->find('first', array('conditions' => array('Career_orientation.id' => $id)));

		$this->set('career_orientation',$career_orientation);

		//set prof value
		//set job_history value
		//set edu_history value


		//set chart value
		$this -> set('culture', $career_orientation["Career_orientation"]["culture"]);
		$this -> set('salary', $career_orientation["Career_orientation"]["salary"]);
		$this -> set('responsibility', $career_orientation["Career_orientation"]["responsibility"]);
		$this -> set('compassion', $career_orientation["Career_orientation"]["compassion"]);
		$this -> set('sense_of_humor', $career_orientation["Career_orientation"]["sense_of_humor"]);
		$this -> set('perfectionism', $career_orientation["Career_orientation"]["perfectionism"]);

		//set selecter value
		$this -> set('e_culture', ($career_orientation["Career_orientation"]["culture"]/10)-1);
		$this -> set('e_salary', ($career_orientation["Career_orientation"]["salary"]/10)-1);
		$this -> set('e_responsibility', ($career_orientation["Career_orientation"]["responsibility"]/10)-1);
		$this -> set('e_compassion', ($career_orientation["Career_orientation"]["compassion"]/10)-1);
		$this -> set('e_sense_of_humor', ($career_orientation["Career_orientation"]["sense_of_humor"]/10)-1);
		$this -> set('e_perfectionism', ($career_orientation["Career_orientation"]["perfectionism"]/10)-1);

		
		$d = $this->data;
		
				
		if(!empty($d)){
			
			$this->Career_orientation->saveField('id',$id);
			
			//Career orientation
			isset($d['User']['culture']) ? $this->Career_orientation->saveField('culture',($d["User"]["culture"]+1)*10):'';
			isset($d['User']['salary']) ? $this->Career_orientation->saveField('salary',($d["User"]["salary"]+1)*10):'';
			isset($d['User']['responsibility']) ? $this->Career_orientation->saveField('responsibility',($d["User"]["responsibility"]+1)*10):'';
			isset($d['User']['compassion']) ? $this->Career_orientation->saveField('compassion',($d["User"]["compassion"]+1)*10):'';
			isset($d['User']['sense_of_humor']) ? $this->Career_orientation->saveField('sense_of_humor',($d["User"]["sense_of_humor"]+1)*10):'';
			isset($d['User']['perfectionism']) ? $this->Career_orientation->saveField('perfectionism',($d["User"]["perfectionism"]+1)*10):'';

			//$this->flash('キャリア志向性がアップデートされました。Your Career Orientation has been updated', './profile');
			$this->Session->setFlash(__('<span style="color:red">キャリア志向性がアップデートされました。Your Career Orientation has been updated　</span>', true));
			$this->redirect(array('action'=>'profile'));
		
			
			//$this->Session->setFlash(__('Your Profile has been updated', true));
			//$this->redirect(array('action'=>'home'));

		}

	}
	
	function user_profile_view($id = null){
		$this -> User -> id = $id;
		$this -> set('prof', $this-> User ->read());

		$this -> Career_orientation -> id =$id;
		$this -> set('career_orientation', $this -> Career_orientation ->read());
		
		$career_orientation = $this -> Career_orientation -> find('first', array('conditions'=>array('Career_orientation.id' => $id)));
		
		$ses = $this->Session->read('id');
		
		$this->set('ses',$ses);
			
		//set chart value
		$this -> set('culture', $career_orientation["Career_orientation"]["culture"]);
		$this -> set('salary', $career_orientation["Career_orientation"]["salary"]);
		$this -> set('responsibility', $career_orientation["Career_orientation"]["responsibility"]);
		$this -> set('compassion', $career_orientation["Career_orientation"]["compassion"]);
		$this -> set('sense_of_humor', $career_orientation["Career_orientation"]["sense_of_humor"]);
		$this -> set('perfectionism', $career_orientation["Career_orientation"]["perfectionism"]);

		//set selecter value
		$this -> set('e_culture', ($career_orientation["Career_orientation"]["culture"]/10)-1);
		$this -> set('e_salary', ($career_orientation["Career_orientation"]["salary"]/10)-1);
		$this -> set('e_responsibility', ($career_orientation["Career_orientation"]["responsibility"]/10)-1);
		$this -> set('e_compassion', ($career_orientation["Career_orientation"]["compassion"]/10)-1);
		$this -> set('e_sense_of_humor', ($career_orientation["Career_orientation"]["sense_of_humor"]/10)-1);
		$this -> set('e_perfectionism', ($career_orientation["Career_orientation"]["perfectionism"]/10)-1);
		
		//for employer view
		$employer_id = $this->Session->read('employer_id');
		$this->set('employer_id',$employer_id);
	}
	
	function allusers(){
		$new_user=$this->User->query("SELECT u.* FROM users u order by u.id desc");
		$this->set('new_user',$new_user);
		//var_dump($new_user);
	}
	
	function alljobs(){
		 $conditions = array(
           'conditions' => array('delete_flg' => 0),
           'order' => array('employer_id asc'),
           'group' => array('id'),
           
         );
		$jobpost = $this->Jobpost->find("all",$conditions);
		$this->set('jobpost',$jobpost);
		
		$_insql = '';
		$hotjobkey=$this->Ctob_wink->query("select ctob_winks.jobpost_id,count(*) as cnt from ctob_winks as ctob_winks , jobposts as j where ctob_winks.jobpost_id = j.id and j.delete_flg =0 group by ctob_winks.jobpost_id order by cnt desc limit 5");
		foreach ($hotjobkey as $key => $val) { $_insql .=$val['ctob_winks']['jobpost_id'].',';}
		$insql = sprintf('select * from jobposts where id in (%s) and delete_flg =0',trim($_insql,','));
		$hotjobs=$this->Ctob_wink->query($insql);
		
		foreach ( $hotjobs as $key => $val ) {
			$_hotjobs[$val['jobposts']['id']] = $val['jobposts'];
		}
		
		$this->set('hotjob',$_hotjobs);
		$this->set('hotjobkey',$hotjobkey);
		
	}
	
	function allhotjobs(){
		$conditions = array(
           'conditions' => array('delete_flg' => 0),
           'order' => array('employer_id asc'),
           'group' => array('id'),
           
         );
		$jobpost = $this->Jobpost->find("all",$conditions);
		$this->set('jobpost',$jobpost);
		
		$_insql = '';
		$hotjobkey=$this->Ctob_wink->query("select ctob_winks.jobpost_id,count(*) as cnt from ctob_winks as ctob_winks , jobposts as j where ctob_winks.jobpost_id = j.id and j.delete_flg =0 group by ctob_winks.jobpost_id order by cnt desc limit 10");
		foreach ($hotjobkey as $key => $val) { $_insql .=$val['ctob_winks']['jobpost_id'].',';}
		$insql = sprintf('select * from jobposts where id in (%s) and delete_flg =0',trim($_insql,','));
		$hotjobs=$this->Ctob_wink->query($insql);
		
		foreach ( $hotjobs as $key => $val ) {
			$_hotjobs[$val['jobposts']['id']] = $val['jobposts'];
		}
		
		$this->set('hotjob',$_hotjobs);
		$this->set('hotjobkey',$hotjobkey);
	}
	
	
	function ctobWink() {
		$data=null;
		$sid=$this->Session->read('id'); // sid = SenderID for Wink (login user)
		$rid=(int)$_GET['rid']; //rid = ReceiverID for Wink ("Get 'rid'" from Wink button)
		$jid=(int)$_GET['jid'];

		$data['wink']['sid']=$sid;
		$data['wink']['rid']=$rid;
		$data['wink']['jid']=$jid;

		$this->Ctob_wink->save();
		$data['wink']['id']=$this->Ctob_wink->id;

		$this->Ctob_wink->id=$data['wink']['id'];

		$this->Ctob_wink->saveField('sid',$sid);
		$this->Ctob_wink->saveField('rid',$rid);
		$this->Ctob_wink->saveField('jobpost_id',$jid);

		$this->set('data',$data);

		$rdata=$this->Corp_profile->findById($rid);
		$this->Session->setFlash(__('<span style="color:red">You like it! イイネ！　</span>', true));
		$this->redirect(array('action'=>'index'));
		// $this->set('rname',$rdata['corp_profile']['name']);

	}

	// --- Comment Sending Function with Wink from Consumer to Buisiness ---//
	function ctobComment() {
		$data=null;
		$this->set('id', (int)$_GET['id']); //Wink ID which you want to comment with
		//	var_dump($this->data);

		if(!empty($this->data)){

			$wink=$this->Ctob_wink->findById((int)$_GET['id']);

			//var_dump($wink);

			$this->Ctob_wink->id=(int)$_GET['id'];
			$this->Ctob_wink->saveField('content',$this->data['Wink']['content']);
			$this->Ctob_wink->saveField('check',0);
			$this->Session->setFlash(__('Your Comment has been sent', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	//--- Show Wink list for Buisiness (Receiver) ---//
	function ctobWinklist(){
		$id = $this->Session->read('id');
		$update = array('Ctob_wink.check'=>1);
		$condition = array('Ctob_wink.rid'=>0);//$this->Session->read('id'));
		$this->Ctob_wink->updateAll($update, $condition); //check flag: false -> true
		$winks = $this->Ctob_wink->findAllBySid($id);//$this->Session->read('id'));
		$this->set('winks', $winks);
		//Author Toyo

		/*
		$job=array();
		foreach($winks as $item){
			$like = $this -> Jobpost->find('first',array("conditions"=>array("Jobpost.id" =>$item['Ctob_wink']['jobpost_id'])));
			array_push($job,$like);
		}
		$this->set('job',$job);
		*/
		
		$_job = $this->Ctob_wink->query("SELECT c.*, j.* FROM ctob_winks c, jobposts j WHERE c.sid = $id AND j.id = c.jobpost_id;");
		$this->set('_job',$_job);
		
		//var_dump($_job);
		
	}

	function btocWinklist(){
		$id = $this->Session->read('id');
		$update = array('Btoc_wink.check'=>1);
		$condition = array('Btoc_wink.rid'=>0);//$this->Session->read('id'));
		$this->Btoc_wink->updateAll($update, $condition); //check flag: false -> true
		$winks = $this->Btoc_wink->findAllByRid($id);//$this->Session->read('id'));
		$this->set('winks', $winks);
		
		
		$corp=array();
		foreach($winks as $item){
			$like = $this ->Corp_profile->find('first',array("conditions"=>array("Corp_profile.id" =>$item['Btoc_wink']['sid'])));
			array_push($corp,$like);
		}

		$this->set('corp',$corp);
		
		
		$_corp = $this->Btoc_wink->query("SELECT b.*, c.* FROM btoc_winks b, corp_profiles c WHERE b.rid = $id AND b.sid = c.id;");
		$this->set('_corp',$_corp);
		
	}

	function r_message(){
		$id = $this->Session->read('id');

		$u_msg = $this->User_message->query("SELECT e.* FROM employer_messages e  WHERE e.read_flg = 0 AND e.rid = $id;");
		$this->set('u_msg',$u_msg);


		$msg = $this->Employer_message->query("SELECT e.*, c.*  FROM employer_messages e, corp_profiles c WHERE e.rid = $id AND c.id = e.sid;");
		$this->set('msg',$msg);
		
		

		//$d=$this->data;

	}

	function create_message(){
		$id = $this->Session->read('id');
		$rid=isset($_GET['rid'])?($_GET['rid']):'';
		$corp_name = $this->Corp_profile->find('first',array("conditions"=>array("Corp_profile.id" =>$rid)));

		$this->set('rid',$rid);
		$this->set('corp_name',$corp_name["Corp_profile"]["corporation"]);

		$d=$this->data;


		if(!empty($d)){
			$this->User_message->saveField('sid', $id);
			$this->User_message->saveField('rid',$d["User"]["rid"]);
			$this->User_message->saveField('rel', 1);  //rel 0 means Eemployer -> Users, 1 means Users to Employers, 2 means Users to Users
			$this->User_message->saveField('read_flg', 0); //0 for unread
			$this->User_message->saveField('subject',$d["User"]["subject"]);
			$this->User_message->saveField('body',$d["User"]["body"]);
			$this->User_message->saveField('created',date("Y-m-d H:i:s"));

			$this->Session->setFlash(__('メッセージが送信されました。Your Message has been sent to Recruiter', true));
			$this->redirect(array('action'=>'index'));

			//$this->data["Create_message"]["created_at"] = date("Y-m-d H:i:s");;
		}


	}

	function view_message(){
		$id = $this->Session->read('id');
		$mid=(int)$_GET['id'];

		$msg = $this->Employer_message->query("SELECT e.*, c.*  FROM employer_messages e, corp_profiles c WHERE e.id = $mid AND c.id = e.sid;");
		$this->set('msg',$msg);

		$this->Employer_message->id=$mid;
		$this->Employer_message->saveField('read_flg',1); //1 means already read
	}

	function reply_message(){
		$id = $this->Session->read('id');

		if(!empty($_GET['id'])){
			$mid=$_GET['id'];
			$this->Employer_message->id=$mid;
			$this->Employer_message->saveField('read_flg',1); //1 means already read
			$msg = $this->Employer_message->query("SELECT e.*, c.*  FROM employer_messages e, corp_profiles c WHERE e.id = $mid AND c.id = e.sid;");
			$this->set('msg',$msg);
		}else{$_GET['id']='';}

		$d=$this->data;
		//pr($d);

		if(!empty($d)){
			$this->User_message->saveField('sid', $id);
			$this->User_message->saveField('rid',$d["User"]["rid"]);
			$this->User_message->saveField('rel', 1);  //rel 0 means Eemployer -> Users, 1 means Users to Employers, 2 means Users to Users
			$this->User_message->saveField('read_flg', 0); //0 for unread
			$this->User_message->saveField('subject',$d["User"]["subject"]);
			$this->User_message->saveField('body',$d["User"]["body"]);
			$this->User_message->saveField('created',date("Y-m-d H:i:s"));

			$this->Session->setFlash(__('メッセージが送信されました。Your Message Has been sent', true));
			$this->redirect(array('action'=>'home'));
		}

	}

	//function jobpostview($id = null){
	//$this -> Jobpost ->id = $id;
	//$this->set('jobpost', $this->Jobpost->read());
	//}


	/*
	 * display job detail and do job_apply
	 */
	function jobpostview ($id = null) {
		$this->Jobpost->id = $id;
		$this->Session->write('jobpost_id',$id);
		$employer = $this->Jobpost->find('first',array("conditions"=>array("Jobpost.id" =>$id)));
		$employer_id = $employer["Jobpost"]["employer_id"];
		$this->set('jobpost', $this->Jobpost->read());
		$this->set('user_id', $this->Session->read('id'));
		$this->set('employer_id',$employer_id);

		if(!empty($_GET['hid'])){
			$hid = $_GET['hid'];
			$head = $this->User->find('first',array("conditions"=>array("User.twitter_id" =>$hid)));
			$this->set('hid',$hid);
			$this->set('image',$head["User"]["images"]);
			$this->Session->write('hid',$hid);
		}

		$ses = $this->Session->read('id');
		$this->set('ses',$ses);

		if(!empty($ses)){
			$user = $this->User->find('first',array("conditions"=>array("User.id" =>$ses)));
			$tid = $user["User"]["twitter_id"];
			$this->set('tid',$tid);
		}
	}

	/*
	 * insert data to user_applicant
	 * @author chihiro
	 */
	function user_applicant () {

		// insert created_at value
		$this->data["User_applicant"]["created_at"] = date("Y-m-d H:i:s");;
		$this->User_applicant->save($this->data);

		$this->flash('Your application has been sent.', '/users/index');
	}

	/*  user_resume, user_applicant, user_save_job, corp_profile_view,
	 * insert data to user_applicant
	 * @author chihiro
	 */
	function user_resume () {
		$id = $this->Session->read('id');
		$jobpost = $this->Session->read('jobpost_id');
		$hid = $this->Session->read('hid');
		if(!empty($hid)){$this->set('hid',$hid);}
		
		//var_dump($hid);
		/* after adding resume uploader, this can not be working.
		$this->set('job_id', $this->data["User_save_job"]["save_jobpost_id"]);
		$this->set('user_id', $this->data["User_save_job"]["user_id"]);
		$this->set('employer_id',$this->data["User_save_job"]["employer_id"]);
		*/


		$employer = $this->Jobpost->find('first',array("conditions"=>array("Jobpost.id" =>$jobpost)));
		$employer_id = $employer["Jobpost"]["employer_id"];
		$this->set('job_id', $jobpost);
		$this->set('user_id', $this->Session->read('id'));
		$this->set('employer_id',$employer_id);
		//$this->set('hid',$this->data["User_save_job"]["hid"]);
		//var_dump($this->data);

		$resume = $this ->FileUpload->query("SELECT f.* FROM file_uploads f WHERE f.twitter_id = $id AND f.jobpost_id= $jobpost order by f.id desc;");
		$this->set('resume',$resume);


	}
	/*
	 * insert data to user_save_job
	 * @author chihiro
	 */
	function user_save_job() {
		// insert created_at value
		$this->data["User_save_job"]["created_at"] = date("Y-m-d H:i:s");;
		$this->User_save_job->save($this->data);
		$this->flash('Your job has been saved.', '/users/index');
	}


	function corp_profile_view($id = null){
		$this -> Corp_profile -> id = $id;
		$this -> set('corp_profile', $this-> Corp_profile ->read());

		$this -> Corp_culture -> id =$id;
		$this -> set('corp_culture', $this -> Corp_culture ->read());

		$corp_culture = $this -> Corp_culture -> find('first', array('conditions'=>array('Corp_culture.id' => $id)));
		
		$ses = $this->Session->read('id');
		
		$this->set('ses',$ses);
		
		$this -> set('culture', $corp_culture["Corp_culture"]["culture"]);
		$this -> set('salary', $corp_culture["Corp_culture"]["salary"]);
		$this -> set('responsibility', $corp_culture["Corp_culture"]["responsibility"]);
		$this -> set('compassion', $corp_culture["Corp_culture"]["compassion"]);
		$this -> set('sense_of_humor', $corp_culture["Corp_culture"]["sense_of_humor"]);
		$this -> set('perfectionism', $corp_culture["Corp_culture"]["perfectionism"]);


	}


	function view($id = NULL) {
		if (empty($id)) {
			$myid = $this->Session->read('id');
			$id = $myid;
		}

		$this->User->id = $id;
		$this->set('User', $this->User->read());
		$data = $this -> User ->data;
		//var_dump($this->Session->read('id'));
		$fb_id= $data["User"]["fb_id"];


		$this->Fb_profile ->id = $fb_id;
		$this -> Fb_profile->read();
		//var_dump($this->Fb_profile);
		print($this->Fb_profile->data['Fb_profile']['name']);

		$this->set('Fb_profile', $this->Fb_profile->data['Fb_profile']);

	}

	function home(){
		$facebook = new Facebook(array(
  		'appId'  => '105889496138624',
  		'secret' => '4c79ae3dea214d17ebdab77bed748173',
  		'cookie' => true,


		));
		$myid = $this->Session->read('id');
		
		$u_msg = $this->User_message->query("SELECT e.* FROM employer_messages e  WHERE e.read_flg = 0 AND e.rid = $myid;");
		$this->set('u_msg',$u_msg);

		//User.id    User is Table, myid is a column, find a data of $myid in "User" table.

		$hoge = $this->User->find('first', array('conditions' => array('User.id' => $myid)));


		$fb_id = $hoge['User']['fb_id'];
		$fb_prof = $this ->Fb_profile->find('all', array('conditions' => array('Fb_profile.fb_id' => $fb_id)));

		//var_dump($fb_prof);



		if(!$hoge){
			//user is not loogged in
			$this -> flash('you are not logged in', './index' );
		}

		$prof = $this->User_profile->find('first', array('conditions' => array('User_profile.id' => $myid)));
		$image = $prof["User_profile"]["image"];
		$this->set('image',$image);

		$job = $this->Job_history->find('first', array('conditions' => array('Job_history.user_id' => $myid)));
		$this ->set('job',$job);

		$career_orientation = $this ->Career_orientation->find('first', array('conditions' => array('Career_orientation.id' => $myid)));
		$corp_culture = $this->Corp_culture->find('all');



		$diff = array();

		foreach ($corp_culture as $item){
			array_push($diff, array(
		"id" => $item["Corp_culture"]["id"],
		"culture" => $career_orientation["Career_orientation"]["culture"]-$item["Corp_culture"]["culture"],
		"salary" => $career_orientation["Career_orientation"]["salary"]-$item["Corp_culture"]["salary"],
		"compassion" => $career_orientation["Career_orientation"]["compassion"]-$item["Corp_culture"]["compassion"] ,
		"responsibility" => $career_orientation["Career_orientation"]["responsibility"]-$item["Corp_culture"]["responsibility"] ,
		"sense_of_humor" => $career_orientation["Career_orientation"]["sense_of_humor"]-$item["Corp_culture"]["sense_of_humor"],
		"perfectionism" => $career_orientation["Career_orientation"]["perfectionism"]-$item["Corp_culture"]["perfectionism"]
			));
		}

		$this -> Match -> id = $myid;

		$match = array();
		foreach($diff as $item){
			array_push($match,array(
		"id" => $item["id"],
		"culture" => (abs($item["culture"]*3)),
		"salary" => (abs($item["salary"]*3)),
		"compassion" => abs($item["compassion"]),
		"responsibility" => abs($item["responsibility"]),
		"sense_of_humor" => abs($item["sense_of_humor"]),
		"perfectionism" => abs($item["perfectionism"]),
		"total" => (abs($item["culture"]*3))+(abs($item["salary"]*3))+abs($item["compassion"])+abs($item["responsibility"])+abs($item["sense_of_humor"])+abs($item["perfectionism"]),

			//$this-> Match ->save($match);
			));
		}

		function cmp($a, $b) {
			if ($a["total"] == $b["total"]) {
				return 0;
			}
			return ($a["total"] < $b["total"]) ? -1 : 1;
		}

		// Array to be sorted

		// Sort and print the resulting array
		uasort($match, 'cmp');

		//array_slice      ($variable, where to start, # of elements you would like to pick);
		$_total = array_slice($match,0,5);
		$i = 0;
		while( $i <count($_total)) {
			$total[$_total[$i]["id"]] = $_total[$i];
			$i++;
		}


		//pr($total);
		$match_list = array();
		foreach($total as $item){
			$c =$this->Corp_profile->find('first', array('conditions' => array('Corp_profile.id' => $item["id"])));
			array_push($match_list,$c);
		}
		//pr($match_list);
		// for output enployee list
			
		$user_applicants = $this ->User_applicant->query("SELECT u.*, j.*  FROM user_applicants u, jobposts j WHERE j.id = u.jobpost_id AND u.user_id = $myid;");
		//var_dump($user_applicants);
		//$user_save_jobs = $this->User_save_job->Jobpost->find('all', array('conditions' => array('User_save_job.user_id' =>  $myid)));
		$user_save_jobs = $this-> User_save_job ->query("SELECT u.*, j.*  FROM user_save_jobs u, jobposts j WHERE j.id = u.jobpost_id AND u.user_id = $myid;");

		$this->set('career_orientation',$career_orientation);
		$this->set('jobpost', $this->Jobpost->find('all'));
		$this->set('user_applicants',$user_applicants);
		$this->set('user_save_jobs',$user_save_jobs);
		$this->set('total', $total);
		$this->set('match_list', $match_list);
		$this -> set('id',$myid);
		$this -> set('image', $image);
		$this -> set('name',$hoge['User']['username']);
		$this -> set('loginUrl', $facebook->getLoginUrl(array("next"=>"http://job-tiger.com/users/fb_login")));

		if(isset($fb_prof['0'])){
			$this -> set('employer_1', $fb_prof['0']['Fb_profile']['employer_1']);
			$this -> set ('position_1', $fb_prof['0']['Fb_profile']['position_1']);
		}
	}


	function jobtiger(){

	}

	function login(){
		if (!empty($this->data)) {
			//var_dump($this->data);
			$n = $this -> data['User']['username'];
			$m = $this -> User -> find('first', array('conditions' => array('User.username' => $n)));


			if($this -> data['User']['passwd'] == $m['User']['passwd'])
			{
				$id =  $m['User']['id'];
				$this->Session->write('id', $id);
				$this->redirect('/users/home');
			} else {
				$this->flash('ID or password is not correct.' , '/users/index');
			}



		}


	}






	function signup(){
		if (!empty($this->data)) {
			$t = $this -> data;
			$user = array('User' => array(
				"username" => $t["User"]["username"],
				"passwd" =>   $t["User"]["passwd"],
				"email" =>    $t["User"]["email"]
			));


			$this-> User -> save($user);
			$this->flash('Your account has been created.','http://job-tiger.com');
			//pr($this->data);
		}
	}


	function logout(){
		$facebook = new Facebook(array(
  		'appId'  => '105889496138624',
  		'secret' => '4c79ae3dea214d17ebdab77bed748173',
  		'cookie' => true,
		));
		$this->Session->del('id');


		$facebook->getLogoutUrl(array());


		$logoutUrl = $facebook->getLogoutUrl(array("next"=>"http://job-tiger.com/users/index"));
		$this->Session->setFlash(__('ログアウトしました。You are logged out', true));
		$this->redirect(array('action'=>'index'));

		//$this->flash( 'you have been logged out', $logoutUrl);

	}


	function fb_login(){
		// Create our Application instance (replace this with your appId and secret).
		$facebook = new Facebook(array(
  		'appId'  => '105889496138624',
  		'secret' => '4c79ae3dea214d17ebdab77bed748173',
  		'cookie' => true,


		));

		// We may or may not have this data based on a $_GET or $_COOKIE based session.
		//
		// If we get a session here, it means we found a correctly signed session using
		// the Application Secret only Facebook and the Application know. We dont know
		// if it is still valid until we make an API call using the session. A session
		// can become invalid if it has already expired (should not be getting the
		// session back in this case) or if the user logged out of Facebook.
		$session = $facebook->getSession();

		$me = null;
		// Session based API call.
			
		$uid = null;
		if ($session) {
			try {
				$uid = $facebook->getUser();
				$me = $facebook->api('/me');

			} catch (FacebookApiException $e) {
				error_log($e);
			}
		}

		// login or logout url will be needed depending on current user state.

		$loginUrl = null;
		$logoutUrl =null;
		if ($me) {
			$logoutUrl = $facebook->getLogoutUrl();
		} else {
			$loginUrl = $facebook->getLoginUrl();
		}

		$this->data = array("Fb_profile" =>
		array("name" => $me["name"],"fb_id"=>$me["id"]));

		//var_dump($me);


		if(!isset($me["name"])){
		 $me["name"]= "";
		}

		if(!isset($me["last_name"])){
		 $me["last_name"]= "";
		}

		if(!isset($me["first_name"])){
		 $me["first_name"]= "";
		}

		if(!isset($me["link"])){
		 $me["link"]= "";
		}

		if(!isset($me["bio"])){
		 $me["bio"]= "";
		}

			
		if(!isset($me["work"]["0"])){
			$me["work"]["0"]["employer"]["name"] = "";
			$me["work"]["0"]["position"]["name"] = "";
			$me["work"]["0"]["location"]["name"] = "";
			$me["work"]["0"]["start_date"] = "";
			$me["work"]["0"]["end_date"] = "";
		}

		if(!isset($me["work"]["1"])){
			$me["work"]["1"]["employer"]["name"] = "";
			$me["work"]["1"]["position"]["name"] = "";
			$me["work"]["1"]["location"]["name"] = "";
			$me["work"]["1"]["start_date"] = "";
			$me["work"]["1"]["end_date"] = "";
		}

		if(!isset($me["work"]["2"])){
			$me["work"]["2"]["employer"]["name"] = "";
			$me["work"]["2"]["position"]["name"] = "";
			$me["work"]["2"]["location"]["name"] = "";
			$me["work"]["2"]["start_date"] = "";
			$me["work"]["2"]["end_date"] = "";
		}

		if(!isset($me["work"]["3"])){
			$me["work"]["3"]["employer"]["name"] = "";
			$me["work"]["3"]["position"]["name"] = "";
			$me["work"]["3"]["location"]["name"] = "";
			$me["work"]["3"]["start_date"] = "";
			$me["work"]["3"]["end_date"] = "";
		}

		if(!isset($me["work"]["4"])){
			$me["work"]["4"]["employer"]["name"] = "";
			$me["work"]["4"]["position"]["name"] = "";
			$me["work"]["4"]["location"]["name"] = "";
			$me["work"]["4"]["start_date"] = "";
			$me["work"]["4"]["end_date"] = "";
		}

		if(!isset($me["work"]["5"])){
			$me["work"]["5"]["employer"]["name"] = "";
			$me["work"]["5"]["position"]["name"] = "";
			$me["work"]["5"]["location"]["name"] = "";
			$me["work"]["5"]["start_date"] = "";
			$me["work"]["5"]["end_date"] = "";
		}

		if(!isset($me["work"]["6"])){
			$me["work"]["6"]["employer"]["name"] = "";
			$me["work"]["6"]["position"]["name"] = "";
			$me["work"]["6"]["location"]["name"] = "";
			$me["work"]["6"]["start_date"] = "";
			$me["work"]["6"]["end_date"] = "";
		}

		if(!isset($me["work"]["7"])){
			$me["work"]["7"]["employer"]["name"] = "";
			$me["work"]["7"]["position"]["name"] = "";
			$me["work"]["7"]["location"]["name"] = "";
			$me["work"]["7"]["start_date"] = "";
			$me["work"]["7"]["end_date"] = "";
		}

		if(!isset($me["education"]["0"])){
			$me["education"]["0"]["school"]["name"]="";
			$me["education"]["0"]["year"]["name"]="";
		}

		if(!isset($me["education"]["1"])){
			$me["education"]["1"]["school"]["name"]="";
			$me["education"]["1"]["year"]["name"]="";
		}
			
		if(!isset($me["education"]["2"])){
			$me["education"]["2"]["school"]["name"]="";
			$me["education"]["2"]["year"]["name"]="";
		}
			
		if(!isset($me["education"]["3"])){
			$me["education"]["3"]["school"]["name"]="";
			$me["education"]["3"]["year"]["name"]="";
		}
			
		if(!isset($me["education"]["4"])){
			$me["education"]["4"]["school"]["name"]="";
			$me["education"]["4"]["year"]["name"]="";
		}
			
		if(!isset($me["education"]["5"])){
			$me["education"]["5"]["school"]["name"]="";
			$me["education"]["5"]["year"]["name"]="";
		}
			
		if(!isset($me["education"]["6"])){
			$me["education"]["6"]["school"]["name"]="";
			$me["education"]["6"]["year"]["name"]="";
		}

		if(!isset($me["education"]["7"])){
			$me["education"]["7"]["school"]["name"]="";
			$me["education"]["7"]["year"]["name"]="";

		}



		$image = file_get_contents("https://graph.facebook.com/".$me['id']."/picture");
		//header('Content-type: image/jpeg');
		//echo $image;
		$image_prof = "https://graph.facebook.com/".$me['id']."/picture";



		$my_info = array('Fb_profile' => array("fb_id" => $me["id"],
		 "name"=>$me["name"],
		 "firstname" =>$me["first_name"], "lastname" => $me["last_name"],"img_url" => $image_prof,
         "fb_url" => $me["link"], "bio" => $me["bio"], 
			


         "employer_1" => $me["work"]["0"]["employer"]["name"], 
         "location_1" => $me["work"]["0"]["location"]["name"],
		 "position_1" => $me["work"]["0"]["position"]["name"],
		 "start_date_1" =>$me["work"]["0"]["start_date"], 
		 "end_date_1"  =>$me["work"]["0"]["end_date"],
			
		 "employer_2" => $me["work"]["1"]["employer"]["name"], 
         "location_2" => $me["work"]["1"]["location"]["name"],
		 "position_2" => $me["work"]["1"]["position"]["name"],
		 "start_date_2" =>$me["work"]["1"]["start_date"], 
		 "end_date_2"  =>$me["work"]["1"]["end_date"],


		  "employer_3" => $me["work"]["2"]["employer"]["name"], 
         "location_3" => $me["work"]["2"]["location"]["name"],
		 "position_3" => $me["work"]["2"]["position"]["name"],
		 "start_date_3" =>$me["work"]["2"]["start_date"], 
		 "end_date_3"  =>$me["work"]["2"]["end_date"],

		 "employer_4" => $me["work"]["3"]["employer"]["name"], 
         "location_4" => $me["work"]["3"]["location"]["name"],
		 "position_4" => $me["work"]["3"]["position"]["name"],
		 "start_date_4" =>$me["work"]["3"]["start_date"], 
		 "end_date_4"  =>$me["work"]["3"]["end_date"],
			
		 "employer_5" => $me["work"]["4"]["employer"]["name"], 
         "location_5" => $me["work"]["4"]["location"]["name"],
		 "position_5" => $me["work"]["4"]["position"]["name"],
		 "start_date_5" =>$me["work"]["4"]["start_date"], 
		 "end_date_5"  =>$me["work"]["4"]["end_date"],
			
		 "employer_6" => $me["work"]["5"]["employer"]["name"], 
         "location_6" => $me["work"]["5"]["location"]["name"],
		 "position_6" => $me["work"]["5"]["position"]["name"],
		 "start_date_6" =>$me["work"]["5"]["start_date"], 
		 "end_date_6"  =>$me["work"]["5"]["end_date"],
			
		 "employer_7" => $me["work"]["6"]["employer"]["name"], 
         "location_7" => $me["work"]["6"]["location"]["name"],
		 "position_7" => $me["work"]["6"]["position"]["name"],
		 "start_date_7" =>$me["work"]["6"]["start_date"], 
		 "end_date_7"  =>$me["work"]["6"]["end_date"],

		 "employer_8" => $me["work"]["7"]["employer"]["name"], 
         "location_8" => $me["work"]["7"]["location"]["name"],
		 "position_8" => $me["work"]["7"]["position"]["name"],
		 "start_date_8" =>$me["work"]["7"]["start_date"], 
		 "end_date_8"  =>$me["work"]["7"]["end_date"],

		  "school_1" => $me["education"]["0"]["school"]["name"], 
		  "year_1"   => $me["education"]["0"]["year"]["name"],

		   "school_2" => $me["education"]["1"]["school"]["name"], 
		   "year_2"   => $me["education"]["1"]["year"]["name"],

		   "school_3" => $me["education"]["2"]["school"]["name"], 
		   "year_3"   => $me["education"]["2"]["year"]["name"],

		   "school_4" => $me["education"]["3"]["school"]["name"], 
		   "year_4"   => $me["education"]["3"]["year"]["name"],

		   "school_5" => $me["education"]["4"]["school"]["name"], 
		   "year_5"   => $me["education"]["4"]["year"]["name"],

		   "school_6" => $me["education"]["5"]["school"]["name"], 
		   "year_6"   => $me["education"]["5"]["year"]["name"],

		   "school_7" => $me["education"]["6"]["school"]["name"], 
		   "year_7"   => $me["education"]["6"]["year"]["name"]
		));
			
		$this -> Fb_profile -> save($my_info);


		$p = $this -> User -> find('first', array('conditions' => array('User.fb_id' => $me["id"])));


		if(empty($p)){
			$user_info = array('User' => array(
		"username" => $me["name"],
		"fb_id" => $me["id"],
		"linkedin_id" => "",
		"passwd" =>""    
		));

		$this -> User -> save($user_info);

		}

			
		$hoge = $this->User->find('first', array('conditions' => array('User.fb_id' => $me["id"])));

		/* currently no need for saving connection info so save this feature for later phase.

		$connection = $facebook->api($me["id"].'/friends');

		$i = 0;
		$b = $connection["data"];



		$e = $this->Fb_connection->find('all', array('conditions' => array('Fb_connection.fb_id_1' => $hoge["User"]["fb_id"])));
		$f = array();
		foreach ($e as $item){
		array_push($f, $item["Fb_connection"]["fb_id_2"] );
		}

		$g = array();
		$id_to_userdata = array();

		foreach($b as $item){
		array_push($g, $item["id"]);
		$id_to_userdata[$item["id"]] = $item;
		}




		//$k = $id_to_userdata["123"]
		//$k["name"]


		//insert elements into $g = array()

		$diff = array_diff($g, $f);

		foreach($diff as $item){
		$d = array('Fb_connection' => array("fb_id_1" => $me["id"], "fb_id_2" =>$item));

		$this -> Fb_connection -> save($d);

		//save only increments of Fb_connection from last updates
		}

		//find current friends list from DB

		$c_friends_array =$this->Fb_profile-> find('all', array('conditions' => array('Fb_profile.fb_id' => $f)));

		$c_friends =array();
		foreach($c_friends_array as $item){
		array_push($c_friends, $item['Fb_profile']['id'],$item['Fb_profile']['name']);
		}
			
			
		$b = $connection["data"];
			
			

		$n_friends = array();
			
		foreach($b as $item){
		array_push($n_friends,$item);
		}
			
			
		$diffname= array_diff($n_friends,$c_friends);
			
		//var_dump($diffname);
		//$diffname is ana rray including "id" and "name"
			
		foreach($diffname as $item){
		$h = array('Fb_profile' => array("fb_id" => $item["id"], "name" => $item["name"]));

		$this -> Fb_profile -> save($h);
			
		save only new friends



		}
		*/
			
		// save friends info to fb_profiles
		//save method always use array that is why $d is an array here.
		//after ->    does not have to be string
		//array key has to be string in php
			
		$id =  $hoge['User']['id'];
		$this->Session->write('id', $id);
		//print_r($hoge);
		$this->redirect('/users/fb_home');
			
	}



	function fb_profile(){
		$myid = $this->Session->read('id');
		$hoge = $this->User->find('first', array('conditions' => array('User.id' => $myid)));
		$fb_id = $hoge['User']['fb_id'];

		$fb_profile = $this -> Fb_profile -> find ('first', array('conditions'=> array('Fb_profile.fb_id' => $fb_id)));


		$this -> Career_orientation -> id = $myid;

		$t = $this->data;
		if(!empty($t)){
			$array=array(10,20,30,40,50,60,70,80,90,100);
			$d = array('Career_orientation' =>array(
			//"myid" => $myid,
		"culture" => $array[$t["User"]["culture"]],
		"salary" => $array[$t["User"]["salary"]],
		"compassion" => $array[$t["User"]["compassion"]],
		"responsibility" => $array[$t["User"]["responsibility"]],
		"sense_of_humor" => $array[$t["User"]["sense_of_humor"]],
		"perfectionism" => $array[$t["User"]["perfectionism"]]
			));

			$this-> Career_orientation ->save($d);
		}

		$career_orientation = $this -> Career_orientation -> find('first', array('conditions'=>array('Career_orientation.id' => $myid)));

		$image = $fb_profile['Fb_profile']['img_url'];

		$this -> set('image', $image);
		$this -> set('fb_profile',$fb_profile);
		$this -> set('career_orientation', $career_orientation);
		$this -> set('culture', $career_orientation["Career_orientation"]["culture"]);
		$this -> set('salary', $career_orientation["Career_orientation"]["salary"]);
		$this -> set('responsibility', $career_orientation["Career_orientation"]["responsibility"]);
		$this -> set('compassion', $career_orientation["Career_orientation"]["compassion"]);
		$this -> set('sense_of_humor', $career_orientation["Career_orientation"]["sense_of_humor"]);
		$this -> set('perfectionism', $career_orientation["Career_orientation"]["perfectionism"]);
		//var_dump($career_orientation);

		$this -> set('e_culture', ($career_orientation["Career_orientation"]["culture"]/10)-1);
		$this -> set('e_salary', ($career_orientation["Career_orientation"]["salary"]/10)-1);
		$this -> set('e_responsibility', ($career_orientation["Career_orientation"]["responsibility"]/10)-1);
		$this -> set('e_compassion', ($career_orientation["Career_orientation"]["compassion"]/10)-1);
		$this -> set('e_sense_of_humor', ($career_orientation["Career_orientation"]["sense_of_humor"]/10)-1);
		$this -> set('e_perfectionism', ($career_orientation["Career_orientation"]["perfectionism"]/10)-1);
	}

	function fb_home(){
		$facebook = new Facebook(array(
  		'appId'  => '105889496138624',
  		'secret' => '4c79ae3dea214d17ebdab77bed748173',
  		'cookie' => true,


		));
		$myid = $this->Session->read('id');


		//User.id    User is Table, myid is a column, find a data of $myid in "User" table.

		$hoge = $this->User->find('first', array('conditions' => array('User.id' => $myid)));


		$fb_id = $hoge['User']['fb_id'];
		$fb_prof = $this ->Fb_profile->find('all', array('conditions' => array('Fb_profile.fb_id' => $fb_id)));

		//var_dump($fb_prof);



		if(!$hoge){
			//user is not loogged in
			$this -> flash('you are not logged in', './index' );
		}

		if(!empty($fb_prof['0'])){
			$image = $fb_prof['0']['Fb_profile']['img_url'];

		}

		$career_orientation = $this ->Career_orientation->find('first', array('conditions' => array('Career_orientation.id' => $myid)));
		$corp_culture = $this->Corp_culture->find('all');



		$diff = array();

		foreach ($corp_culture as $item){
			array_push($diff, array(
		"id" => $item["Corp_culture"]["id"],
		"culture" => $career_orientation["Career_orientation"]["culture"]-$item["Corp_culture"]["culture"],
		"salary" => $career_orientation["Career_orientation"]["salary"]-$item["Corp_culture"]["salary"],
		"compassion" => $career_orientation["Career_orientation"]["compassion"]-$item["Corp_culture"]["compassion"] ,
		"responsibility" => $career_orientation["Career_orientation"]["responsibility"]-$item["Corp_culture"]["responsibility"] ,
		"sense_of_humor" => $career_orientation["Career_orientation"]["sense_of_humor"]-$item["Corp_culture"]["sense_of_humor"],
		"perfectionism" => $career_orientation["Career_orientation"]["perfectionism"]-$item["Corp_culture"]["perfectionism"]
			));
		}

		$this -> Match -> id = $myid;

		$match = array();
		foreach($diff as $item){
			array_push($match,array(
		"id" => $item["id"],
		"culture" => (abs($item["culture"]*3)),
		"salary" => (abs($item["salary"]*3)),
		"compassion" => abs($item["compassion"]),
		"responsibility" => abs($item["responsibility"]),
		"sense_of_humor" => abs($item["sense_of_humor"]),
		"perfectionism" => abs($item["perfectionism"]),
		"total" => (abs($item["culture"]*3))+(abs($item["salary"]*3))+abs($item["compassion"])+abs($item["responsibility"])+abs($item["sense_of_humor"])+abs($item["perfectionism"]),

			//$this-> Match ->save($match);
			));
		}

		function cmp($a, $b) {
			if ($a["total"] == $b["total"]) {
				return 0;
			}
			return ($a["total"] < $b["total"]) ? -1 : 1;
		}

		// Array to be sorted

		// Sort and print the resulting array
		uasort($match, 'cmp');

		//array_slice      ($variable, where to start, # of elements you would like to pick);
		$_total = array_slice($match,0,5);
		$i = 0;
		while( $i <count($_total)) {
			$total[$_total[$i]["id"]] = $_total[$i];
			$i++;
		}


		//pr($total);
		$match_list = array();
		foreach($total as $item){
			$c =$this->Corp_profile->find('first', array('conditions' => array('Corp_profile.id' => $item["id"])));
			array_push($match_list,$c);
		}
		//pr($match_list);
		// for output enployee list
			
		$user_applicants = $this ->User_applicant->query("SELECT u.*, j.*  FROM user_applicants u, jobposts j WHERE j.id = u.jobpost_id AND u.user_id = $myid;");
		//var_dump($user_applicants);
		//$user_save_jobs = $this->User_save_job->Jobpost->find('all', array('conditions' => array('User_save_job.user_id' =>  $myid)));
		$user_save_jobs = $this-> User_save_job ->query("SELECT u.*, j.*  FROM user_save_jobs u, jobposts j WHERE j.id = u.jobpost_id AND u.user_id = $myid;");

		$this->set('jobpost', $this->Jobpost->find('all'));
		$this->set('user_applicants',$user_applicants);
		$this->set('user_save_jobs',$user_save_jobs);
		$this->set('total', $total);
		$this->set('match_list', $match_list);
		$this -> set('id',$myid);
		$this -> set('image', $image);
		$this -> set('name',$hoge['User']['username']);
		$this -> set('loginUrl', $facebook->getLoginUrl(array("next"=>"http://job-tiger.com/users/fb_login")));

		if(isset($fb_prof['0'])){
			$this -> set('employer_1', $fb_prof['0']['Fb_profile']['employer_1']);
			$this -> set ('position_1', $fb_prof['0']['Fb_profile']['position_1']);
		}
	}

	function stats(){
		//$fb_id_1 = $this->Session->read('fb_id_1');
		//$fb_id_2 = $this -> Session -> read('fb_id_2');

		//User.id    User is Table, myid is a column, find a data of $myid in "User" table.
		$myid = $this->Session->read('id');
		$hoge = $this->User->find('first', array('conditions' => array('User.id' => $myid)));



		$cons = $this->Fb_connection->find('all', array('conditions' => array('Fb_connection.fb_id_1' => $hoge["User"]["fb_id"])));


		//$consname = $this -> Fb_profile -> find('all',array('conditions' => array('Fb_profile.id' => $cons["Fb_connection"]["fb_id_2"])));

		//$friends_name = $this -> Fb_connection-> find('all', array('conditions' => array(Fb)))


		$ids = array();

		foreach($cons as $item){
			array_push($ids, $item["Fb_connection"]["fb_id_2"] );
		}


		$s = $this -> Fb_profile -> find("all", array("conditions" => array('Fb_profile.fb_id' => $ids)));

		$names = array();
		foreach($s as $item){
			array_push($names, $item["Fb_profile"]["name"]);
		}

		$name = $hoge['User']['username'];

		$this -> set('cons', $cons);
		$this -> set('s', $s);
		$this -> set('names', $names);
		$this -> set('name',$name);

	}


	function test() {
		if (!empty($this->data)) {
			if ($this->Jobpost->save($this->data)) {
				$this->flash('Your post has been saved.','/posts');
				pr($this->data);
			}
		}
	}

	function add() {
		if (!empty($this->data)) {
			//$t = $this ->data;
			//$pic_a = array("name" => $t["Users"]["image"]["name"],"image" =>  );
			$this->Pics->create();
			if ($this->Pics->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
	}

	function delete($id) {
		$this->Jobpost->del($id);
		$this->flash('The post with id: '.$id.' has been deleted.', '/posts');
	}

	function edit($id = null) {
		$this->Jobpost->id = $id;
		if (empty($this->data)) {
			$this->data = $this->Jobpost->read();
		} else {
			if ($this->Jobpost->save($this->data['Jobpost'])) {
				$this->flash ('Your post has been updated.','/posts');
			}
		}
	}
}
?>
