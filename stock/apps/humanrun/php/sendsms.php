#!/usr/bin/env php
<?php
/**
 *
 * 业务功能类
 *
 */

class SendMail {
    /**
     * 构造函数
     * @param array $config
     */
    public function __construct(){
    }

    public function  sendMessageNow($Content,$DesMobile,$method='post'){
        $OperID = "";
        //操作密码：与帐号名称对应的密码
        $OperPass = "";
        //发送时间：YYYYMMDDHHMMSS格式,为空表示立即发送
        $SendTime = "";
        //消息有效期：YYYYMMDDHHMMSS格式,规定时间内发送失败则重发,过时作废
        $ValidTime = "20141231235959";
        //附加号码
        $AppendID = "";
        //消息类型：取值有15和8。15以普通短信形式下发,8以长短信形式下发
        $Content_Type = "8";
        $Content = mb_convert_encoding($Content.' 【xxx】','gbk','utf-8');
        if(strtolower($method)=='post'){
            $this->postSendMsg($OperID,$OperPass,$SendTime,$ValidTime,$AppendID,$Content_Type,$Content,$DesMobile);
        }else{
            $this->getSendMsg($OperID,$OperPass,$SendTime,$ValidTime,$AppendID,$Content_Type,$Content,$DesMobile);
        }

    }

    private function postSendMsg($OperID, $OperPass, $SendTime, $ValidTime, $AppendID, $Content_Type, $Content, $DesMobile) {
        $DesMobileSend = "";
        /*将手机号从数组转变成一个用逗号分开的字符串，字符串末尾有逗号不影响消息下发。*/
        foreach ($DesMobile as $DesMobileTemp) {
            $DesMobileSend = $DesMobileSend . trim($DesMobileTemp) . ",";
        }
        $CommString = "OperID=" . $OperID . "&OperPass=" . $OperPass . "&SendTime=" . $SendTime . "&ValidTime=" . $ValidTime . "&AppendID=" . $AppendID . "&DesMobile=" . trim($DesMobileSend) . "&Content=" . urlencode($Content) . "&ContentType=" . $Content_Type;
        $TestUrl = "http://xxxxx.xxx:xxxx/xxxx/xxxxx";

        $ch = curl_init();
        $this_header = array(
            "charset=UTF-8"
        );
        curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
        curl_setopt($ch, CURLOPT_URL, $TestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $CommString);
        $response = curl_exec($ch);

        $this->processResponse($response,$DesMobile,$Content);
    }

    private function getSendMsg($OperID, $OperPass, $SendTime, $ValidTime, $AppendID, $Content_Type, $Content, $DesMobile) {
        $DesMobileSend = "";
        foreach ($DesMobile as $DesMobileTemp) {
            $DesMobileSend = $DesMobileSend . trim($DesMobileTemp) . ",";
        }
        $CommString = "OperID=" . $OperID . "&OperPass=" . $OperPass . "&SendTime=" . $SendTime . "&ValidTime=" . $ValidTime . "&AppendID=" . $AppendID . "&Content=" . urlencode($Content) . "&DesMobile=" . trim($DesMobileSend) . "&ContentType=" . $Content_Type;
        $TestUrl = "http://xxxxxxxx:xxxx/xxxx/xxxx";

        $ch = curl_init($TestUrl . "?" . $CommString) ;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
        $output = curl_exec($ch) ;
        $this->processResponse($output,$DesMobile,$Content);
    }

    private function processResponse($xml,$DesMobile,$content){
        $respXML = simplexml_load_string($xml);
        $result['code'] = (string)$respXML->code;
        foreach($respXML->message as $sxe){
            $result[(string)$sxe->desmobile] = (string)$sxe->msgid;
        }

        $datas = array();
        foreach ($DesMobile as $DesMobileTemp) {
            $data = array();
            $data['phone'] = trim($DesMobileTemp);
            $data['content'] = mb_convert_encoding($content,'utf-8','gbk');
            $data['append_id'] = $result[$data['phone']];
            $data['status'] = $result['code'] == "01" || $result['code'] == "03";
            $data['sms_status'] = $result['code'];
            $datas[] = $data;
        }
        print_r($datas);
    }

}

$sendMail = new SendMail();

$log = var_export($argv,true);
file_put_contents("/tmp/sendsms.log",$log.PHP_EOL,FILE_APPEND);
$DesMobile = isset($argv[1]) ? $argv[1] : '13800000000';
$DesMobile = explode(",",$DesMobile);
$Content = isset($argv[2]) ? $argv[2] : "nginx 日志错误报警，请处理";
$Content .= isset($argv[3]) ? $argv[3] : "";
$sendMail->sendMessageNow($Content,$DesMobile,$method='get');