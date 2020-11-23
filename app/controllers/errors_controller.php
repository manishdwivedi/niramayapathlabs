<?php 
class ErrorsController extends AppController {
    public $name = 'Errors';

    public function beforeFilter() {
        echo "aaaa";
		parent::beforeFilter();
		
        $this->Auth->allow('error404');
    }

    public function error404() {
		echo "bbbb";
        $this->layout = false;
    }
}
?>