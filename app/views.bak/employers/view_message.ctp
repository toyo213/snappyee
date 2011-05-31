<?php //var_dump($msg); ?>



<a href =./reply_message?id=<?php echo $msg['0']['u']['id'];?>>Reply to This Message</a>

<?php 
$name=$msg['0']['p']['name'];
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


