
<div id="body"> 
			<li class="navlistbox" style="float:left"><a href=./home>Home</a></li>
			<li class="navlistbox" style="float:left"><a href=./profile>Profile</a></li>
			<li class="navlistbox" style="float:left"><a href=./index>Top Page</a></li>
			<li class="navlistbox" style="float:left"><a href=./logout>Log Out</a></li>　	
		</ul>
		</div>
<br/>
<br/>

<br />
<br />
<br />
<?php
$tw = $prof['User']['twitter_id'];
$image = $prof['User']['images'];
$name = $prof['User']['name'];
$location = $prof['User']['location'];
$bio = $prof['User']['bio'];
$url = $prof['User']['url'];
$followers = $prof['User']['followers'];
$followings = $prof['User']['followings'] ;

echo "<span style=color:red>".$tw."</span>";

if(!empty($image)){
		echo "<br/><br/>";
		echo "<img src =".$image."></img>";
		echo "<br/><br/>";	
	}


$profile=<<<DOC_END

<table width = 600 height = 150>
<tr> 
<th>Name</th>
<td>$name </td>
</tr>

<tr> 
<th>Location</th>
<td>$location </td>
</tr>

<tr> 
<th>Bio</th>
<td>$bio </td>
</tr>

<tr> 
<th>Followers</th>
<td>$followers</td>
</tr>

<tr> 
<th>Followings</th>
<td>$followings</td>
</tr>

</table>
<br/>
<br/>
<br/>

DOC_END;

echo $profile;
?>

<?php echo '<a href=./edit_profile>Edit Your Career Orientation あなたのキャリア志向性を編集</a>'; ?>

<br />
<br />
<br />
<h2>Career Orientation Chart </h2>
<img src= http://chart.apis.google.com/chart?cht=r&chs=400x400&chd=t:<?php echo $culture;?>,<?php echo $salary;?>,<?php echo $responsibility;?>,<?php echo $compassion;?>,<?php echo $sense_of_humor;?>,<?php echo $perfectionism;?>,<?php echo $culture;?>&chxt=x&chxl=0:|Culture|Salary|Responsibility|Warmth/Compassion|Sense_of_Humor|Perfectionism> </img>
<br/>
<br/>

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

$twitter = $prof['User']['twitter_id'];;
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


