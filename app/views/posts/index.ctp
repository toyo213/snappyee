<h1>Blog posts</h1>

<p>
<?php
if($user){
	//var_dump($user);
	echo "こんにちは".$user['User']['username']."さん<br/>";
	echo $html->link("Add Post", "/posts/add");
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo $html->link("logout", "/posts/logout");
}
else{
	echo $html->link("Login", "/users/login");
}
?></p>

<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Created</th>
	</tr>

<!-- $post配列をループして、投稿記事の情報を表示 -->

<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['id']; ?></td>
		<td>
			<?php echo $html->link($post['Post']['title'],'/posts/view/'.$post['Post']['id']);?>
			<?php if($user)echo $html->link(
				'Delete',
				"/posts/delete/{$post['Post']['id']}",
				null,
				'Are you sure?'
			)?>
			<?php if($user)echo $html->link('Edit', '/posts/edit/'.$post['Post']['id']);?>
		</td>
		<td><?php echo $post['Post']['created']; ?></td>
	</tr>
<?php endforeach; ?>

</table>

