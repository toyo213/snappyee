<br/>
<br/><br/>

<?php 

echo "ジョブタイガーのα版テストにご協力いただきありがとうございます。<br/>
下記のフォームにemail,を入力いただけましたらご案内のメールを送信いたします。<br/><br/><br/>
Thank you for your cooperation to Job Tiger Alpha Test. please submit your email for the invitation email.";
?>

<br/><br/><br/>

<?php e($form->create('User', array('action'=>'alpha'))); ?>
<h2>Email</h2>
<p><?php e($form->text('email', array('size'=>'35', 'maxlength'=>'100'))); ?><?php e($form->error('Url.full_url')); ?></p>
<br/>
<br/>

<?php e($form->submit('送信 submit')); ?>
<?php e($form->end()); ?>







