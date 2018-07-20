<?php
if(!isset($_SESSION))
    {
        session_start();
    }


$db=new PDO("mysql:host=localhost;dbname=id5705848_todo",'id5705848_assign4','assign4');

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}

?>
