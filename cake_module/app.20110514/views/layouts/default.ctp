<?= $facebook->html(); ?>
<head>
<title>Facebook Plugin Example</title>
</head>
<?php echo $scripts_for_layout ?>
</head>
<body>
<?= $facebook->init(); ?>
<? echo $facebook->login(array('perms' => 'offline_access,email,read_stream,publish_stream')); ?>
    <br>
<? echo $facebook->share();?>
    <br>
<? echo $facebook->share('http://www.rakuten.co.jp'); ?>
    <br>
<? echo $facebook->share('http://www.rakuten.co.jp', array('style' => 'link', 'label' => 'Check it out!')); ?>
    <br>
<? echo $facebook->like(); ?>
    <br>
<?
//イイネ！ボタンのカスタマイズ
echo $facebook->like(array(
'font' => 'veranda',
'layout' => 'button_count',
'action' => 'recommend',
'colorscheme' => 'dark'));
?>
    <br>
    	<?php echo $facebook->picture($fbuser['id']); ?>

<?php echo $facebook->logout(array('redirect' => array('controller' => 'users', 'action' => 'logout'))); ?>

<!-- すべてのビューで表示するための何らかのメニューがある場合、ここでそれを読み込む -->
<div id="header">
    <div id="menu">...</div>



&nbsp;<?php echo $html->link('twitterログイン', '/oauths/twitter' ); ?>
&nbsp;<?php echo $html->link('fbtry', '/users/fbtry' ); ?>
&nbsp;<?php echo $html->link('fbtest', '/users/fbtest' ); ?>
&nbsp;<?php echo $html->link('mixiログイン', '/users/input' ); ?>
&nbsp;<?php echo $html->link('facebookログイン', 'http://www.facebook.com/connect/uiserver.php?app_id=102978646442980&perms=user_location&next=http://apps.facebook.com/stamita/&display=page&next=http://apps.facebook.com/stamita/&method=permissions.request&return_session=1' ); ?>

&nbsp;<?php echo $html->link('入力', '/users/input' ); ?>
&nbsp;<?php echo $html->link('リアルタイム表示', '/users/twitter' ); ?>
&nbsp;<?php echo $html->link('地図表示', '/users/map' ); ?>
&nbsp;<?php echo $html->link('ディレクトリ表示', '/users/people' ); ?>
&nbsp;<?php echo $html->link('ログアウト', '/users/logout' ); ?>


</div>




<!-- ここがビューを表示させたい場所 -->
<?php echo $content_for_layout ?>

<!-- 各表示ページにフッターを追加する -->
<div id="footer">...</div>

</body>
</html>
