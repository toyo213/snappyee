<h1>写真の評価をする You like this photo?</h1>
<?php //echo $facebook->picture($fbuser['id']); ?>
Uploaded by <a href="../profile?pid=<?php echo $lists['Photo']['id'];?>"><?php echo $lists['User']['nickname'];?> </a> &nbsp;&nbsp;&nbsp; <a href="<?php echo $lists['User']['blogurl'];?>">Blog </a> <br>

<?php //var_dump($lists);?>
<img src="<?php echo $lists['Photo']['fbpath'];?>"></img>


<?php echo $facebook->like(array('show_faces'=>"false",'href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id']));?>

<?php echo $facebook->comments(array('href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id'])); ?>

<?php //var_dump($_SERVER["SERVER_NAME"]); ?>
<?php //echo "http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id']; ?>


<!--  
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=216286761727505&amp;xfbml=1"></script><fb:like href="http://ck.soogle.me/users/fbpict_like/10" send="true" width="450" show_faces="true" font=""></fb:like>

http://ck.soogle.me/users/fbpict_like/.$lists["Photo"]["id"]

http://.$_SERVER['SERVER_NAME']./users/fbpict_like/.$lists['Photo']['id']
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:comments href="http://ck.soogle.me/users/fbpict_like/10" num_posts="2" width="500"></fb:comments>

-->
