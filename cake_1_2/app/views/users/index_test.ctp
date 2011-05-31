<?php
        function cutStr( $InStr, $MaxSize ) {
            if ( strlen( $InStr ) > $MaxSize ) {
                return( substr( $InStr, 0, $MaxSize -3 ) . " ..." );
            } else {
                return( $InStr );
            }
        }
    ?> 
	<div id="header"> 
		<ul id="nav">
			<li class="navlistbox"><a href="#" accesskey="u">Sign Up</a></li>
			<li class="navlistbox"><a href="#" accesskey="s" class="jqModal">Sign in</a></li>
		</ul>
	</div> 



<div><a href="<?php echo $loginUrl; ?>"> <img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif"> </a>
</div>
<br />
<br />
<div><?php echo  '<a href = "http://job-tiger.com/cake_1_2/users/login"> login with Job Tiger ID  </a>' ?>
</div>
<br />
<br />
<div><?php echo  '<a href = "http://job-tiger.com/cake_1_2/users/signup"> Sign up for Job Tiger ID</a>' ?>
</div>
<br />
<br />

<div><?php echo  '<a href = "http://job-tiger.com/cake_1_2/employers/signup">Looking For Hiring? Sign up for Job Tiger! </a>' ?>
</div>

<br />
<br />

<div><?php echo  '<a href = "http://job-tiger.com/cake_1_2/employers/login">Employers Login </a>' ?>
</div>

<br />
<br />

<div>
<p><?php echo $html->link("Add Job Post", "/employers/jobpost"); ?></p>
</div>
<br />
<br />

<h2>Hot Jobs</h2>

<table>
	<tr>
		<th>Like</th>
		<th>Corporate</th>
		<th>Job title</th>
		<th>Salary Range</th>
		<th>Location</th>
		<th>Requirement</th>
	</tr>

	<?php foreach ($jobpost as $item): ?>
	<tr>
		<td><a href="http://job-tiger.com/cake_1_2/users/ctobWink?rid=<?php echo $item['Jobpost']['employer_id'];?>"><img src="http://job-tiger.com/cake_1_2/images/btn_like.png"></a></td>
		<td><?php echo $html->link($item['Jobpost']['corporation'], '/users/corp_profile_view/'.$item['Jobpost']['employer_id']); ?></td>
		<td><?php echo $html->link($item['Jobpost']['job_title'],'/users/jobpostview/'.$item['Jobpost']['id']);?></td>
		<td><?php echo $item['Jobpost']['salary_range_min'].' - '.$item['Jobpost']['salary_range_max']; ?>
		<?php echo cutStr($item['Jobpost']['salary_range_comment'], 50); ?></td>
		<td><?php echo $item['Jobpost']['location']; ?></td>
        <td><?php echo cutStr($item['Jobpost']['requirement'], 200 ); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<br/>
<br/>
<br/>
<h2>New Job Post</h2>

<table>
	<tr>
		<th>Like</th>
		<th>Corporate</th>
		<th>Job title</th>
		<th>Salary Range</th>
		<th>Location</th>
		<th>Requirement</th>
	</tr>

	<?php foreach ($jobpost as $item): ?> 
	<tr>
		<td><a href="http://job-tiger.com/cake_1_2/users/ctobWink?rid=<?php echo $item['Jobpost']['employer_id'];?>"><img src="http://job-tiger.com/cake_1_2/images/btn_like.png"></a></td>
		<td><?php echo $html->link($item['Jobpost']['corporation'], '/users/corp_profile_view/'.$item['Jobpost']['employer_id']); ?></td>
		<td><?php echo $html->link($item['Jobpost']['job_title'],'/users/jobpostview/'.$item['Jobpost']['id']);?></td>
		<td><?php echo $item['Jobpost']['salary_range_min'].' - '.$item['Jobpost']['salary_range_max']; ?>
		<?php echo cutStr($item['Jobpost']['salary_range_comment'], 50); ?></td>
		<td><?php echo $item['Jobpost']['location']; ?></td>
        <td><?php echo cutStr($item['Jobpost']['requirement'], 200 ); ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<br />
<br />
<br/>

<h2>Who is New to Job Tiger?</h2>

<br />
<br />

