<?php
class Cola_Helper_Favorite
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
     * syslogng记录日志
     * @param  string $message   消息体
     * @param  string $msgaction 消息动作名称
     * @param  int    $addtime   添加时间
     * @param  string $operator  操作
     * @param  string $source    消息来源
     * @return boole            
     */
    public static function syslogng($message,$msgaction,$addtime,$operator='ugc',$source='video'){
      if(empty($message) || empty($msgaction) || empty($addtime)){
          return false;
      }
      $syslogng = new Cola_Com_Syslogng();
      $syslogng->property['datetime'] = date("Y-m-d H:i:s",$addtime);
      $syslogng->property['clientip'] = Cola_Request::clientIp();
      $syslogng->property['operator'] = $operator;
      $syslogng->property['source']   = $source;
      $syslogng->property['message']  = $message;
      return $syslogng->log('favorite', $msgaction);
    }
   
    /**
     * 下发收藏消息
     * @param  int    $uid     用户ID
     * @param  string $message 消息内容
     * @return boole
     */
    public static function sendUserMessages($uid,$contents){
        if(empty($uid)||empty($contents)){
            return false;
        }
        $message = self::curl('http://api.my.letv.com/message/add','post',array('content'=>$contents,'from'=>10,'type'=>1,'uid'=>$uid));
        $message = json_decode($message,true);
        if(200 == $message['code']){
            return true;
        }else{
            return false;
        }
    }
}