<?php
$aiueo = array(
 'あ'=>'あ'
,'い'=>'い'
,'う'=>'う'
,'え'=>'え'
,'お'=>'お'
,'か'=>'か'
,'き'=>'き'
,'く'=>'く'
,'け'=>'け'
,'こ'=>'こ'
,'さ'=>'さ'
,'し'=>'し'
,'す'=>'す'
,'せ'=>'せ'
,'そ'=>'そ'
,'た'=>'た'
,'ち'=>'ち'
,'つ'=>'つ'
,'て'=>'て'
,'と'=>'と'
,'な'=>'な'
,'に'=>'に'
,'に'=>'に'
,'ね'=>'ね'
,'の'=>'の'
,'は'=>'は'
,'ひ'=>'ひ'
,'ふ'=>'ふ'
,'へ'=>'へ'
,'ほ'=>'ほ'
,'ま'=>'ま'
,'み'=>'み'
,'む'=>'む'
,'め'=>'め'
,'も'=>'も'
,'や'=>'や'
,'ゆ'=>'ゆ'
,'よ'=>'よ'
,'ら'=>'ら'
,'り'=>'り'
,'る'=>'る'
,'れ'=>'れ'
,'ろ'=>'ろ'
,'わ'=>'わ'
,'を'=>'を'
,'ん'=>'ん'
);
echo $form->create('null',array('type' => 'get','url' => '/users/people')); 
echo $form->input('fn', array('options' => $aiueo,'selected' => $fn));
echo $form->end('芸能人を検索する');
foreach ($list as $key => $val ) {
   print $html->link($val['People']['name'], array('controller'=>'users', 'action'=>'people_add','name' => $val['People']['name'])).'<br>';
}

?>
http://category.goo.ne.jp/entertainment/00448/
http://dir.yahoo.co.jp/Entertainment/TV_People/
