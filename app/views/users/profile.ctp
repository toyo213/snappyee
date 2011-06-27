<?php //var_dump($this->params); ?>


<div align="left">
<?php if(!empty($u['User']['first_name']) && !empty($u['User']['last_name'])){
echo "<a href=".$u['User']['blogurl'].">";
echo "<img src=https://graph.facebook.com/".$u['User']['first_name'].".".$u['User']['last_name']."/picture />";
echo "</a>";
}
?>
<br/>
<a href="<?php echo $u['User']['blogurl']; ?>">
<font color="red" size="3"><?php echo $u['User']['nickname']; ?></font>
</a>
</div>

<table border=2 width=500 >
<caption>
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
<td bgcolor="#FFF0F5"><?php echo __('User Name'); ?></td>
<td><?php echo $u['User']['nickname']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5"><?php echo __('Location'); ?></td>
<td><?php echo $u['User']['location']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5"><?php echo __('Profile'); ?></td>
<td><?php echo $u['User']['profile']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5"><?php echo __('Profile URL'); ?></td>
<td><a href="<?php echo $u['User']['blogurl']; ?>"><?php echo $u['User']['blogurl']; ?></a></td>
</tr>
</table>


<?php //var_dump($photo_list);?>
<?php //echo $fb_id;?>
<br/>
<br/>
<p align="left">
<font color="red" size="3"><?php echo $u['User']['nickname']; ?></font>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('Photos');?>
</p>

<div class="photoList rightMarginS leftcol">
	<?php $i = 0; ?>
    <?php while ($i < 5): ?>
    <?php if(!empty($photo_list[$i]['Photo']['fbpath'])){	
    echo "<div class=photo radiux3px>";
   	echo "<a href=/users/fbpict_like/".$photo_list[$i]['Photo']['id'].">"; 
   	echo "<img src=".$photo_list[$i]['Photo']['fbpath']." width=163 alt= >";
   	echo "</img>";
   	echo "</a>";
   	echo "</div>";
    }
    
    ?>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>

<div class="photoList rightMarginS leftcol">
    <?php $i = 6; ?>
    <?php while ($i < 10): ?>
        <?php if(!empty($photo_list[$i]['Photo']['fbpath'])){	
    echo "<div class=photo radiux3px>";
   	echo "<a href=/users/fbpict_like/".$photo_list[$i]['Photo']['id'].">"; 
   	echo "<img src=".$photo_list[$i]['Photo']['fbpath']." width=163 alt= >";
   	echo "</img>";
   	echo "</a>";
   	echo "</div>";
    } 
    ?>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->

<!-- photo list Normal 1 -->
<div class="photoList rightMarginS leftcol">
    <?php $i = 10; ?>
    <?php while ($i < 13): ?>
        <?php if(!empty($photo_list[$i]['Photo']['fbpath'])){	
    echo "<div class=photo radiux3px>";
   	echo "<a href=/users/fbpict_like/".$photo_list[$i]['Photo']['id'].">"; 
   	echo "<img src=".$photo_list[$i]['Photo']['fbpath']." width=163 alt= >";
   	echo "</img>";
   	echo "</a>";
   	echo "</div>";
    } 
    ?>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->

<!-- photo list Normal 2 -->
<div class="photoList leftcol">
    <?php $i = 13; ?>
    <?php while ($i < 18): ?>
      <?php if(!empty($photo_list[$i]['Photo']['fbpath'])){	
    echo "<div class=photo radiux3px>";
   	echo "<a href=/users/fbpict_like/".$photo_list[$i]['Photo']['id'].">"; 
   	echo "<img src=".$photo_list[$i]['Photo']['fbpath']." width=163 alt= >";
   	echo "</img>";
   	echo "</a>";
   	echo "</div>";
    } 
    ?>
  <?php  $i++; ?>
    <?php endwhile; ?>
</div>