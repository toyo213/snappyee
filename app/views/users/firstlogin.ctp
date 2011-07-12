
<br/>
<br/>
<?php echo __('<b>Please Use Facebook account to login <img src=/img/geegee_title.png width=90 height=30></img></b>');?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if (empty($user)) {
    echo $facebook->login(array('perms' => 'offline_access,email,user_photos,friends_photos,read_stream,publish_stream'));
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<br/>
<br/>
<br/>
