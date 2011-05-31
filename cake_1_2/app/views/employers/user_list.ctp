<br />
<br />

<h2>Matched Users</h2>
<table style="width:100%">
<tr>
  <th>Name</th>
  <th>Job Title</th>
  <th>Location</th>
<tr>

	<?php foreach ($users as $user):?>
<tr>
<td>
	<?php echo $html->link($user["f"]["name"], '/users/profile/'.$user["u"]["myid"]); ?><br />
</td>
<td>
	<?php echo $user["f"]["position_1"]; ?><br />
</td>
<td>
	<?php echo $user["f"]["location_1"]; ?><br />
</td>
<tr>
	<?php endforeach; ?>
</table>
<br />
<br />
<br />
<br />
