<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registreerumis vorm</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <img src="0.webp">
      <h3>Registreeri nüüd</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <p>Nimi<sup>*</sup></p>
      <input type="text" name="name" required placeholder="Sisesta oma nimi">
      <p>Email<sup>*</sup></p>
      <input type="email" name="email" required placeholder="sisesta oma email">
      <p>Parool<sup>*</sup></p>
      <input type="password" name="password" required placeholder="sisesta oma parool">
      <p>Kinnita Parool<sup>*</sup></p>
      <input type="password" name="cpassword" required placeholder="kinnita oma parool">
      <p>Roll<sup>*</sup></p>
      <select name="user_type">
         <option value="user">Tava Kasutaja</option>
         <option value="admin">Adminn</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>On juba konto? <a href="login_form.php">Logi sisse!</a></p>
   </form>

</div>

</body>
</html>