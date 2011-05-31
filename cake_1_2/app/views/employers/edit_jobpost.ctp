<h3>Job Post</h3>
<br/>
<br/>

<?php e($form->create('Employer', array('action'=>'edit_jobpost'))); ?>
<h4>Corporation 企業名</h4>
<p><?php e($form->text('corporation', array('size'=>'35', 'maxlength'=>'1000', 'value' => $jobpost["Jobpost"]["corporation"] ))); ?><?php e($form->error('Url.full_url')); ?></p>
<br/>
<br/>
<h4>Job Title　職種</h4>
<p><?php e($form->text('job_title', array('size'=>'35', 'maxlength'=>'1000', 'value'=>$jobpost["Jobpost"]["job_title"]))); ?><?php e($form->error('Url.full_url')); ?></p>
<br/>
<br/>

<h4>Location　勤務地</h4>
<p><?php e($form->text('location', array('size'=>'35', 'maxlength'=>'1000','value'=>$jobpost["Jobpost"]["location"]))); ?><?php e($form->error('Url.full_url')); ?></p>
<br/>
<br/>

<h4>Salary Range　給与レンジ</h4>
<p><?php e($form->text('salary_range_min', array('size'=>'35', 'value'=>$jobpost["Jobpost"]["salary_range_min"]))); ?> -
<?php e($form->text('salary_range_max', array('size'=>'35','value'=>$jobpost["Jobpost"]["salary_range_max"]))); ?></p>
<br/>
<br/>

<h4>Salary Range Comment　給与レンジコメント</h4>

<p><?php echo $form->textarea('salary_range_comment', array('cols' => 40, 'rows' => 10, 'value'=>$jobpost["Jobpost"]["salary_range_comment"])); ?></p>
<br/>
<br/>


<h4>Requirement　応募条件</h4>
<p><?php echo $form->textarea('requirement', array('cols' => 80, 'rows' => 10, 'value'=>$jobpost["Jobpost"]["requirement"])); ?></p>
<br/>
<br/>

<h4>Job Description　職務内容</h4>
<p><?php echo $form->textarea('job_description', array('cols' => 80, 'rows' => 10, 'value'=>$jobpost["Jobpost"]["job_description"])); ?></p>

<br/>
<br/>

<?php echo $form->hidden('Jobpost_id', array('value'=> $jobpost["Jobpost"]["id"]));?>

<?php e($form->submit('update')); ?>
<?php e($form->end()); ?>

