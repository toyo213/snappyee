

<br />
<br />
<br />
<?php

$name = $prof['User_profile']['name'];
$email = $prof['User_profile']['email'];
$phone = $prof['User_profile']['phone'];

$user_prof=<<<DOC_END
<h3>Profile</h3><br/><br/>
<table width = 400 height = 150>
<tr> 
<th>Name</th>
<td>$name</td>
</tr>

<tr>
<th>
email
</th>
<td>
<a href=$email>$email </a>
</td>
</tr>

<tr><th>
phone
</th>
<td>$phone</td>
</tr>

</table><br/><br/>
DOC_END;

echo $user_prof;

?>


<br />
<br />
<br />

<?php 
echo "<h3>Work History</h3><br/><br/>";

$i_list = array("IT/Software/Internet","Finance/Banking","Retail","Transport&Logistics","Human Resource","Apparel","Entertaiment","Manufacturer","Other");

foreach($job_history as $item)
{
$industry = $i_list[$item['Job_history']['industry']];
$corp=$item['Job_history']['corporation'];	
$job_title=$item['Job_history']['job_title'];
$location=$item['Job_history']['location'];
$current=$item['Job_history']['current'];
$start_year=$item['Job_history']['start_year'];
$start_month=$item['Job_history']['start_month'];
$end_year=$item['Job_history']['end_year'];
$end_month=$item['Job_history']['end_month'];
$summary=$item['Job_history']['summary'];



$j_history=<<<DOC_END



<table width = 600 height = 150>
<tr> 
<th>Industry</th>
<td>$industry </td>
</tr>

<tr> 
<th>Corporation</th>
<td>$corp </td>
</tr>

<tr> 
<th>Job Title</th>
<td>$job_title </td>
</tr>

<tr> 
<th>Location</th>
<td>$location </td>
</tr>


<tr> 
<th>Time Period</th>
<td>$start_year $start_month - $end_year $end_month $current</td>
</tr>

<tr> 
<th>Summary</th>
<td>$summary</td>
</tr>

</table>
<br/>
<br/>
<br/>

DOC_END;

echo $j_history;
}

?>

<?php 
echo "<h3>Education</h3><br/><br/>";

$d_list = array("BA","BS","MA","MBA","MS","Ph.D");

foreach($edu_history as $item)
{
$degree = $d_list[$item['Edu_history']['degree']];
$school=$item['Edu_history']['school'];	
$fields=$item['Edu_history']['fields_of_study'];
$location=$item['Edu_history']['location'];

$start_year=$item['Edu_history']['start_year'];
$start_month=$item['Edu_history']['start_month'];
$end_year=$item['Edu_history']['end_year'];
$end_month=$item['Edu_history']['end_month'];
$summary=$item['Edu_history']['summary'];

$e_history=<<<DOC_END

<table width = 600 height = 150>
<tr> 
<th>Degree</th>
<td> $degree</td>
</tr>

<tr> 
<th>School</th>
<td> $school</td>
</tr>

<tr> 
<th>Location</th>
<td> $location</td>
</tr>

<tr> 
<th>Fields of Study</th>
<td> $fields</td>
</tr>

<tr> 
<th>Time Attended</th>
<td>$start_year $start_month $end_year $end_month</td>
</tr>

<tr> 
<th>Summary</th>
<td>$summary</td>
</tr>

</table>
<br/><br/><br/>
DOC_END;

echo $e_history;
}

?>





<h2>Career Orientation Questionnaire</h2>


<p>Career Orientation Chart </p>
<img src= http://chart.apis.google.com/chart?cht=r&chs=400x400&chd=t:<?php echo $culture;?>,<?php echo $salary;?>,<?php echo $responsibility;?>,<?php echo $compassion;?>,<?php echo $sense_of_humor;?>,<?php echo $perfectionism;?>,<?php echo $culture;?>&chxt=x&chxl=0:|Culture|Salary|Responsibility|Warmth/Compassion|Sense_of_Humor|Perfectionism> </img>
<br/>
<br/>

<!-- <img src= http://chart.apis.google.com/chart?cht=r&chs=400x400&chd=t:<?php echo $salary;?>,20,30,40,50,70,70&chxt=x&chxl=0:|Culture|Salary|Responsibility|Warmth/Compassion|Sense_of_Humor|Perfectionism> </img> -->


<?php 
$c=<<<DOC_END
<br/><br/>

<table>
<tr>
<th>Culture</th>
<th>Salary</th>
<th>Responsibility</th>
<th>Compassion</th>
<th>Sense of Humor</th>
<th>Perfectionism</th>
</tr>

<tr>
<font size=15><td> 1:Conservative  -  10: Liberal</td></font size>
<td> 1:Seniority-based  -  10: Performance-based </td>
<td> 1:Not so Important  -  10: Extremly Important </td>
<td>1:Not so Important  -  10: Extremly Important </td>
<td>1:Not so Important  -  10: Extremly Important </td>
<td>1:Not so Important  -  10: Extremly Important </td>
</tr>



<tr>
<td> $culture </td>
<td> $salary </td>
<td> $responsibility </td>
<td> $compassion </td>
<td> $sense_of_humor </td>
<td> $perfectionism </td>
</tr>
</table>
<br/><br/>
DOC_END;

echo $c;

?>

<?php 

$twitter = $prof["User_profile"]["twitter"];
$t=<<<DOC_END
<br/><br/>
<h2>Twitter</h2>
<p alighn =right>
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 4,
  interval: 6000,
  width: 250,
  height: 300,
  theme: {
    shell: {
      background: '#41b4f2',
      color: '#ffffff'
    },
    tweets: {
      background: '#f5fafa',
      color: '#050505',
      links: '#4aed05'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: 'all'
  }
}).render().setUser("$twitter").start();
</script>
</p>
DOC_END;

if(!empty($twitter)){
echo $t;
}

?>

