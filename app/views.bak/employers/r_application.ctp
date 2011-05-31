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
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<h2>Recieved Application 応募者一覧</h2>

<br/>
<br/>
<?php 
$application = count($r_application);

echo "<a href=/employers/r_application><p># of Applications recieved <span style=color:red>".$application."</span></p></a>"; 
echo "<a href=/employers/r_application><p>現在の応募者数 <span style=color:red>".$application."</span></p></a>";
?>
<br/>
<br/>

<table>
	<tr>
			<th>Name</th>
			<th>Twitter ID</th>
			<th>profile pic</th>
			<th>Location　</th>
			<th>Date and Time</th>
			<th>Job Post ID（ジョブ番号）</th>
			<th>Resume（履歴書）</th>
			<th>Referer（紹介者）</th>
	</tr>

<?php foreach ($r_application as $item): ?>
	<tr>
		<td><?php echo $html->link($item['us']['name'], '/users/user_profile_view/'.$item['us']['id']); ?></td>
		
		<td><?php echo $html->link($item['us']['twitter_id'], 'http://twitter.com/#!/'.$item['us']['twitter_id']); ?></td>
		<td><?php if(!empty($item['us']['images']))echo "<img src =".$item['us']['images']."> </img>"; ?></td>
		<td><?php echo $item['us']['location'];?></td>
		<td><?php echo $item['u']['created_at']; ?></td>
		<td><?php echo $html->link($item['u']['jobpost_id'], '/employers/jobpostview/'.$item['u']['jobpost_id']);?></td>
		<td><?php if(!empty($item['u']['resume'])){echo '<a href=/tmp/'.$item['u']['resume'].'?aid='.$item['u']['id'].'><img src=http://cdn1.iconfinder.com/data/icons/prettyoffice/32/import.png></a>';}?></td>
		<td><?php if(!empty($item['u']['hid'])){ echo $html->link($item['u']['hid'],'http://twitter.com/#!/'.$item['u']['hid']);} ?></td>
	</tr>
 <?php endforeach; ?>
</table>







<!--

<table>
	<tr>
			<th>Name</th>
			<th>Corporation</th>
			<th>Job Title</th>
			<th>Location</th>
			<th>Date and Time</th>
			<th>Job Post ID</th>
			<th>Resume</th>
	</tr>


<?php foreach ($r_application as $item): ?>
	<tr>
		<td><?php echo $html->link($item['up']['name'], '/employers/user_profile_fullview?sid='.$item['up']['id']); ?></td>
		<td><?php echo $item['j']['corporation']; ?></td>
		<td><?php echo $item['j']['job_title']; ?></td>
		<td><?php echo $item['j']['location'];?></td>
		<td><?php echo $item['u']['created_at']; ?></td>
		<td><?php echo $html->link($item['u']['jobpost_id'], '/employers/jobpostview/'.$item['u']['jobpost_id']);?></td>
		<td><?php if(!empty($item['u']['resume'])){echo '<a href=/tmp/'.$item['u']['resume'].'><img src=http://cdn1.iconfinder.com/data/icons/prettyoffice/32/import.png></a>';}?></td>
	</tr>
 <?php endforeach; ?>
</table>


<?php //var_dump($r_application);?>

-->
