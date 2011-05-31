<div class="users form">
<?php echo $form->create('User', array('enctype'=>'multipart/form-data'));?>
	<fieldset>
 		<legend><?php __('Add User');?></legend>
	<?php
		echo $form->input('name');
		echo $form->file('image');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
