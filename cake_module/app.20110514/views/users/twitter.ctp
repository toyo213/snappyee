<?php
foreach ($list as $key => $val) {
    print sprintf('%sに「%s」を「%s」さんが「%s」でスタ見た☆　コメント:%s 緯度:%s 経度%s<br>'
                  ,$val['PeopleFind']['ts']
                  ,$val['people']['name']
                  ,'名無し'
                  ,$val['PeopleFind']['spot_name']
                  ,$val['PeopleFind']['comment']
                  ,$val['PeopleFind']['ido']
                  ,$val['PeopleFind']['kdo']
   );
}