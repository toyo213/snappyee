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




<div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<h2>Recived "Likes"   　　　　　　　　　　　　  <a href=./s_wink>Your Likes　送ったLikes</a></h2>
</div>

<br/>
<br/>


<span style="color:red"> <?php echo count($r_like); ?> Likes </span>

<br/>
<br/>
<table>
	<tr>
			<th>Name</th>
			<th>Twitter ID</th>
			<th>profile pic</th>
			<th>Location　</th>
			<th>Date and Time</th>
	</tr>
	
<?php foreach ($r_like as $item): ?>
	<tr>
		<td><?php echo $html->link($item['u']['name'], '/users/user_profile_view/'.$item['u']['id']); ?></td>
		<td><?php echo $html->link($item['u']['twitter_id'],'http://twitter.com/#!/'.$item['u']['twitter_id']); ?></td>
		<td><?php if(!empty($item['u']['images'])){echo '<img src='.$item['u']['images'].'></img>'; }?></td>
		<td><?php echo $item['u']['location']; ?></td>
		<td><?php echo $item['c']['created'];?> </td>
	</tr>
 <?php endforeach; ?>
</table>
