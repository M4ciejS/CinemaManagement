<?php
namespace M4ciej\CinemaManagement\Repository;
/*
 * Made by M4ciej
 */

/**
 * Description of ShowingRepository
 *
 * @author m4ciej
 */
class ShowingRepository {

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
     * @param Showing $showing
     */
    public function add($showing) {
        try {
            $this->connection->insertSql("Showings", array('movie_id', 'cinema_id'), array($showing->getMovie_id(), $showing->getCinema_id()));
            $id = $this->connection->getLastInsertedId();

            //region Extra reflection
            $reflectionClass = new ReflectionClass($showing);
            $reflectionProperty = $reflectionClass->getProperty('id');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($showing, $id);
            //endregion
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete($id) {
        $this->connection->query("DELETE FROM Showings WHERE id=" . $id);
    }

    /**
     * 
     * @return array
     */
    public function findAll() {
        $showings = array();
        $r = $this->connection->query("SELECT * FROM Showings");
        foreach ($r as $row) {
            $showing = new Showing($row['cinema_id'], $row['movie_id']);
            //region Extra reflection
            $reflectionClass = new ReflectionClass($showing);
            $reflectionProperty = $reflectionClass->getProperty('id');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($showing, $row['id']);
            //endregion
            $showings[] = $showing;
        }
        //var_dump($showings);
        return $showings;
    }

    /**
     * 
     * @param int $id
     * @return 
     */
    public function findBy($id) {
        $r = $this->connection->query("SELECT * FROM Showings WHERE id=" . $id)->fetch_assoc();
        $showing = new Showing($r['cinema_id'], $r['movie_id']);
        //region Extra reflection
        $reflectionClass = new ReflectionClass($showing);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($showing, $id);
        //endregion
        return $showing;
    }

    /**
     * 
     * @param Cinema $cinema
     * @return Movie[]
     */
    public function findCinemaShowings(Cinema $cinema) {
        $showings = array();
        $r = $this->connection->query("Select * FROM Showings where cinema_id=" . $cinema->getId());
        if ($r->num_rows > 0) {
            foreach ($r as $v) {
                $movieRepository = new MovieRepository($this->connection);
                $movie = $movieRepository->findBy($v['movie_id']);
                $showings[$v['id']] = $movie;
            }
            return $showings;
        }
        return false;
    }

    /**
     * 
     * @param Movie $movie
     * @return Cinema[]
     */
    public function findMovieShowings(Movie $movie) {
        $showings = array();
        $r = $this->connection->query("Select * FROM Showings where movie_id=" . $movie->getId());
        if ($r->num_rows > 0) {
            foreach ($r as $v) {
                $cinemaRepository = new CinemaRepository($this->connection);
                $cinema = $cinemaRepository->findBy($v['cinema_id']);
                $showings[$v['id']] = $cinema;
            }
            return $showings;
        }
        return false;
    }

}
