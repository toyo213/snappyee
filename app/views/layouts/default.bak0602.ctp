<?php echo $facebook->html(); ?>
<head>
<title>Gee Gee prototype</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="Content-Language" content="ja" />
<?php echo $html->css('/css/style.css'); ?>  
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<?php echo $scripts_for_layout ?>
</head>
<body>
<?= $facebook->init(); ?>
<!-- Jquery /-->
<link href="/js/jQuery/jqModal/jqModal.css" rel="stylesheet" type="text/css" />
<link href="/css/login.css" rel="stylesheet" type="text/css" />
<script src="/js/jQuery/jquery-1.2.6.js" type="text/javascript"></script>
<script src="/js/jQuery/jqModal/jqModal.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
//$('#dialog').jqm();
$('#dialog').jqm({ modal: true });
});
</script>
<!-- /jQuery-->
    <div id="header">
	<div class="headerInnner">
    	<a href="/"><h1 class="leftcol">Gee Gee [ジージー]</h1></a>
        <div id="gnavi" class="leftcol">
            <a href="/users/fbphoto_upload">Facebookフォトをアップロード  </a><span class="delimiter">|</span><!--
            --><a href="/users/photo_upload">PC/MACからフォトをアップロード  </a><span class="delimiter">|</span><!--
            --><a href="#">Gee Geeの楽しみ方  </a>
        </div>
        <div id="userStatus" class="radiux3px leftcol">
            <div id="fb-root"></div><?php echo $facebook->picture($fbuser['id']); ?><? echo $facebook->login(array('perms' => 'offline_access,email,user_photos,friends_photos,read_stream,publish_stream')); ?>
        <br/><?php echo $facebook->logout(array('redirect' => array('controller' => 'users', 'action' => 'logout'))); ?>

        </div>  
    </div>
</div>
    
<br>
&nbsp;<?php //echo $html->link('写真投稿テスト', '/users/fbtry' ); ?>
&nbsp;<?php //echo $html->link('写真をgeegeeにアップ', '/users/fbtest' ); ?>
&nbsp;<?php //echo $html->link('アップした写真を確認する', '/photos/main' ); ?>
&nbsp;<?php //echo $html->link('facebookログイン', 'http://www.facebook.com/connect/uiserver.php?app_id=102978646442980&perms=user_location&next=http://apps.facebook.com/stamita/&display=page&next=http://apps.facebook.com/stamita/&method=permissions.request&return_session=1' ); ?>

<div id="content" class="clearfix">
	<div id="topContent" class="radiux5px clearfix"><?php echo  $user['User']['nickname']; ?>さん こんにちは!! ジージーはお気に入りの自分フォトをアップロードして、みんなで楽しむサイトです！<br/>
	Gee Gee is a web service where you can upload fashion photos in your style and share it with the world.</div>
    <div id="leftContent" class="radiux5px leftcol">    
        <div id="photoContent" class="radiux5px clearfix">
            <div class="tagList radiux5px">
                ジャンル別にチェック！
                <a href="/users/top/nail">ネイル</a><span class="delimiter">|</span><!--
                --><a href="/users/top/makeup">メイク</a><span class="delimiter">|</span><!--
                --><a href="/users/top/hair">ヘアスタイル</a><span class="delimiter">|</span><!--
                --><a href="/users/top/fashion">ファッション</a><span class="delimiter">|</span><!--
                --><a href="/users/top/accessory">アクセ</a><span class="delimiter">|</span><!--
                --><a href="/users/top/bag">バッグ</a>
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
    	<div class="partTitle" style="margin-top:10px;">Gee Gee ランキング</div>
    	<div class="partContent">	
     <?php $i = 1;?>  
     <?php foreach ($list as $key => $val): ?>
            <div class="photo radiux3px">
            <a href="#"><img src="<?php echo $val['Photo']['fbpath']; ?>" width="210px" alt="" /></a>
                <div class="crown">No.<?php echo $i;?></div>
            </div>
     <?php $i++;if($i ==6 ) break;  ?>
     <?php endforeach; ?><!-- 
            <div class="photo radiux3px">
                <a href="#"><img src="img/sample_pic/3.jpg" width="210px" alt="" /></a>
                <div class="crown">2nd</div>
            </div>
            <div class="photo radiux3px">
                <a href="#"><img src="img/sample_pic/276.jpg" width="210px" alt="" /></a>
                <div class="crown">3rd</div>
            </div>
            <div class="photo radiux3px">
                <a href="#"><img src="img/sample_pic/321.jpg" width="210px" alt="" /></a>
                <div class="crown">4th</div>
            </div>
             <div class="photo radiux3px">
                <a href="#"><img src="img/sample_pic/35.jpg" width="210px" alt="" /></a>
                <div class="crown">5th</div>
            </div>             
                         -->
        </div>

        <div class="bgWhile" style="margin-top:10px;">    
			<script src="http://widgets.twimg.com/j/2/widget.js"></script>
            <script>
            new TWTR.Widget({
              version: 2,
              type: 'profile',
              rpp: 4,
              interval: 6000,
              width: 240,
              height: 300,
              theme: {
                shell: {
                  background: '#FFFFFF',
                  color: '#e73658'
                },
                tweets: {
                  background: '#FFFFFF',
                  color: '#e73658',
                  links: '#e73658'
                }
              },
              features: {
                scrollbar: false,
                loop: false,
                live: false,
                hashtags: true,
                timestamp: true,
                avatars: false,
                behavior: 'all'
              }
            }).render().setUser('Gee_Gee__').start();
            </script>
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
