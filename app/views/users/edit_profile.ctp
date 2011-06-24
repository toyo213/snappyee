
<?php e($form->create('User', array('action'=>'edit_profile'))); ?>

<p><?php echo __('User Name');?></p>
<?php e($form->input('nickname', array('type' => 'text', 'value' => $u['User']['nickname'] ,'div'=>false,'required'=>true,'label' =>'','size'=>30)));?>

<p><?php echo __('Location');?></p>
<?php e($form->input('location', array('type' => 'text', 'value' => $u['User']['location'] ,'div'=>false,'label' =>'','size'=>30)));?>
<br/>
<p><?php echo __('Profile');?></p>
<?php e($form->input('profile', array('type' => 'text','style'=>'width:21em;height:10em','maxlength'=>200, 'value' => $u['User']['profile'] ,'div'=>true,'label' =>'','size'=>30)));?>
<br/>
<p><?php echo __('Profile URL');?></p>
<?php e($form->input('blogurl', array('type' => 'text', 'value' => $u['User']['blogurl'] ,'div'=>true,'label' =>'','size'=>30)));?>
<?php e($form->input('id', array('type' => 'hidden', 'value' => $u['User']['id'])));?>
<br/>

<?php e($form->submit('Update')); ?>
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