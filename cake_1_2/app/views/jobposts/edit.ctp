	
<h1>Edit Post</h1>
<?php
	echo $form->create('Jobpost', array('action' => 'edit'));
	echo $form->input('corporation');
echo $form->input('job_title');
echo $form->input('salary_range_min');
echo $form->input('salary_range_max');
echo $form->input('salary_range_comment');	
echo $form->input('location');
echo $form->input('requirement',array('rows' => '3'));
echo $form->input('job_description',array('rows' => '3'));
echo $form->input('id', array('type'=>'hidden')); 
echo $form->end('Save Post');
?>