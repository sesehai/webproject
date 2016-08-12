<?php
class HomeController extends BaseController {
    public function __construct() {
        parent::__construct();
        
    }
    
    public function indexAction() {
        $result = "Hello,this is my home! wellcome!";
        $this->output($result);
    }
    
}
