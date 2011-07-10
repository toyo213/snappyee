<div class="rightMarginS leftcol"> 
<?php
echo $form->create('users', array('type' => 'post', 'action' => 'fbpict_add','label'=>false));
foreach ($albums as $key => $val) {
    $pt = '<a href="/users/fbpict_add?pid=%s"><img src="%s"  width="260px" /></a>';
    echo sprintf($pt, $val['pid'], $val['src_big']);
}
echo '</span><br>';
echo '<br>';
?>
</div>
<div class="rightMarginS leftcol"> 
Category<div style="float: left;font-family:Shruti;font-size:15px;color:#e73659;">*</div><br>
<?php   
echo $form->input(
	'category_id',
	array('type' => 'select', 'options' => $category,'label'=>false),
	array(''=>'--')
);
?>
<br><br>
Comment<div style="float: left;font-family:Shruti;font-size:15px;color:#e73659;">*</div><br>
<?php echo $form->input('Photo.comment', array('cols' => 20, 'rows' => 10,'label'=>false));?>
<input type="submit" value="<?php echo __('Upload'); ?>" />
<?php 
echo $form->hidden('Photo.fb_path' ,array('value' =>$val['src_big'] ));
echo $form->end();
 ?>
</div>
