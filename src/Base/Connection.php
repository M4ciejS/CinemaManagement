<?php
namespace M4ciej\CinemaManagement\Base;

use Exception;
use mysqli;
use mysqli_result;
/**
 * Copyright
 */

/**
 * Class Connection
 */
class Connection {

    private $connection;

    public function __construct(mysqli $mysqli) {
        if ($mysqli->connect_error) {
            throw new Exception($mysqli->connect_error);
        }
        $this->connection = $mysqli;
    }

    /**
     * 
     * @param string $sql
     * @return mysqli_result
     * @throws Exception
     */
    public function query($sql) {
        $result = $this->connection->query($sql);
        if ($result == false OR $this->connection->error) {
            throw new Exception($this->connection->error);
        }

        return $result;
    }

    /**
     * 
     * @param string $tableName
     * @param array $listOfColumns
     * @param array $listOfValues
     */
    public function insertSql($tableName, array $listOfColumns, array $listOfValues) {
        $list = [];

        foreach ($listOfValues as $value) {
            $list[] = $this->escapeString($value);
        }

        $sql = sprintf(
                "INSERT INTO %s (%s) VALUES (%s)", $tableName, join(',', $listOfColumns), join(',', $list)
        );

        $this->query($sql);
    }
    /**
     * 
     * @param string $tableName
     * @param string $condition
     * @param array $listOfColumns
     */
    /*Warto/Nie warto?
     * public function selectSql($tableName,$condition,array $listOfColumns=array('*')){
        $sql="Select ";
        $columns=implode(",".$listOfColumns);
        $sql.=$coulmns."FROM ".$tableName." WHERE ".$this->connection->real_escape_string($condition);
        $this->query($sql);
    }*/
    /**
     * 
     * @return int
     */
    public function getLastInsertedId() {
        return $this->connection->insert_id;
    }

    private function escapeString($string) {
        if (is_string($string)) {
            return sprintf('"%s"', $this->connection->real_escape_string($string));
        } else {
            return $string;
        }
    }

    /**
     * 
     * @param string $tableName
     * @param array $listOfValue
     * @param array $primaryKeyId
     */
    public function updateSql($tableName, array $listOfValues, $primaryKeyId) {
        $list = [];
        foreach ($listOfValues as $columnName => $value) {
            $tempValue = $this->escapeString($value);
            $list[] = sprintf("%s=%s", $columnName, $tempValue);
        }

        $sql = sprintf(
                "UPDATE %s SET %s WHERE id = %s", $tableName, join(',', $list), $primaryKeyId
        );

        $this->query($sql);
    }
    /**
     * 
     * @param string $tableName
     * @param int $id
     * @return boolean
     */
    public function recordExists($tableName,$id){
        if($this->query("SELECT id FROM ".$tableName." WHERE id=".$id)->num_rows>0){
            return true;
        }
        return false;
    }

}
