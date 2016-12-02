<?php

/*
 * Made by M4ciej
 */

/**
 * Description of CinemaRepository
 *
 * @author m4ciej
 */
class CinemaRepository implements InterfaceRepository {

    private $connection;

    /**
     * 
     * @param Connection $connection
     */
    function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * 
     * @param Payment $cinema
     */
    public function add($cinema) {
        $this->connection->insertSql("Cinemas", array('name', 'address'), array($cinema->getName(), $cinema->getAddress()));
        $id = $this->connection->getLastInsertedId();

        //region Extra reflection
        $reflectionClass = new ReflectionClass($cinema);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($cinema, $id);
        //endregion
    }
    /**
     * 
     * @param Cinema $cinema
     */
    public function update($cinema){
        $listOfValues['name']=$cinema->getName();
        $listOfValues['address']=$cinema->setAddress($address);
        $key=$cinema->getId();
        $this->connection->updateSql("Cinemas", $listOfValues, $key);
    }
    /**
     * 
     * @param Cinema $cinema
     */
    public function delete($cinema) {
        try {
            $this->connection->query("DELETE FROM Cinemas WHERE id=" . $cinema->getId());
        } catch (Exception $e) {
            echo "Blad:" . $e;
        }
    }

    /**
     * 
     * @return Cinema array
     */
    public function findAll() {
        $cinemas = array();
        $r = $this->connection->query("SELECT * FROM Cinemas");
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
    }

    /**
     * 
     * @param int $id
     * @return Cinema
     */
    public function findBy($id) {
        $r = $this->connection->query("SELECT * FROM Cinemas WHERE id=" . $id)->fetch_assoc();
        $cinema = new Cinema($r['name'], $r['address']);
        //region Extra reflection
        $reflectionClass = new ReflectionClass($cinema);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($cinema, $id);
        //endregion
        return $cinema;
    }

}
