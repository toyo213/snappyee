<h1>写真の評価をする You like this photo?</h1>
<?php echo $facebook->picture($fbuser['id']); ?><?php echo $lists['User']['nickname'];?>'s picture</a><br>
<a href="<?php echo $lists['User']['blogurl'];?>"><?php echo $lists['User']['nickname'];?>'s related URL</a><br>
<img src="<?php echo $lists['Photo']['fbpath'];?>"></img>




<?php echo $facebook->comments(); ?>