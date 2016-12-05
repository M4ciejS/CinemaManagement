<?php
namespace M4ciej\CinemaManagement\Entity;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Cinema {

    private $id;
    private $name;
    private $address;

    function __construct($name="", $address="") {
        $this->id = null;
        $this->name = $name;
        $this->address = $address;
    }
    public function __toString() {
        return $this->name.' '.$this->address;
    }
            function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getAddress() {
        return $this->address;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setAddress($address) {
        $this->address = $address;
    }

}
