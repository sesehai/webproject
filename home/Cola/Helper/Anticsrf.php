<?php
/**
 *
 * @author yangzongjian@letv.com
 * @copyright 2015 letv.com
 * @link www.letv.com
 */
class Cola_Helper_Anticsrf
{
    private static $sec = '7gtc096z1wW8';

    //创建个 csrf 串
    //存浏览器cookie 或者 form hidden 中
    public static function create(){
        $time = time();

        $csrf_code = md5($time.self::$sec).'.'.$time;

        return $csrf_code;
    }

    //验证串的有效性
    //可以验证过期与否
    public static function check($csrf_code,$expire = 0){
        if(strpos($csrf_code,'.') !== false){
            list($md5_code,$code_ctime) = explode(".",$csrf_code);
            if(md5($code_ctime.self::$sec) != $md5_code){
                return false;
            }
        }else{
            return false;
        }

        if(is_numeric($expire) && $expire > 0){
            if( (time() - $code_ctime) > $expire ){
                return false;
            }
        }

        return true;
    }
}
