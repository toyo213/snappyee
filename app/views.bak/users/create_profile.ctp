<?php  

$culture=null;
$salary=null;
$responsibility=null;
$compassion=null;
$sense_of_humor=null;
$perfectionism=null;
?>


<?php 

echo "<br/><br/>";
echo "Detailed profile will significantly increase the probabilities to be found by recruiters.";

echo "<h2>Your Profile Photo</h2>";
echo "<br/><br/>";
echo "<br/><br/>";
echo "<button type=submit>upload your profile photo</button>";
echo "<br/><br/>";
e($form->create('User', array('action'=>'create_profile')));
echo "<h2>Your Name</h2>";
e($form->text('name', array('size'=>'35', 'maxlength'=>'1000')));  
e($form->error('Url.full_url')); 
echo "<br/><br/>";

echo "<h2>Email</h2>";
e($form->text('email', array('size'=>'35', 'maxlength'=>'1000')));
echo "<br/><br/>";

echo "<h2>Phone</h2>";
e($form->text('phone', array('size'=>'35', 'maxlength'=>'1000')));
echo "<br/><br/>";

echo "<h2>Twitter Account</h2>(Optional)";
e($form->text('twitter', array('size'=>'35', 'maxlength'=>'1000')));
echo "<br/><br/>";

//work history
echo "<h2>Work History</h2>";
echo "<h3><a href=> ADD Job History</a></h3>";
echo "<br/>";
$list = array("IT/Software/Internet","Finance/Banking","Retail","Transport&Logistics","Human Resource","Apparel","Entertaiment","Manufacturer","Other");
e($form->input('industry', array('type' => 'select', 'options' => $list))); 
echo "<br/><br/>";
echo "<h3>Corporation</h3><br/>";
e($form->text('corporation', array('size'=>'35', 'maxlength'=>'1000')));
echo "<br/><br/>";
echo "<h3>Job Title</h3><br/>";
e($form->text('job_title', array('size'=>'35', 'maxlength'=>'1000')));
//year(string $fieldName, int $minYear, int $maxYear, mixed $selected, array $attributes, boolean $showEmpty)
echo "<br/><br/>";
echo "<h3>Location </h3><br/>";
e($form->text('location', array('size'=>'35', 'maxlength'=>'1000')));
echo "<br/><br/>";
echo "<h3>Time Period</h3>";
echo "<br/>";
echo $form->checkbox('current');
echo "Currently working for this position";
echo "<p><br/>"; 
echo "Start Date";
echo "&nbsp&nbsp;";
//e($form->datetime('start', 'YM','NONE',$selected=2000));
echo $form->year('job_start_date',$minYear=1960,$maxYear = 2020);
echo "&nbsp&nbsp;";
echo $form->month('job_start_date');
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
echo "End Date&nbsp;";
//e($form->datetime('end', 'YM','NONE',$selected=2000));
echo $form->year('job_end_date',$minYear=1960,$maxYear = 2020);
echo "&nbsp&nbsp;";
echo $form->month('job_end_date');
echo "<br/><br/><h3>Summary</h3>";
echo $form->textarea('summary', array('cols' => 65, 'rows' =>7));
echo "</p>";

//Education History 
echo "<br/><br/><h2>Education</h2>";

echo "<h3><a href=> ADD Education </a></h3>";
echo "<br/>";
$list = array("BA","BS","MA","MBA","MS","Ph.D");
e($form->input('degree', array('type' => 'select', 'options' => $list))); 
echo "<br/><br/>";
echo "<h3>School</h3><br/>";
e($form->text('school', array('size'=>'35', 'maxlength'=>'1000')));
echo "<br/><br/>";

echo "<h3>Location</h3><br/>";
e($form->text('location', array('size'=>'35', 'maxlength'=>'1000')));
echo "<br/><br/>";

echo "<h3>Fields of Study</h3><br/>";
e($form->text('fields_of_study', array('size'=>'35', 'maxlength'=>'1000')));

echo "<br/><br/>";
echo "<h3>Dates Attended</h3>";
echo "<p><br/>"; 
echo "Start Date";
echo "&nbsp&nbsp;";
echo $form->year('edu_start_date',$minYear=1960,$maxYear = 2020);
echo "&nbsp&nbsp;";
echo $form->month('edu_start_date');
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
echo "End Date&nbsp;";
echo $form->year('edu_end_date',$minYear=1960,$maxYear = 2020);
echo "&nbsp&nbsp;";
echo $form->month('edu_end_date');
echo "<br/><br/><h3>Summary</h3>";
echo $form->textarea('summary', array('cols' => 65, 'rows' => 7));
echo "</p>";

echo "<br/><br/>";


echo "<br/><br/>";
echo "<h2>Career Orientation</h2>";
echo "<img src= http://chart.apis.google.com/chart?cht=r&chs=400x400&chd=t:".$culture.",".$salary.",".$responsibility.",".$compassion.",".$sense_of_humor.",".$perfectionism.",".$culture."&chxt=x&chxl=0:|Culture|Salary|Responsibility|Warmth/Compassion|Sense_of_Humor|Perfectionism> </img>";
echo "<br/><br/>";

echo "<h3>Culture</h3><br/>";
echo "<p> 1:Conservative  -  10: Liberal </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('culture', array('type' => 'select', 'options' => $list))); 
echo "<br/><br/><br/>";


echo "<h3>Salary</h3><br/>";
echo "<p> 1:Seniority-based  -  10: Performance-based </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('salary', array('type' => 'select', 'options' => $list))); 
echo "<br/><br/><br/>";


echo "<h3>Responsibility</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('responsibility', array('type' => 'select', 'options' => $list))); 
echo "<br/><br/><br/>";

echo "<h3>Warmth/Compassion</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('compassion', array('type' => 'select', 'options' => $list))); 
echo "<br/><br/><br/>";

echo "<h3>Sense of Humor</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('sense_of_humor', array('type' => 'select', 'options' => $list))); 
echo "<br/><br/><br/>";

echo "<h3>Perfectionism/Excellence</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('perfectionism', array('type' => 'select', 'options' => $list))); 

echo "<br/><br/><br/>";

e($form->submit('create your profile')); 
e($form->end()); 

?>