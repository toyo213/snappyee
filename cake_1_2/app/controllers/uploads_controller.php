<?php
class UploadsController extends AppController
{

	var $name = 'Uploads';
	var $components = array('FileHandler');
	var $uses = array('FileUpload','User','User_profile','User_save_job','User_applicant','Career_orientation','Pics','Corp_profile','Corp_culture','Ctob_wink', 'Btoc_wink','Job_history','Edu_history');


	/**
	 * handle upload of files and submission info
	 */
	function index() {
		//if (isset($this->data)) {
		if (true) {

			// allowed mime types for upload
			$allowedMime = array(
                              'image/jpeg',          // images
                              'image/pjpeg', 
                              'image/png', 
                              'image/gif', 

                              'application/pdf',     // pdf
                              'application/x-pdf', 
                              'application/acrobat', 
                              'text/pdf',
                              'text/x-pdf', 

                              'text/plain',          // text
			);

			// extra database field
			//$dbFields = array('extra_field'  => $this->data['data']['extra_field']);
			$dbFields = array('extra_field'  => '');
			
                        // set the upload directory
			$uploadDir = realpath(TMP).DS;
			//echo $uploadDir;
			$resume = $uploadDir;
			$this->set('resume',$resume);


			// settings for component
			$this->FileHandler->setAllowedMime($allowedMime);
			$this->FileHandler->setDebugLevel(1);
			$this->FileHandler->setRequired(0);
			$this->FileHandler->setHandlerType('db');
			$this->FileHandler->setDbModel('FileUpload');
			$this->FileHandler->addDbFields($dbFields);

			if ($this->FileHandler->upload('userfile', $uploadDir)) {

				/* if nothing is submitted and required is set to 0
				 * upload() will return true so you need to handle
				 * empty uploads in your own way
				 */
				//echo 'upload succeeded';
				$this->set('uploadData', $this->FileHandler->getLastUploadData());
				//var_dump($this->FileHandler->getLastUploadData());
				$updir = $this->FileHandler->getLastUploadData();
				$dir = explode('/',$updir[0]['dir']);
				$sql   =  'update file_uploads set twitter_id ='.$this->Session->read('id').' where subdir =\''.$dir[7].'\'';
				$jobpost = 'update file_uploads set jobpost_id ='.$this->Session->read('jobpost_id').' where subdir =\''.$dir[7].'\'';
				//var_dump($sql);
				$this->FileUpload->query("$sql");
				$this->FileUpload->query("$jobpost");
				// $lastinsertid
				// update file_uploads set twitter_id = $this->Session->read('myid')  $where id = $lastinsertid;
				$this->redirect('/users/user_resume');
			} else {
				echo 'upload failed';
			}

			$this->set('errorMessage', $this->FileHandler->errorMessage);
		}

	}//index()

}//UploadsController
?>
