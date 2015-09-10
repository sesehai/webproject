<?php

class Order_Auto {
    /**
     * 构造函数
     * @access public
     */
    public function __construct() {
        // $this->_apiDomain = '';
        $this->_apiDomain = '';
    }

    // 获取登陆验证码
    public function send($phone){
        $url = $this->_apiDomain . 'zeus/join/sms/send?appid=0101';
        $post_data = array(
            'mobile' => $phone,
            'smstype' => 'login',
        );
        // $post_data = http_build_query($post_data);
        $post_data = json_encode($post_data);
        $header = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($post_data),
        );

        $result = $this->_curl($url, $post_data, 'POST', $header);
        return $result;
    }

    // 登陆
    public function login($phone, $smsmcode){
        $url = $this->_apiDomain . 'zeus/join/login?appid=0101';
        $post_data = array(
            'mobile' => $phone,
            'smsmcode' => $smsmcode,
        );
        // $post_data = http_build_query($post_data);
        $post_data = json_encode($post_data);
        $header = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($post_data),
        );

        $result = $this->_curl($url, $post_data, 'POST', $header);
        return $result;
    }

    // 接单
    public function receive($ticket, $tid){
        $url = $url = $this->_apiDomain . 'zeus/security/torder/receive?';
        $post_data = array(
            'appid' => '0101',
            'tid' => $tid,
        );
        $post_data = http_build_query($post_data);
        $url .= $post_data;
        $header = array(
            'ticket: ' . $ticket,
        );

        $result = $this->_curl($url, $post_data);
        return $result;
    }

    // 到岗
    public function work($ticket, $oid){
        $url = $url = $this->_apiDomain . 'zeus/security/torder/work?';
        $post_data = array(
            'appid' => '0101',
            'oid' => $oid,
        );
        $post_data = http_build_query($post_data);
        $url .= $post_data;
        $header = array(
            'ticket: ' . $ticket,
        );

        $result = $this->_curl($url, $post_data);
        return $result;
    }

    // 报单
    public function confirm($ticket, $post_data){
        $url = $this->_apiDomain . 'zeus/security/torder/confirm?appid=0101';

        // $post_data = http_build_query($post_data);
        $post_data = json_encode($post_data);
        $header = array(
            'ticket: ' . $ticket,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($post_data),
        );

        $result = $this->_curl($url, $post_data, 'POST', $header);
        return $result;
    }

    /**
     * 使用 application/x-www-form-urlencoded 方式提交数据
     * @param string $post_url 请求地址
     * @param array() $post_data 提交数据
     * @param int $timeout 超时时间
     * @return string
     */
    private function _curl($post_url, $post_data = '', $method = 'GET', $header = array(), $timeout = 5){
        // $header = array();
        // $header[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        // $header[] = 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3 ';
        // $header[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0 ';
        // $header[] = 'Host: '.$host;
        // $header[] = 'Connection: Keep-Alive ';
        // $header[] = 'Cookie: '.$cookie;
        // $header[] = 'If-None-Match: 1429635365-10';
        // $header[] = 'Cache-Control: max-age=0';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $post_url);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_NOBODY, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        if( $method == 'POST' ){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS,$post_data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; Trident/5.0)');
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }
}
