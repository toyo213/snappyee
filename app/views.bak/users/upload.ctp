<?php
	$options = array(
		'action'=>'upload',
		'type'=>'file'
	);
	echo $form->create('Upload', $options);
?>
	<dl>
		<dt>ファイル：</dt>
		<dd><?php echo $form->file('file_name') ?>
		<?php echo $form->error('file_name') ?></dd>
	</dl>
	<?php echo $form->submit('送信'); ?>
<?php echo $form->end(); ?>
