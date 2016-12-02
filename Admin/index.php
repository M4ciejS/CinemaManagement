<?php
require_once '../bootstrap.php';
session_start();
/**
 * @param Connection $connection Description
 */
if(MethodCheck::checkInputMethod("wyloguj")){
    unset($_SESSION['logged']);
    unset($_SESSION['user']);
}
if (MethodCheck::checkInputMethod("login") == "POST") {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $result = $connection->query("SELECT password FROM Administratorzy WHERE login='root'");
    if ($result->num_rows > 0) {
        $r=$result->fetch_assoc();
        if (password_verify($password, $r['password'])) {
            $_SESSION['logged']=true;
            $_SESSION['user']=$login;
        }
    }
}
?>
<!DOCTYPE html>
<!--
Made by M4ciej
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Panel Administracyjny</title>
    </head>
    <body>
        <?php if((!isset($_SESSION['logged']))||($_SESSION['logged']==false)):?>
        <form method="POST" action="index.php">
            <label>Login</label>
            <input type="text" name="login"/><br/>
            <label>Password</label>
            <input type="password" name="password"/><br/>
            <input type="submit" value="Zaloguj się"/>
        </form>
        <?php else:?>
        <h2>Zarządzanie</h2>
        <ol>
            <li><a href="admin.php">Zarządzanie administratorami</a></li>
            <li><a href="kina.php">Zarządzanie Kinami</a></li>
            <li><a href="filmy.php">Zarządzanie Filmami</a></li>
            <li><a href="platnosci.php">Zarządzanie Płatnościami</a></li>
            <li><a href="index.php?wyloguj=true">Wyloguj się</a></li>
        </ol>
        <?php endif;?>
    </body>
</html>
