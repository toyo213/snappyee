
<h3>Job Post Confirm</h3>
<br/>
<br/>

<?php e($form->create('Employer', array('action'=>'jobpost_payment'))); ?>

<table width = 600 height = 300>
<?php echo "<tr><th>".$em["Employer"]["corporation"]."</th></tr>" ; ?>
<?php echo "<tr><th>".$em["Employer"]["job_title"]."</th></tr>" ; ?>
<?php echo "<tr><th>".$em["Employer"]["location"]."</th></tr>"; ?>
<?php echo "<tr><th>".$em["Employer"]["salary_range_min"]." - ".$em["Employer"]["salary_range_max"]."</th></tr>" ; ?>
<?php echo "<tr><th>".$em["Employer"]["salary_range_comment"]."</th></tr>"; ?>

<?php echo "<tr><th>".$em["Employer"]["requirement"]."</th></tr>" ; ?>
<?php echo "<tr><th>".$em["Employer"]["job_description"]."</th></tr>" ; ?>
</table>

<br/>
<br/>

<?php //e($form->submit('Go to Payment Page For Job Post')); ?>
<?php e($form->end()); ?>

<br/>
<br/>

<?php e($form->create('Employer', array('action'=>'jobpost'))); ?>
<input type="hidden" name="data[Employer][corporation]" value="<?php echo $em["Employer"]["corporation"]; ?>">
<input type="hidden" name="data[Employer][job_title]" value="<?php echo $em["Employer"]["job_title"]; ?>">
<input type="hidden" name="data[Employer][location]" value="<?php echo $em["Employer"]["location"]; ?>">
<input type="hidden" name="data[Employer][salary_range_min]" value="<?php echo $em["Employer"]["salary_range_min"]; ?>">
<input type="hidden" name="data[Employer][salary_range_max]" value="<?php echo $em["Employer"]["salary_range_max"]; ?>">
<input type="hidden" name="data[Employer][salary_range_comment]" value="<?php echo $em["Employer"]["salary_range_comment"]; ?>">
<input type="hidden" name="data[Employer][requirement]" value="<?php echo $em["Employer"]["requirement"]; ?>">
<input type="hidden" name="data[Employer][job_description]" value="<?php echo $em["Employer"]["job_description"]; ?>">

<?php e($form->submit('confirm')); ?>
<?php e($form->end()); ?>

<br/>
<br/>

