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
    <link rel="stylesheet" href="../css/coursesstyle.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
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

</body>

    <div class="container">
        <div class="details">
            <h2>Tutorials</h2>

        </div>
       
        <div class="main-box">
            <?php
                $idTut = $_GET['tutorial'];

                $query = 'SELECT idTutorial,name,description,icon,link
                FROM tutorials 
                WHERE idTutorial = '.$idTut.'
                ORDER BY idTutorial';
                 $result = mysqli_query($con, $query);
                 if (!$result)
                {
                    echo 'Error Message: ' . mysqli_error($con) . '<br>';
                    exit;
                }                
    
                 // Output the record using if statements and echo
                 while ($record = mysqli_fetch_assoc($result))
                 {
                 echo '<div class="box box-grey">'.
                 "Title:  " . $record['name'] . "<br />" .'<hr>'.
                 "Description:  " . $record['description'] . "<br />" .'<hr>'.
                 "Link:  " . $record['link'] . "<br />" .'<hr>'.
                 '<img class="temeplate_imagine" src="../photos/'.$record['icon'].'"  >'.
                 '</div>';
                 }
                
            ?>
        </div>
    </div>

</body>

</html>