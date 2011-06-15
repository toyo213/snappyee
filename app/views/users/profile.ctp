<?php // var_dump($u);?>
<table border=2 width=500 align=center>
<caption><font color="red"><?php echo $u['User']['nickname']; ?></font>さんのプロフィール</caption>
<tr>
<td bgcolor="#FFF0F5">ユーザネーム</td>
<td><?php echo $u['User']['nickname']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5">ロケーション</td>
<td><?php echo $u['User']['location']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5">アナタについて</td>
<td><?php echo $u['User']['profile']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5">プロフィールURL</td>
<td><a href="<?php echo $u['User']['blogurl']; ?>"><?php echo $u['User']['blogurl']; ?></a></td>
</tr>
</table>

<?php //var_dump($photo_list);?>
<?php //echo $fb_id;?>
<br/>
<br/>
<h2><font color="red"><?php echo $u['User']['nickname']; ?></font>さんのフォト</h2>

<div class="photoList rightMarginS leftcol">
	<?php $i = 0; ?>
    <?php while ($i < 5): ?>
    <?php if(!empty($photo_list[$i])){	
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
        <?php if(!empty($photo_list[$i])){	
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
        <?php if(!empty($photo_list[$i])){	
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
      <?php if(!empty($photo_list[$i])){	
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