<div class="User_profiles form">
<?php echo $form->create('User_profiles', array('enctype'=>'multipart/form-data'));?>
	<fieldset>
 		<legend><?php __('User_profiles Pic');?></legend>
	<?php
		echo $form->input('name');
		echo $form->file('image');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
