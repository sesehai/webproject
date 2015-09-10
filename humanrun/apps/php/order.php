<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT_PATH", dirname(dirname((dirname(__FILE__)))));

require_once ROOT_PATH.'/base.php';
spl_autoload_register(array('Base','auto_load'));

/**
 * 通过手机登陆 获取 ticket,并保存到文件
 */
function login($phone){
    $orderAuto = new Order_Auto();
    // 获取登陆验证码
    $sendResult = $orderAuto->send($phone);
    echo $sendResult;
    $sendResultAry = json_decode($sendResult, true);
    $smsmcode = ( isset($sendResultAry['code'])
        && $sendResultAry['code'] == '200'
        && isset($sendResultAry['entity']) )
        ? $sendResultAry['entity'] : '';
    echo $smsmcode;
    print_r($sendResultAry);
    // 登陆
    $loginResult = $orderAuto->login($phone, $smsmcode);
    echo $loginResult;
    $loginResultAry = json_decode($loginResult, true);
    $ticket = ( isset($loginResultAry['code'])
        && $loginResultAry['code'] == '200'
        && isset($loginResultAry['entity']) )
        ? $loginResultAry['entity'] : '';
    // 记录日志
    // 日期 手机 ticket
    $content = date("Y-m-d H:i:s") . ' '. $phone . ' ' . $ticket . PHP_EOL;
    $file = ROOT_PATH . str_replace('/', DIRECTORY_SEPARATOR, '/apps/data/order/login.log');
    file_put_contents($file , $content, FILE_APPEND);
    return $ticket;
}

// TODO
// 第一步，从文件读取手机号，登陆生成ticket保存到文件
// $ticket = login('13651181081');

// 第二步，读取ticket 文件 和 task 文件进行批量接单
$orderAuto = new Order_Auto();
$file = ROOT_PATH . str_replace('/', DIRECTORY_SEPARATOR, '/apps/data/order/login.log');
$contents = file_get_contents($file);
$ticketsLine = explode("\n", $content);
$ticketAry = array();
foreach ($ticketsLine as $key => $value) {
    $tikets = explode(" ", $value);
    // 每个手机号一个最新ticket
    $ticketAry[$tikets[2]] = $tikets[3];
}

// 第三步，接单，到岗、报单
foreach ($ticketAry as $phone => $ticket) {
    $receiveResult = $orderAuto->receive($ticket, $tid);
}
