<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT_PATH", dirname(dirname(__FILE__)));

require_once ROOT_PATH.'/base.php';
spl_autoload_register(array('Base', 'auto_load'));

/**
 * 推送消息
 */
function push(){
    $deviceToken = "e0ae5778f1d2ad3b3856d261d39fb9b24f58866c345d5449f814d3c9ee7d1a78";
    $alert = "测试123";
    $body = array("aps" => array("alert" => "{$alert}", "badge" => 1, "sound" => 'received5.caf'));
    $ctx = stream_context_create();
    // stream_context_set_option($ctx, "ssl", "local_cert", ROOT_PATH."/apps/data/letv_iphone_dev_push_test.pem");
    stream_context_set_option($ctx, "ssl", "local_cert", ROOT_PATH."/apps/data/apns-dev.pem");
    
    // 测试地址
    $fp = stream_socket_client("ssl://gateway.sandbox.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
    // 正式地址
    // $fp = stream_socket_client("ssl://gateway.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
    if (!$fp) {
        print "Failed to connect $err $errstrn";
    }else{
        print "Connection OK \n";
        $payload = json_encode($body);
        $msg = chr(0) . pack("n",32) . pack("H*",$deviceToken) . pack("n",strlen($payload)) . $payload;
        print "sending message :" . $payload . "\n";
        $fwrite = fwrite($fp, $msg);
        if($fwrite){
            print_r($fwrite);
            print "sending ok! \n";
        }
        fclose($fp);
    }
}

push();