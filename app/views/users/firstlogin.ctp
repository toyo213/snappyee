<h1>Please use facebook acount for login 'gee-gee'</h1><br>
<?php
if (empty($user)) {
    echo $facebook->login(array('perms' => 'offline_access,email,user_photos,friends_photos,read_stream,publish_stream'));
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
