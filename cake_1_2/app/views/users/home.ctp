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

<div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<?php 
$un_msg = count($u_msg);
 
if($un_msg == 0){
echo "";}
else{
echo "<a href=/users/r_message><p>You have <span style=color:red>".$un_msg."Unread Messages </span></p></a>";
echo "<a href=/users/r_message><p>新しいメッセージが <span style=color:red>".$un_msg."件あります。</span> </p></a>";
}
?>
<br/>
<?php echo '<a href ="./profile">'.$name.'</a>'?>
</div>
<br/>
<br/>
 <?php if(isset($image)){echo "<img src =$image>";} ?>

<?php if(empty($career_orientation)){
echo "<h3><a href=./create_profile>キャリア志向性を入力してください　Please fill out your career orientaiton</a></h3>";
echo "<span style =color:red>キャリア志向生を入力するとマッチングが可能になります。</span>";
echo "<span style =color:red>Job Matching feature enabled after filling out career orientaion</span>";
}else{
	$corp=$job["Job_history"]["corporation"];
	$title=$job["Job_history"]["job_title"];
	echo "<h3>$corp</h3>"; 
	echo "<br/>";
	echo "<h3>$title</h3>";
	}
?>

<br/>
<br/>


<h2>貴方のキャリア志向性マッチしてる企業　Your Match</h2>

<table>
   <tr>
    <th>Corporation </th>
   	<th>URL</th>
   	<th>Profile</th>
   	<th>Contact</th>
   	<th>Match Rating</th>	
   </tr>	
   
   <?php foreach ($match_list as $item): ?>
	<tr> 
		<td><?php echo $html->link($item['Corp_profile']['corporation'], '/users/corp_profile_view/'.$item['Corp_profile']['id']); ?></td>
		<td><?php echo $html->link($item['Corp_profile']['corp_url'], $item['Corp_profile']['corp_url']   ); ?></td>
        <td><?php echo cutStr($item['Corp_profile']['corp_profile'],50); ?></td>
        <td><?php echo cutStr($item['Corp_profile']['corp_contact'],20); ?></td>
		<td><?php echo isset($total[$item['Corp_profile']['id']]["total"]) == true ? (1000 - $total[$item['Corp_profile']['id']]["total"])/10:""; ?></td>
   </tr>
	<?php endforeach; ?>
</table>

<br /><br />
<h2>Saved Jobs　保存したジョブ</h2>
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

<h2>Applied Jobs　応募したジョブ</h2>
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






