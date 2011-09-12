
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
echo "<b>";
echo "<dt class=txtbold>";
echo __('Profile URL');
echo "</dt>";
echo "</b>";
echo $form->input('blogurl', array('type'=>'text','label'=>'','value'=>$fbuser["link"]));
//echo $form->hidden('id', array('value'=>$list[0]['People']['id']));
echo "</dl>";
echo "<dd>";
?>

<dt>
<b>
<?php echo __('Location');?>
</b>
<?php echo $form->input('location',array('type'=>'text','label'=>'','value'=>$fbuser["location"]["name"]));?>
</dt>
<br>

<dt>
<b>
<?php echo __('Fashion Magazines you often read'); ?>
</b>
</dt>

<?php

Configure::load('magazines');
$mag = Configure::read('magazines.regist');
 
echo $form->input("magazines", 
                  array('type' => 'select', 'multiple' => 'checkbox', 'label' =>'',
                        'options' =>$mag));
?>

<br>
<b><?php echo __('Industry'); ?></b>


<?php

Configure::load('occupations');
		preg_match(('/.*(ja|jp).*/'),$_SERVER['HTTP_ACCEPT_LANGUAGE'],$match);
		if(count($match) > 0 ) {
			$this->isJpn = true;
			$occupations = Configure::read('occupations.jpn');
		} else {
			$occupations = Configure::read('occupations.en');
		}

echo $form->input("occupations",
                  array('type' => 'select', 'options' =>$occupations,'label'=>''));
      
?>
<br>
<b><?php echo __('About Myself'); ?></b>

<?php 
echo $form->input("profile",
                  array('type' => 'input', 'label'=>''));
?>


<input type="submit" value="<?php echo __('Create Account'); ?>" />

<?php 
echo $form->end();
echo "</dd>";
?>
				