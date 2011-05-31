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
    		<?php if(!empty($employer_id)){
    			echo "<h3>Welcome <span style=color:red>".$employer."</span></h3>";
				echo "<br/><br/><a href=/employers/home>Home</a>";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=/employers/logout>Log Out</a><br/><br/><br/>";
				
			} else{
			echo "<ul>";
			echo "<li class=navlistbox style=float:left>";
			echo "<a href=http://job-tiger.com/users/twitter> <img src=/images/twitter-sign-in-l.png></img></a>";
			echo "</li>";
			echo "<li class=navlistbox style=float:right>";
			echo "<a href=http://twitter.com/share class=twitter-share-button data-url=http://job-tiger.com/ data-text=Upgrade your career today. Job Tiger data-count=vertical data-via=jobtiger411>Tweet</a><script type=text/javascript src=http://platform.twitter.com/widgets.js></script>";
			echo "</li>";
			echo "<li class=navlistbox style=float:right>";
			echo "<a href=http://job-tiger.com/employers/login>Employers</a>";
			echo "</li>";
			echo "<li class=navlistbox style=float:right>";
			echo "<a href=users/jobtiger>About</a>";
			echo "</li>";
			echo "</ul>";
			};
			
			?>
			
			
	</div>

<img src=/images/top.png></img>
		
<br/><br/><br/>



<br/>
<br/>
<br/>		
 <h2><a href=/users/allhotjobs>Hot Jobs  人気掲載ジョブランキング！</a></h2>

<table>
	<tr>
		<th>Like</th>
		<th>Retweet</th>
		<th>Corporate（企業名）</th>
		<th>Job Title <br/>（職種）</th>
		<th>Salary Range<br/>(給与レンジ）</th>
		<th>Location（勤務地）</th>
		<th>Requirement（応募条件）</th>
               
	</tr>

	<?php foreach ($hotjobkey as $item => $value): ?>
	<tr>
		<td><a href="http://job-tiger.com/users/ctobWink?rid=<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['employer_id'];?>&jid=<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['id'];?>"><img src="http://job-tiger.com/images/btn_like.png"></a>
		<br/><br/>
		<span style="color:red"><?php echo $value[0]['cnt'];?> Likes! </span>
		</td>
		<td>
		<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://job-tiger.com/users/jobpostview/<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['id'];?>" data-text="<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['corporation'];?>,<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['job_title'];?>, Salary Range <?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['salary_range_min'];?> - <?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['salary_range_max']; ?>,Job Tiger" data-count="vertical" data-via="jobtiger411">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</td>
		<td><?php echo $html->link($hotjob[$value['ctob_winks']['jobpost_id']]['corporation'], '/users/corp_profile_view/'.$hotjob[$value['ctob_winks']['jobpost_id']]['employer_id']); ?></td>
		<td><?php echo $html->link($hotjob[$value['ctob_winks']['jobpost_id']]['job_title'],'/users/jobpostview/'.$hotjob[$value['ctob_winks']['jobpost_id']]['id']);?></td>
		<td><?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['salary_range_min'].' - '.$hotjob[$value['ctob_winks']['jobpost_id']]['salary_range_max']; ?>
		<?php echo cutStr($hotjob[$value['ctob_winks']['jobpost_id']]['salary_range_comment'], 50); ?></td>
		<td><?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['location']; ?></td>
        <td><?php echo cutStr($hotjob[$value['ctob_winks']['jobpost_id']]['requirement'], 50 ); ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<br/>
<br/>
<br/>



<h2><a href=/users/alljobs>New Job Post　新着ジョブ！</a></h2>

<table>
	<tr>
		<th>Like</th>
		<th>Retweet</th>
		<th>Corporate（企業名）</th>
		<th>Job Title <br/>（職種）</th>
		<th>Salary Range<br/>(給与レンジ）</th>
		<th>Location（勤務地）</th>
		<th>Requirement（応募条件）</th>
    
	</tr>

	<?php foreach ($jobpost as $item): ?> 
	<tr>
		<td><a href="http://job-tiger.com/users/ctobWink?rid=<?php echo $item['Jobpost']['employer_id'];?>&jid=<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['id'];?>"><img src="http://job-tiger.com/images/btn_like.png"></a></td>
		<td>
		<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://job-tiger.com/users/jobpostview/<?php echo $item['Jobpost']['id'];?>" data-text="<?php echo $item['Jobpost']['corporation'];?>,<?php echo $item['Jobpost']['job_title'];?>,Salary Range <?php echo $item['Jobpost']['salary_range_min'];?> - <?php echo $item['Jobpost']['salary_range_max']; ?>,Job Tiger" data-count="vertical" data-via="jobtiger411">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</td>
		<td><?php echo $html->link($item['Jobpost']['corporation'], '/users/corp_profile_view/'.$item['Jobpost']['employer_id']); ?></td>
		<td><?php echo $html->link($item['Jobpost']['job_title'],'/users/jobpostview/'.$item['Jobpost']['id']);?></td>
		<td><?php echo $item['Jobpost']['salary_range_min'].' - '.$item['Jobpost']['salary_range_max']; ?>
		<?php echo cutStr($item['Jobpost']['salary_range_comment'], 50); ?></td>
		<td><?php echo $item['Jobpost']['location']; ?></td>
        <td><?php echo cutStr($item['Jobpost']['requirement'], 50 ); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<div><?php e($paginator->counter(array("format" => "(all %count% ) %start%\xef\xbd\x9e%end%")));?></div>
<div><?php e($paginator->numbers(array('separator' => ' | ', 'modulus' => '2')));?></div>


<br/>
<br/>
<br/>

<h2><a href=/users/allusers>Who is New to Job Tiger?　新規登録ユーザ一覧</a></h2>

<?php //var_dump($new_user); ?>

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

<br />
<br />

 

 
 
