<?php
/*
 * 2015-06-12 by yangzongjian@letv.com
 *
 * 依赖
 *   1. b8 bayes 实现 http://nasauber.de/opensource/b8/
 *   2. redis 存储训练集合
 *   3. scws中文分词 https://github.com/hightman/scws
 *
 *  目前手工训练，详情参看 $this->Learn()
 *
 * todo:
 *     1，增量训练
 *     2，分词库加强（跟业务相关性提高）
 *
*/
require_once(dirname(__file__).'/../Com/B8/b8.php');

class Cola_Helper_Spam {
    /*
    * type 训练集数据的来源区分类型
    * 如：聊天训练集过滤聊天垃圾
    *  评论训练集过滤聊天垃圾
    *  弹幕训练集过滤弹幕垃圾
    * 自定义type的值即可，默认为聊天室
    * 注意不要太长(10个字符以内)
    */
    public function __construct($isLearn = false,$type = 'chat2.0'){
        define('SPAM_TRAIN_VERSION',"SP_".$type."_");

        if($isLearn){
            //写库
            $this->config_storage = array(
                //'database'   => '',
                //'table_name' => '',
                'host'       => '117.121.54.31',
                'port'       => '7379',
                //'user'       => '',
                //'pass'       => '',
            );
        }else{
            //读库
            $this->config_storage = array(
                //'database'   => '',
                //'table_name' => '',
                'host'       => '117.121.54.30',
                'port'       => '7379',
                //'user'       => '',
                //'pass'       => '',
            );
        }

        //用redis存储训练集
        $this->config_b8 = array(
            'storage' => 'redis',
        );

        $this->config_lexer = array(
            'old_get_html' => FALSE,
            'get_html'     => TRUE
        );

        $this->config_degenerator = array(
            'multibyte' => TRUE
        );

        //注入redis 对象
        $redis = new Redis();
        $redis->connect($this->config_storage['host'], $this->config_storage['port']);

        $this->config_storage['redis'] = $redis;

        if($isLearn){
            //初始化
            $iniData = array(
                'b8*dbversion' => array('count_ham' => 3,'count_spam' => 0),
                'b8*texts' => array('count_ham' => 0,'count_spam' => 0),
            );

            foreach($iniData as $k => $v){
                $key = SPAM_TRAIN_VERSION.'_'.base64_encode($k);
                $this->config_storage['redis']->hMset($key,$v);
            }
        }
    }

    /**
    * 取是否是垃圾的可能性 默认 0.5
    * 越大越可能是垃圾，最大为1
    * 一般应用中大于 0.7 就可以判定为垃圾
    * 根据业务情况灵活指定这个阀值即可
    **/
    public function TextRating($text) {
        try {
            $b8 = new b8($this->config_b8, $this->config_storage, $this->config_lexer, $this->config_degenerator);
            $rating = $b8->classify($text);

            return sprintf("%.3f",$rating);
        }catch(Exception $e) {
            return '0.5';
        }
    }

    /*
    *
    训练前手工清除下之前的训练数据
    redis-cli -h 117.121.54.31 -p 7379 KEYS "spamdata2015061*" |xargs redis-cli -h 117.121.54.31 -p 7379 DEL

    * $filename: 文本文件，一行条记录
    * $type    : ham|spam
    * 用法：
    *
    *  include spam.php
        $spam = new Cola_Helper_Spam();
        $spam->Learn($text,$type);
        $spam->Learn($text,$type);
    */
    public function Learn($text,$type){
        try {
            $b8 = new b8($this->config_b8, $this->config_storage, $this->config_lexer, $this->config_degenerator);
            if($type == 'spam'){
                $b8->learn($text,b8::SPAM);
            }else{
                $b8->learn($text,b8::HAM);
            }
        }catch(Exception $e) {
            echo "Error:", $e->getMessage();
        }
    }
}
