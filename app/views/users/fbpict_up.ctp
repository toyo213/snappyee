
<?php echo __('Upload FB photo to Gee Gee'); ?>
<?php echo __('Upload this photo to Gee Gee?');?>

<?php
echo $form->create('users', array('type' => 'post', 'action' => 'fbpict_add'));
foreach ($albums as $key => $val) {
    $pt = '<a href="/users/fbpict_add?pid=%s"><img src="%s"  width="260px" /></a>';
    echo sprintf($pt, $val['pid'], $val['src_big']);
}
echo '<br>';
echo '<br>';
$category_id = array(100=>'ネイル', 200=>'メイク', 300=>'ヘアスタイル',400=>'ファッション',500=>'アクセ',600=>'バック',700=>'サンダル&パンプス');
echo $form->input(
	'category_id',
	array('type' => 'select', 'options' => $category_id),
	array(''=>'--')
);
echo $form->submit('登録する', array('div' => 'false')); 
echo $form->hidden('Photo.fb_path' ,array('value' =>$val['src_big'] ));
echo $form->end();
 ?>
