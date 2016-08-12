<?php

class BaseController extends Cola_Controller {
	protected $language_bag;
    public function __construct() {
        parent::__construct();
        $this->empty_obj = (object)array();
        //语言lang
        //chs-简体中文 cht-繁体中文 en-英文 
        $this->_lang = $this->getVar('lang', 'chs');
        cola::reg('_lang', $this->_lang);
		//包含语言包，设置语言变量
        $this->_language_bag = cola::config('_language_bag');
    }
    
    public function output($data, $status = STATUS_OK, $msg = array()) {
        header('Content-Type:application/json; charset=utf-8');
        $output = array();
        $output['header']['status'] = (string)$status;
        if (empty($data)) {
            $output['body'] = $this->empty_obj;
        } else {
            $output['body'] = $data;
        }
        if (!empty($msg)) {
            $output['header']['error'] = $msg;
        }
        debugSet('[ALL] cost:' . flagtime());
        if (DEBUG) {
            $output['_debug_data'] = debugGet();
        }
        echo json_encode($output);
        exit;
    }
    
}
