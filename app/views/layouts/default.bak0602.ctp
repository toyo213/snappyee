<?php echo $facebook->html(); ?>
<head>
<title>Gee Gee prototype</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="Content-Language" content="ja" />
<?php echo $html->css('/css/style.css'); ?>  
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

<?php echo $scripts_for_layout ?>

<link rel="stylesheet" href="/css/login.css" type="text/css" media="screen, projection" />   
<link href="/css/signup.css" rel="stylesheet" type="text/css" />	 
<link href="/js/jQuery/jqModal/jqModal.css" rel="stylesheet" type="text/css" />
<link href="/css/login.css" rel="stylesheet" type="text/css" />

<link href="/css/DropDownMenu.css" rel="stylesheet" type="text/css" media="all">
<script src="/js/navi.js" type="text/javascript"></script>
<script src="/js/DropDownMenu.js" type="text/javascript"></script>

<script src="/js/geegee.js" type="text/javascript"></script>

<script src="/js/jQuery/jquery-1.2.6.js" type="text/javascript"></script>  
<script src="/js/jQuery/jqModal/jqModal.js" type="text/javascript"></script>  
<script type="text/javascript">
$(function() {
//$('#dialog').jqm();
$('#dialog').jqm({ modal: true });
});
</script>
<!-- /jQuery-->
</head>
<body id="home" onLoad="MM_preloadImages('img/images/btn_createmyaccount_on.gif')">
<?= $facebook->init(); ?>
    <div id="header">
	<div class="headerInnner">
    	<a href="/"><h1 class="leftcol">Gee Gee</h1></a>
        <div id="gnavi" class="leftcol">
            <a href="/users/fbphoto_upload"><?php echo __('Upload FB photo'); ?></a><span class="delimiter">|</span><!--
            --><a href="/users/photo_upload"><?php echo __('Upload photo from your PC'); ?></a><span class="delimiter">|</span><!--
            --><a href="/users/howto"><?php echo __('How to Gee Gee!'); ?></a>
        </div>
        <div id="userStatus" class="leftcol">

            <?
            if (empty($user)) {
                echo $facebook->login(array('perms' => 'offline_access,email,user_photos,friends_photos,read_stream,publish_stream'));
            } else {
                echo sprintf('<div class="pic leftcol">%s</div>',$facebook->picture($fbuser['id'], array('width' => '26', 'height' => '26')));
                echo sprintf('<div class="username leftcol">%s</div>', '<!--morelink--><a href=/users/profile><font color=white size=2>'.$user['User']['nickname'].'</font></a><!--morelink-->');
                echo sprintf('<div class="logout radiux3px leftcol">%s</div>', $facebook->logout(array('redirect' => array('controller' => 'users', 'action' => 'logout'))));
            }
            ?>            
            </div>
        <!--
                <div id="userStatus" class="radiux3px leftcol">
                    <div id="fb-root"></div><?php echo $facebook->picture($fbuser['id']); ?>
    	<br/>
    	<a href="http://<?php echo $_SERVER["SERVER_NAME"] . "/users/profile"; ?>">	
                <font size="2" color="red"><?php echo $user['User']['nickname']; ?></font>
                </a>
        -->
            
        </div>
    </div>

<div id="content" class="clearfix">
	<div id="topContent" class="radiux5px clearfix"> 
         <?php echo __('Gee Gee is a web service where you can upload fashion photos in your style and share it with the world.');?>   <br/>
	</div>
    <div id="leftContent" class="radiux5px leftcol">    
        <div id="photoContent" class="radiux5px clearfix">
            <div class="tagList radiux5px">
                <?php echo __('Check Trending Photos!'); ?>
                <a href="/users/top/nail"><?php echo __('Nail'); ?></a><span class="delimiter">|</span><!--
                --><a href="/users/top/makeup"><?php echo __('Make-up'); ?></a><span class="delimiter">|</span><!--
                --><a href="/users/top/hair"><?php echo __('Hair Style'); ?></a><span class="delimiter">|</span><!--
                --><a href="/users/top/fashion"><?php echo __('Fashion'); ?></a><span class="delimiter">|</span><!--
                --><a href="/users/top/accessory"><?php echo __('Accessory'); ?></a><span class="delimiter">|</span><!--
                --><a href="/users/top/bag"><?php echo __('Bag'); ?></a></a><span class="delimiter">|</span><!--
                --><a href="/users/top/shoes"><?php echo __('Shoes'); ?></a>
            </div> 
           
            
<!-- ここがビューを表示させたい場所 -->
<?php echo $content_for_layout ?>
        </div>
    </div>
      
    
    

    <div id="rightContent" class="leftcol">
        <div class="bgWhile">
            <div id="fb-root"></div>
           <!-- <script src="http://connect.facebook.net/ja_JP/all.js#xfbml=1"></script><fb:like-box href="#" width="240" show_faces="true" stream="false" header="false"></fb:like-box> -->
        </div>
    	<div class="partTitle" ><?php echo __('Gee Gee Ranking'); ?></div>
    	<div class="partContent">	
     <?php $i = 1;?>  
     <?php foreach ($list as $key => $val): ?>
            <div class="photo photoRanking radiux3px">
            <a href="/users/fbpict_like/<?php echo $val['Photo']['id'];?>"><img src="<?php echo $val['Photo']['fbpath']; ?>" width="210px" alt="" /></a>
                <div class="crown">No.<?php echo $i;?></div>
            </div>
     <?php $i++;if($i ==6 ) break;  ?>
     <?php endforeach; ?>
        </div>

        <div class="bgWhile" style="margin-top:10px;">    
<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FGee-Gee%2F214073558614020%3Fnotif_t%3Dfbpage_admin&amp;width=240&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;height=427" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:240px; height:427px;" allowTransparency="true"></iframe>
		</div>        
    </div> 
</div>
<div id="footer" class="clearfix">
	<div class="footerInner">
    <a href="http://213stomperz.com/">	&copy;2011 gee-gee. All Rights Reserved. </a>
    </div>
</div>
</body>
</html>
