<<<<<<< HEAD
<?php
error_reporting(E_ALL);
ini_set("display_errors","on");

$start_time = microtime(true);

// $url = "http://dynamic.app.m.letv.com/android/dynamic.php?mod=mob&ctl=home55&act=index&devid=13EF2A68-B5FC-4D53-8E10-1355334B1B56&history=23136876-23141514-23121642-23091511-23066265-23076626-23053612-23034290-23028261-23020822&pcode=010510000&version=5.6.1";
// $r = file_get_contents($url);
sleep(1);
$times = (microtime(true) - $start_time);

// echo intval($times*1000);

// echo md5('need_tk=true&newpwd=123456&oldpwd=server&pcode=010110000&plat=mobile_tv&tk=102505bd4aQC1BsZFkSU2lGSoQiKTLGtrm2cbnx09gWLRjuLiiv8VwfSMfFLMm2ZPHZwMy9V&version=6.0&poi345');

// need_tk=true&newpwd=123456&oldpwd=server&pcode=010110000&plat=mobile_tv&tk=102505bd4aQC1BsZFkSU2lGSoQiKTLGtrm2cbnx09gWLRjuLiiv8VwfSMfFLMm2ZPHZwMy9V&version=6.0&poi345
// need_tk=true&newpwd=123456&oldpwd=server&pcode=010110000plat=mobile_tv&tk=102505bd4aQC1BsZFkSU2lGSoQiKTLGtrm2cbnx09gWLRjuLiiv8VwfSMfFLMm2ZPHZwMy9V&version=6.0&poi345

// echo serialize("SMS_CODE");

function checkSign($sign_key, $params, $sign){
    $result = true;
    $valueStr = '';
    ksort($params);
    foreach ($params as $key=>$value) {
        $valueStr .= $key."=".$value."&";
    }
    $valueStr .= $sign_key;
    $valueStrMd5 = strtolower(md5($valueStr));
    echo $valueStr,"\n";
    if( $valueStrMd5 == $sign ){
        $result = true;
    }else{
        $result = false;
    }

    echo "$valueStrMd5 == $sign","\n";
}

// http://test2.m.letv.com/android/dynamic.php?mod=pay&ctl=activity&act=index&pcode=0101202990357&version=6.0&userid=42662154&username=qq_36F1F049B42239F131F9ABC53BCB82F7&devid=f7df2fd05e49e6c9d373959229f79218&imei=111&mac=222&apisign=000
$params = array(
    'userid' => '42662154',
    'username' => 'qq_36F1F049B42239F131F9ABC53BCB82F7',
    'devid' => 'f7df2fd05e49e6c9d373959229f79218',
    'imei' => '111',
    'mac' => '222',
    'version' => '6.0',
    'pcode' => '0101202990357',
);
checkSign($sign_key =  'poi345', $params, $sign = '000');

echo 'devid=f7df2fd05e49e6c9d373959229f79218&imei=111&mac=222&pcode=0101202990357&userid=42662154&username=qq_36F1F049B42239F131F9ABC53BCB82F7&version=6.0&poi345';
=======
<?php
// $str = "abc";
// $find = "b";
// $pos = strpos($str, $find);
// if( $pos != false ){
//     echo "yes";
// }else{
//     echo "no";
// }
//
// echo md5("_010210173_5.9_adcache");

echo md5('cityId=55&education=高中&idNumber=410521198708016078&photoBack=http://image.gojsgo.cn/images/2015/07/18/20150718201948.jpg&photoEducation=http://image.gojsgo.cn/images/2015/06/23/20150623190016.jpg&photoFront=http://image.gojsgo.cn/images/2015/07/18/20150718201900.jpg&picture=http://image.gojsgo.cn/images/2015/06/23/20150623160236.jpg&provinceId=4&realName=申测试2&sex=1&123456');
>>>>>>> 54ffeeaaf0dd2dbc6ad9e95a78c253513e49c553
