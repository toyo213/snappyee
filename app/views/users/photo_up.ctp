
<img src="<?php echo $img_path; ?>" width="600" height="600"></img>

<?php
echo $form->create('users', array('type' => 'post', 'action' => 'photo_update'));
echo '<br>';
echo '<br>';
$category_id = array(100=>'ネイル', 200=>'メイク', 300=>'ヘアスタイル',400=>'ファッション',500=>'アクセ',600=>'バック',700=>'サンダル&パンプス');
echo $form->input(
	'category_id',
	array('type' => 'select', 'options' => $category),
	array(''=>'--')
);?>
<br/>

<input type="submit" value="<?php echo __('Upload'); ?>" />
<?php 
//echo $form->submit('登録する', array('div' => 'false')); 
echo $form->hidden('Photo.id' ,array('value' =>$l_id ));
echo $form->end();
 ?>

 <?php //var_dump($category);?>