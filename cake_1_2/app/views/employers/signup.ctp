<h2>Employers Sign Up 企業用アカウントサインアップ</h2>
<?php $session->flash('auth'); ?>
<?php e($form->create('Employer', array('action'=>'signup'))); ?>
<?php echo $f;?>
<h2><p class="label">Username</p></h2>
<p><?php e($form->text('username', array('size'=>'35', 'maxlength'=>'1000'))); ?><?php e($form->error('Url.full_url')); ?></p>

<br/>
<br/>
<h2><p class="label">Password</p></h2>
<p><?php e($form->password('passwd', array('size'=>'35'))); ?></p>

<br/>
<br/>
<h2><p class="label">Email</p></h2>
<p><?php e($form->text('email', array('size'=>'35'))); ?></p>
<?php //echo $ee;  ?>
<br/>
<p>I read and accept Job Tiger <a href =""> Terms and Conditions</a></p>
<p>Job Tiger利用規約に同意します</p>
<?php echo $form->error('T&C');?>
<?php echo $form->checkbox('T&C',array('type'=>'text'));?>
<br/>
<br/>
<br/>
<?php e($form->submit('/images/btn_createmyaccount_on.gif')); ?>
<?php e($form->end()); ?>

