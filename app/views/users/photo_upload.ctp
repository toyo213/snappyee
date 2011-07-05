
<?php echo __('<p>Please Read <a href= ../users/tc>Photo Upload Guidelines</a> before Upload.</p>');?>
<form name="form" action="/users/photo_up" method="POST" ENCTYPE="MULTIPART/FORM-DATA" >
<input name="img_path" type="file" size="40">
<input name="up" type="submit" value="<?php echo __('upload');?>"><hr>
</form>