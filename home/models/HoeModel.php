<?php
class HomeModel extends BaseModel {
    private $name;
    
    public function __construct($param) {
        parent::__construct();
    }
    
    public function getName() {
        return $this->model;
    }

    public function  setName($name) {
        $this->name = $name;
    }
}