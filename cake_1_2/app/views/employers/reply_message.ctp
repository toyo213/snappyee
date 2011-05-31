<?php //var_dump($msg); ?>

<br/>
<br/>
<h2>Reply Message</h2>

<?php 

$subject=$msg['0']['u']['subject'];
$body=nl2br($msg['0']['u']['body']);
$date=$msg['0']['u']['created'];

$d=<<<DOC_END


<table width = 600 height = 150>

<tr>
<th>
Subject
</th>
<td>
$subject
</td>
</tr>


<tr>
<th>
Body
</th>
<td>
$body
</td>
</tr>

<tr>
<th>
Date recieved
</th>
<td>$date</td>
</tr>
</table><br/><br/>
DOC_END;

echo $d;

?>
<?php
$ms = explode("\n",$msg['0']['u']['body']);
$new_msg = '';
foreach ( $ms as $val ) {
    $new_msg .= '> '.$val."\n";
}
?>


<?php e($form->create('Employer', array('action'=>'reply_message'))); ?>
<h4>Message</h4>
<p><?php e($form->textarea('body', array('cols'=>55, 'rows'=> 7, 'value'=>$new_msg))); ?><?php e($form->error('Url.full_url')); ?></p>
<br/>
<br/>
<?php echo $form->hidden('sid', array('value'=> $msg['0']['u']['rid']));?>
<?php echo $form->hidden('rid', array('value'=> $msg['0']['u']['sid']));?>
<?php echo $form->hidden('subject', array('value'=> $subject));?>


<?php e($form->submit('submit')); ?>
<?php e($form->end()); ?>


