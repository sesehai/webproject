<?php
error_reporting(E_ALL);
ini_set('display_errors', 'off');
//初始化MC配置
date_default_timezone_set('Asia/Shanghai');

!empty($version) ? $root = $version . '/' : $root = '';
define('ROOT_PATH', preg_replace("/\/+/is", '/', dirname(__FILE__)) . '/' . $root);
define('APP_DIR', dirname(__FILE__));
define('LIBRARY_PATH', APP_DIR . '/Cola/'); //类库目录

require dirname(__FILE__) . '/Cola/Cola.php';

$cola = Cola::getInstance();
require ROOT_PATH . '/base/BaseController.php';
require ROOT_PATH . '/base/BaseModel.php';
require ROOT_PATH . '/base/Util.php';
//开始计时
flagtime();
$document_root = $_SERVER['DOCUMENT_URI'];
$cola->setPathInfo($document_root);
try {
    $cola->boot(ROOT_PATH . 'config.inc.php')->dispatch();
}
catch(Exception $e) {
    echo $e->getMessage();
    //echo 'Wellcome!';
}