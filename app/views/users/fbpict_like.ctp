<h1>写真の評価をする You like this photo?</h1>
<?php //echo $facebook->picture($fbuser['id']); ?>
Uploaded by <a href="../profile/"><?php echo $lists['User']['nickname'];?> </a> &nbsp;&nbsp;&nbsp; <a href="<?php echo $lists['User']['blogurl'];?>">Blog </a> <br>

<img src="<?php echo $lists['Photo']['fbpath'];?>"></img>




<?php echo $facebook->comments(); ?>