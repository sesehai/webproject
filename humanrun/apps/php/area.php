<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT_PATH", dirname(dirname((dirname(__FILE__)))));

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

    /**
     * 省份 坐标获取
     */
    public function getLngLatLevel0(){
        $sql = "SELECT * FROM `area` WHERE `level` = 0";
        $leve0Rows = $this->_pdoModel->query($sql, array());
        $num = 1;
        foreach ($leve0Rows as $key => $value) {
            echo $num . "\t" . $value['area_name'];
            echo "\n";
            $level0RowsLngLat = $this->_pdoModel->query("SELECT * FROM `wc_area` WHERE `level` = '省' AND `areaname` LIKE '{$value['area_name']}%' ", array());
            foreach ($level0RowsLngLat as $lnglatRow) {
                echo "\t" . $lnglatRow['lng'] . "\t" . $lnglatRow['Lat'] . "\n";
            }
            $num++;
        }
    }

    /**
     * 市 坐标获取
     */
    public function getLngLatLevel2(){
        $sql = "SELECT * FROM `area` WHERE `level` = 2";
        $leve2Rows = $this->_pdoModel->query($sql, array());
        $num = 1;
        foreach ($leve2Rows as $key => $value) {
            echo $num . "\t" . $value['area_name'];
            echo "\n";
            $level2RowsLngLat = $this->_pdoModel->query("SELECT * FROM `wc_area` WHERE `level` = '市' AND `areaname` LIKE '{$value['area_name']}%' ", array());
            foreach ($level2RowsLngLat as $lnglatRow) {
                echo "\t" . $lnglatRow['lng'] . "\t" . $lnglatRow['Lat'] . "\n";
            }
            $num++;
        }
    }

    /**
     * 区 坐标获取
     */
    public function getLngLatLevel3(){
        $sql = "SELECT * FROM `area` WHERE `level` = 2";
        $leve3Rows = $this->_pdoModel->query($sql, array());
        $num = 1;
        foreach ($leve3Rows as $key => $value) {
            echo $num . "\t" . $value['area_name'];
            echo "\n";
            $level3RowsLngLat = $this->_pdoModel->query("SELECT * FROM `wc_area` WHERE `level` = '区' AND `areaname` LIKE '{$value['area_name']}%' ", array());
            foreach ($level3RowsLngLat as $lnglatRow) {
                echo "\t" . $lnglatRow['lng'] . "\t" . $lnglatRow['Lat'] . "\n";
            }
            $num++;
        }
    }

}

$area = new Area(array());

$area->getLngLatLevel3();
