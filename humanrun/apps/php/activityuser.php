<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT_PATH", dirname(dirname((dirname(__FILE__)))));

require_once ROOT_PATH.'/base.php';
spl_autoload_register(array('Base','auto_load'));

/**
 * area process
 */
class Activity
{

    function __construct($config)
    {
        if(empty($config)){
            $config = array(
               'db_type' => 'mysql',
               'dbconfig' => array (
                    'host' =>'127.0.0.1',
                    'port' => '3306',
                    'dbname' => '',
                    'username' => '',
                    'password' => '',
                    'driver_options' => array(
                        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                        PDO::ATTR_EMULATE_PREPARES => true,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';",
                    ),
                  ),
            );
        }

        $this->_pdoModel = new Pdo_Model($config);
    }

    public function getdata()
    {
        $sql = "select * from mclient_newuser_activity where date(addtime)>='2015-08-01' and date(addtime)<='2015-08-31'";
        $level2Rows = $this->_pdoModel->query($sql, array());
        // print_r($level2Rows);
        foreach ($level2Rows as $level2Row) {
            file_put_contents("/letv/logs/activity.txt", implode(",", $level2Row), FILE_APPEND);
            // echo implode(",", $level2Row);
        }
    }
}

$activity = new Activity(array());

$activity->getdata();
