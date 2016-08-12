<?php

class Cola_Com_Cache_Memcached extends Cola_Com_Cache_Abstract {
    protected $_connection;
    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = array()) {
        //$this->_connection = new Memcached();
        //使用memcached长连接
        $this->_connection = new Memcached('moxi');
        parent::__construct($options);
        //$this->_connection->setOption(Memcached::OPT_COMPRESSION, true);
        if (!count($this->_connection->getServerList())) {
            $this->_connection->addServers($this->_options['servers']);
        }
    }

    /**
     * Set cache
     *
     * @param mixed $keys
     * @param mixed $data
     * @param int $expire : sec
     * @return boolean
     */
    public function set($keys, $data = null, $expire = null) {
        //多key set时，只有2个参数：array,expire
        if (is_array($keys)) {
            $expire = $data;
        }
        if (null === $expire) {
            $expire = $this->_options['ttl'];
        }

        if (is_array($keys)) {
            return $this->_connection->setMulti($keys, $expire);
        } else {
            return $this->_connection->set($keys, $data, $expire);
        }
    }

    /**
     * Get Cache
     *
     * @param mixed $id
     * @return mixed
     */
    public function get($id) {
        if (is_array($id)) {
            return $this->_connection->getMulti($id);
        } else {
            return $this->_connection->get($id);
        }
    }

    /**
     * Delete cache
     * @param mixed $key
     * @return boolean
     */
    public function delete($key) {
        if (is_array($key)) {
            return $this->_connection->deleteMulti($key);
        } else {
            return $this->_connection->delete($key);
        }
    }

    /**
     * Increment value
     *
     * @param string $key
     * @param int $value
     */
    public function increment($key, $value = 1) {
        return $this->_connection->increment($key, $value);
    }

    /**
     * clear cache
     */
    public function clear() {
        $this->_connection->flush();
    }

    protected function close() {
        $this->_connection->quit();
    }

    public function stats() {
        return $this->_connection->getStats();
    }
}
