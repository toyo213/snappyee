<?php $session->flash('auth'); ?>
<?php e($form->create('User', array('action'=>'login'))); ?>
<h2><p class="label">Username</p></h2>
<p><?php e($form->text('username', array('size'=>'35', 'maxlength'=>'1000'))); ?><?php e($form->error('Url.full_url')); ?></p>

<br/>
<br/>
<h2><p class="label">Password</p></h2>
<p><?php e($form->password('passwd', array('size'=>'35'))); ?></p>

<br/>
<br/>
<?php e($form->submit('login')); ?>
<?php e($form->end()); ?>
