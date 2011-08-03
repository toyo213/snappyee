
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

echo "<dt class=txtbold>";
echo __('User Name');
echo "</dt>";

echo $form->input('nickname' ,array('type'=>'text','label'=>'','value'=>$fbuser["name"], 'vertical-align'=>'middle','text-align'=>'right'));
echo "<br/>";
echo "<dt class=txtbold>";
echo __('Profile URL');
echo "</dt>";
echo $form->input('blogurl', array('type'=>'text','label'=>'','value'=>$fbuser["link"]));
//echo $form->hidden('id', array('value'=>$list[0]['People']['id']));
echo "</dl>";
echo "<br/><dd>";?>

<dt class="textbold">
<?php echo __('Fashion Magazines you often read'); ?>
</dt>
<?php //echo $form->input('magazines',array('type'=>'checkbox'));?>

<?php //$magazines = array('CanCan'=>'CanCan','JJ'=>'JJ'); ?>
<?php //var_dump($magazines);?>
<?php
$t = array(1,2,4,5); 
echo $form->input("magazines", 
                  array('type' => 'select', 'multiple' => 'checkbox', 
                        'options' =>$t));
?>


<?php //var_dump($magazines);?>



<?php //echo $form->checkbox('magazines',array('multiples'=>array(1,2,3)));?>


<input type="checkbox" name="magazines" value="ELLE"> Elle
<input type="checkbox" name="magazines" value="MORE"> More
<input type="checkbox" name="magazines" value="CanCan"> CanCan
<input type="checkbox" name="magazines" value="JJ"> JJ
<input type="checkbox" name="magazines" value="NYLON"> NYLON
<input type="checkbox" name="magazines" value="GQ"> GQ
<input type="checkbox" name="magazines" value="SAFARI"> SAFARI
<input type="checkbox" name="magazines" value="OCEANS"> OCEANS
<input type="checkbox" name="magazines" value="SEDA"> SEDA
<input type="checkbox" name="magazines" value="VERY"> VERY
<input type="checkbox" name="magazines" value="InRed"> InRed
<input type="checkbox" name="magazines" value="Egg"> Egg
<input type="checkbox" name="magazines" value="Seventeen"> Seventeen
<input type="checkbox" name="magazines" value="PopTeen"> PopTeen
<input type="checkbox" name="magazines" value="AneCan"> AneCan
<input type="checkbox" name="magazines" value="LEON"> LEON
<input type="checkbox" name="magazines" value="Precious"> Precious
<input type="checkbox" name="magazines" value="Glitter"> Glitter
<input type="checkbox" name="magazines" value="Domani"> Domani
<input type="checkbox" name="magazines" value="Cawaii"> Cawaii
<input type="checkbox" name="magazines" value="CUTiE"> CUTiE
<input type="checkbox" name="magazines" value="JILLE"> JILLE
<input type="checkbox" name="magazines" value="PS"> PS
<input type="checkbox" name="magazines" value="ViVi"> ViVi

<br/>
<br/>

<dt class="textbold">
<?php echo __('Occupations'); ?>
</dt>

<?php
$ocu = array('Clothes Store Staff','Fashion Model','Photographer','Nail Artist','Cosmetician', 'Hairdresser','Magazine Editor','Designer','Dr','IT','Finance','Strategy Consulting','Scientist','Unemployed','Other');

echo $form->input("occupations",
                  array('type' => 'select', 'options' =>$ocu,'label'=>''));
      
?>

<?php //echo $form->input('occupations',array('type'=>'text','label'=>''));?>




<dt class="textbold">
<?php echo __('Interests'); ?>
</dt>
<?php echo $form->input('interests',array('type'=>'text','label'=>''));?>

<dt class="textbold">
Locations
</dt>
<?php echo $form->input('location',array('type'=>'text','label'=>'','value'=>$fbuser["location"]["name"]));?>

<input type="submit" value="<?php echo __('Create Account'); ?>" />

<?php 
echo $form->end();
echo "</dd>";
?>
				