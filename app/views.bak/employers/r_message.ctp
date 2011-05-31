
<div id="body"> 
		<ul>
			<li class="navlistbox" style="float:left"><a href=./home>Home</a></li>
			<li class="navlistbox" style="float:left"><a href=./profile>Profile </a></li>
			<li class="navlistbox" style="float:left"><a href= ../users/index>Top Page</a></li>
			<li class="navlistbox" style="float:left"><a href=./logout>Log Out</a></li>
			<li class="navlistbox" style="float:left"><a href=./r_application>Application</a></li>
			<li class="navlistbox" style="float:left"><a href=./r_wink> Likes </a></li>
			<li class="navlistbox" style="float:left"><a href=./r_message>Message</a></li>
		</ul>
		</div>


<p>You have <span style="color:red"> <?php echo count($u_msg); ?> Unread Messages </span> </p>
<p>新しいメッセージが <span style="color:red"> <?php echo count($u_msg); ?> 件あります。 </span> </p>

<br/>
<br/>

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
		<td><?php echo $html->link($item['p']['name'], '/employers/user_profile_view?sid='.$item['p']['id']); ?></td>
		<td><?php echo $html->link($item['u']['subject'],'/employers/reply_message?id='.$item['u']['id']); ?></td>
		<td><?php echo $html->link(mb_substr($item['u']['body'],0,10).'...','/employers/reply_message?id='.$item['u']['id']); ?></td>
		<td><?php echo $item['u']['created']; ?></td>
	</tr>
 <?php endforeach; ?>
</table> 
<br/>
<br/>

<?php //var_dump($msg);?>
