<?php
if (isset($prm['aid'])) {
    echo __('<h1><font color =red><b>Select Photos to Upload</b></font></h1>');
    echo '<ul id="banner">';
    foreach ($albums as $key => $val) {
        echo '<li><div class="photo photoFloat">';
        $pt = '<a href="/users/fbpict_up?pid=%s&aid=%s"><img src="%s" height="100px" /></a></div></li>';
        echo sprintf($pt, $val['pid'], $prm['aid'], $val['src']) . "\n";
    }
    echo '</ul>';
} else {
    echo __('<h1><font color =red><b>Select Album</b></font></h1><p>Please make sure your photo album privacy setting is set to either <b>Everyone</b> or <b>Friends Only</b></p>');
    echo __('<p>Please Read <a href= ../users/tc>Photo Upload Guidelines</a> before Upload.</p>');
    echo '<ul id="banner">';
    foreach ($albums as $key => $val) {
        echo '<li><div class="photo photoRankingAlbum radiux3px photoFloat">';
        $pt = '<a href="/users/fbphoto_upload?aid=%s"><img src="%s" width="110px"/></a>'."\n";
        echo sprintf($pt, $val['aid'], $val['src']);
        echo '</div></li>';
        }
    echo '</ul>';
}
foreach ($friends['data'] as $key => $val) {
             $pt ='<img src="https://graph.facebook.com/%s/picture" alt="profile" />';
             //echo sprintf($pt,$val['id']);
        }
?>
