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

<h2>掲載ジョブリスト　Job Post List</h2>

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

	<?php foreach ($jobpost as $item): ?> 
	<tr>
		<td><a href="http://job-tiger.com/users/ctobWink?rid=<?php echo $item['Jobpost']['employer_id'];?>&jid=<?php echo $item['Jobpost']['id'];?>"><img src="http://job-tiger.com/images/btn_like.png"></a></td>
		<td>
		<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://job-tiger.com/users/jobpostview/<?php echo $item['Jobpost']['id'];?>" data-text="<?php echo $item['Jobpost']['corporation'];?>,<?php echo $item['Jobpost']['job_title'];?>,Salary Range <?php echo $item['Jobpost']['salary_range_min'];?> - <?php echo $item['Jobpost']['salary_range_max']; ?>,Job Tiger" data-count="vertical" data-via="jobtiger411">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</td>
		<td><?php echo $html->link($item['Jobpost']['corporation'], '/users/corp_profile_view/'.$item['Jobpost']['employer_id']); ?></td>
		<td><?php echo $html->link($item['Jobpost']['job_title'],'/users/jobpostview/'.$item['Jobpost']['id']);?></td>
		<td><?php echo $item['Jobpost']['salary_range_min'].' - '.$item['Jobpost']['salary_range_max']; ?>
		<?php echo cutStr($item['Jobpost']['salary_range_comment'], 50); ?></td>
		<td><?php echo $item['Jobpost']['location']; ?></td>
        <td><?php echo cutStr($item['Jobpost']['requirement'], 50 ); ?></td>
        <td><?php echo $item['Jobpost']['created_at'] ?></td>
	</tr>
	<?php endforeach; ?>
</table>
