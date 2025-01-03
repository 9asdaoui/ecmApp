<?php 
session_start();

if (!isset($_SESSION["userid"])||$_SESSION["role"]!=="client") {
header("location:../log_in.php");
exit();
}else{
    echo 'you hae the acces';
}
?>