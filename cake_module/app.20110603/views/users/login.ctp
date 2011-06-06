




<div id="login_body">
  <h1>ログイン画面</h1>
  <?php

    // ログインできなかった場合はエラーメッセージ表示
//    if (!empty($login_error)) {
//        echo '<font color="red"><b>' . $login_error . '</b></font>';
//    }
  ?>

<?php //echo $form->create('User', array('type' => 'post','action' => 'login')); ?>
<?php
//echo $form->input('username');
//echo $form->input('password');
?>
<?php //echo $form->end('Login'); ?>
<?php //echo $html->link('新規登録', '/users/add', array('class'=>'button','target'=>'_blank')); ?>
&nbsp;<?php //echo $html->link('ログアウト', '/users/logout' ); ?>


<?= $facebook->init(); ?>
<? echo $facebook->login(array('perms' => 'offline_access,email,user_photos,friends_photos,read_stream,publish_stream')); ?>
<? //echo $facebook->share();?>
<? //echo $facebook->share('http://www.rakuten.co.jp'); ?>
<? //echo $facebook->share('http://www.rakuten.co.jp', array('style' => 'link', 'label' => 'Check it out!')); ?>
<? //echo $facebook->like(); ?>
<?
//イイネ！ボタンのカスタマイズ
/*
echo $facebook->like(array(
'font' => 'veranda',
'layout' => 'button_count',
'action' => 'recommend',
'colorscheme' => 'dark'));
*/
 ?>
 <br>
<?php echo $facebook->picture($fbuser['id']); ?>

<?php echo $facebook->logout(array('redirect' => array('controller' => 'users', 'action' => 'logout'))); ?>

<!-- すべてのビューで表示するための何らかのメニューがある場合、ここでそれを読み込む -->
<div id="header">
    <div id="menu">...</div>



&nbsp;<?php echo $html->link('写真投稿テスト', '/users/fbtry' ); ?>
&nbsp;<?php echo $html->link('写真をgeegeeにアップ', '/users/fbtest' ); ?>
&nbsp;<?php echo $html->link('アップした写真を確認する', '/photos/main' ); ?>
&nbsp;<?php echo $html->link('facebookログイン', 'http://www.facebook.com/connect/uiserver.php?app_id=102978646442980&perms=user_location&next=http://apps.facebook.com/stamita/&display=page&next=http://apps.facebook.com/stamita/&method=permissions.request&return_session=1' ); ?>

<!--
&nbsp;<?php //echo $html->link('入力', '/users/input' ); ?>
&nbsp;<?php //echo $html->link('リアルタイム表示', '/users/twitter' ); ?>
&nbsp;<?php //echo $html->link('地図表示', '/users/map' ); ?>
&nbsp;<?php //echo $html->link('ディレクトリ表示', '/users/people' ); ?>
&nbsp;<?php //echo $html->link('ログアウト', '/users/logout' ); ?>
-->

</div>






