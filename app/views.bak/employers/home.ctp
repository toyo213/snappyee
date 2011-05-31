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

<?php 

$un_msg = count($u_msg);

 
if($un_msg == 0){
echo "";}
else{
echo "<a href=/employers/r_message><p>You have <span style=color:red>".$un_msg."Unread Messages </span></p></a>";
echo "<a href=/employers/r_message><p>新しいメッセージが <span style=color:red>".$un_msg."件あります。</span> </p></a>";
echo "<br/><br/>";
}
?>

<?php 
$application = count($r_application);

echo "<a href=/employers/r_application><p># of Applications recieved <span style=color:red>".$application."</span></p></a>"; 
echo "<a href=/employers/r_application><p>現在の応募者数 <span style=color:red>".$application."</span></p></a>";
echo "<br/><br/>"; 
?>


<h2>Employers Home</h2>
<!--  
<p align = right>Search Box </p>
<br/>
<?php e($form->create('User', array('action'=>'profile'))); ?>
<?php  
$list = array("IT","Retail","Finance","Entertaiment");
e($form->input('Industry', array('type' => 'select', 'options' => $list , 'value' => ""))); 
?>

<p>Corporation</p>
<?php e($form->text('corporation', array('size'=>'35', 'maxlength'=>'1000'))); ?>
<p>Job title</p>
<?php e($form->text('job_title', array('size'=>'35', 'maxlength'=>'1000'))); ?>
<p>Location</p>
<?php e($form->text('location', array('size'=>'35', 'maxlength'=>'1000'))); ?>
<p>Name</p>
<?php e($form->text('Name', array('size'=>'35', 'maxlength'=>'1000'))); ?>
<br/><br/>
<?php e($form->submit('Search Candidates')); ?>
<?php e($form->end()); ?>

<br/>
<br/>
-->

<?php echo '<h2><a href ="./profile">'.$name.'</a></h2>'; ?>
<br/>
<br/>
<br/>

<?php

$corp=$corp_profile["Corp_profile"]["corporation"];
$url=$corp_profile["Corp_profile"]["corp_url"];
$prof=$corp_profile["Corp_profile"]["corp_profile"];
$contact=$corp_profile["Corp_profile"]["corp_contact"];

$p=<<<DOC_END
<table width = 600 height = 300><tr> 
<th>Corporation</th>
<td>$corp </td>
</tr>

<tr>
<th>
URL
</th>
<td>
<a href=$url>$url </a>
</td>
</tr>

<tr><th>
Corporate Profile
</th>
<td>$prof </td>
</tr>

<tr><th>
Contact
</th>
<td>$contact</td>
</tr>
</table><br/><br/>
DOC_END;

if(!empty($corp_profile)){
echo $p;
} else {
	echo '<h2><a href = "./profile"> 企業プロフィールを作成する Create Corporate Profile</a></h2>'; 
} 


?>




 
<h2>Your Jobpost これまでの求人掲載 </h2>

<br/><br/>
<?php echo  '<a href = "./jobpost"> Add Job Post 求人情報を掲載 </a>' ?>
<br/><br/>

<table>
	<tr>
		<th>Corporate　企業名</th>
		<th>Job title　職種</th>
		<th>Salary Range　<br/>給与レンジ</th>
		<th>Location  勤務地</th>
		<th>Requirement　<br/>応募条件</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

	<?php foreach ($jobposts as $item): ?>
	<tr>
		<td><?php echo $html->link($item['Jobpost']['corporation'], '/users/corp_profile_view/'.$item['Jobpost']['employer_id']); ?></td>
		<td><?php echo $html->link($item['Jobpost']['job_title'],'/employers/jobpostview/'.$item['Jobpost']['id']);?></td>
		<td><?php echo $item['Jobpost']['salary_range_min'].' - '.$item['Jobpost']['salary_range_max']; ?>
		<?php echo cutStr($item['Jobpost']['salary_range_comment'], 50); ?></td>
		<td><?php echo $item['Jobpost']['location']; ?></td>
        <td><?php echo cutStr($item['Jobpost']['requirement'], 200 ); ?></td>
        <td><a href="http://job-tiger.com/employers/edit_jobpost?jid=<?php echo $item['Jobpost']['id'];?>"> Edit</a></td>
        <td><a href="javascript:void(0);" onclick="var ok=confirm('Are you sure you want to delete it? 本当に削除しますか？');if (ok) location.href='http://job-tiger.com/employers/delete_jobpost?jid=<?php echo $item['Jobpost']['id'];?>'; return false;"> Delete</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<br/>
<br/>
<br/>
<br/>
<br/>


<!--  
<h2>Top 10 Matches to Your Corporate Culture </h2>

<br/>
<br/>
<table>
	<tr>
 	<th>Twitter</th>
    <th> Name </th>
    <th>location</th>
    <th>url</th>
    <th>followers</th>
    <th>followings</th>
    <th>Match Ratings </th>
 	</tr>
 <?php foreach ($user_match as $item): ?>
	<tr>
		<td><?php echo $item['Job_history']['corporation']; ?></td>
		<td><?php echo $html->link($item['Job_history']['job_title'],'/employers/user_profile_view?sid='.$item['Job_history']['user_id']); ?></td>
        <td><?php echo $item['Job_history']['location']; ?></td>
		<td><?php echo isset($total[$item['Job_history']['user_id']]["total"]) == true ? (1000-$total[$item['Job_history']['user_id']]["total"])/10:""; ?></td>
	</tr>
 <?php endforeach; ?>
</table>

-->

<br/>
<br/>
 
<br/>

