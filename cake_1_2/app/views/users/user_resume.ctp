<!-- input type="text" style="width:100px;" /> -->

<br/>
<br/>

Your full profile will be viewed by this Employer after your application submission.

<br/> この企業に応募した場合、企業側は貴方の経歴を見る事ができます。

<br/>
<br/>

<?php
 echo $form->create('User', array('type' => 'post', 'action' => 'user_applicant'));
 echo $form->hidden('User_applicant.user_id', array('value' => $user_id));
 echo $form->hidden('User_applicant.jobpost_id', array('value' => $job_id));
 echo $form->hidden('User_applicant.employer_id', array('value'=> $employer_id));
 if(!empty($hid)){echo $form->hidden('User_applicant.hid', array('value'=> $hid));}
 if(!empty($resume)){  
 	echo $form->hidden('User_applicant.resume', array('value'=> $resume["0"]["f"]["subdir"]."/".$resume["0"]["f"]["file_name"]));}
 echo $form->end('Submit'); 
?>

<!--   Resume full path example /cake_1_2/app/tmp/rf4cf716d2364ae/Go-Pon.pdf -->


<?php 
if (!empty($resume)){ echo $resume["0"]["f"]["file_name"]; 
 echo "<img src=http://cdn1.iconfinder.com/data/icons/prettyoffice/64/import.png>";
}
?>


<br/>
<br/>
<br/>
<br/>
<br/>

<h4>Attach Your Resume 履歴書を添付してください</h4>


<?php echo $form->create('Upload',array('enctype' => 'multipart/form-data','action'=>'index')); ?>

<input type="file" name="userfile[]"/>
<br/>

<?php //echo $form->input('data.extra_field'); ?>


<?php //echo $form->hidden('File_upload.extra_field',array('value'=>"test"));?> 
<br/>

<?php
if (isset($uploadData)) {
    var_dump($uploadData);
}

if (isset($errorMessage)) {
    var_dump($errorMessage);
}
?>

<?php echo $form->end('upload'); ?>

<?php if (!empty($uploadData)){ echo $uploadDir; 
 echo "<img border=0 src=/images/logo.gif width=15 height=15 alt=profile>";
}
 ?>


