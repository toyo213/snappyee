<?php if(!empty($hid)){
	echo "Via&nbsp;&nbsp;<span style=color:red>".$hid."</span>"; }
	
	if(!empty($image)){
		echo "<br/><br/>";
		echo "<img src =".$image."></img>";	
	}
	
?>

<br /><br />

<h2><?php echo $jobpost["Jobpost"]["corporation"] ?></h2>

		<ul>
		<li class="navlistbox" style="float:left">
		<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://job-tiger.com/users/jobpostview/<?php echo $jobpost["Jobpost"]["id"];?>?hid=<?php if(!empty($tid)){echo $tid;}?>" data-text="<?php echo $jobpost["Jobpost"]["corporation"];?>,<?php echo $jobpost["Jobpost"]["job_title"];?>, Salary Range <?php echo $jobpost["Jobpost"]["salary_range_min"];?> - <?php echo $jobpost["Jobpost"]["salary_range_max"]; ?>" data-count="vertical" data-via="jobtiger411">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<br/>
		<br/>
		<a href="/users/ctobWink?rid=<?php echo $jobpost['Jobpost']['employer_id'];?>&jid=<?php echo $jobpost["Jobpost"]["id"];?>"><img src="/images/btn_like.png"></a></p>
		<br/>
	
		</li>
		</ul>	


<br/>

<br/>


<table style ="width:100%;">
<tr><th>Job Title<br/>(職種）</th><td><?php echo $jobpost["Jobpost"]["job_title"] ?></td></tr>
<tr><th>Salary Range <br/>（給与レンジ）</th><td><?php echo $jobpost["Jobpost"]["salary_range_min"] ?> - <?php echo $jobpost["Jobpost"]["salary_range_max"] ?><br/> <?php echo $jobpost["Jobpost"]["salary_range_comment"] ?></td></tr>
<tr><th>Location<br/>（勤務地）</th><td><?php echo $jobpost["Jobpost"]["location"] ?></td></tr>
<tr><th>Requirement<br/>（応募条件）</th><td><?php echo $jobpost["Jobpost"]["requirement"] ?></td></tr>
</table>

<br />
<br />

<table style ="width:100%;">
<tr><th>Job Description（職務内容）</th></tr>
<tr><td> <?php echo $jobpost["Jobpost"]["job_description"] ?></td></tr>
 
</table>

<br />
<br />
 

<?php

if($ses===null){
$twitter=<<<DOC_END
<span style=color:red>
To Apply or save this jobpost please login with your Twitter Account. 
<br/>この求人情報への応募についてはtwitterでログインのうえ行ってください。
</span>
<a href="/users/twitter">
<br/>
<br/>
<img src=/images/twitter-sign-in-l.png></img>
</a>
DOC_END;

echo $twitter;

}else{
	
echo $form->create('User', array('type' => 'post', 'action' => 'user_save_job'));
 	echo $form->hidden('User_save_job.user_id', array('value' => $user_id));
 	echo $form->hidden('User_save_job.jobpost_id', array('value' => $jobpost["Jobpost"]["id"]));
 	echo $form->hidden('User_save_job.employer_id', array('value' => $jobpost["Jobpost"]["employer_id"]));
echo $form->end('Save this Job Post');	

echo $form->create('User', array('type' => 'post', 'action' => 'user_resume', 'style' => 'float:right;'));
 	echo $form->hidden('User_save_job.user_id', array('value' => $user_id));
 	echo $form->hidden('User_save_job.save_jobpost_id', array('value' => $jobpost["Jobpost"]["id"]));
 	echo $form->hidden('User_save_job.employer_id', array('value' => $jobpost["Jobpost"]["employer_id"]));
 	if(!empty($hid)){echo $form->hidden('User_save_job.hid', array('value' => $hid));}
echo $form->end('Apply for this Job Post');
}
?>



