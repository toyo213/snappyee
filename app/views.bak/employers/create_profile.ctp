<h2>Corporate Profile</h2>

<?php echo '<a href ="./profile">'.$name.'</a>'?><br/>

<br/>
<br/>
<br/>
<br/>
<?php


$create=<<<DOC_END
<h2><a href = ./create_profile>Create Profile</a> </h2>

<br/><br/>
$form->create('Employer', array('action'=>'profile'))
<h2>Corporation</h2>
$form->text('corporation', array('size'=>'35', 'maxlength'=>'1000'))  
e($form->error('Url.full_url')); 
<br/><br/>

<h2>URL</h2>
e($form->text('url', array('size'=>'35', 'maxlength'=>'1000')));

<br/><br/>
<h2>Corporation Profile</h2>
$form->textarea('corp_profile', array('cols' => 80, 'rows' => 10))
<br/><br/><h2>Contact</h2>
$form->textarea('corp_contact', array('cols' => 80, 'rows' => 5))
<br/><br/>

<h2>Twitter Account</h2>
e($form->text('twitter', array('size'=>'35', 'maxlength'=>'1000')))

<h2>Corporate Culture Chart </h2>
<img src= http://chart.apis.google.com/chart?cht=r&chs=400x400&chd=t:".$culture.",".$salary.",".$responsibility.",".$compassion.",".$sense_of_humor.",".$perfectionism.",".$culture."&chxt=x&chxl=0:|Culture|Salary|Responsibility|Warmth/Compassion|Sense_of_Humor|Perfectionism> </img>";
<br/><br/>

<h3>Culture</h3><br/>
<p> 1:Conservative  -  10: Liberal </p><br/> 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('culture', array('type' => 'select', 'options' => $list))); 
<br/><br/><br/>


<h3>Salary</h3><br/>
<p> 1:Seniority-based  -  10: Performance-based </p><br/> 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('salary', array('type' => 'select', 'options' => $list))); 
<br/><br/><br/>


<h3>Responsibility</h3><br/>
echo "<p> 1:Not so Important  -  10: Extremly Important </p><br/>"; 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('responsibility', array('type' => 'select', 'options' => $list))); 
echo "<br/><br/><br/>";

<h3>Warmth/Compassion</h3><br/>
<p> 1:Not so Important  -  10: Extremly Important </p><br/> 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('compassion', array('type' => 'select', 'options' => $list))); 
<br/><br/><br/>

<h3>Sense of Humor</h3><br/>
<p> 1:Not so Important  -  10: Extremly Important </p><br/> 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('sense_of_humor', array('type' => 'select', 'options' => $list))); 
<br/><br/><br/>

<h3>Perfectionism/Excellence</h3><br/>
<p> 1:Not so Important  -  10: Extremly Important </p><br/> 
$list = array(1,2,3,4,5,6,7,8,9,10);
e($form->input('perfectionism', array('type' => 'select', 'options' => $list))); 

<br/><br/><br/>

e($form->submit('update your corporate profile')); 
e($form->end()); 
DOC_END;

echo $create;

?>