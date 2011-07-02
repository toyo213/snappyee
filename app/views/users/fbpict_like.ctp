<div class="photoList rightMarginS leftcol"> 
<img src="<?php echo $lists['Photo']['fbpath'];?>"  width="400"></img>
<br/>
</div>

<div class="photoDetail rightMarginS rightcol"> 
<h1>
<font size="4"><?php echo __('You Like This Photo?');?></font> 
</h1>

<?php if($isLike==false):  ?>
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
<span id="change_area"><span class="likeFontBig"><?php echo (int)$result['Photo_like']['cnt'];?></span>likes</span>
<div id="b_erace">

<div class="like_on_big like_button radiux3px" id="change_btn"><?php echo __('Like!'); ?></div>
<!--
<form action="" id="form1" method="post">
<button type="button" src="/img/icn_yes.gif" id="change_btn" value="like" /> 
<img src="/img/icn_yes.gif" />
</button>    
</form>
-->
</div>
<?php else:  ?>    
<span class="likeFontBig"><?php echo sprintf("%03d",$result['Photo_like']['cnt']);?></span><span style="font-family:Shruti;">likes</span>
<?php endif;  ?>
<br><?php echo __('Uploaded');?> by <a href="../profile?pid=<?php echo $lists['Photo']['id'];?>"><font size="3"><?php echo $lists['User']['nickname'];?> </a>&nbsp;(<a href="<?php echo $lists['User']['blogurl'];?>">Blog</font></a>)<br>
<?php echo $facebook->like(array('show_faces'=>"false",'href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id']));?>
</div>
<?php echo $facebook->comments(array('href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id'])); ?>
