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
    // <05dce08a fffaf626 19781929 be65ca74 f871364c 13086a30 627572a5 8d5665ac>
    // <678be32a bdf28146 158c4edc d2268963 5126cc8c 9459f27f d65b062f 8d81b4a3>
    $deviceToken = "678be32abdf28146158c4edcd22689635126cc8c9459f27fd65b062f8d81b4a3";
    $alert = "测试123";
    $body = array("aps" => array("alert" => "{$alert}", "badge" => 1, "sound" => 'received5.caf'));
    $ctx = stream_context_create();
    // stream_context_set_option($ctx, "ssl", "local_cert", ROOT_PATH."/apps/data/ck.pem");
    stream_context_set_option($ctx, "ssl", "local_cert", ROOT_PATH."/apps/data/apns-dev.pem");

    // 测试地址
    $fp = stream_socket_client("ssl://gateway.sandbox.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
    // 正式地址
    //$fp = stream_socket_client("ssl://gateway.push.apple.com:2195", $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
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
