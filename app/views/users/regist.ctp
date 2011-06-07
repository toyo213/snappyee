ユーザ登録<br>
<?php foreach ($fbuser as $key => $val):?>
<?php echo $key.' : '.$val; ?><br>
<?php endforeach;?>
<?php
echo $form->create('User',array('type' => 'post','url' =>   '/users/regist_end'));
//echo $form->input('comment');
//echo $form->input('ido');
//echo $form->input('kdo');
echo $form->input('nickname');
//echo $form->hidden('id', array('value'=>$list[0]['People']['id']));
echo $form->end('ユーザ登録');
?>