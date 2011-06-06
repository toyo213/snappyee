<?php
//var_dump($prm);
if (isset($prm['aid'])) {
    echo '<h1>Please choice your best picture</h1>';
    foreach ($albums as $key => $val) {
        $pt = '<a href="/users/fbpict_up?pid=%s&aid=%s"><img src="%s" /></a>';
        echo sprintf($pt, $val['pid'],$prm['aid'],$val['src_big']);
    }
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
