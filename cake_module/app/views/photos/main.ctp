<h1>New Photo!!</h1>
<?php
foreach ($list as $key => $val) {
   print sprintf('<img src="%s"></img>',$val['Photo']['fbpath']);
}
?>