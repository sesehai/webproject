<?php
class Cola_Helper_Tw
{
	
	public static function output($code=200,$data=array(),$callback=''){
		if(empty($callback) || !preg_match('/^\w+$/',$callback)){
			exit(json_encode(array('code'=>$code,'data'=>$data)));
		}else{
			exit($callback.'('.json_encode(array('code'=>$code,'data'=>$data)).')');
		}
	}
	
	public static function Curl($destURL, $paramStr='',$flag='get',$name='',$password=''){
	   if(!extension_loaded('curl')) exit('php_curl.dll');
		$curl = curl_init(); 
		if($flag=='post'){
			curl_setopt($curl, CURLOPT_POST, 1);               
			curl_setopt($curl, CURLOPT_POSTFIELDS, $paramStr); 
		}
		curl_setopt($curl, CURLOPT_URL, $destURL);    
		curl_setopt($curl, CURLOPT_TIMEOUT, 5);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		if(!empty($name) && !empty($password)){
			curl_setopt($curl, CURLOPT_USERPWD, "{$name}:{$password}");
		}
		$str = curl_exec($curl);
		curl_close($curl);
		return $str;
	}

	public static function formattime($duration){
		if(empty($duration)){
			return 0;
		}
		$m = intval($duration/60);
		if($m < 10){
			$m = "0".$m;
		}
		$s = intval($duration%60);
		if($s < 10){
			$s = "0".$s;
		}
		return $m.':'.$s;
	}
		
	// 简单混淆编码字符串
	public static function encode($sec) {
		$sec = strval ( $sec );
		$key = '0123456789abefijmnqruvyz0123456789CDGHKLOPSTWX';
		$key = str_shuffle ( $key );
		$keyposition = 1;
		
		$len = strlen ( $sec );
		$str = '';
		for($i = 0; $i < $len; $i ++) {
			if (($i % $keyposition) == 0) {
				$str .= $key [$i / $keyposition];
			}
			$str .= $sec [$i];
		}
		$str .= $key [$i / $keyposition];
		return $str;
	}
	
	// 从上面混淆的字符串解码
	public static function decode($str) {
		$str = strval ( $str );
		$keyposition = 2;
		
		$str = substr ( $str, 0, - 1 );
		$len = strlen ( $str );
		$sec = '';
		for($i = 0; $i < $len; $i ++) {
			if (($i % $keyposition) != 0) {
				$sec .= $str [$i];
			}
		}
		
		return $sec;
	}

	public static function cachecontrol($cachetime = 600){
		header("Cache-Control: max-age=$cachetime");
		$gmttime = time() + $cachetime - 28800;
		$expires = date ( 'D, d M Y H:i:s \G\M\T', $gmttime);
		header("Expires: $expires");
	}
}