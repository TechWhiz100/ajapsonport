<?php

include 'config.php';

// session_start();

// if(!isset($admin_id)){
//    header('location: login');
// }

// $admin_id = $_SESSION['admin_id'];

// if(!isset($admin_id)){
//    header('location: login');
// };





// $admin_id = $_SESSION['admin_id'];



if(isset($_POST['register'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `users` WHERE name = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $message[] = 'username already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `users`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $message[] = 'new admin registered successfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css"> -->

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>


<header class="header">

<section class="flex">

   <a href="admin.php" class="logo"><img src="images/logo.png" alt=""></a>

   <nav class="navbar">
      <ul>
          <!-- <li><a href="#home">home</a></li>
          <li><a href="">about us <i class="fa fa-caret-down" aria-hidden="true"></i>   </a>
              <ul>
                  <li><a href="../teams.html">our teams</a></li>
                  <li><a href="../services.html">our services</a></li>
              </ul> -->
          </li>
          <!-- <li><a href="#">messages</a></li> -->
      </ul>
  </nav>

</section>
</header>


<section class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" class="btn" name="register">
   </form>

</section>


<script src="js/admin_script.js"></script>

</body>
</html>