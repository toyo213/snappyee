



<?php
        function cutStr( $InStr, $MaxSize ) {
            if ( strlen( $InStr ) > $MaxSize ) {
                return( substr( $InStr, 0, $MaxSize -3 ) . " ..." );
            } else {
                return( $InStr );
            }
        }
    ?>
        




<img src=/images/top.png></img>


		
<br/><br/><br/>

<img src= <?php echo $image;?>></img>  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href=./logout>Sign Out</a>      
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href =./home> User Home </a>       <br/>

<?php 
echo $screen_name;
echo "<br/>";
if(!empty($name)){echo $name;}
echo "<br/>";
if(!empty($location)){echo $location;}
echo "<br/>";
if(!empty($bio)){echo $bio;}
echo "<br/>";
if(!empty($url)){echo $html->link($url,$url);}
echo "<br/>";
if(!empty($followers)){echo $followers."followers";}
echo "<br/>";
if(!empty($followings)){echo $followings."followings";}
echo "<br/>";
if(!empty($tweets)){echo $tweets."tweets";}

//pr ($xml);
?>

<br/>
<br/>
<br/>		
<h2><a href=/users/allhotjobs>Hot Jobs  人気掲載ジョブランキング！</a></h2>

<table>
	<tr>
		<th>Like</th>
		<th>Retweet or <br/> D Msg</th>
		<th>Corporate（企業名）</th>
		<th>Job Title <br/>（職種）</th>
		<th>Salary Range<br/>(給与レンジ）</th>
		<th>Location（勤務地）</th>
		<th>Requirement（応募条件）</th>
	</tr>

	<?php foreach ($hotjobkey as $item => $value): ?>
	<tr>
		<td><a href="/users/ctobWink?rid=<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['employer_id'];?>&jid=<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['id'];?>"><img src="/images/btn_like.png"></a>
		<br/><br/>
		<span style="color:red"><?php echo $value[0]['cnt'];?> Likes! </span>
		</td>
		<td>
		<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://job-tiger.com/users/jobpostview/<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['id'];?>?hid=<?php echo $screen_name;?>" data-text="<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['corporation'];?>,<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['job_title'];?>, Salary Range <?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['salary_range_min'];?> - <?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['salary_range_max']; ?>" data-count="vertical" data-via="jobtiger411">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<br/><br/>  <a href="/users/direct_msg?jid=<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['id'];?>"> <img src=/images/btn_d.png></img> </a>
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
		<th>Retweet or <br/> D Msg</th>
		<th>Corporate（企業名）</th>
		<th>Job Title <br/>（職種）</th>
		<th>Salary Range<br/>(給与レンジ）</th>
		<th>Location（勤務地）</th>
		<th>Requirement（応募条件）</th>
	</tr>

	<?php foreach ($jobpost as $item): ?> 
	<tr>
		<td><a href="/users/ctobWink?rid=<?php echo $item['Jobpost']['employer_id'];?>&jid=<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['id'];?>"><img src="/images/btn_like.png"></a></td>
		<td>
		<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://job-tiger.com/users/jobpostview/<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['id'];?>?hid=<?php echo $screen_name;?>" data-text="<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['corporation'];?>,<?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['job_title'];?>, Salary Range <?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['salary_range_min'];?> - <?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['salary_range_max']; ?>" data-count="vertical" data-via="jobtiger411">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<br/><br/>  <a href="/users/direct_msg?jid=<?php echo $item['Jobpost']['id'];?>"> <img src=/images/btn_d.png></img> </a>
		</td><td><?php echo $html->link($item['Jobpost']['corporation'], '/users/corp_profile_view/'.$item['Jobpost']['employer_id']); ?></td>
		<td><?php echo $html->link($item['Jobpost']['job_title'],'/users/jobpostview/'.$item['Jobpost']['id']);?></td>
		<td><?php echo $item['Jobpost']['salary_range_min'].' - '.$item['Jobpost']['salary_range_max']; ?>
		<?php echo cutStr($item['Jobpost']['salary_range_comment'], 50); ?></td>
		<td><?php echo $item['Jobpost']['location']; ?></td>
        <td><?php echo cutStr($item['Jobpost']['requirement'], 50 ); ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<div><?php e($paginator->counter(array("format" => "(all %count% ) %start%～%end%")));?></div>
<div><?php e($paginator->numbers(array('separator' => ' | ', 'modulus' => '2')));?></div>

<br/>
<br/>
<br/>

<h2><a href=/users/allusers>Who is New to Job Tiger?　新規登録ユーザ一覧</a></h2>

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
	<td><?php echo $item["u"]["name"];  ?></td>
	<td><?php echo $item["u"]["location"];   ?></td>
	<td><?php echo $item["u"]["bio"]; ?></td>
</tr>

<?php endforeach; ?>
</table>

<br />
<br />

 
