<?php
class Service_Base {

    /**
     * The home directory of model
     *
     * @var string
     */
    protected $_modelsHome = null;

    public function __construct()
    {
        if (null === $this->_modelsHome) {
            $this->_modelsHome = Cola::config('_modelsHome');
        }
    }

    /**
     * Instantiated model
     *
     * @param string $name            
     * @param string $dir            
     * @return Cola_Model
     */
    protected function model($name = null, $dir = null)
    {
        if (null === $name) {
            return $this->model;
        }
        
        null === $dir && $dir = $this->_modelsHome;
        $class = ucfirst($name) . 'Model';
        if (Cola::loadClass($class, $dir)) {
            return new $class();
        }
        
        throw new exception("Can't load model '$class' from '$dir'");
    }

}