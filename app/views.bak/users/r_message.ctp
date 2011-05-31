
<br/>
<br/>
<p>You have <span style="color:red"> <?php echo count($u_msg); ?> Unread Messages </span> </p>
<p>新しいメッセージが <span style="color:red"> <?php echo count($u_msg); ?> 件あります。 </span> </p>


<br/>
<br/>

<table>
	<tr>
			<th>Name</th>
			<th>Subject</th>
			<th>Body</th>
			<th>Date and Time</th>
	</tr>
<?php foreach ($msg as $item): ?>
	<tr>
		<td><?php echo $html->link($item['c']['corporation'], '/users/corp_profile_view/'.$item['c']['id']); ?></td>
		<td><?php echo $html->link($item['e']['subject'],'/users/reply_message?id='.$item['e']['id']); ?></td>
		<td><?php echo $html->link(mb_substr($item['e']['body'],0,10).'...','/users/reply_message?id='.$item['e']['id']); ?></td>
		<td><?php echo $item['e']['created']; ?></td>
	</tr>
 <?php endforeach; ?>
</table> 
<br/>
<br/>

