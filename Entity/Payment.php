<?php

class Payment {

    private $id;
    private $ticket_id;
    private $type;
    private $date;

    function __construct($ticket_id, $type, $date) {
        $this->id = null;
        $this->ticket_id = $ticket_id;
        $this->type = $type;
        $this->date = $date;
    }

    function getId() {
        return $this->id;
    }

    function getTicket_id() {
        return $this->ticket_id;
    }

    function getType() {
        return $this->type;
    }

    function getDate() {
        return $this->date;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setDate($date) {
        $this->date = $date;
    }

}
