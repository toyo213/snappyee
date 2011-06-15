
<?php e($form->create('User', array('action'=>'edit_profile'))); ?>

<p><font color="#FFF0F5">ユーザネーム</font></p>
<?php e($form->input('nickname', array('type' => 'text', 'value' => $u['User']['nickname'] ,'div'=>true,'required'=>true,'label' =>'ユーザネーム')));?>
<?php e($form->input('location', array('type' => 'text', 'value' => $u['User']['location'] ,'div'=>true,'label' =>'ロケーション')));?>

<?php e($form->input('profile', array('type' => 'text','style'=>'width:21em;height:10em','maxlength'=>200, 'value' => $u['User']['profile'] ,'div'=>true,'label' =>'プロフィール')));?>

<?php e($form->input('blogurl', array('type' => 'text', 'value' => $u['User']['blogurl'] ,'div'=>true,'label' =>'URL　　 　　')));?>
<?php e($form->input('id', array('type' => 'hidden', 'value' => $u['User']['id'])));?>
<br/>

<?php e($form->submit('アップデート')); ?>
<?php e($form->end()); ?>

<?php // var_dump($u);?>

<!--  
<table border=2 width=500 align=center>
<caption><font color="red"><?php echo $u['User']['nickname']; ?></font>さんのプロフィール</caption>
<tr>
<td bgcolor="#FFF0F5">ユーザネーム</td>
<td><?php echo $u['User']['nickname']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5">ロケーション</td>
<td><?php echo $u['User']['location']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5">アナタについて</td>
<td><?php echo $u['User']['profile']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5">プロフィールURL</td>
<td><a href="<?php echo $u['User']['blogurl']; ?>"><?php echo $u['User']['blogurl']; ?></a></td>
</tr>
</table>
-->