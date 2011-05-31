
<?php 
if($ses===null){
$mes=<<<DOC_END
<span style=color:red>
To send message to recruiter please login with your Twitter Account. 
<br/>この企業へのメッセージ送信についてはtwitterでログインのうえ行ってください。
</span>
<a href="/users/twitter">
<br/>
<br/>
<img src=/images/twitter-sign-in-l.png></img>
</a>
DOC_END;

echo $mes;

}else{
echo"<a href = /users/create_message?rid=".$corp_profile['Corp_profile']['id'].">Send Message メッセージを送る</a>";
}
?>


<br/>
<br/>

<?php 
$twitter = $corp_profile["Corp_profile"]["twitter"];
$t=<<<DOC_END

<br/>
<br/>
<h2>Corporate Twitter　企業ツイッター</h2>
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

<?php
$corp=$corp_profile["Corp_profile"]["corporation"];
$url=$corp_profile["Corp_profile"]["corp_url"];
$prof=$corp_profile["Corp_profile"]["corp_profile"];
$contact=$corp_profile["Corp_profile"]["corp_contact"];

$d=<<<DOC_END

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

echo $d;

?>



<?php

echo "<h2>Corporate Culture Chart　企業文化チャート </h2>";
echo "<img src= http://chart.apis.google.com/chart?cht=r&chs=400x400&chd=t:".$corp_culture["Corp_culture"]["culture"].",".$corp_culture["Corp_culture"]["salary"].",".$corp_culture["Corp_culture"]["responsibility"].",".$corp_culture["Corp_culture"]["compassion"].",".$corp_culture["Corp_culture"]["sense_of_humor"].",".$corp_culture["Corp_culture"]["perfectionism"].",".$corp_culture["Corp_culture"]["culture"]."&chxt=x&chxl=0:|Culture|Salary|Responsibility|Warmth/Compassion|Sense_of_Humor|Perfectionism> </img>";
echo "<br/><br/>";

echo "<br/><br/>";


$k=<<<DOC_END
<br/><br/>

<table>
<tr>
<th>Culture<br/>企業文化</th>
<th>Salary<br/>給与</th>
<th>Responsibility<br/>責任</th>
<th>Compassion<br/>思いやり</th>
<th>Sense of Humor<br/>ユーモア </th>
<th>Perfectionism<br/>完璧主義</th>
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

echo $k;

if(!empty($corp_profile["Corp_profile"]["twitter"])){
	echo $t;
}


?>