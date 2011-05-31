<br/>
<br/>
<img src="/images/img_txt_joinjobtiger.gif" alt="Join JobTiger!"><br />
<p class="up5down5 txtbold">No more search, No more Headhunters.</p>
<br/>
<h3>New to Job Tiger?</h3><br/>
<div>
JobTiger is a social job matching service that takes your preferences and skill sets,<br>
And automatically matches them with employers requirements and corporate culture.
</div>
<br/>
<br/>

<?php $session->flash('auth'); ?>
<?php e($form->create('User', array('action'=>'signup'))); ?>

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
<br/>
<br/>
<p>I read and accept Job Tiger <a href =""> Terms and Conditions</a></p>
<?php echo $form->checkbox('T&C');?>
<br/>
<br/>
<br/>
<br/>
<?php e($form->submit('/images/btn_createmyaccount_on.gif')); ?>
<?php e($form->end()); ?>






