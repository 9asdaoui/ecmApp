<?php 
session_start();

if (!isset($_SESSION["userid"])||$_SESSION["role"]!=="client"||$_SESSION["is_active"]!==1) {
    if($_SESSION["is_active"]==0){
        header("location:../401.html");
    }else{
        header("location:../log_in.php");}
exit();
}else{
    echo 'you hae the acces';
}
?>