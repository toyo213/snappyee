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
<script src="/js/jQuery/jquery-1.2.6.js" type="text/javascript"></script>  
<script src="/js/jQuery/jqModal/jqModal.js" type="text/javascript"></script>
<script src="/js/jQuery/MyThumbnail.js"></script>
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
         <?php echo __('Gee Gee is a web service where you can upload fashion photos in style and share it with the world.');?>   <br/>
	</div>
        
        
            
            
<!-- ここがビューを表示させたい場所 -->
<?php echo $content_for_layout ?>
        
    
</div>

<div id="footer" class="clearfix">
	<div class="footerInner">
    <a href="http://213stomperz.com/">	&copy;2011 gee-gee. All Rights Reserved. </a>
    </div>
</div>
</body>
</html>
