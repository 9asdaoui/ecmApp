<?php 
session_start();

if (!isset($_SESSION["userid"])||$_SESSION["role"]!=="client"||$_SESSION["is_active"]!==1) {
    if($_SESSION["is_active"]==0){
        header("location:../401.html");
    }else{
        header("location:../log_in.php");}
}else{
    $user_id = $_SESSION["userid"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Navbar with Sidebar</title>
  <link href="style.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

  <nav class="navbar">
    <div class="burger-menu" onclick="toggleSidebar()">
      <i class="fas fa-bars"></i>
        <div class="logo">
      <img src="sm.png" alt="Brand Logo">
      <span class="brand-name">artify</span>
    </div>
    </div>
  
    <div class="search-container">
      <input type="text" placeholder="Search..." class="search-bar">
      <button class="search-button"><i class="fas fa-search"></i></button>
    </div>
  </nav>

  <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="close-btn" onclick="closeSidebar()">&times;</a>
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="orders.php"><i class="fas fa-box"></i> Orders</a>
    <a href="cart.php" ><i class="fas fa-shopping-cart"></i> Cart</a>
    <a href="../log_in.php?logout=1"><i class="fa fa-sign-in"></i> Logout</a>
    <a href="#"><i class="fa fa-cog"></i> Settings</a>
  </div>