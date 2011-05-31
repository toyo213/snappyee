

<h2><?php if(isset($fb_profile)){ echo '<a href = "./home">'.$fb_profile['Fb_profile']['name'].'</a>'; } ?></h2>

<img src = <?php if(isset($fb_profile)){ echo $image ;} ?>>
<br/>
<br/>
<?php echo '<h3> <a href = "./stats"> YOUR STATS </a></h3>';?>
<br />
<?php echo  '<a href = "./logout"> Log Out  </a>';?>

<br />
<br />
<br />


<?php
//print 
<<<EOF
<script type="text/javascript">
<!--
alert($("#item1").nodevalue);
// -->
</script>
<div id="fb_job_pane" style="background: red; width:200px; height: auto;">
<div id="item1" style="width:180px; height: 30px;">
{$fb_profile['Fb_profile']['employer_1']}
</div>
</div>
<div id="ti_job_pane" style="background: gray; width:200px; height: auto;">
</div>
EOF;
?>

<?php
if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['employer_1']== ""){
		echo "";
	} else  { echo "<h2>Work History</h2><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_1']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['position_1']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['location_1']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['start_date_1']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['end_date_1']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_1']."</th></tr>";
	echo "</table>";
	}
}
?>


<?php
if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['employer_2']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_2']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['position_2']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['location_2']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['start_date_2']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['end_date_2']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_2']."</th></tr>";
	echo "</table>";}
}
?>



<?php if (isset($fb_profile['0'])){
	if($fb_profile['0']['Fb_profile']['employer_3']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_3']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['position_3']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['location_3']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['start_date_3']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['end_date_3']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_3']."</th></tr>";
	echo "</table>";}
}
?>

<?php if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['employer_4']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_4']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['position_4']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['location_4']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['start_date_4']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['end_date_4']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_4']."</th></tr>";
	echo "</table>";}
}
?>

<?php if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['employer_5']==""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_5']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['position_5']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['location_5']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['start_date_5']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['end_date_5']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_5']."</th></tr>";
	echo "</table>";}
}
?>

<?php  if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['employer_6']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_6']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['position_6']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['location_6']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['start_date_6']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['end_date_6']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_6']."</th></tr>";
	echo "</table>";}
}
?>

<?php if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['employer_7']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_7']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['position_7']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['location_7']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['start_date_7']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['end_date_7']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_7']."</th></tr>";
	echo "</table>";}
}
?>

<?php if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['employer_8']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_8']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['position_8']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['location_8']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['start_date_8']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['end_date_8']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['employer_8']."</th></tr>";
	echo "</table>";}
}
?>

<?php  if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['school_1']== ""){
		echo "";
	} else { echo "<br/><br/><br/><h2>Education</h2><br/>";
	echo "<br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['school_1']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['year_1']."</th></tr>";
	echo "</table>";}
}
?>

<?php if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['school_2']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['school_2']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['year_2']."</th></tr>";
	echo "</table>";}
}
?>

<?php if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['school_3']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['school_3']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['year_3']."</th></tr>";
	echo "</table>";}
}
?>

<?php  if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['school_4']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['school_4']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['year_4']."</th></tr>";
	echo "</table>";}
}
?>

<?php  if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['school_5']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['school_5']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['year_5']."</th></tr>";
	echo "</table>";}
}
?>

<?php  if (isset($fb_profile)){
	if($fb_profile['Fb_profile']['school_6']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['school_6']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['year_6']."</th></tr>";
	echo "</table>";}
}
?>

<?php
if (isset($fb_profile['0'])){
	if($fb_profile['0']['Fb_profile']['school_7']== ""){
		echo "";
	} else { echo "<br/><br/><br/>";
	echo "<table>";
	echo "<tr><th>".$fb_profile['Fb_profile']['school_7']."</th></tr>";
	echo "<tr><th>".$fb_profile['Fb_profile']['year_7']."</th></tr>";
	echo "</table>";}
}
?>

<br />
<br />
<br />



<h2>Career Orientation Questionnaire</h2>


<p>Career Orientation Chart </p>
<img src= http://chart.apis.google.com/chart?cht=r&chs=400x400&chd=t:<?php echo $culture;?>,<?php echo $salary;?>,<?php echo $responsibility;?>,<?php echo $compassion;?>,<?php echo $sense_of_humor;?>,<?php echo $perfectionism;?>,<?php echo $culture;?>&chxt=x&chxl=0:|Culture|Salary|Responsibility|Warmth/Compassion|Sense_of_Humor|Perfectionism> </img>
<br/>
<br/>


<?php e($form->create('User', array('action'=>'fb_profile'))); ?>

<?php
echo "<h3>Culture</h3><br/>";
echo "<p> 1:Conservative  -  10: Liberal </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('culture', array('type' => 'select', 'options' => $list , 'value' => $e_culture))); 
echo "<br/><br/><br/>";


echo "<h3>Salary</h3><br/>";
echo "<p> 1:Seniority-based  -  10: Performance-based </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('salary', array('type' => 'select', 'options' => $list, 'value' => $e_salary))); 
echo "<br/><br/><br/>";


echo "<h3>Responsibility</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('responsibility', array('type' => 'select', 'options' => $list, 'value' => $e_responsibility))); 
echo "<br/><br/><br/>";

echo "<h3>Warmth/Compassion</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('compassion', array('type' => 'select', 'options' => $list, 'value' => $e_compassion))); 
echo "<br/><br/><br/>";

echo "<h3>Sense of Humor</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('sense_of_humor', array('type' => 'select', 'options' => $list, 'value' => $e_sense_of_humor))); 
echo "<br/><br/><br/>";

echo "<h3>Perfectionism/Excellence</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('perfectionism', array('type' => 'select', 'options' => $list, 'value' => $e_perfectionism))); 

?> 
<br/>
<br/>
<br/>

<?php e($form->submit('update your profile')); ?>
<?php e($form->end()); ?>
