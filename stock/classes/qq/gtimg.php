<<<<<<< HEAD
<?php
class qq_gtimg
{
    public function getName()
    {
        return __METHOD__;
    }

    public function __construct($config = array())
    {
    }

    /**
     * 根据code 获取实时信息
     * @param array $codesAry
     * @return array
     */
    public function getInfosByCode($codesAry)
    {
        // http://qt.gtimg.qq.com/?q=sz300005,sh600016,sh600717
        // response:
        // v_sz300005="51~探路者~300005~27.71~26.39~26.30~186660~107280~79380~27.71~30~27.70~544~27.69~169~27.68~45~27.67~1~27.72~25~27.73~134~27.74~216~27.75~234~27.76~33~14:34:00/27.71/36/S/99762/15151|14:33:54/27.71/51/S/141369/15146|14:33:51/27.71/1/S/2771/15144|14:33:45/27.71/7/B/19397/15140|14:33:45/27.72/48/B/133002/15137|14:33:40/27.71/12/B/33252/15132~20150421143400~1.32~5.00~27.73~26.30~27.71/186624/508135993~186660~50824~5.76~45.72~~27.73~26.30~5.42~89.83~142.16~10.58~29.03~23.75~";
        $result = array();
        $gtimgApi = 'http://qt.gtimg.qq.com/?';
        // $gtimgApi = 'http://test2.m.letv.com/luq.php?';
        if (!empty($codesAry)) {
            $q = implode(',', $codesAry);
            $url = $gtimgApi."q=".$q;
            $cookie = '';
            $content = $this->_curl($url, $cookie);
            $content = iconv("GBK", "utf-8", $content);
            $contentAry = explode(";", $content);
            $result = $this->_filterData($contentAry);
        } else {
            $result = array();
        }

        return $result;
    }

    private function _filterData($contentAry)
    {
        $columsAry = array(
            // 0 => '未知',
            // 1 => '名字',
            2 => '代码',
            3 => '当前价格',
            4 => '昨收',
            5 => '今开',
            6 => '成交量',
            7 => '外盘',
            8 => '内盘',
            // 9 => '买一',
            // 10 => '买一量',
            // 19 => '卖一',
            // 20 => '卖一量',
            // 29 => '最近逐笔成交',
            // 30 => '时间',
            // 31 => '涨跌',
            // 32 => '涨跌%',
            // 33 => '最高',
            // 34 => '最低',
            // 35 => '价格/成交量（手）/成交额',
            // 36 => '成交量',
            // 37 => '成交:万',
            // 38 => '换手率%',
            // 39 => '市盈率',
            // 40 => '',
            // 41 => '最高',
            // 42 => '最低',
            // 43 => '振幅%',
            // 44 => '流通市值',
            // 45 => '总市值',
            // 46 => '市净率',
            // 47 => '涨停价',
            // 48 => '跌停价',
        );

        $result['header'] = $columsAry;
        foreach ($contentAry as $stString) {
            $stString = trim($stString);
            if (!empty($stString)) {
                $stKeyValAry = explode('"', $stString);
                $strAry = explode('~', $stKeyValAry[1]);
                $item = array();
                foreach ($columsAry as $index => $nameCn) {
                    $item[$index] = $strAry[$index];
                }
                $result['body'][] = $item;
            }
        }

        return $result;
    }

    private function _curl($url, $cookie)
    {
        $urlAry = parse_url($url);
        $host = $urlAry['host'];
        $ch = curl_init();
        $header = array();
        $header[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $header[] = 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3 ';
        $header[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0 ';
        $header[] = 'Host: '.$host;
        $header[] = 'Connection: Keep-Alive ';
        $header[] = 'Cookie: '.$cookie;
        $header[] = 'If-None-Match: 1429635365-10';
        $header[] = 'Cache-Control: max-age=0';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($ch);
        curl_close($ch);

        return $ret;
    }
}
=======
<?php
class Qq_Gtimg {
    public function getName() {
        return __METHOD__;
    }

    public function __construct($config = array()){
    }

    /**
     * 根据code 获取实时信息
     * @param array $codesAry
     * @return array
     */
    public function getInfosByCode($codesAry){
        // http://qt.gtimg.qq.com/?q=sz300005,sh600016,sh600717
        // response:
        // v_sz300005="51~探路者~300005~27.71~26.39~26.30~186660~107280~79380~27.71~30~27.70~544~27.69~169~27.68~45~27.67~1~27.72~25~27.73~134~27.74~216~27.75~234~27.76~33~14:34:00/27.71/36/S/99762/15151|14:33:54/27.71/51/S/141369/15146|14:33:51/27.71/1/S/2771/15144|14:33:45/27.71/7/B/19397/15140|14:33:45/27.72/48/B/133002/15137|14:33:40/27.71/12/B/33252/15132~20150421143400~1.32~5.00~27.73~26.30~27.71/186624/508135993~186660~50824~5.76~45.72~~27.73~26.30~5.42~89.83~142.16~10.58~29.03~23.75~";
        $result = array();
        $gtimgApi = 'http://qt.gtimg.qq.com/?';
        // $gtimgApi = 'http://test2.m.letv.com/luq.php?';
        if( !empty($codesAry) ){
            $q = implode(',', $codesAry);
            $url = $gtimgApi."q=".$q;
            $cookie = '';
            $content = $this->_curl($url, $cookie);
            $content = iconv("GBK", "utf-8", $content);
            $contentAry = explode(";", $content);
            $result = $this->_filterData($contentAry);
        }else{
            $result = array();
        }

        return $result;
    }

    private function _filterData($contentAry){
        $columsAry = array(
            // 0 => '未知',
            // 1 => '名字',
            2 => '代码',
            3 => '当前价格',
            4 => '昨收',
            5 => '今开',
            6 => '成交量',
            7 => '外盘',
            8 => '内盘',
            // 9 => '买一',
            // 10 => '买一量',
            // 19 => '卖一',
            // 20 => '卖一量',
            // 29 => '最近逐笔成交',
            // 30 => '时间',
            // 31 => '涨跌',
            // 32 => '涨跌%',
            // 33 => '最高',
            // 34 => '最低',
            // 35 => '价格/成交量（手）/成交额',
            // 36 => '成交量',
            // 37 => '成交:万',
            // 38 => '换手率%',
            // 39 => '市盈率',
            // 40 => '',
            // 41 => '最高',
            // 42 => '最低',
            // 43 => '振幅%',
            // 44 => '流通市值',
            // 45 => '总市值',
            // 46 => '市净率',
            // 47 => '涨停价',
            // 48 => '跌停价',
        );

        $result['header'] = $columsAry;
        foreach ($contentAry as $stString) {
            $stString = trim($stString);
            if( !empty($stString) ){
                $stKeyValAry = explode('"', $stString);
                $strAry = explode('~', $stKeyValAry[1]);
                $item = array();
                foreach ($columsAry as $index => $nameCn) {
                    $item[$index] = $strAry[$index];
                }
                $result['body'][] = $item;
            }
        }

        return $result;
    }

    private function _curl($url, $cookie){
        $urlAry = parse_url($url);
        $host = $urlAry['host'];
        $ch = curl_init();
        $header = array();
        $header[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $header[] = 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3 ';
        $header[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0 ';
        $header[] = 'Host: '.$host;
        $header[] = 'Connection: Keep-Alive ';
        $header[] = 'Cookie: '.$cookie;
        $header[] = 'If-None-Match: 1429635365-10';
        $header[] = 'Cache-Control: max-age=0';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($ch);
        curl_close($ch);

        return $ret;
    }

}
>>>>>>> 54ffeeaaf0dd2dbc6ad9e95a78c253513e49c553
