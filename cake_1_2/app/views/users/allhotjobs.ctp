<?php
        function cutStr( $InStr, $MaxSize ) {
            if ( strlen( $InStr ) > $MaxSize ) {
                return( substr( $InStr, 0, $MaxSize -3 ) . " ..." );
            } else {
                return( $InStr );
            }
        }
    ?>



<br/>

<h2>ホットジョブリスト　Hot Job List</h2>

<table>
	<tr>
		<th>Like</th>
		<th>Retweet</th>
		<th>Corporate（企業名）</th>
		<th>Job Title <br/>（職種）</th>
		<th>Salary Range<br/>(給与レンジ）</th>
		<th>Location（勤務地）</th>
		<th>Requirement（応募条件）</th>
        <th>Posted(掲載日）</th>       
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
        <td><?php echo $hotjob[$value['ctob_winks']['jobpost_id']]['created_at']   ?></td>
	</tr>
	<?php endforeach; ?>
</table>
