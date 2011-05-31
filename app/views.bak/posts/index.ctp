/app/views/posts/index.ctp

	
<h1>Job Posts</h1>
<p><?php echo $html->link("Add Job Post", "/posts/add"); ?></p>
<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Created</th>
	</tr>
<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['id']; ?></td>
		<td>
			<?php echo $html->link($post['Post']['title'],'/posts/view/'.$post['Post']['id']);?>
			<?php echo $html->link(
				'Delete', 
				"/posts/delete/{$post['Post']['id']}", 
				null, 
				'Are you sure?'
			)?>
			<?php echo $html->link('Edit', '/posts/edit/'.$post['Post']['id']);?>
		</td>
		<td><?php echo $post['Post']['created']; ?></td>
	</tr>
<?php endforeach; ?>

</table>


