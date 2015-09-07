<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT_PATH", dirname(dirname((dirname(__FILE__)))));

require_once ROOT_PATH.'/base.php';
spl_autoload_register(array('Base','auto_load'));

// $options = array (
//     'host'  => '',
//     'port'  => '',
// );

$options = array (
    'host' => '',
    'port' => '',
    'auth' => '',
);
$redis = new Redis_Base($options);
$keys = $redis->keys('*TASK_*');
// print_r($keys);
foreach ($keys as $key => $value) {
    $val = $redis->get($value);
    echo $val . PHP_EOL;
}

//echo phpversion();
