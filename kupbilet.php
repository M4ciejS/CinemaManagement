<?php
session_start();
require_once 'bootstrap.php';
$ticket=null;
$action=0;
if(MethodCheck::checkInputMethod()=="GET"){
    if(isset($_GET['id'])){
        $_SESSION['showing_id']=trim($_GET['id']);
        $action=1;
    }
}else if((MethodCheck::checkInputMethod()=="POST")&&(isset($_SESSION['showing_id']))){
    $ticketRepository=new TicketRepository($connection);
    $ticket=new Ticket($_SESSION['showing_id'], $_POST['quantity'], $_POST['price']);
    $ticketRepository->add($ticket);
    $action=2;
}
?>
<!DOCTYPE html>
<!--
Made by M4ciej
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kup Bilet</title>
    </head>
    <body>
        <?php if($action==1):?>
        <form name='kupbilet' method='POST' action='kupbilet.php'>
            <label>Podaj ilość</label>
            <input type='number' name='quantity' min='1' step='1'/><br/>
            <label>Podaj cenę:</label>
            <input type='number' name='price' min='1' step='0.5'/><br/>
            <input type='submit' value='Kup bilet'/>
        </form>
        <?php elseif($action==2):?>
        <h2>Bilet zerezerwowany</h2>
        <a href="platnosc.php?id=<?php echo $ticket->getId();?>">Zapłać za bilet</a>
        <?php endif;?>
    </body>
</html>
