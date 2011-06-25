<h1><font size="4"><?php echo __('You Like This Photo?');?></font></h1>
<?php //echo $facebook->picture($fbuser['id']); ?>
<br/>
<?php echo __('Uploaded');?> by <a href="../profile?pid=<?php echo $lists['Photo']['id'];?>"><font size="3"><?php echo $lists['User']['nickname'];?> </a> &nbsp;&nbsp;&nbsp; <a href="<?php echo $lists['User']['blogurl'];?>">Blog </font></a> <br>


<img src="<?php echo $lists['Photo']['fbpath'];?>"></img>
<br/>
<?php echo $result['Photo_like']['cnt']+1;?>members like this.

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
<span id="change_area"></span>
<div id="b_erace">
<form action="" id="form1" method="post">
<button type="button" src="/img/icn_yes.gif" id="change_btn" value="like" /> 
<img src="/img/icn_yes.gif" />
</button>    
</form>
</div>
    
<?php endif;  ?>
<?php echo $facebook->like(array('show_faces'=>"false",'href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id']));?>
<?php echo $facebook->comments(array('href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id'])); ?>
