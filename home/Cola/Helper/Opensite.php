<?php

class Cola_Helper_Opensite {

    public static function output($code = 200, $data = array(), $callback = '') {
        if (empty($callback) || !preg_match('/^\w+$/', $callback)) {
            exit(json_encode(array('code' => $code, 'data' => $data)));
        } else {
            exit($callback . '(' . json_encode(array('code' => $code, 'data' => $data)) . ')');
        }
    }

    public static function Curl($destURL, $paramStr = '', $flag = 'get', $name = '', $password = '') {
        if (!extension_loaded('curl'))
            exit('php_curl.dll');
        //$curl = curl_init();
        //改用@qinlei提供的curl
        $_objCurl = new Cola_Com_Curl(Cola::config('curl_config'));
        $curl = $_objCurl->curl;
        if ($flag == 'post') {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $paramStr);
        }
        curl_setopt($curl, CURLOPT_URL, $destURL);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($name) && !empty($password)) {
            curl_setopt($curl, CURLOPT_USERPWD, "{$name}:{$password}");
        }
        $_objCurl->exec();
        $str = $_objCurl->response;
        //$str = curl_exec($curl);
        curl_close($curl);
        return $str;
    }

    public static function getAppUrl() {
        $host = strtolower(trim($_SERVER['HTTP_HOST']));
        switch ($host) {
            case 'itools.m.letv.com':
                $url = 'https://itunes.apple.com/cn/app/le-shi-ying-shi-guo-nei-zui/id385285922?mt=8';
                break;
            case '360.m.letv.com':
                $url = 'http://app.m.letv.com/android/index.php?mod=stat&ctl=download&act=add&pcode=010110000&direct=android&name=' . urlencode('乐视影视android客户端') . '&360ext=apk&refer=102&p=2';
                break;
        }
        return $url;
    }

    public static function formattime($duration) {
        if (empty($duration)) {
            return 0;
        }
        $m = intval($duration / 60);
        if ($m < 10) {
            $m = "0" . $m;
        }
        $s = intval($duration % 60);
        if ($s < 10) {
            $s = "0" . $s;
        }
        return $m . ':' . $s;
    }

}
