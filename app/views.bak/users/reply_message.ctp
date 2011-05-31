<?php //var_dump($msg); ?>

<br/>
<br/>
<h2>Reply Message</h2>

<?php 
$corp=$msg['0']['c']['corporation'];
$subject=$msg['0']['e']['subject'];
$body=$msg['0']['e']['body'];
$date=$msg['0']['e']['created'];

$d=<<<DOC_END


<table width = 600 height = 150>
<tr> 
<th>Corporation</th>
<td>$corp </td>
</tr>

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

<!--  
<br/>
<br/>


<h4> To <?php echo $msg['0']['c']['corporation'];?> </h4>

<br/>
<br/>
<h4> Subject <?php echo $msg['0']['e']['subject'];?> </h4>
-->
<?php
$ms = explode("\n",$msg['0']['e']['body']);
$new_msg = '';
foreach ( $ms as $val ) {
    $new_msg .= '> '.$val."\n";
}
?>
<?php e($form->create('User', array('action'=>'reply_message'))); ?>
<h4>Message</h4>
<br/>
<p><?php e($form->textarea('body', array('cols'=>55, 'rows'=> 7, 'value'=>$new_msg))); ?><?php e($form->error('Url.full_url')); ?></p>
<br/>
<?php echo $form->hidden('sid', array('value'=> $msg['0']['e']['rid']));?>
<?php echo $form->hidden('rid', array('value'=> $msg['0']['e']['sid']));?>
<?php echo $form->hidden('subject', array('value'=> $subject));?>


<?php e($form->submit('submit')); ?>
<?php e($form->end()); ?>


