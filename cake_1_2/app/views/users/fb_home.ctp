<?php
        function cutStr( $InStr, $MaxSize ) {
            if ( strlen( $InStr ) > $MaxSize ) {
                return( substr( $InStr, 0, $MaxSize -3 ) . " ..." );
            } else {
                return( $InStr );
            }
        }
    ?>

<?php echo  $myid ?><br/>

<?php echo '<a href ="./profile">'.$name.'</a>'?><br/>
<br/>
<img src = <?php echo $image ; ?>>


<h3><a href=./create_profile>create your profile</a></h3>
<br/>
<h3><a href=./fb_profile>FB profile</a></h3>

<br/>
<br/>
<?php if(isset($employer_1)){ echo $employer_1; } ?>
<br/>
<br/>
<?php if(isset($employer_1)){ echo $position_1; } ?>


<br/>
<br/>
<?php echo '<h3> <a href = "./stats"> YOUR STATS </a></h3>'?> <br/>
<br/>
<br/>
<a href= ./index > Go To Top Page</a>
<br/>
<br/>
<?php echo  '<a href = "./logout"> Log Out  </a>' ?> <br/>
<br/>
<br/>

<h2>Your Match</h2>

<table>
   <tr>
    <th>Corporation </th>
   	<th>URL</th>
   	<th>Profile</th>
   	<th>Contact</th>
   	<th>Match Rating</th>	
   </tr>	
   <?php //pr($match_list);?>
   <?php foreach ($match_list as $item): ?>
	<tr> 
		<td><?php echo $html->link($item['Corp_profile']['corporation'], '/users/corp_profile_view/'.$item['Corp_profile']['id']); ?></td>
		<td><?php echo $html->link($item['Corp_profile']['corp_url'], $item['Corp_profile']['corp_url']   ); ?></td>
        <td><?php echo cutStr($item['Corp_profile']['corp_profile'],50); ?></td>
        <td><?php echo cutStr($item['Corp_profile']['corp_contact'],20); ?></td>
		<td><?php echo isset($total[$item['Corp_profile']['id']]["total"]) == true ? $total[$item['Corp_profile']['id']]["total"]:""; ?></td>
   </tr>
	<?php endforeach; ?>
</table>

<h2>Recieved "Likes" Signal</h2>

<h2><a href =http://job-tiger.com/users/ctobWinklist> Your "Likes" Job Post List</a></h2>

<br /><br />
<h2>Saved Jobs</h2>
<table>
  <tr>
    <th>Corporate</th>
    <th>Job title</th>
    <th>Salary Range</th>
    <th>Location</th>
    <th>Requirement</th>
  </tr>

  <?php foreach ($user_save_jobs as $item): ?>
  <tr>
    <td><?php echo $html->link($item['j']['corporation'], '/users/corp_profile_view/'.$item['j']['employer_id']); ?></td>
    <td><?php echo $html->link($item['j']['job_title'], '/users/jobpostview/'.$item['j']['id']);?></td>
    <td><?php echo $item['j']['salary_range_min'].' - '.$item['j']['salary_range_max']; ?>
    <?php echo substr($item['j']['salary_range_comment'], 0, 50); ?></td>
    <td><?php echo $item['j']['location']; ?></td>
    <td><?php echo substr($item['j']['requirement'], 0, 200); ?></td>

  </tr>
  <?php endforeach; ?>
</table>

<br/>
<br/>

<h2>Applied Jobs</h2>
<table>
  <tr>
    <th>Corporate</th>
    <th>Job title</th>
    <th>Salary Range</th>
    <th>Location</th>
    <th>Requirement</th>
  </tr>

  <?php foreach ($user_applicants as $item): ?>
  <tr>
    <td><?php echo $html->link($item['j']['corporation'], '/users/corp_profile_view/'.$item['j']['employer_id']); ?></td>
    <td><?php echo $html->link($item['j']['job_title'], '/users/jobpostview/'.$item['j']['id']);?></td>
    <td><?php echo $item['j']['salary_range_min'].' - '.$item['j']['salary_range_max']; ?>
    <?php echo substr($item['j']['salary_range_comment'], 0, 50); ?></td>
    <td><?php echo $item['j']['location']; ?></td>
    <td><?php echo substr($item['j']['requirement'], 0, 200); ?></td>

  </tr>
  <?php endforeach; ?>
</table>
