<?php

/*
 * Made by M4ciej
 */

/**
 * Description of Showing
 *
 * @author m4ciej
 */
class Showing {

    private $id;
    private $cinema_id;
    private $movie_id;
    /**
     * 
     * @param int $cinema_id
     * @param int $movie_id
     */
    function __construct($cinema_id=0, $movie_id=0) {
        $this->id = null;
        $this->cinema_id = $cinema_id;
        $this->movie_id = $movie_id;
    }
    /**
     * 
     * @return int
     */
    function getCinema_id() {
        return $this->cinema_id;
    }
    /**
     * 
     * @return int
     */
    function getMovie_id() {
        return $this->movie_id;
    }
    /**
     * 
     * @param int $cinema_id
     */
    function setCinema_id(int $cinema_id) {
        $this->cinema_id = $cinema_id;
    }
    /**
     * 
     * @param int $movie_id
     */
    function setMovie_id($movie_id) {
        $this->movie_id = $movie_id;
    }
    /**
     * 
     * @return int
     */
    function getId() {
        return $this->id;
    }

}
