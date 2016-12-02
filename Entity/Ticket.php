<?php
class Ticket{
    private $id;
    private $showing_id;
    private $quantity;
    private $price;
    function __construct($showing_id, $quantity, $price) {
        $this->id = null;
        $this->showing_id = $showing_id;
        $this->quantity = $quantity;
        $this->price = $price;
    }
    function getId() {
        return $this->id;
    }

    function getShowing_id() {
        return $this->showing_id;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getPrice() {
        return $this->price;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setShowing_id($showing_id) {
        $this->showing_id = $showing_id;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setPrice($price) {
        $this->price = $price;
    }



}

