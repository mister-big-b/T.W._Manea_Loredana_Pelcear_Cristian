<?php

require_once "../myAccount/config.php";
?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

    <title>SkVi</title>
</head>


<body>
    <header>
        <div class="wrapper">
            <div class="logo">
                <img src="../assets/logo.png" alt="">
            </div>
            <ul class="nav-area">
                <li><a href="../html/front_page.php">Home</a></li>
                <li><a href="../html/service.php">Services</a></li>
                <li><a href="../php/courses.php">Courses</a></li>
                <li><a href="../myAccount/login.php">Login</a></li>
                <li><a href="../html/about.php">About</a></li>
            </ul>
        </div>
    </header>

    <div class="welcome-text">
        <h1>
            We are <span>Skill Virtual Instructor</span></h1>
           


<?php

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]=== false) 
{ 
 
    ?>
    <a href="../myAccount/register.php">Register</a>


    <?php
 }
?>



        
    </div>

</body>

</html>