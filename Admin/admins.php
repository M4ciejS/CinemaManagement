<?php
require_once '../bootstrap.php';
session_start();
$pass="99999999";
$encode= password_hash($pass, PASSWORD_DEFAULT);
$sql="Insert into Administrators (login,password) values ('root','".$encode."')";
$connection->query($sql);
/* 
 * Made by M4ciej
 */

