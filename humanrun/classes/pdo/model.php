<?php
require_once 'db.php';
Class Pdo_Model{

    // db对象池
    protected static $dbPool = array();

    public function __construct($dbConfig){
        $this->_db = new Pdo_Db($dbConfig);
    }

    public function getDb(){
        return $this->_db;
    }

    public function insert($data, $table){
        $result = '';
        $db = $this->getDb();
        $db->connect();
        $fieldStr = '';
        $fieldValStr = '';
        $valueAry = array();
        if( isset($data) && !empty($data) ){
            foreach($data as $key=>$value){
                $fieldStr .= " `{$key}`,";
                $fieldValStr .= " ?,";
                $valueAry[] = $value;
            }
            $fieldStr = substr($fieldStr,0,-1);
            $fieldValStr = substr($fieldValStr,0,-1);
        }
        $sql = "INSERT INTO `{$table}`({$fieldStr}) VALUES({$fieldValStr})";
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        if( $result ) {
            $result = $db->lastId();
        }
        $db->disConnect();
        return $result;
    }

    public function insertValues($datas, $table){
        $db = $this->getDb();
        $db->connect();
        $valueAry = array();
        $sql = "";
        if( isset($datas) && !empty($datas) ){
            foreach($datas as $data){
                $fieldStr = "";
                $fieldValStr = "";
                foreach($data as $key=>$value){
                    $fieldStr .= " `{$key}`,";
                    $fieldValStr .= " ?,";
                    $valueAry[] = $value;
                }
                $fieldStr = substr($fieldStr,0,-1);
                $fieldValStr = substr($fieldValStr,0,-1);
                $sql .= "INSERT INTO `{$table}`({$fieldStr}) VALUES({$fieldValStr});";
            }
        }

        $db->prepare($sql);
        $result = $db->execute($valueAry);
        if( $result ) {
            $result = $db->affectRows();
        }
        $db->disConnect();
        return $result;
    }

    public function query($sql, $valueAry){
        $db = $this->getDb();
        $db->connect();
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        $row = $db->fetchAll();
        $db->disConnect();
        return $row;
    }

    public function getOne($sql, $valueAry){
        $db = $this->getDb();
        $db->connect();
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        $row = $db->fetchOne();
        $db->disConnect();
        return $row;
    }

    public function update($condition, $conditionValAry, $data, $table){
        $result = '';
        $db = $this->getDb();
        $db->connect();
        $fieldValStr = '';
        $valueAry = array();
        if( isset($data) && !empty($data) ){
            foreach($data as $key=>$value){
                $fieldValStr .= " `{$key}` = ?,";
                $valueAry[] = $value;
            }
        }
        $fieldValStr = substr($fieldValStr,0,-1);
        foreach ($conditionValAry as $value) {
            $valueAry[] = $value;
        }
        $sql = "UPDATE `{$table}` SET {$fieldValStr}  WHERE {$condition} ";
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        $db->disConnect();
        return $result;
    }

    public function delete($condition, $valueAry, $table){
        $db = $this->getDb();
        $db->connect();
        $sql = "DELETE  FROM `{$table}` WHERE {$condition} ";
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        $db->disConnect();
        return $result;
    }

}
