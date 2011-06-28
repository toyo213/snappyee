<div class = "table">
<table align="center">
<?php e($form->create('User', array('action'=>'edit_profile'))); ?>
<tr>
<td bgcolor="#FFF0F5"><b><?php echo __('User Name');?></b></td>
<td>
<?php e($form->input('nickname', array('type' => 'text', 'value' => $u['User']['nickname'] ,'div'=>false,'required'=>true,'label' =>'','size'=>30)));?>
</td>
</tr>
<tr>
<td bgcolor="#FFF0F5"><b><?php echo __('Location');?></b></td>
<td>
<?php e($form->input('location', array('type' => 'text', 'value' => $u['User']['location'] ,'div'=>false,'label' =>'','size'=>30)));?>
</td>
</tr>

<tr>
<td bgcolor="#FFF0F5"><b><?php echo __('Profile');?></b></td>
<td>
<?php e($form->input('profile', array('type' => 'textarea','style'=>'width:21em;height:10em','maxlength'=>200, 'value' => $u['User']['profile'] ,'div'=>true,'label' =>'','size'=>30)));?>
</td>
</tr>

<tr>
<td bgcolor="#FFF0F5"><b><?php echo __('Profile URL');?></b></td>
<td>
<?php e($form->input('blogurl', array('type' => 'text', 'value' => $u['User']['blogurl'] ,'div'=>true,'label' =>'','size'=>30)));?>
<?php e($form->input('id', array('type' => 'hidden', 'value' => $u['User']['id'])));?>
</td>
</tr>


</table>
</div>
<br/>
<p align="center"><input type="submit" value="<?php echo __('Update'); ?>" /></p>
<?php e($form->end()); ?>


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