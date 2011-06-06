<div id="login_body">
  <h1>ログイン画面</h1>
  <?php
    // ログインできなかった場合はエラーメッセージ表示
    if (!empty($login_error)) {
        echo '<font color="red"><b>' . $login_error . '</b></font>';
    }
  ?>

<?php echo $form->create('User', array('type' => 'post','action' => 'login')); ?>
<?php
echo $form->input('username');
//echo $form->input('password');
?>
<tr>
<th>パスワード</th><td><input type="password" name="password" /></td>
</tr>
<?php echo $form->end('Login'); ?>
<?php echo $html->link('新規登録', '/users/add', array('class'=>'button','target'=>'_blank')); ?>
&nbsp;<?php echo $html->link('ログアウト', '/users/logout' ); ?>

