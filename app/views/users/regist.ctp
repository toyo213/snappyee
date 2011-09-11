
<img src="/img/geegee_title_pink.png" width="200" height="66"></img>

<?php //var_dump($this->params);?>

<?php foreach ($fbuser as $key => $val):?>
<?php // echo $key.' : '.$val; ?>
<?php endforeach;?>


<?php
echo $form->create('User',array('type' => 'post','url' =>   '/users/regist_end'));
//echo $form->input('comment');
//echo $form->input('ido');
//echo $form->input('kdo');
//echo "<fieldset>";
echo "<dl>";
echo  "<legend>";
echo "<font color=red>"; 
echo __('Gee Gee Create Account');
echo "</font>";
echo "</legend>";
echo "<br/>";

echo "<b>";
echo __('User Name');
echo "</b>";

echo $form->input('nickname' ,array('type'=>'text','label'=>'','value'=>$fbuser["name"], 'vertical-align'=>'middle','text-align'=>'right'));
echo "<br/>";
echo "<dt class=txtbold>";
echo __('Profile URL');
echo "</dt>";
echo $form->input('blogurl', array('type'=>'text','label'=>'','value'=>$fbuser["link"]));
//echo $form->hidden('id', array('value'=>$list[0]['People']['id']));
echo "</dl>";
echo "<br/><dd>";?>

<b>
<?php echo __('Fashion Magazines you often read'); ?>
</b>


<?php

Configure::load('magazines');
$mag = Configure::read('magazines');
 
echo $form->input("magazines", 
                  array('type' => 'select', 'multiple' => 'checkbox', 
                        'options' =>$mag));
?>

<b><?php echo __('Occupations'); ?></b>


<?php

Configure::load('ocupations');
$ocupations = Configure::read('ocupations');

echo $form->input("occupations",
                  array('type' => 'select', 'options' =>$ocupations,'label'=>''));
      
?>

<b>Locations</b>

<?php echo $form->input('location',array('type'=>'text','label'=>'','value'=>$fbuser["location"]["name"]));?>

<input type="submit" value="<?php echo __('Create Account'); ?>" />

<?php 
echo $form->end();
echo "</dd>";
?>
				