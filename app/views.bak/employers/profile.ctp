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

<h2>Corporate Profile</h2>

<?php echo '<h2><a href ="./home">'.$name.'</a></h2>'; ?><br/>

<br/>
<br/>

<?php
$twitter = $corp_profile["Corp_profile"]["twitter"];
$t=<<<DOC_END

<h2>Corporate Twitter</h2>
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

?>

<?php //echo $html->link($item['Jobpost']['job_title'],'/users/jobpostview/'.$item['Jobpost']['id']);?>

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

DOC_END;

if(!empty($corp_profile)){
echo "<a href ='./edit_profile'>Edit your Corporate Profile　企業プロフィールを編集</a><br/><br/>";	
echo $p;
echo "<h2>Corporate Culture Chart </h2>";
echo "<img src= http://chart.apis.google.com/chart?cht=r&chs=400x400&chd=t:".$culture.",".$salary.",".$responsibility.",".$compassion.",".$sense_of_humor.",".$perfectionism.",".$culture."&chxt=x&chxl=0:|Culture|Salary|Responsibility|Warmth/Compassion|Sense_of_Humor|Perfectionism> </img>";
echo "<br/>";
echo $c;


	echo "<br/><br/>";

		if(!empty($corp_profile["Corp_profile"]["twitter"])){
		echo $t;
		}

} else { 
	
echo "<h2><a href = ./create_profile>Create Profile 企業プロファイルを作成</a> </h2>";

echo "<br/><br/>";
e($form->create('Employer', array('action'=>'profile')));
echo "<h2>Corporation</h2>";
e($form->text('corporation', array('size'=>'35', 'maxlength'=>'1000')));  
e($form->error('Url.full_url')); 
echo "<br/><br/>";

echo "<h2>URL</h2>";
e($form->text('url', array('size'=>'35', 'maxlength'=>'1000')));

echo "<br/><br/>";
echo "<h2>Corporation Profile</h2>";
echo $form->textarea('corp_profile', array('cols' => 80, 'rows' => 10));
echo "<br/><br/><h2>Contact</h2>";
echo $form->textarea('corp_contact', array('cols' => 80, 'rows' => 5));
echo "<br/><br/>";

echo "<h2>Twitter Account</h2>";
echo "<img src=/images/at_mark.jpg width=40 height=50></img>"; 
e($form->text('twitter', array('size'=>'35', 'maxlength'=>'1000')));

echo "<h2>Corporate Culture Chart </h2>";
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

e($form->submit('update your corporate profile')); 
e($form->end()); 
}
?>