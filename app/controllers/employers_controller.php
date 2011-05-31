<?php
class EmployersController extends AppController {
	var $name = 'Employers';

	var $uses = array('User','Employer', 'Fb_profile', 'Fb_connection','Jobpost','Corp_profile','Corp_culture','Career_orientation',
	'User_profile','User_applicant','Ctob_wink', 'Btoc_wink','Job_history','Edu_history','User_message','Employer_message');
	// when you want to use models besides Users you have to define as $uses = array (xxxx)

	function index(){

	}


	function signup(){
				$f ="";
				$this->set('f',$f);
				
		if (!empty($this->data)) {
			$t = $this -> data;
				
			//var_dump($t);
			$employer = array('Employer' => array(
				"username" => $t["Employer"]["username"],
				"passwd" =>   $t["Employer"]["passwd"],
				"email" =>    $t["Employer"]["email"]
			));
				
			$e=$this->Employer->find('first', array('conditions' => array('Employer.username' => $employer["Employer"]["username"])));	
			if(!empty($e)){
				$f="<span style=color:red>このIDは既に使用されています。this username has alrady been taken please choose another one</span>";
				$this->set('f',$f); 
			}else{
				$f ="";
				$this->set('f',$f);
				
				$this->Employer->set( $this->data );
				//var_dump($this->Employer->validates($this->data));
				//			$this-> Employer -> save($employer);
				if (!$this->Employer->save($this->data)) {
					$errors = $this->Employer->invalidFields();
					$er = '';
					foreach ($errors as $key => $val ) {
						$er .= $key.':'.$val.'<br>';
					}
					$this->Session->setFlash(__($er, true));
					
					$this->redirect('/employers/signup');
					//exit;
				}



				$this->sendMail($t["Employer"]["email"], 'Welcome to Job Tiger! Job Tigerへようこそ',
			'Japanese'."\n\n".
			'Job Tigerにサインアップいただき誠にありがとうございます。'."\n\n".'下記が貴方のアカウント情報ですのでご確認ください'
			."\n\n".'User Name           '.$t["Employer"]["username"]."\n\n".
			         'Email    '.$t["Employer"]["email"]."\n\n\n\n".

			'English'."\n\n".
			'Thank you for signing up Job Tiger!'."\n\n".'The easiest way to find right candidates!'
			."\n\n".'Your User Name           '.$t["Employer"]["username"]."\n\n".
			'Email    '.$t["Employer"]["email"]."\n\n\n\n", 
			'info@job-tiger.com','Team Job Tiger');


			//			$this-> Employer -> save($employer);
			$this->flash('アカウントが作成されました　Your account has been successfully created.','/employers/login');
			//pr($this->data);
			}
		}
		

	}




	function login(){
		if (!empty($this->data)) {
			//var_dump($this->data);
			$n = $this -> data['Employer']['username'];
			$m = $this -> Employer -> find('first', array('conditions' => array('Employer.username' => $n)));


			if($this -> data['Employer']['passwd'] == $m['Employer']['passwd'])
			{
				$employer_id =  $m['Employer']['employer_id'];
				$this->Session->write('employer_id', $employer_id);
				$this->redirect('/users/index');
				//$this->flash('you have been logged in as '.$m['Employer']['username'], '/employers/home');
					
			} else {

				$this->Session->setFlash(__('<span style="color:red">Usernameもしくはパスワードが正しくありませんID or password is not correct.</span>', true));
				$this->redirect(array('action'=>'login'));
			}


			//$s = $this -> find -> array("User.id" =>  );
			//if($this -> User -> password = "$s")
		}

	}

	function logout(){
		$this->Session->del('employer_id');
		$this->Session->setFlash(__('ログアウトしました。You are logged out', true));
		$this->redirect(array('action'=>'../users/index'));
	}

	function home(){
		$employer_id = $this->Session->read('employer_id');
		$employer_array = $this->Employer->find('first', array('conditions' => array('Employer.employer_id' => $employer_id)));
		//var_dump($employer_array);
		$this ->set('name', $employer_array["Employer"]["username"]);

		$u_msg = $this->User_message->query("SELECT u.* FROM user_messages u  WHERE u.read_flg = 0 AND u.rid = $employer_id;");
		$this->set('u_msg',$u_msg);

			
		$corp_profile = $this-> Corp_profile ->find('first', array('conditions' => array('Corp_profile.id' => $employer_id)));

		$conditions = array(
           'conditions' => array('delete_flg' => 0,
		'employer_id'=>$employer_id)
		);

		$my_jobpost = $this->Jobpost->find('all', $conditions);

		$r_application = $this->User->query("SELECT u.*,us.* FROM user_applicants u,users us WHERE u.user_id = us.id AND u.employer_id = $employer_id;");
		$this->set('r_application',$r_application);
		 

		//$my_jobpost = $this -> Jobpost -> find('all', array('conditions' => array('Jobpost.employer_id' => $employer_id)));




		$corp_culture = $this -> Corp_culture -> find('first', array('conditions' => array('Corp_culture.id' => $employer_id)));
		$career_orientation = $this->Career_orientation->find('all');


		$diff = array();

		foreach ($career_orientation as $item){
			array_push($diff, array(
		"id" => $item["Career_orientation"]["id"],
		"culture" => $item["Career_orientation"]["culture"]-$corp_culture["Corp_culture"]["culture"],
		"salary" => $item["Career_orientation"]["salary"]-$corp_culture["Corp_culture"]["salary"],
		"compassion" => $item["Career_orientation"]["compassion"]-$corp_culture["Corp_culture"]["compassion"] ,
		"responsibility" => $item["Career_orientation"]["responsibility"]-$corp_culture["Corp_culture"]["responsibility"] ,
		"sense_of_humor" => $item["Career_orientation"]["sense_of_humor"]-$corp_culture["Corp_culture"]["sense_of_humor"],
		"perfectionism" => $item["Career_orientation"]["perfectionism"]-$corp_culture["Corp_culture"]["perfectionism"]
			));
		}



		$this -> Match -> id = $employer_id;

		$match = array();
		foreach($diff as $item){
			array_push($match,array(
		"user_id" => $item["id"],
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


		// Comparison function
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
		$_total = array_slice($match,0,10);
		$i = 0;
		while($i <count($_total)) {
			$total[$_total[$i]["user_id"]] = $_total[$i];
			$i++;
		}

		$match_list = array();
		foreach($total as $item){
			$c =$this->User->find('first', array('conditions' => array('User.id' => $item["user_id"])));
			array_push($match_list,$c);
		}

		//var_dump($match_list);
		//this feature will be back in business when we get more users

		//Job_hisotry only
		$user_match =array();
		foreach($total as $item){
			$k=$this->Job_history->find('first', array('conditions' => array('Job_history.user_id' => $item["user_id"])));
			array_push($user_match,$k);
		}



		//pr($match_list);
		//pr($total);
		//$user_applicants = $this ->User_applicant->query("SELECT u.*, j.*  FROM user_applicants u, jobposts j WHERE j.id = u.jobpost_id AND u.user_id = $myid;");

		$this -> set('total', $total);
		$this->set('match_list', $match_list);
		$this->set('career_orientation',$career_orientation);
		//var_dump($my_jobpost);
		$this -> set('corp_profile', $corp_profile);
		$this -> set('jobposts', $my_jobpost);
		$this-> set('user_match',$user_match);
	}



	// --- Wink Sending function from Buisiness(Sender) to Comnsumer(Receiver) ---//
	function btocWink() {
		$data=null;
		$sid=$this->Session->read('employer_id'); // sid = SenderID for Wink (login user)
		$rid=(int)$_GET['rid']; //rid = ReceiverID for Wink ("Get 'rid'" from Wink button)

		$data['wink']['sid']=$sid;
		$data['wink']['rid']=$rid;

		$this->Btoc_wink->save();
		$data['wink']['id']=$this->Btoc_wink->id;

		$this->Btoc_wink->id=$data['wink']['id'];

		$this->Btoc_wink->saveField('sid',$sid);
		$this->Btoc_wink->saveField('rid',$rid);

		$this->set('data',$data);

		$rdata=$this->User_profile->findById($rid);
		// $this->set('rname',$rdata['user_profile']['name']);
		$this->Session->setFlash(__('<span style="color:red">You like it! イイネ！　</span>', true));
		$this->redirect(array('action'=>'../users/user_profile_view/'.$rid));

	}

	// --- Comment Sending Function with Wink from Consumer to Buisiness ---//
	function btocComment() {
		$data=null;
		$this->set('id', (int)$_GET['id']); //Wink ID which you want to comment with
		//	var_dump($this->data);

		if(!empty($this->data)){

			$wink=$this->Btoc_wink->findById((int)$_GET['id']);

			//var_dump($wink);

			$this->Btoc_wink->id=(int)$_GET['id'];
			$this->Btoc_wink->saveField('content',$this->data['Wink']['content']);
			$this->Btoc_wink->saveField('check',0);
			$this->Session->setFlash(__('Your Comment has been sent', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function btocWinklist(){
		$this->Session->read('employer_id');
		$update = array('Btoc_wink.check'=>1);
		$condition = array('Btoc_wink.rid'=>0);//$this->Session->read('myid'));
		$this->Btoc_wink->updateAll($update, $condition);
		$winks = $this->Btoc_wink->findAllByRid('myid');//$this->Session->read('myid'));
		$this->set('winks', $winks);
	}


	function r_wink(){
		$employer_id = $this->Session->read('employer_id');
		$likes = $this->Ctob_wink->find('all', array('conditions' => array('Ctob_wink.rid' =>  $employer_id)));

		/*
		 $name = array();
		 foreach($likes as $item){
			$c =$this->User_profile->find('first', array('conditions' => array('User_profile.id' => $item["Ctob_wink"]["sid"])));
			array_push($name,$c["User_profile"]["name"]);
			}
			*/

		$r_likes = $this->Job_history->query("SELECT c.*,j.* FROM ctob_winks c,job_histories j WHERE c.sid = j.user_id AND c.rid = $employer_id;");
		//job_order conditions have to be added later so that it can choose only most recent job history data
		$r_like  = $this->Ctob_wink->query("SELECT c.*,u.* FROM ctob_winks c,users u WHERE c.sid = u.id AND c.rid = $employer_id;");



		$this->set('likes',$likes);
		$this->set('r_likes',$r_likes);
		$this->set('r_like',$r_like);
	}

	function s_wink(){
		$employer_id = $this->Session->read('employer_id');
		$likes = $this->Btoc_wink->find('all', array('conditions' => array('Btoc_wink.sid' =>  $employer_id)));

		$s_likes=array();
		foreach($likes as $item){
			$p_likes = $this->User->find('first', array('conditions' => array('User.id' =>  $item["Btoc_wink"]["rid"])));
			array_push($s_likes,$p_likes);
		}
			
		$_s_likes = $this->Btoc_wink->query("SELECT u.*,bw.* FROM users u,btoc_winks bw WHERE u.id = bw.rid AND bw.sid = $employer_id;");


		$this->set('likes',$likes);
		$this->set('s_likes',$s_likes);
		$this->set('_s_likes',$_s_likes);
	}

	function r_application(){
		$employer_id = $this->Session->read('employer_id');
		$application = $this->User_applicant->find('all', array('conditions' => array('User_applicant.employer_id' =>  $employer_id)));

		/*
		 $job_history=array();
		 $applicants=array();
		 foreach($application as $item)
		 {
			$a = $this->User_profile->find('first', array("conditions"=>array("User_profile.id"=> $item["User_applicant"]["user_id"])));
			$b = $this->Job_history->find('first', array("conditions"=>array("Job_history.user_id"=> $item["User_applicant"]["user_id"])));
			array_push($applicants,$a);
			array_push($job_history,$b);
			}
			*/

		//$r_application = $this->Job_history->query("SELECT u.*,j.*,up.* FROM user_applicants u,job_histories j,user_profiles up WHERE u.user_id = j.user_id && j.user_id = up.id AND u.employer_id = $employer_id;");
		$r_application = $this->User->query("SELECT u.*,us.* FROM user_applicants u,users us WHERE u.user_id = us.id AND u.employer_id = $employer_id;");
		//var_dump($r_application);
		//conditions to shoose only most recent record has to be added

		//var_dump($r_application);

		$this->set('r_application',$r_application);
		$this ->set('application',$application);

		$aid=isset($_GET['aid'])?$_GET['aid']:'';
		if(!empty($aid)){
			$this->User_applicant->id = $aid;
			$this->saveField('read_flg',1); //1 means alrady read
		};
		//$this->set('applicants', $applicants);
		//$this->set('job_history',$job_history);
	}

	function edit_jobpost(){
		$employer_id = $this->Session->read('employer_id');
		$jid=isset($_GET['jid'])?$_GET['jid']:'';
		$jobpost = $this->Jobpost->find('first', array('conditions' => array('Jobpost.id' => $jid)));

		$this ->set('jobpost', $jobpost);
		$this->set('jid', $jid);

		$t = $this -> data;

		if (!empty($t)){
			$this->Jobpost->saveField('id',$t["Employer"]["Jobpost_id"]);
			$this->Jobpost->saveField('corporation',$t["Employer"]["corporation"]);
			$this->Jobpost->saveField('job_title',$t["Employer"]["job_title"]);
			$this->Jobpost->saveField('location',$t["Employer"]["location"]);
			$this->Jobpost->saveField('salary_range_min',$t["Employer"]["salary_range_min"]);
			$this->Jobpost->saveField('salary_range_max',$t["Employer"]["salary_range_max"]);
			$this->Jobpost->saveField('salary_range_comment',$t["Employer"]["salary_range_comment"]);
			$this->Jobpost->saveField('requirement',$t["Employer"]["requirement"]);
			$this->Jobpost->saveField('job_description',$t["Employer"]["job_description"]);

			$this->flash('your Jobpost has been updated', './home','0');
		}
		//header info can not be modified
		//$this->Session->setFlash(__('You are logged out', true));
		//$this->redirect(array('action'=>'index'));
	}

	function jobpostview ($id = null) {
		$this->Jobpost->id = $id;
		$employer = $this->Jobpost->find('first',array("conditions"=>array("Jobpost.id" =>$id)));
		$employer_id = $employer["Jobpost"]["employer_id"];
		$this->set('jobpost', $this->Jobpost->read());
		$this->set('user_id', $this->Session->read('myid'));
		$this->set('employer_id',$employer_id);
	}

	function user_profile_view(){

		//needs to be fixed later
		$id=(int)$_GET['sid'];


		//$this -> User_profile -> id = $id;
		//$this -> set('user_profile', $this-> User_profile ->read());

		$prof = $this->User->find('first', array('conditions' => array('User_profile.id' => $id)));

		$this->set('prof',$prof);

		$this -> Career_orientation -> id =$id;
		$this -> set('career_orientation', $this -> Career_orientation ->read());

		$career_orientation = $this -> Career_orientation -> find('first', array('conditions'=>array('Career_orientation.id' => $id)));
		$this -> set('culture', $career_orientation["Career_orientation"]["culture"]);
		$this -> set('salary', $career_orientation["Career_orientation"]["salary"]);
		$this -> set('responsibility', $career_orientation["Career_orientation"]["responsibility"]);
		$this -> set('compassion', $career_orientation["Career_orientation"]["compassion"]);
		$this -> set('sense_of_humor', $career_orientation["Career_orientation"]["sense_of_humor"]);
		$this -> set('perfectionism', $career_orientation["Career_orientation"]["perfectionism"]);

		/*
		 //for the career orientation value
		 $this ->set('e_culture', ($career_orientation["Career_orientation"]["culture"]-10)/10);
		 $this ->set('e_salary', ($career_orientation["Career_orientation"]["salary"]-10)/10);
		 $this ->set('e_responsibility', ($career_orientation["Career_orientation"]["responsibility"]-10)/10);
		 $this ->set('e_compassion',($career_orientation["Career_orientation"]["compassion"]-10)/10);
		 $this ->set('e_sense_of_humor', ($career_orientation["Career_orientation"]["sense_of_humor"]-10)/10);
		 $this ->set('e_perfectionism', ($career_orientation["Career_orientation"]["perfectionism"]-10)/10);
		 */
	}

	function user_profile_fullview(){
		$id=(int)$_GET['sid'];

		$this -> User_profile -> id = $id;
		$this -> set('user_profile', $this-> User_profile ->read());

		$prof = $this->User_profile->find('first', array('conditions' => array('User_profile.id' => $id)));
		$job_history = $this->Job_history->find('all', array('conditions' => array('Job_history.user_id' => $id)));
		$edu_history = $this->Edu_history->find('all', array('conditions' => array('Edu_history.user_id' => $id)));

		$this->set('prof',$prof);
		$this->set('job_history',$job_history);
		$this->set('edu_history',$edu_history);

		$this -> Career_orientation -> id =$id;
		$this -> set('career_orientation', $this -> Career_orientation ->read());

		$career_orientation = $this -> Career_orientation -> find('first', array('conditions'=>array('Career_orientation.id' => $id)));
		$this -> set('culture', $career_orientation["Career_orientation"]["culture"]);
		$this -> set('salary', $career_orientation["Career_orientation"]["salary"]);
		$this -> set('responsibility', $career_orientation["Career_orientation"]["responsibility"]);
		$this -> set('compassion', $career_orientation["Career_orientation"]["compassion"]);
		$this -> set('sense_of_humor', $career_orientation["Career_orientation"]["sense_of_humor"]);
		$this -> set('perfectionism', $career_orientation["Career_orientation"]["perfectionism"]);
	}

	function profile(){
		$employer_id = $this->Session->read('employer_id');
		$employer_array = $this->Employer->find('first', array('conditions' => array('Employer.employer_id' => $employer_id)));
		$this ->set('name', $employer_array["Employer"]["username"]);

		$corp_profile = $this-> Corp_profile ->find('first', array('conditions' => array('Corp_profile.id' => $employer_id)));

		$this -> set('corp_profile', $corp_profile);
			
		//var_dump($this -> data);
		$t = $this -> data;
			
		$this -> Corp_profile -> id = $employer_id;
		if (!empty($t)){
			$corp_info = array('Corp_profile' => array(
			//"employer_id" => $employer_id,
				"corporation" => $t["Employer"]["corporation"],
				"corp_url"   => $t["Employer"]["url"],
				"corp_profile"=>$t["Employer"]["corp_profile"],
				"corp_contact"=>$t["Employer"]["corp_contact"],
			    "twitter" =>    $t["Employer"]["twitter"]
			));



			$this ->Corp_profile ->save($corp_info);

			$this->flash('your corporation profile has been updated', './home','0');


			$this->set('corp_info', $corp_info);

		}



		$corp_culture = $this -> Corp_culture -> find('first', array('conditions'=>array('Corp_culture.id' => $employer_id)));
		$this -> Corp_culture -> id = $employer_id;

		//var_dump($employer_id);
		$s = $this->data;
		$this -> Corp_culture -> id = $employer_id;
		//var_dump($s);
		if(!empty($s)){
			$array=array(10,20,30,40,50,60,70,80,90,100);
			$d = array('Corp_culture' =>array(
			//"myid" => $myid,
		"culture" => $array[$s["Employer"]["culture"]],
		"salary" => $array[$s["Employer"]["salary"]],
		"compassion" => $array[$s["Employer"]["compassion"]],
		"responsibility" => $array[$s["Employer"]["responsibility"]],
		"sense_of_humor" => $array[$s["Employer"]["sense_of_humor"]],
		"perfectionism" => $array[$s["Employer"]["perfectionism"]]
			));

			$this-> Corp_culture ->save($d);
		}

		$this -> set('corp_culture', $corp_culture);
		$this -> set('culture', $corp_culture["Corp_culture"]["culture"]);
		$this -> set('salary', $corp_culture["Corp_culture"]["salary"]);
		$this -> set('responsibility', $corp_culture["Corp_culture"]["responsibility"]);
		$this -> set('compassion', $corp_culture["Corp_culture"]["compassion"]);
		$this -> set('sense_of_humor', $corp_culture["Corp_culture"]["sense_of_humor"]);
		$this -> set('perfectionism', $corp_culture["Corp_culture"]["perfectionism"]);
		//$this-> set('twitter', $t["Employer"]["twitter"]);
		//var_dump($corp_culture);

	}

	function edit_profile(){
		$employer_id = $this->Session->read('employer_id');
		$employer_array = $this->Employer->find('first', array('conditions' => array('Employer.employer_id' => $employer_id)));
		$this ->set('name', $employer_array["Employer"]["username"]);

		$corp_profile = $this-> Corp_profile ->find('first', array('conditions' => array('Corp_profile.id' => $employer_id)));
		$this -> set('corp_profile', $corp_profile);

		$corp_culture = $this -> Corp_culture -> find('first', array('conditions'=>array('Corp_culture.id' => $employer_id)));

		$this -> Corp_culture -> id = $employer_id;


		$t = $this -> data;

		$this -> Corp_profile -> id = $employer_id;
		if (!empty($t)){
			$corp_info = array('Corp_profile' => array(
			//"employer_id" => $employer_id,
				"corporation" => $t["Employer"]["corporation"],
				"corp_url"   => $t["Employer"]["url"],
				"corp_profile"=>$t["Employer"]["corp_profile"],
				"corp_contact"=>$t["Employer"]["corp_contact"],
				"twitter" =>    $t["Employer"]["twitter"]
			));



			$this ->Corp_profile ->save($corp_info);

			$this->flash('your corporation profile has been updated', './home','0');


			$this->set('corp_info', $corp_info);

		}

		//data save
		$s = $this->data;
		if(!empty($s)){
			$array=array(10,20,30,40,50,60,70,80,90,100);
			$d = array('Corp_culture' =>array(
			//"myid" => $myid,
		"culture" => $array[$s["Employer"]["culture"]],
		"salary" => $array[$s["Employer"]["salary"]],
		"compassion" => $array[$s["Employer"]["compassion"]],
		"responsibility" => $array[$s["Employer"]["responsibility"]],
		"sense_of_humor" => $array[$s["Employer"]["sense_of_humor"]],
		"perfectionism" => $array[$s["Employer"]["perfectionism"]]
			));

			$this-> Corp_culture ->save($d);
		}

		$this -> set('corp_culture', $corp_culture);
		$this -> set('culture', $corp_culture["Corp_culture"]["culture"]);
		$this -> set('salary', $corp_culture["Corp_culture"]["salary"]);
		$this -> set('responsibility', $corp_culture["Corp_culture"]["responsibility"]);
		$this -> set('compassion', $corp_culture["Corp_culture"]["compassion"]);
		$this -> set('sense_of_humor', $corp_culture["Corp_culture"]["sense_of_humor"]);
		$this -> set('perfectionism', $corp_culture["Corp_culture"]["perfectionism"]);


		//var_dump(($corp_culture["Corp_culture"]["culture"]-10)/10);

		$this ->set('e_culture', ($corp_culture["Corp_culture"]["culture"]-10)/10);
		$this ->set('e_salary', ($corp_culture["Corp_culture"]["salary"]-10)/10);
		$this ->set('e_responsibility', ($corp_culture["Corp_culture"]["responsibility"]-10)/10);
		$this ->set('e_compassion',($corp_culture["Corp_culture"]["compassion"]-10)/10);
		$this ->set('e_sense_of_humor', ($corp_culture["Corp_culture"]["sense_of_humor"]-10)/10);
		$this ->set('e_perfectionism', ($corp_culture["Corp_culture"]["perfectionism"]-10)/10);
	}

	/*
	 * employers can serach user
	 *@author chihiroms
	 */
	function user_list() {

		$sql = "SELECT f.*, u.myid from fb_profiles f, users u WHERE u.fb_id = f.id ";

		if (isset($this->data["Employer"]["location"]) && $this->data["Employer"]["location"] != "") {
			$sql .= "AND (f.location_1 LIKE '%" . $this->data["Employer"]["location"]. "%' OR f.location_2 LIKE '%" .$this->data["Employer"]["location"]. "%' OR f.location_3 LIKE '%" .$this->data["Employer"]["location"]. "%' )  ";
		}

		if (isset($this->data["Employer"]["Name"]) && $this->data["Employer"]["Name"] != "") {
			$sql .= "AND (f.name LIKE '%" .$this->data["Employer"]["Name"]. "%' ) ";
		}

		if (isset($this->data["Employer"]["job_title"]) && $this->data["Employer"]["job_title"] != "") {
			$sql .= "AND (f.position_1 LIKE '%" . $this->data["Employer"]["job_title"]. "%' OR f.position_2 LIKE '%" .$this->data["Employer"]["job_title"]. "%'  OR f.position_3 LIKE '%" .$this->data["Employer"]["job_title"]. "%' ) ";
		}

		if (isset($this->data["Employer"]["corporation"]) && $this->data["Employer"]["corporation"] != "") {
			$sql .= "AND ( f.employer_1 LIKE '%" . $this->data["Employer"]["corporation"]. "%' OR f.employer_2 LIKE '%" .$this->data["Employer"]["corporation"]. "%' OR f.employern_3 LIKE '%" .$this->data["Employer"]["corporation"]. "%' ) ";
		}

		$sql .= ";";

		$users = $this->Fb_profile->query($sql);
		$this->set('users', $users);
		echo $sql;
	}

	function create_message(){
		$id = $this->Session->read('employer_id');
		$rid=isset($_GET['rid'])?($_GET['rid']):'';
		$name = $this->User->find('first',array("conditions"=>array("User.id" =>$rid)));


		$this->set('rid',$rid);
		$this->set('name',$name["User"]["twitter_id"]);
		$this->set('image',$name["User"]["images"]);

		$d=$this->data;


		if(!empty($d)){
			$this->Employer_message->saveField('sid', $id);
			$this->Employer_message->saveField('rid',$d["Employer"]["rid"]);
			$this->Employer_message->saveField('rel', 1);  //rel 0 means Eemployer -> Users, 1 means Users to Employers, 2 means Users to Users
			$this->Employer_message->saveField('read_flg', 0); //0 for unread
			$this->Employer_message->saveField('subject',$d["Employer"]["subject"]);
			$this->Employer_message->saveField('body',$d["Employer"]["body"]);
			$this->Employer_message->saveField('created',date("Y-m-d H:i:s"));

			$this->Session->setFlash(__('メッセージが送信されました。Your Message has been sent', true));
			$this->redirect(array('action'=>'home'));

			//$this->data["Create_message"]["created_at"] = date("Y-m-d H:i:s");;
		}

	}

	function r_message(){
		$id = $this->Session->read('employer_id');
		$u_msg = $this->User_message->query("SELECT u.* FROM user_messages u  WHERE u.read_flg = 0 AND u.rid = $id;");
		$this->set('u_msg',$u_msg);

		$msg = $this->Employer_message->query("SELECT u.*, p.*  FROM user_messages u, users p WHERE u.rid = $id AND p.id = u.sid;");
		$this->set('msg',$msg);
	}

	function view_message(){
		$id = $this->Session->read('employer_id');
		$mid=(int)$_GET['id'];

		$msg = $this->User_message->query("SELECT u.*, p.*  FROM user_messages u, users p WHERE u.id = $mid AND p.id = u.sid;");
		$this->set('msg',$msg);

		$this->User_message->id=$mid;
		$this->User_message->saveField('read_flg',1); //1 means already read
	}

	function reply_message(){
		$id = $this->Session->read('employer_id');

		if(!empty($_GET['id'])){
			$mid=$_GET['id'];
			$this->User_message->id=$mid;
			$this->User_message->saveField('read_flg',1); //1 means already read
			$msg = $this->User_message->query("SELECT u.*, p.*  FROM user_messages u, users p WHERE u.id = $mid AND p.id = u.sid;");
			$this->set('msg',$msg);
		}else{$_GET['id']='';}


		$d=$this->data;
		//pr($d);

		if(!empty($d)){
			$this->Employer_message->saveField('sid', $id);
			$this->Employer_message->saveField('rid',$d["Employer"]["rid"]);
			$this->Employer_message->saveField('rel', 1);  //rel 0 means Eemployer -> Users, 1 means Users to Employers, 2 means Users to Users
			$this->Employer_message->saveField('read_flg', 0); //0 for unread
			$this->Employer_message->saveField('subject',$d["Employer"]["subject"]);
			$this->Employer_message->saveField('body',$d["Employer"]["body"]);
			$this->Employer_message->saveField('created',date("Y-m-d H:i:s"));

			$this->Session->setFlash(__('メッセージが送信されました。Your Message Has been sent', true));
			$this->redirect(array('action'=>'home'));
		}

			
	}

	function jobpost(){
		$employer_id = $this->Session->read('employer_id');

		$this -> Jobpost -> id = $employer_id;

		//var_dump($this->data);
		$em = $this-> data;
		if (!empty($em)){
			$jobpost = array('Jobpost' => array(
			"employer_id" => $employer_id,
			"corporation" => $em["Employer"]["corporation"],
			"job_title"   => $em["Employer"]["job_title"],
			"location"     => $em["Employer"]["location"],
			"salary_range_min"=>$em["Employer"]["salary_range_min"],
			"salary_range_max"=>$em["Employer"]["salary_range_max"],
			"salary_range_comment" => $em["Employer"]["salary_range_comment"],
			"requirement"=> $em["Employer"]["requirement"],
			"job_description" =>$em["Employer"]["job_description"],
			"created_at" => date("Y-m-d H:i:s")
			));
			//var_dump($_POST);
			//var_dump($em);
			$this -> set ('em', $em);
			if(@$_POST['mode']=='confirm'){
				$this->render("jobpost_confirm");
				return;
			}

			$this ->Jobpost ->save($jobpost);
			$this->flash('your job post has been posted!!', './home','0');

		}
	}

	function jobpost_confirm(){
		$employer_id = $this->Session->read('employer_id');


	}

	function delete_jobpost(){
		$jid=(int)$_GET['jid'];
		$j = $this -> Jobpost -> find('first', array('conditions' => array('Jobpost.id' => $jid)));

		$this->Jobpost->id=$jid;
		$this->Jobpost->saveField('delete_flg',1);
		$this->Session->setFlash(__('求人情報を削除しました。Jobpost has been deleted', true));
		$this->redirect(array('action'=>'home'));
	}

	function jobpost_payment(){

	}


	function sendMail($to, $subject, $body, $from_email,$from_name)
	{
		$headers  = "MIME-Version: 1.0 \n" ;
		$headers .= "From: " .
           "".mb_encode_mimeheader (mb_convert_encoding($from_name,"ISO-2022-JP","AUTO")) ."" .
           "<".$from_email."> \n";
		$headers .= "Reply-To: " .
           "".mb_encode_mimeheader (mb_convert_encoding($from_name,"ISO-2022-JP","AUTO")) ."" .
           "<".$from_email."> \n";
			

		$headers .= "Content-Type: text/plain;charset=ISO-2022-JP \n";


		/* Convert body to same encoding as stated
		 in Content-Type header above */

		$body = mb_convert_encoding($body, "ISO-2022-JP","AUTO");

		/* Mail, optional paramiters. */
		$sendmail_params  = "-f$from_email";

		mb_language("ja");
		$subject = mb_convert_encoding($subject, "ISO-2022-JP","AUTO");
		$subject = mb_encode_mimeheader($subject);

		$result = mail($to, $subject, $body, $headers, $sendmail_params);
			
		return $result;
	}


}
?>
