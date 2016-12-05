<?php
namespace M4ciej\CinemaManagement\Entity;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Movie {

    private $id;
    private $name;
    private $description;
    private $rating;

    function __construct($name="", $description="", $rating=0) {
        $this->id=null;
        $this->name = $name;
        $this->description = $description;
        $this->rating = $rating;
    }
    public function __toString() {
        return $this->name;
    }
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getRating() {
        return $this->rating;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setRating($rating) {
        $this->rating = $rating;
    }

}
