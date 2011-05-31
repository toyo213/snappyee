<?php
foreach ($albums['data'] as $key => $val) {
             $pt ='<img src="https://graph.facebook.com/%s/picture?access_token=%s" />';
             echo sprintf($pt,$val['id'],$ac);
        }

foreach ($friends['data'] as $key => $val) {
             $pt ='<img src="https://graph.facebook.com/%s/picture" alt="profile" />';
             echo sprintf($pt,$val['id']);
        }
?>
