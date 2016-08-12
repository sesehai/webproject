<?php
class Cola_Helper_Video
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
      return $syslogng->log('video', $msgaction);
    }
    /**
    * 处理视频时长 由秒转换成分钟显示
    * @param  intger $second 秒
    * @return string  
    */
    public static function secondtominutes($second){
	 if($second >= 60){
            $m = intval($second/60);
            $s = $second - $m*60;
            if($m < 10){
                $m = '0'.$m;
            }
            if($s < 10){
                $s = '0'.$s;
            }
            return $m.':'.$s;
        }elseif($second < 60 && $second >= 10){
            return '00:'.$second;
        }elseif($second < 10){
            return '00:0'.$second;
        }
    }
    
    /**
    * 处理时间 友好展示
    * @param  intger $sTime unix时间戳
    * @param  string $type  返回格式
    * @return string
    */
    public static function friendlyDate($sTime,$type = 'normal') {
        if (!$sTime){
            return '';
        }
        //sTime=源时间，cTime=当前时间，dTime=时间差
        $cTime =   time();
        $dTime =   $cTime - $sTime;
        $dDay  =   intval(date("z",$cTime)) - intval(date("z",$sTime));
        $dDay  =   intval($dTime/3600/24);
        $dYear =   intval(date("Y",$cTime)) - intval(date("Y",$sTime));
        //normal：n秒前，n分钟前，n小时前，日期
        if($type=='normal'){
            if( $dTime < 60 ){
                if($dTime < 10){
                    return '刚刚';
                }else{
                    return intval(floor($dTime / 10) * 10)."秒前";
                }
            }elseif( $dTime < 3600 ){
                return intval($dTime/60)."分钟前";
            //今天的数据.年份相同.日期相同.
            }elseif( $dYear==0 && $dDay == 0  ){
            //return intval($dTime/3600)."小时前";
                return '今天'.date('H:i',$sTime);
            }elseif($dYear==0){
                return date("m月d日 H:i",$sTime);
            }else{
                return date("Y-m-d H:i",$sTime);
            }
        }elseif($type=='mohu'){
            if( $dTime < 60 ){
                return $dTime."秒前";
            }elseif( $dTime < 3600 ){
                return intval($dTime/60)."分钟前";
            }elseif( $dTime >= 3600 && $dDay == 0  ){
                return intval($dTime/3600)."小时前";
            }elseif( $dDay > 0 && $dDay<=7 ){
                return intval($dDay)."天前";
            }elseif( $dDay > 7 &&  $dDay <= 30 ){
                return intval($dDay/7) . '周前';
            }elseif( $dDay > 30 && $dDay <= 365){
                return intval($dDay/30) . '个月前';
            }elseif($dDay > 365){
                return intval($dDay/365) . '年前';
            }
        }elseif($type=='full'){
            return date("Y-m-d , H:i:s",$sTime);
        }elseif($type=='ymd'){
            return date("Y-m-d",$sTime);
        }else{
            if( $dTime < 60 ){
                return $dTime."秒前";
            }elseif( $dTime < 3600 ){
                return intval($dTime/60)."分钟前";
            }elseif( $dTime >= 3600 && $dDay == 0  ){
                return intval($dTime/3600)."小时前";
            }elseif($dYear==0){
                return date("Y-m-d H:i:s",$sTime);
            }else{
                return date("Y-m-d H:i:s",$sTime);
            }
        }
    }

    /**
     * 生成唯一id函数（长度是30位）
     * @param int $uid 用户id
     * @param int $time 10位unix时间戳
     * @param string $char 预留项，10:普通目录，20表示文件，11表示home目录，14表示回收站，默认00
     * @return NULL|string
     */
    public static function createuniqid($uid, $char = '11', $time = 0){
        if($uid < 1){
            return null;
        }
        $struid = sprintf("%012s",$uid);
        $strtime = $time == 0 ? date('ymdHis',time()) : date('ymdHis',$time);
        $strrand4 = rand(1000,9999);
        return $strtime . $struid . $char . $strrand4;
    }
    
    /**
     * 返回UGC频道的版权名称
     * @param int $copyright
     * @return string
     */
    public static function getcopyrightname($copyright) {
        $copyright_config = array(
                '20006' =>  '原创',
                '20007' =>  '转载'
        );
        if (isset($copyright_config[$copyright])) {
            return $copyright_config[$copyright];
        }
        return null;
    }

    /**
     * 返回UGC频道的视频分类标题
     * @param int $style
     * @return string
     */
    public static function getstylename($style) {
        $style_config = array(
                '592001' => '音乐',
                '592002' => '娱乐',
                '592003' => '时尚',
                '592004' => '旅游',
                '592005' => '亲子',
                '592006' => '片花',
                '592007' => '综艺',
                '592008' => '电影',
                '592009' => '纪录片',
                '592010' => '财经',
                '592011' => '搞笑',
                '592012' => '汽车',
                '592013' => '体育',
                '592014' => '游戏',
                '592015' => '原创',
                '592016' => '广告',
                '592017' => '生活',
                '592018' => '健康',
                '592019' => '教育',
                '592020' => '科技',
                '592021' => '军事',
                '592022' => '社会热点',
                '592025' => '动漫',
                '592023' => '其他',
                '592024' => '美女',
                '592026' => '宠物'
        );
        if (isset($style_config[$style])) {
            return $style_config[$style];
        }
        return null;
    }

    /**
     * 获取视频信息
     * @param  array $video_ids 视频ID
     * @return array
     */
    public static function getvideoinfo(array $video_ids){
        if(empty($video_ids)){
            return false;
        }
        $request_url    = 'http://i.api.letv.com/mms/inner/video/get?id='.implode(',', $video_ids).'&type=2&vmode=0&token='.md5(implode(',', $video_ids).'usercenterzxcvbnm').'&platform=usercenter';
        $request_result = self::curl($request_url);
        $request_result = json_decode($request_result,true);
        $request_data   = $result_data = array();
        1 == count($video_ids) ? $request_data = array($request_result['data']) : $request_data = $request_result['data'];
        foreach ($request_data as $key => $value) {
            $result_data[$value['id']] = $value;
        }
        foreach ($video_ids as $key => $value) {
            if(!isset($result_data[$value])){
                $result_data[$value] = array();
            }
        }
        return $result_data;
    }

    public static function blacklist($user_id,$user_ip){
        if(empty($user_id)){
            return false;
        }
        $array_user_id = array(35078135=>1,88588245=>1,75359169=>1,75359215=>1,75359335=>1,75359476=>1,75359544=>1,75359646=>1,75359888=>1,75360058=>1,75360478=>1,75360547=>1,75360611=>1,75360680=>1,75360723=>1,72875133=>1,75244209=>1,75244221=>1,75244628=>1,75245120=>1,75245197=>1,75245592=>1,72879491=>1,72879492=>1,75245988=>1,75246284=>1,75246087=>1,75246547=>1,72875465=>1,88527164=>1,75246770=>1,75247156=>1,75247653=>1,75247814=>1,75248381=>1,75248512=>1,75248857=>1,75249399=>1,88654201=>1,72875057=>1,75249623=>1,75249762=>1,75249875=>1,75250037=>1,75250156=>1,75250225=>1,75250299=>1,75250398=>1,75250519=>1,75250734=>1,75251643=>1,75252013=>1,75252072=>1,75252445=>1,75253173=>1,75253401=>1,72879481=>1,75253517=>1,72874950=>1,75254002=>1,75254324=>1,72879490=>1,75254642=>1,72879488=>1,75254945=>1,75255147=>1,72879487=>1,75364099=>1,75255282=>1,75364106=>1,72879486=>1,75255983=>1,75364223=>1,72879485=>1,75364325=>1,75256437=>1,75256511=>1,75364436=>1,75256956=>1,75364703=>1,75257222=>1,75364934=>1,75257629=>1,75365151=>1,75257898=>1,75258044=>1,75365344=>1,75258168=>1,75365646=>1,75258569=>1,75365680=>1,75365875=>1,88687060=>1,75258880=>1,75259060=>1,75366044=>1,75259176=>1,75259344=>1,75366186=>1,75259450=>1,75259592=>1,75366294=>1,75259751=>1,75366409=>1,75366863=>1,75259907=>1,75367123=>1,75259973=>1,75260181=>1,75260543=>1,75260842=>1,75367638=>1,75261179=>1,75367457=>1,75367523=>1,88300911=>1,88693864=>1,88704688=>1,88715628=>1,72879484=>1,72879479=>1,72879482=>1,72879478=>1,72879463=>1,72879477=>1,88557243=>1);
        $array_user_ip = array('60.12.212.28'=>1,
                                "124.93.209.29"=>1,
                                "122.200.66.102"=>1,
                                "222.161.203.137"=>1,
                                "113.6.255.12"=>1,
                                "113.6.255.13"=>1,
                                "222.134.113.199"=>1,
                                "113.6.255.15"=>1,
                                "218.61.0.213"=>1,
                                "222.134.118.243"=>1,
                                "113.6.254.12"=>1,
                                "113.6.255.16"=>1,
                                "113.6.255.14"=>1,
                                "113.6.254.15"=>1,
                                "125.211.219.21"=>1,
                                "111.192.116.47"=>1,
                                "218.28.59.188"=>1,
                                "222.134.115.88"=>1,
                                "65.255.32.32"=>1,
                                "222.134.122.132"=>1,
                                "113.6.254.16"=>1,
                                "113.6.254.14"=>1,
                                "60.209.5.244"=>1,
                                "112.227.84.194"=>1,
                                "113.6.254.13"=>1,
                                "221.193.206.114"=>1,
                                "119.164.255.144"=>1,
                                "60.28.62.213"=>1,
                                "61.162.84.83"=>1,
                                "218.25.17.248"=>1,
                                "119.48.73.56"=>1,
                                "220.178.96.15"=>1,
                                "202.101.233.28"=>1,
                                "116.22.217.135"=>1,
                                "61.180.81.80"=>1,
                                "124.156.72.196"=>1,
                                "221.12.173.130"=>1,
                                "124.156.72.192"=>1,
                                "218.25.54.10"=>1,
                                "218.16.159.72"=>1,
                                "60.172.229.172"=>1,
                                "113.57.230.43"=>1,
                                "183.129.196.130"=>1,
                                "222.187.162.3"=>1,
                                "65.255.32.33"=>1,
                                "113.107.254.6"=>1,
                                "61.177.54.220"=>1,
                                "49.68.62.7"=>1,
                                );

        if(isset($array_user_id[$user_id]) || isset($array_user_ip[$user_ip])){
            return false;
        }else{
            return true;
        }
    }
}