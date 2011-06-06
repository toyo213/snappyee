<?php
class ScmController extends AppController {
var $name = 'scm';
public $autoRender = false;
public $uses = array("scm");
var $layout = "scm";
    function index()
    {
      $this->render('view'); 
      $this->search('search');
      // viewからデータを取り出す
      Scm::vd();
    }
 

   function view($id) {
       //アクションのロジックがここに来ます。
      var_dump('view');
   }
    function share($customer_id, $recipe_id) {
        //アクションのロジックがここに来ます。
    }
    function search($query) {
        //アクションのロジックがここに来ます。
        var_dump('search'); 
   }
}
?>
