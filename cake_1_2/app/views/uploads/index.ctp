<?php echo $form->create('Upload',array('enctype' => 'multipart/form-data','action'=>'index')); ?>

<input type="file" name="userfile[]"/>
<br/>
extra info
<?php echo $form->input('data.extra_field'); ?>
<br/>

<?php
if (isset($uploadData)) {
    var_dump($uploadData);
}

if (isset($errorMessage)) {
    var_dump($errorMessage);
}
?>

<?php echo $form->end('upload'); ?>
