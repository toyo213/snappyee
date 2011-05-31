<h2>Who is New to Job Tiger?　新規登録ユーザ一覧</h2>

<table>
	<tr>
		<th>Twitter ID</th>	
		<th>Profile Pic</th>
		<th>Name</th>
		<th>Location</th>
		<th>Bio</th>
	</tr>
	<?php foreach ($new_user as $item):?>
<tr>
	<td><?php echo $html->link($item["u"]["twitter_id"],'http://twitter.com/#!/'.$item["u"]["twitter_id"]);?></td>
	<td><?php if(!empty($item["u"]["images"])){ echo "<img src=".$item["u"]["images"]."></img>"; }?> </td>
	<td><?php echo $html->link($item['u']['name'], '/users/user_profile_view/'.$item['u']['id']); ?></td>
	<td><?php echo $item["u"]["location"];   ?></td>
	<td><?php echo $item["u"]["bio"]; ?></td>
</tr>

<?php endforeach; ?>
</table>