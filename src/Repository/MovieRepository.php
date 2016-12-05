<?php
namespace M4ciej\CinemaManagement\Repository;
/*
 * Made by M4ciej
 */

/**
 * Description of MovieRepository
 *
 * @author m4ciej
 */
class MovieRepository implements InterfaceRepository {

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
     * @param Movie $movie
     */
    public function add($movie) {
        $this->connection->insertSql("Movies", array('name', 'description', 'rating'), array($movie->getName(), $movie->getDescription(), $movie->getRating()));
        $id = $this->connection->getLastInsertedId();

        //region Extra reflection
        $reflectionClass = new ReflectionClass($movie);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($movie, $id);
        //endregion
    }
    /**
     * 
     * @param Movie $movie
     */
    public function update($movie){
        $listOfValues['name']=$movie->getName();
        $listOfValues['description']=$movie->getDescription();
        $listOfValues['rating']=$movie->getRating();
        $key=$movie->getId();
        $this->connection->updateSql("Movies", $listOfValues, $key);
    }
    /**
     * 
     * @param Movie $movie
     */
    public function delete($movie) {
        try {
            $this->connection->query("DELETE FROM Movies WHERE id=" . $movie->getId());
        } catch (Exception $e) {
            echo "Blad:" . $e->getMessage();
        }
    }

    /**
     * 
     * @return array()
     */
    public function findAll() {
        $movies = array();
        $r = $this->connection->query("SELECT * FROM Movies");
        foreach ($r as $row) {
            $movie = new Movie($row['name'], $row['description'], $row['rating']);
            //region Extra reflection
            $reflectionClass = new ReflectionClass($movie);
            $reflectionProperty = $reflectionClass->getProperty('id');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($movie, $row['id']);
            //endregion
            $movies[] = $movie;
        }
        return $movies;
    }

    /**
     * 
     * @param int $id
     * @return Movie
     */
    public function findBy($id) {
        $r = $this->connection->query("SELECT * FROM Movies WHERE id=" . $id)->fetch_assoc();
        $movie = new Movie($r['name'], $r['description'], $r['rating']);
        //region Extra reflection
        $reflectionClass = new ReflectionClass($movie);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($movie, $id);
        //endregion
        return $movie;
    }

}
