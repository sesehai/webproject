<?php

class Redis_Base {
    private $conn;
    /**
     * 构造函数
     * @access public
     */
    public function __construct($config = array('host'=>'', 'port' => '', 'auth' => '')) {
        if ( !extension_loaded('redis') ) {
            throw new Exception('Redis 错误：没有找到Redis组件。');
        }

        $options = array (
            'host' => $config['host'],
            'port' => $config['port'],
        );

        $this->options =  $options;
        $this->conn = new Redis;
        $this->connected = $this->conn->connect($options['host'], $options['port']);
        $this->conn->auth($config['auth']);
    }

    /**
     * 是否连接
     * @access private
     * @return boolen
     */
    private function isConnected() {
        return $this->connected;
    }

    /**
     * 读取缓存
     * @access public
     * @param string $name 缓存变量名
     * @return mixed
     */
    public function get($name) {
        return $this->conn->get($name);
    }

    /**
     * 写入缓存
     * @access public
     * @param string $name 缓存变量名
     * @param mixed $value  存储数据
     * @param integer $expire  有效时间（秒）
     * @return boolen
     */
    public function set($name, $value, $expire = null) {
        if(is_null($expire)) {
            $expire = "";
        }
        if(is_int($expire)) {
            $result = $this->conn->setex($name, $expire, $value);
        }else{
            $result = $this->conn->set($name, $value);
        }
        return $result;
    }

    /**
     * 删除缓存
     *
     * @access public
     * @param string $name 缓存变量名
     * @return boolen
     */
    public function rm($name) {
        return $this->conn->delete($name);
    }

    /**
     * 清除缓存
     * @access public
     * @return boolen
     */
    public function clear() {
        return $this->conn->flushDB();
    }

    /**
     * Push messages to redis server
     *
     */
    function lPush($key,$value){
        return $this->conn->lPush($key,$value);
    }

    /**
     * Pop messages from redis server by devid
     *
     */
    function rPop($key){
       return $this->conn->rPop($key);
    }

    public function close(){
        $this->conn->close();
    }

    public function keys($pattern){
        return $this->conn->keys($pattern);
    }
}
?>
