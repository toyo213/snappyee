「<?php print $list[0]['People']['name'];?>」さんを発見(スタ見た)した！<br>
どこで？<br>
緯度・経度<br>

<?php
echo $form->create('PeopleFind',array('type' => 'post','url' =>   '/users/people_confirm'));
echo $form->input('comment');
echo $form->input('ido');
echo $form->input('kdo');
echo $form->input('spot_name');
echo $form->hidden('id', array('value'=>$list[0]['People']['id']));
echo $form->end('登録');