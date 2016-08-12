<?php
/**
 * 将简体中文转换至台湾繁体中文
 * 
 * @author dengshuaifeng@letv.com
 * @copyright 2013 letv.com
 * @link www.letv.com
 */
class Cola_Helper_Convert {
	public static function zh2tw($string) {
		require dirname ( dirname ( __FILE__ ) ) . '/ZhConversion.php';
		return strtr ( strtr ( $string, $zh2TW ), $zh2Hant );
	}
	
	// 引用方式处理
	public static function zh2twi(&$string) {
		$string = self::zh2tw ( $string );
	}
}