<?php
//var_dump($prm);
if (isset($prm['aid'])) {
    echo __('<h1>Select Photos to Upload</h1>');
    echo '<ul id="banner">';
    foreach ($albums as $key => $val) {
        $pt = '<li><a href="/users/fbpict_up?pid=%s&aid=%s"><img src="%s" width="110px" /></a></li>';
        echo sprintf($pt, $val['pid'],$prm['aid'],$val['src'])."\n";
        }
    echo '</ul>';
    
} else {
    echo __('<h1>Select Album</h1><p>Please make sure your photo album privacy setting is set to either <b>Everyone</b> or <b>Friends Only</b></p>');
    echo __('<p>Please Read <a href= ../users/T&C_EN>Photo Upload Guidelines</a> before Upload.</p>');
    foreach ($albums as $key => $val) {    
    $pt = '<a href="/users/fbphoto_upload?aid=%s"><img src="%s" /></a>';
    echo sprintf($pt, $val['aid'], $val['src']);
    }
}
foreach ($friends['data'] as $key => $val) {
             $pt ='<img src="https://graph.facebook.com/%s/picture" alt="profile" />';
             //echo sprintf($pt,$val['id']);
        }
?>
