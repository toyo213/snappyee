<h1>写真の評価をする You like this photo?</h1>
<?php //echo $facebook->picture($fbuser['id']); ?>
Uploaded by <a href="../profile?pid=<?php echo $lists['Photo']['id'];?>"><?php echo $lists['User']['nickname'];?> </a> &nbsp;&nbsp;&nbsp; <a href="<?php echo $lists['User']['blogurl'];?>">Blog </a> <br>


<img src="<?php echo $lists['Photo']['fbpath'];?>"></img>
<br/>

<script>
$(function() {
    $('#change_btn').click(function() {
    $("#change_area").html('<img src="/img/scroll.gif" width="10" height="10" alt="Now Loading..." />');
    $.post('/users/like/<?php echo $lists['Photo']['id'];?>',
            {
                name : $('#name').attr('value')
            },
            callBack);
    });
});

function callBack(data) {
    $('#change_area').html(data);
    $('#b_erace').hide();
}
</script>

<span id="change_area"></span>
<div id="b_erace">
<form action="" id="form1" method="post">
<button type="button" src="/img/icn_yes.gif" id="change_btn" value="like" /> 
<img src="/img/icn_yes.gif" />
</button>
    
</form>
</div>
    
<?php echo $facebook->like(array('show_faces'=>"false",'href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id']));?>
<?php echo $facebook->comments(array('href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id'])); ?>

<!--  
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=216286761727505&amp;xfbml=1"></script><fb:like href="http://ck.soogle.me/users/fbpict_like/10" send="true" width="450" show_faces="true" font=""></fb:like>

http://ck.soogle.me/users/fbpict_like/.$lists["Photo"]["id"]

http://.$_SERVER['SERVER_NAME']./users/fbpict_like/.$lists['Photo']['id']
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:comments href="http://ck.soogle.me/users/fbpict_like/10" num_posts="2" width="500"></fb:comments>

-->
