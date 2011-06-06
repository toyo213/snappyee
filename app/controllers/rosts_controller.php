<?php
class RostsController extends AppController {
    var $name = 'Rosts';

    function index() {
    	$this->set('rosts', $this->Rost->find('all'));
    }
}
?>
