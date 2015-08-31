<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT_PATH", dirname(dirname(dirname((dirname(__FILE__))))));

require_once ROOT_PATH.'/base.php';
spl_autoload_register(array('Base','auto_load'));

/**
 * area process
 */
class Area
{

    function __construct($config)
    {
        if(empty($config)){
            $config = array(
               'db_type' => 'mysql',
               'dbconfig' => array (
                    'host' =>'',
                    'port' => '',
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

    public function getLeve2NoLevelCity()
    {
        $sql = "SELECT * FROM `area` WHERE `level` = 2 ";
        $level2Rows = $this->_pdoModel->query($sql, array());
        // print_r($level2Rows);
        foreach ($level2Rows as $level2Row) {
            $level3RowsNum = $this->_pdoModel->query("SELECT count(*) as total FROM `area` WHERE `parent_id` = {$level2Row['id']}", array());
            if(empty($level3RowsNum[0]['total'])){
                // print_r($level2Row);
                file_put_contents("result.txt", var_export($level2Row, true)."\n", FILE_APPEND);
            }else{
                // print_r($level3RowsNum);
            }

        }
    }
}

$area = new Area(array());

$area->getLeve2NoLevelCity();
