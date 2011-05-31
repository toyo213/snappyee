<div class="Users form">
<?php echo $form->create('Users', array('enctype'=>'multipart/form-data'));?>
	<fieldset>
 		<legend><?php __('User Pic');?></legend>
	<?php
		echo $form->input('name');
		echo $form->file('image');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
