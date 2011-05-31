/app/views/posts/add.ctp	
	
<h1>Add Post</h1>
<?php
echo $form->create('Jobpost');
echo $form->input('corporation');
echo $form->input('job_title');
echo $form->input('salary_range_min');
echo $form->input('salary_range_max');
echo $form->input('salary_range_comment');	
echo $form->input('location');
echo $form->input('requirement',array('rows' => '3'));
echo $form->input('job_description',array('rows' => '3'));
echo $form->end('Save Post');
?>