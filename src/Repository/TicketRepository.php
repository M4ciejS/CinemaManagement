<?php
namespace M4ciej\CinemaManagement\Repository;
/*
 * Made by M4ciej
 */

/**
 * Description of TicketRepository
 *
 * @author m4ciej
 */
class TicketRepository implements InterfaceRepository {

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
     * @param Ticket $ticket
     */
    public function add($ticket) {
        $this->connection->insertSql("Tickets", array('showing_id', 'quantity', 'price'), array($ticket->getShowing_id(), $ticket->getQuantity(), $ticket->getPrice()));
        $id = $this->connection->getLastInsertedId();

        //region Extra reflection
        $reflectionClass = new ReflectionClass($ticket);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($ticket, $id);
        //endregion
    }

    /**
     * 
     * @param Ticket $ticket
     */
    public function delete($ticket) {
        try {
            $this->connection->query("DELETE FROM Tickets WHERE id=" . $ticket->getId());
        } catch (Exception $e) {
            echo "Blad:" . $e->getMessage();
        }
    }

    /**
     * 
     * @return array()
     */
    public function findAll() {
        $tickets = array();
        $r = $this->connection->query("SELECT * FROM Tickets");
        foreach ($r as $row) {
            $ticket = new Ticket($row['showing_id'], $row['quantity'], $row['price']);
            //region Extra reflection
            $reflectionClass = new ReflectionClass($ticket);
            $reflectionProperty = $reflectionClass->getProperty('id');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($ticket, $row['id']);
            //endregion
            $tickets[] = $ticket;
        }
        return $tickets;
    }

    /**
     * 
     * @param int $id
     * @return Ticket
     */
    public function findBy($id) {
        $r = $this->connection->query("SELECT * FROM Tickets WHERE id=" . $id)->fetch_assoc();
        $ticket = new Ticket($r['id'], $r['quantity'], $r['price']);
        //region Extra reflection
        $reflectionClass = new ReflectionClass($ticket);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($ticket, $id);
        //endregion
        return $ticket;
    }

}
