<?php
        function cutStr( $InStr, $MaxSize ) {
            if ( strlen( $InStr ) > $MaxSize ) {
                return( substr( $InStr, 0, $MaxSize -3 ) . " ..." );
            } else {
                return( $InStr );
            }
        }
    ?>


<div id="body">
		<ul> 
			<li class="navlistbox" style="float:left"><a href=./home>Home</a></li>
			<li class="navlistbox" style="float:left"><a href=./profile>Profile</a></li>
			<li class="navlistbox" style="float:left"><a href=./index>Top Page</a></li>
			<li class="navlistbox" style="float:left"><a href=./r_message>Message</a></li>
			<li class="navlistbox" style="float:left"><a href=./btocWinklist>Likes </a></li>
			<li class="navlistbox" style="float:left"><a href=./logout>Log Out</a></li>　	
		</ul>
		</div>
<br/> 	
<br/>
<br/>
<br/>
<br/>
<br/>
<p>
<h2>Your Likes 送ったLikes          <a href=/users/btocWinklist>Recieved Likes　受け取ったLikes</a></h2>
</p>

<br />
<span style="color:red"> <?php echo count($winks); ?> Likes </span>
<br />

<br />
<br />


<table cellpadding="0" cellspacing="0">
					<tr>
					<th> Corporation </th>
					<th>Job Title </th>
					<th>Salary Range</th>
					<th>Location</th>
					<th>Requirement</th>
					<th>Date and Time</th>
					<tr>

	<?php foreach ($_job as $item): ?> 
	<tr>
		<td><?php echo $html->link($item['j']['corporation'], '/users/corp_profile_view/'.$item['j']['employer_id']); ?></td>
		<td><?php echo $html->link($item['j']['job_title'],'/users/jobpostview/'.$item['j']['id']);?></td>
		<td><?php echo $item['j']['salary_range_min'].' - '.$item['j']['salary_range_max']; ?>
		<?php echo cutStr($item['j']['salary_range_comment'], 20); ?></td>
		<td><?php echo $item['j']['location']; ?></td>
        <td><?php echo cutStr($item['j']['requirement'], 20 ); ?></td>
        <td><?php echo $item['c']['created']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<!--  Author hamhei
<table cellpadding="0" cellspacing="0">
					<tr>
					<th> Employer ID </th>
					<th>Job post ID</th>
					<th> Message </th>
					<th> Created Date </th>
					<tr>
				<?php
				$i = 0;
foreach ($winks as $wink):
				$class = null;
if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
	}
?>
				<tr <?php echo $class;?>>

				<td>
				<?php echo $wink['Ctob_wink']['rid']; ?>
				</td>
				<td>
				<?php echo $wink['Ctob_wink']['jobpost_id']; ?>
				</td>
				<td>
				<?php echo $wink['Ctob_wink']['content']; ?>
				</td>
				<td>
				<?php echo $wink['Ctob_wink']['created']; ?>
				</td>
				</tr>
				<?php endforeach; ?>
				</table> -->

