<?php
    include 'config.php';
    session_start();


    
    if(isset($_POST['login'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
     
        $select_admin = $conn->prepare("SELECT * FROM `users` WHERE name = ? AND password = ?");
        $select_admin->execute([$name, $pass]);
        $row = $select_admin->fetch(PDO::FETCH_ASSOC);
     
        if($select_admin->rowCount() > 0){
           $_SESSION['admin_id'] = $row['id'];
           header('location: personal');
        }else{
           $message[] = 'Incorrect username or password!';
        }
     
     }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajapson</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/views.css">
</head>
<body>
        <header class="header">

        <div id="menu-btn" class="fas fa-bars"></div>

        <a href="#" class="logo"> <span>Aja</span>Pson </a>

        <nav class="navbar">
            <a href="#home"></a>
            <a href="#about"></a>
            <a href="#experience"></a>
            <a href="#skills"></a>
            <a href="#projects"></a>
            <!-- <a href="#contact">Admin</a> -->
        </nav>

        <div id="login-btn">
            <i class="fas fa-seedling"></i>
        </div>
        </header> 


<!-- header end  -->

<section class="login" style="margin-top: 10rem;">
    <form action="" method="POST">
    <?php
            if(isset($message)){
                foreach($message as $msg){
                    echo '<div class="message">'.$msg.'</div>';
                }
            }
            ?>
        <h3>login admin</h3>
        <input type="text" class="box" placeholder="enter username" name="name">
        <input type="password" class="box" placeholder="enter password" name="pass">
        <input type="submit" class="btn" value="login" name="login">
    </form>

</section>


<style>
    .message{
        margin: 5px 0;
        width: 100%;
        border-radius: 5px;
        padding: 10px;
        text-align: center;
        background-color: var(--yellow);
        color: var(--black);
        font-size: 20px;
}
</style>
    
</body>
</html>