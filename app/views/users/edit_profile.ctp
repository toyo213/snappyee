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

<tr>
<td bgcolor="#FFF0F5"><b><?php echo __('Favorite Magazines');?></b></td>
<td>
<?php 
Configure::load('magazines');
$mag = Configure::read('magazines.regist');
$m = json_decode($u['User']['magazines']);

e($form->input('magazines', array('type' => 'select', 'multiple' => 'checkbox', 'label' =>'',
                        'options' =>$mag, 'value'=>$m)));
?>
</td>
</tr>

<tr>
<td bgcolor="#FFF0F5"><b><?php echo __('Occupations');?></b></td>
<td>
<?php 
Configure::load('occupations');
$occupations = Configure::read('occupations.regist');

e($form->input('occupations', array('type' => 'select', 'label' =>'',
                        'options' =>$occupations, 'value'=>$u['User']['occupations'])));
?>
</td>
</tr>



</table>
</div>
<br/>
<p align="center"><input type="submit" value="<?php echo __('Update'); ?>" /></p>
<?php e($form->end()); ?>

