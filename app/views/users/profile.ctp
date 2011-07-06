<table border="0">
<tr>
<td>
<table border="0" width=450 align="left">

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
&nbsp;&nbsp;
<?php echo "<font color=red>".$session->flash()."</font>"; ?>
<?php if($user['User']['id']==$u['User']['id']){
echo "<a href=/users/edit_profile?uid=".$u['User']['id'].">";
echo __('Edit Profile');
echo "</a>";
}
?>
</caption>

<?php //var_dump($category);?>
<tr>
<td bgcolor="#FFF0F5" width=30%><span class="profileFont"><?php echo __('Location'); ?></span></td>
<td width=70%><?php echo $u['User']['location']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5"><span class="profileFont"><?php echo __('Profile'); ?></span></td>
<td><?php echo $u['User']['profile']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5"><span class="profileFont"><?php echo __('Profile URL'); ?></span></td>
<td><a href="<?php echo $u['User']['blogurl']; ?>"><?php echo $u['User']['blogurl']; ?></a></td>
</tr>
</table>
</td>

<td>
<table border="0" align="right">

</table>
</td>
</tr>

</table>


<?php //var_dump($photo_list);?>
<?php //echo $fb_id;?>
<br/>
<br/>


<p align="left">
<font color="red" size="3"><?php echo $u['User']['nickname']; ?></font>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('Photos');?>
</p>




<?php 
foreach( $photo_list as $pho ){
  //echo $key. "：" .$value."<br />\n"; // 改行しながら値を表示
  echo "<div class=photoProfile radiux3px>";
   	echo "<a href=/users/fbpict_like/".$pho['Photo']['id'].">"; 
   	echo "<img src=".$pho['Photo']['fbpath']." width=163 alt= >";
   	echo "</img>";
   	echo "</a>";
   	echo "</div>";
}

?>

