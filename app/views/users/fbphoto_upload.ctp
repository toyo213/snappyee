<?php
//var_dump($prm);
if (isset($prm['aid'])) {
    echo __('test');
	echo '<h1>Please choice your best picture</h1>';
    echo '<ul id="banner">';
    foreach ($albums as $key => $val) {
        $pt = '<li><a href="/users/fbpict_up?pid=%s&aid=%s"><img src="%s" width="110px" /></a></li>';
        echo sprintf($pt, $val['pid'],$prm['aid'],$val['src'])."\n";
        }
    echo '</ul>';
    
} else {
    echo '<h1>Please find your best album</h1>';
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
