<h2>Corporate Profile</h2>

<?php echo '<a href ="./profile">'.$name.'</a>'?><br/>

<br/>
<br/>
<br/>
<br/>

<?php e($form->create('Employer', array('action'=>'profile'))); ?>
<h2>Corporation</h2>
<p><?php e($form->text('corporation', array('size'=>'35', 'maxlength'=>'1000'))); ?><?php e($form->error('Url.full_url')); ?></p>
<br/>
<br/>

<h2>URL</h2>
<?php e($form->text('url', array('size'=>'35', 'maxlength'=>'1000'))); ?>

<br/>
<br/>
<h2>Corporation Profile</h2>
<?php echo $form->textarea('corp_profile', array('cols' => 80, 'rows' => 10)); ?>
<br/>
<br/>
<h2>Contact</h2>
<?php echo $form->textarea('corp_contact', array('cols' => 80, 'rows' => 5)); ?>


<br/>
<br/>

<h2>Corporate Culture Chart </h2>
<img src= http://chart.apis.google.com/chart?cht=r&chs=400x400&chd=t:<?php echo $culture;?>,<?php echo $salary;?>,<?php echo $responsibility;?>,<?php echo $compassion;?>,<?php echo $sense_of_humor;?>,<?php echo $perfectionism;?>,<?php echo $culture;?>&chxt=x&chxl=0:|Culture|Salary|Responsibility|Warmth/Compassion|Sense_of_Humor|Perfectionism> </img>
<br/>
<br/>

<?php
echo "<h3>Culture</h3><br/>";
echo "<p> 1:Conservative  -  10: Liberal </p><br/>"; 
$list = array(10,20,30,40,50,60,70,80,90,100);
e($form->input('culture', array('type' => 'select', 'options' => $list , 'value' => 4))); 
echo "<br/><br/><br/>";


echo "<h3>Salary</h3><br/>";
echo "<p> 1:Seniority-based  -  10: Performance-based </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('salary', array('type' => 'select', 'options' => $list , 'value' => 4))); 
echo "<br/><br/><br/>";


echo "<h3>Responsibility</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('responsibility', array('type' => 'select', 'options' => $list , 'value' => 4))); 
echo "<br/><br/><br/>";

echo "<h3>Warmth/Compassion</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('compassion', array('type' => 'select', 'options' => $list, 'value' => 4))); 
echo "<br/><br/><br/>";

echo "<h3>Sense of Humor</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('sense_of_humor', array('type' => 'select', 'options' => $list, 'value' => 4))); 
echo "<br/><br/><br/>";

echo "<h3>Perfectionism/Excellence</h3><br/>";
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('perfectionism', array('type' => 'select', 'options' => $list, 'value' => 4))); 

?> 
<br/>
<br/>
<br/>

<?php e($form->submit('update your corporate profile')); ?>
<?php e($form->end()); ?>





