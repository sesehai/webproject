<?php
class Cola_Helper_Credit
{
    public static function output($code=200,$data=array(),$callback=''){
        if(empty($callback) || !preg_match('/^\w+$/',$callback)){
            exit(json_encode(array('code'=>$code,'data'=>$data)));
        }else{
            exit($callback.'('.json_encode(array('code'=>$code,'data'=>$data)).')');
        }
    }
    
    /**
     * curl模拟请求(带cookie的提交)
     * @param string $url
     * @param string $type get|post
     * @param array $param
     * @param string $param_type  ?|/ 
     * @param int timeout
     * @return string
     */
    public static function curl($url, $type = 'get', $param = array(), $param_type='?', $timeout = 5) {
        $str = '';
        $curl = curl_init ();
        if ('post' == $type) {
            curl_setopt ( $curl, CURLOPT_POST, $type );
            curl_setopt ( $curl, CURLOPT_POSTFIELDS, $param );
        } 
        curl_setopt ( $curl, CURLOPT_URL, $url );
        curl_setopt ( $curl, CURLOPT_TIMEOUT, $timeout ); #默认5s超时时间
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); //返回输出文本流
        $str = curl_exec ( $curl );
        curl_close ( $curl );
        return $str;
    }

     /**
     * 下发消息
     * @param  $uid      用户uid
     * @param  $contents 消息内容
     */
    public static function SendMessage($uid,$contents){
        if(empty($uid)||empty($contents)){
            return false;
        }
        $message = Cola_Com_Http::post('http://api.my.letv.com/message/add',array('content'=>$contents,'from'=>0,'type'=>1,'uid'=>$uid));
        $message = json_decode($message,true);
        if(200 == $message['code']){
            return true;
        }else{
            return false;
        }
    }

    /**
    * 函数SYSLogNG,实现记录日志功能
    * $message 消息内容
    * $msgaction 消息动作
    */
    public static function SYSLogNG($message,$msgaction)
    {
        if(empty($message) || empty($msgaction)){
            return false;
        }
        $syslogng = new Cola_Com_Syslogng();
        $syslogng->property['message']  = $message;
        return $syslogng->log('credit', $msgaction); 
    }
}