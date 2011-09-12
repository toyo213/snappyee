<?php 
Configure::load('magazines');
$mag = Configure::read('magazines.regist');

Configure::load('occupations');
$occupations = Configure::read('occupations.regist');

Configure::load('occupations');
		preg_match(('/.*(ja|jp).*/'),$_SERVER['HTTP_ACCEPT_LANGUAGE'],$match);
		if(count($match) > 0 ) {
			$this->isJpn = true;
			$occupations = Configure::read('occupations.jpn');
		} else {
			$occupations = Configure::read('occupations.en');
		}
?>
<br/>

<table border="1" width=500 align="center">
<caption>
<?php if(!empty($u['User']['fb_id'])){
echo "<a href=".$u['User']['blogurl'].">";
echo "<img src=https://graph.facebook.com/".$u['User']['fb_id']."/picture />";
echo "</a>";
}
?>
<a href="<?php echo $u['User']['blogurl']; ?>">
<font color="red" size="3"><?php echo $u['User']['nickname']; ?></font>
</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo "<font color=red>".$session->flash()."</font>"; ?>
<?php if($user['User']['id']==$u['User']['id']){
echo "<a href=/users/edit_profile?uid=".$u['User']['id'].">";
echo __('Edit Profile');
echo "</a>";
}
?>
<br/>
<br/>
</caption>
<tr>
<td bgcolor="#FFF0F5"><span class="profileFont"><?php echo __('Profile URL'); ?></span></td>
<td><a href="<?php echo $u['User']['blogurl']; ?>"><?php echo $u['User']['blogurl']; ?></a></td>
</tr>
<tr>
<td bgcolor="#FFF0F5" width=30%><span class="profileFont"><?php echo __('Location'); ?></span></td>
<td width=70%><?php echo $u['User']['location']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5"><span class="profileFont"><?php echo __('About Myself'); ?></span></td>
<td><?php echo $u['User']['profile']; ?></td>
</tr>

<tr>
<td bgcolor="#FFF0F5"><span class="profileFont"><?php echo __('Favorite Magazines'); ?></span></td>
<td><?php
$m = json_decode($u['User']['magazines']);

foreach($m as $key => $value)
{
echo $mag[$value]; 
echo "&nbsp;&nbsp;";
}

?>
</td>
</tr>

<tr>
<td bgcolor="#FFF0F5"><span class="profileFont"><?php echo __('Industry'); ?></span></td>
<td><?php 
echo $occupations[$u['User']['occupations']];
//echo array_slice($occupations,$u['User']['occupations'],1);
//echo $u['User']['occupations']; 
?>

</td>
</tr>

</table>

<p align="left">
<font color="red" size="3"><?php echo $u['User']['nickname']; ?></font>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('Photos');?>
</p>


<div id="thumbnail"> 
<a href="http://www.google.com"><img src="http://www.kfsoft.info/MyThumbnail/images/1.jpg" class="myPic"></a> 
<a href="http://www.yahoo.com"><img src="http://www.kfsoft.info/MyThumbnail/images/2.jpg" class="myPic"></a> 
<a href="http://www.kfsoft.info"><img src="http://www.kfsoft.info/MyThumbnail/images/3.jpg" class="myPic"></a> 
<?php foreach( $photo_list as $pho):?>
  <a href="/users/fbpict_like/<?php echo $pho['Photo']['id']; ?>">
  <img src="<?php echo $pho['Photo']['fbpath']; ?>" class="myPic"></img>
  </a>
<?php endforeach; ?>
</div>
  
<script>
$("#thumbnail img").MyThumbnail({ 
    thumbWidth:100, 
    thumbHeight:100, 
    backgroundColor:"#ccc", 
    imageDivClass:"myPic"
}); 
</script>
  
