<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT_PATH", dirname(dirname((dirname(__FILE__)))));

require_once ROOT_PATH.'/base.php';
spl_autoload_register(array('Base','auto_load'));

/**
 * area process
 */
class NginxSatus
{
    const API_YONGGONGBAO_CN_LOG = '/usr/local/nginx/logs/api.yonggongbao.cn.log';

    function __construct($config)
    {
    }

    public function checkLog()
    {
        
    }
}

