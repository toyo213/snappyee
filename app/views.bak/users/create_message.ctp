<br/>
<br/>
<h2>New Message</h2>
<br/>
<br/>

<h4> To <?php echo $corp_name;?> </h4>


<?php e($form->create('User', array('action'=>'create_message'))); ?>

<br/>
<br/>
<h4>Subject</h4>
<p><?php e($form->text('subject', array('size'=>'35', 'maxlength'=>'1000'))); ?><?php e($form->error('Url.full_url')); ?></p>
<br/>
<br/>

<h4>Message</h4>
<p><?php e($form->textarea('body', array('cols'=>55, 'rows'=> 7))); ?><?php e($form->error('Url.full_url')); ?></p>
<br/>
<br/>
<?php echo $form->hidden('rid', array('value'=> $rid));?>

<?php //pr($rid);?>
<?php e($form->submit('submit')); ?>
<?php e($form->end()); ?>

