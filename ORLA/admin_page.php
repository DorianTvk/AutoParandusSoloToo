<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Leht</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3><span>ADMIN</span></h3>
      
      <p>- - - -</p>
      <a href="logout.php" class="btn">Logi välja</a>
      <a href="admin_manage_bookings.php" class="btn">Broneeringud</a>
      <a href="lisateenus.php" class="btn">Lisa uus teenus</a>
      <a href="teenused.php" class="btn">Teenused</a>
      <a href="admin_manage_users.php" class="btn">Kasutajad</a>




   </div>

</div>

</body>
</html>