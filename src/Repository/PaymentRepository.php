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
class PaymentRepository implements InterfaceRepository {

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
     * @param Payment $payment
     */
    public function add($payment) {
        $this->connection->insertSql("Payments", array('ticket_id', 'type', 'date'), array($payment->getTicket_id(), $payment->getType(), $payment->getDate()));
        $id = $this->connection->getLastInsertedId();

        //region Extra reflection
        $reflectionClass = new ReflectionClass($payment);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($payment, $id);
        //endregion
    }
    /**
     * 
     * @param Payment $payment
     */
    public function update($payment){
        $listOfValues['ticket_id']=$payment->getTicket_id();
        $listOfValues['type']=$payment->getType();
        $listOfValues['date']=$payment->getDate();
        $key=$payment->getId();
        $this->connection->updateSql("Kino", $listOfValues, $key);
    }
    /**
     * 
     * @param Payment $payment
     */
    public function delete($payment) {
        $this->connection->query("DELETE FROM Payments WHERE id=" . $payment->getId());
    }

    /**
     * 
     * @return array()
     */
    public function findAll() {
        $payments = array();
        $r = $this->connection->query("SELECT * FROM Payments");
        foreach ($r as $row) {
            $payment = new Payment($row['ticket_id'], $row['type'],$row['date']);
            //region Extra reflection
            $reflectionClass = new ReflectionClass($payment);
            $reflectionProperty = $reflectionClass->getProperty('id');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($payment, $row['id']);
            //endregion
            $payments[] = $payment;
        }
        return $payments;
    }

    /**
     * 
     * @param int $id
     * @return Payment
     */
    public function findBy($id) {
        $r = $this->connection->query("SELECT * FROM Payments WHERE id=" . $id)->fetch_assoc();
        $payment = new Payment($r['ticket_id'], $r['type'], $r['date']);
        //region Extra reflection
        $reflectionClass = new ReflectionClass($payment);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($payment, $id);
        //endregion
        return $payment;
    }

}
