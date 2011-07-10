<?php foreach ( $list as $key => $val):?>
<div class="rightMarginS leftcol"> 
<a href="/users/fbpict_like/<?php echo $val['Photo']['id'];?>"><img src="<?php echo $val['Photo']['fbpath'];?>"  width="400"></img></a>
<br/>
</div>
<div class="photoDetail rightMarginS rightcol"> 
<h1>
<font size="4"><?php echo __('You Like This Photo?');?></font> 
</h1>
<?php if(!isset($userIsLike[$val['Photo']['id']])):  ?>
<script>
$(function() {
    $('#change_btn').click(function() {
    $("#change_area").html('<img src="/img/ajax-loader.gif" width="10" height="10" alt="Now Loading..." />');
    $.post('/users/like/<?php echo $val['Photo']['id'];?>',
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
<span id="change_area"><span class="likeFontBig"><?php echo sprintf("%03d",(int)$val['Photo']['cnt']);?></span>likes</span>
<div id="b_erace">

<div class="like_on_big like_button radiux3px" id="change_btn"><?php echo __('Like!'); ?></div>
</div>
<?php else:  ?>    
<span class="likeFontBig"><?php echo sprintf("%03d",$val['Photo']['cnt']);?></span><span style="font-family:Shruti;">likes</span>
<?php endif;  ?>
<br><?php echo __('Uploaded');?> by <a href="../profile?pid=<?php echo $val['Photo']['id'];?>"><font size="3"><?php //echo $lists['User']['nickname'];?> </a>&nbsp;(<a href="<?php echo $lists['User']['blogurl'];?>">Blog</font></a>)<br>
<a href="/users/fbpict_like/<?php echo $val['Photo']['id'];?>">Detail</a><br>

<?php echo $facebook->like(array('show_faces'=>"false",'href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$val['Photo']['id']));?>
</div>
<?php echo $facebook->comments(array('href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$val['Photo']['id'],'width'=>400)); ?>
<?php endforeach; ?>
