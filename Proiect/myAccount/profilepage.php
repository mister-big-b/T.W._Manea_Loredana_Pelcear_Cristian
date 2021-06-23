<?php
session_start();
include "../myAccount/database.php";
$con = BD::get_con();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkiVi </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/style.css">
    <!-- -->
    <link rel="stylesheet" href="../css/profilstyle.css">

</head>

<body>
    <header>

        <div class="user">
            <!-- <img src="../assets/logo.png" alt=""> -->
           <?php 
                $user = $_SESSION['username'];
                // $user = lcfirst($user);
               
                $query = 'SELECT profilePhoto, username
                FROM accounts 
                WHERE username LIKE "'.$user.'" ';


                 $result = mysqli_query($con, $query);
                 if (!$result)
                {
                    echo 'Error Message: ' . mysqli_error($con) . '<br>';
                    exit;
                } 
            while ($record = mysqli_fetch_assoc($result))
                 {
                    echo '<img class="temeplate_imagine" src="../photos/'.$record['profilePhoto'].'"  >';
                 }
                 
                 ?>
            <h3 class="name"> USER</h3>
            <p class="post"> utilizator </p>
        </div>

        <nav class="navbar">
            <ul>
                <li><a href="#home">home</a></li>
                <li><a href="#about">about</a></li>
                <li><a href="#watched">watched tutorials</a></li>
                <li><a href="#portofolio">uploads</a></li>
                <li><a href="#contact">contact</a></li>
                <li><a href="../html/front_page.php">Back to Site</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>




    <section class="home" id="home">

        <h3>HI THERE !</h3>
        <h1>I'M <span>Mr Whatson</span></h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio deserunt aspernatur fugiat minus enim ullam repudiandae sint sed magnam tenetur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, at.
        </p>
        <a href="#about"><button class="btn">about me <i class="fas fa-user"></i></button></a>

    </section>

    <!-- about section starts  -->

    <section class="about" id="about">

        <h1 class="heading"> <span>about</span> me </h1>

        <div class="row">

            <div class="info">
                <h3> <span> name : </span> mr whatson </h3>
                <h3> <span> age : </span> 20 </h3>
                <h3> <span> role : </span> user </h3>
                <h3> <span> language : </span> en </h3>
                <a href="#"><button class="btn"> download info <i class="fas fa-download"></i> </button></a>
            </div>

            <div class="counter">

                <div class="box">
                    <span>2+</span>
                    <h3>years of experience</h3>
                </div>

                <div class="box">
                    <span>100+</span>
                    <h3>tutorials uploaded </h3>
                </div>

                <div class="box">
                    <span>430+</span>
                    <h3>watched videos</h3>
                </div>

                <div class="box">
                    <span>12+</span>
                    <h3>medals won</h3>
                </div>

            </div>

        </div>

    </section>


    <!-- watched section starts  -->

    <section class="watched" id="watched">

        <h1 class="heading"> list of my <span>watched tutorials</span> </h1>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-graduation-cap"></i>
                <span>2016</span>
                <h3>tutorial 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quos alias praesentium. Id autem provident laborum quae, distinctio eaque temporibus!</p>
            </div>

            <div class="box">
                <i class="fas fa-graduation-cap"></i>
                <span>2017</span>
                <h3>tutorial 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quos alias praesentium. Id autem provident laborum quae, distinctio eaque temporibus!</p>
            </div>

            <div class="box">
                <i class="fas fa-graduation-cap"></i>
                <span>2018</span>
                <h3>tutorial 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quos alias praesentium. Id autem provident laborum quae, distinctio eaque temporibus!</p>
            </div>

            <div class="box">
                <i class="fas fa-graduation-cap"></i>
                <span>2019</span>
                <h3>tutorial 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quos alias praesentium. Id autem provident laborum quae, distinctio eaque temporibus!</p>
            </div>

            <div class="box">
                <i class="fas fa-graduation-cap"></i>
                <span>2020</span>
                <h3>tutorial 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quos alias praesentium. Id autem provident laborum quae, distinctio eaque temporibus!</p>
            </div>

            <div class="box">
                <i class="fas fa-graduation-cap"></i>
                <span>2021</span>
                <h3>tutorial 1</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quos alias praesentium. Id autem provident laborum quae, distinctio eaque temporibus!</p>
            </div>

        </div>

    </section>

    <!-- watched section ends -->
    <!-- uploads section starts  -->

    <section class="uploads" id="uploads">

        <h1 class="heading"> <span>uploads</span> </h1>

        <div class="box-container">

            <div class="box">
                <img src="../assets/icon.png" alt="">
            </div>

            <div class="box">
                <img src="../assets/icon.png" alt="">
            </div>

            <div class="box">
                <img src="../assets/icon.png" alt="">
            </div>

            <div class="box">
                <img src="../assets/icon.png" alt="">
            </div>

            <div class="box">
                <img src="../assets/icon.png" alt="">
            </div>

            <div class="box">
                <img src="../assets/icon.png" alt="">
            </div>

        </div>

    </section>

    <!-- uploads section ends -->


    <!-- contact section starts  -->

    <section class="contact" id="contact">

        <h1 class="heading"> <span>contact</span> me </h1>

        <div class="row">

            <div class="content">

                <h3 class="title">contact info</h3>

                <div class="info">
                    <h3> <i class="fas fa-envelope"></i> mr_whatson@gmail.com </h3>
                    <h3> <i class="fas fa-phone"></i> +123-456-7890 </h3>
                    <h3> <i class="fas fa-phone"></i> +111-222-3333 </h3>
                    <h3> <i class="fas fa-map-marker-alt"></i> mumbai, india - 400104. </h3>
                </div>

            </div>

            <form action="">

                <input type="text" placeholder="name" class="box">
                <input type="email" placeholder="email" class="box">
                <input type="text" placeholder="project" class="box">
                <textarea name="" id="" cols="30" rows="10" class="box message" placeholder="message"></textarea>
                <button type="submit" class="btn"> send <i class="fas fa-paper-plane"></i> </button>

            </form>

        </div>

    </section>

    <!-- contact section ends -->


    <!-- scroll top button  -->

    <a href="../html/front_page.html"> <button type="submit" class="btn"> back to site <i class="fas fa-paper-plane"></i> </button></a>




</body>

</html>