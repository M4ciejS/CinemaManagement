<?php

namespace M4ciej\CinemaManagement\Repository;

use Exception;
use M4ciej\CinemaManagement\Base\Connection;
use M4ciej\CinemaManagement\Entity\Cinema;
use M4ciej\CinemaManagement\Entity\Payment;
use ReflectionClass;

/*
 * Made by M4ciej
 */

/**
 * Description of CinemaRepository
 *
 * @author m4ciej
 */
class CinemaRepository implements InterfaceRepository {

    private static $connection;

    /**
     * 
     * @param Connection $connection
     */
    /*function __construct(Connection $connection) {
        self::$connection = $connection;
    }*/
    public static function SetConnection(Connection $newConnection){
        self::$connection = $newConnection;
    }
    /**
     * 
     * @param Payment $cinema
     */
    public function add($cinema) {
        try {
            self::$connection->insertSql("Cinemas", array('name', 'address'), array($cinema->getName(), $cinema->getAddress()));
            $id = self::$connection->getLastInsertedId();
            //region Extra reflection
            $reflectionClass = new \ReflectionClass($cinema);
            $reflectionProperty = $reflectionClass->getProperty('id');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($cinema, $id);
            //endregion
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 
     * @param Cinema $cinema
     */
    public function update($cinema) {
        $listOfValues['name'] = $cinema->getName();
        $listOfValues['address'] = $cinema->getAddress();
        $key = $cinema->getId();
        try {
            self::$connection->updateSql("Cinemas", $listOfValues, $key);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 
     * @param Cinema $cinema
     */
    public function delete($cinema) {
        try {
            self::$connection->query("DELETE FROM Cinemas WHERE id=" . $cinema->getId());
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 
     * @return Cinema array
     */
    public function findAll() {
        $cinemas = array();
        try {
            $r = self::$connection->query("SELECT * FROM Cinemas");
            foreach ($r as $row) {
                $cinema = new Cinema($row['name'], $row['address']);
                //region Extra reflection
                $reflectionClass = new ReflectionClass($cinema);
                $reflectionProperty = $reflectionClass->getProperty('id');
                $reflectionProperty->setAccessible(true);
                $reflectionProperty->setValue($cinema, $row['id']);
                //endregion
                $cinemas[] = $cinema;
            }
            return $cinemas;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 
     * @param int $id
     * @return Cinema
     */
    public function findBy($id) {
        try {
            $r = self::$connection->query("SELECT * FROM Cinemas WHERE id=" . $id)->fetch_assoc();
            $cinema = new Cinema($r['name'], $r['address']);
            //region Extra reflection
            $reflectionClass = new ReflectionClass($cinema);
            $reflectionProperty = $reflectionClass->getProperty('id');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($cinema, $id);
            //endregion
            return $cinema;
        } catch (Exception $e) {
            return false;
        }
    }

}
