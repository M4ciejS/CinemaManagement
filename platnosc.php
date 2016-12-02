<?php
session_start();
require_once 'bootstrap.php';
$action=0;
$ticketId=0;
if(MethodCheck::checkInputMethod("id")=="GET"){
    $action=1;
    $_SESSION['ticket_id']= trim($_GET['id']);
}
if(MethodCheck::checkInputMethod()=="POST"){
    $payment=new Payment($_SESSION['ticket_id'], trim($_POST['type']), date("Y-m-d"));
    $paymentRepository=new PaymentRepository($connection);
    $paymentRepository->add($payment);
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
        <title>Wybierz sposób płatności</title>
    </head>
    <body>
        <?php if(1==$action):?>
        <form action="platnosc.php" method="POST">
            <label>Wybierz sposób płatności</label><br/>
            <input type="checkbox" name="type" value="cash">Gotówka
            <input type="checkbox" name="type" value="card">Karta<br/>
            <input type="checkbox" name="type" value="Transfer">Przelew
            <input type="checkbox" name="type" value="other">Inny<br/>
            <input type="submit" value="Wybierz">
        </form>
        <?php elseif(2==$action):?>
        <h2>Płatność dokonana</h2>
        <a href="index.php">Powrót do strony głównej</a>
        <?php endif;?>
    </body>
</html>
