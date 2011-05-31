<?php //var_dump($msg); ?>



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
Message
</th>
<td>$body </td>
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


<a href =./reply_message?id=<?php echo $msg['0']['e']['id'];?>>Reply to This Message　メッセージを返信する</a>

