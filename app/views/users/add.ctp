<h3>ユーザ登録</h3>
<?php
// Usersコントローラのaddアクションに送信するので'action' => 'add'
echo $form->create('User', array('action' => 'add'));
echo $form->input('username');
//echo $form->input('password');
?>
<tr>
<th>パスワード</th><td><input type="password" name="password" /></td>
</tr>
<?
echo $form->end('ログイン');
