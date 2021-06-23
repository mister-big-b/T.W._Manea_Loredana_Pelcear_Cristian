<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkiVi </title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="admin.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
 <style>
   .wrapper {
       margin: 0 auto;
       overflow-x: auto;
           }
   
   
    /* zebra striping */
   
   tbody tr:nth-child(odd) {
       background-color: #dee2e493;
   }
   
   tbody tr:nth-child(even) {
       background-color: #44c0f162;
   }
   
   table {
       background-color: #33e0ff48;
   }
   
   table tr td:last-child {
       width: 100px;
   }
   
   .sidebar {
       margin: 0;
       padding: 0;
       width: 200px;
       background-color: #f1f1f1;
       position: fixed;
       height: 100%;
       overflow: auto;
   }
   
   
   /* Sidebar links */
   
   .sidebar a {
       display: block;
       color: black;
       padding: 16px;
       text-decoration: none;
   }
   
   
   /* Active/current link */
   
   .sidebar a.active {
       background-color: #070707;
       color: white;
   }
   
   
   /* Links on mouse-over */
   
   .sidebar a:hover:not(.active, .search) {
       background-color: #555;
       color: white;
   }
   
   
   /* Page content. The value of the margin-left property should match the value of the sidebar's width property */
   
   div.content {
       margin-left: 200px;
       padding: 1px 16px;
       height: 1000px;
       width: 1000px;
   }
   
   body {
       font-family: Arail, sans-serif;
   }
   
   
   /* Formatting search box */
   
   .search-box {
       width: 170px;
       position: relative;
       display: display-inside;
       font-size: 14px;
   }
   
   .search-box input[type="text"] {
       height: 32px;
       padding: 5px 10px;
       border: 1px solid #CCCCCC;
       font-size: 14px;
   }
   
   .result {
       position: absolute;
       z-index: 999;
       top: 100%;
       left: 0;
   }
   
   .search-box input[type="text"],
   .result {
       width: 100%;
       box-sizing: border-box;
   }
   
   
   /* Formatting result items */
   
   .result p {
       margin: 0;
       padding: 7px 10px;
       border: 1px solid #CCCCCC;
       border-top: none;
       cursor: pointer;
   }
   
   .result p:hover {
       background: #f2f2f2;
   }
   
   .container-fluid {
       width: 1100px;
       overflow-x: auto;
   }
   
   
   /* On screens that are less than 700px wide, make the sidebar into a topbar */
   
   @media screen and (max-width: 1200px) {
       .container-fluid {
           width: 70%;
           overflow-x: auto;
       }
       
       
   }
   @media screen and (max-width: 700px) {
       .container-fluid {
           width: 400px;
           overflow-x: auto;
       }
       .sidebar {
           width: 100%;
           height: auto;
           position: relative;
       }
       .sidebar a {
           float: left;
       }
       div.content {
           margin-left: 0;
           overflow-x: auto;
       }
   }
   
   
   /* On screens that are less than 400px, display the bar vertically, instead of horizontally */
   
   @media screen and (max-width: 400px) {
       .sidebar a {
           text-align: center;
           float: none;
       }
   }
   
   @media screen and (max-width: 200px) {
       .sidebar a {
           text-align: center;
           float: none;
       }
   }
   
   
</style>


</head>
<script>

    
    $(document).ready(function() {
        $('.search-box input[type="text"]').on("keyup input", function() {
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("backend-search.php", {
                    term: inputVal
                }).done(function(data) {
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else {
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result p", function() {
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>


<body>


    <div class="sidebar">
        <li> </li><a class="active" href="../html/front_page.php">Site</a></li>
        <a href="#accounts">Accounts</a>
        <a href="#courses">Curses</a>
        <a href="#requests">Requests</a>
        <a href="#tutorials">Tutorials</a>
        <a href="#whowatched">Information</a>

        <a class="search">
            <div class="search-box">
                <input type="text" autocomplete="off" placeholder="Search in database..." />
                <div class="result"></div>

            </div>
        </a>

    </div>




    <!-- Page content -->
    <div class="content" id="accounts">

        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Accounts Details</h2>
                            <a href="createuser.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Users</a>
                        </div>
                        <?php
                        // Include config file
                        require_once "../myAccount/config.php";
                        // Attempt select query execution
                        $sql = "SELECT * FROM accounts";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table">';
                                    echo "<thead>";
                                        echo "<tr>";
                    
                                            echo "<th>#</th>";
                                            echo "<th>Name</th>";
                                            echo "<th>Email</th>";
                                            echo "<th>Password</th>";
                                            echo "<th>ProfilePhoto</th>";
                                            echo "<th>isAdmin</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['idAccount'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
                                        echo "<td>" . $row['profilePhoto'] . "</td>";
                                        echo "<td>" . $row['isAdmin'] . "</td>";
                                            echo "<td>";
                                                echo '<a href="readusers.php?id='. $row['idAccount'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a href="updateuser.php?id='. $row['idAccount'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pen"></span></a>';
                                                echo '<a href="deleteuser.php?id='. $row['idAccount'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                                // echo '<a href="uploadProfileImage.php?id='. $row['idAccount'] .'" title="Upload Image" data-toggle="tooltip"><span class="fa fa-upload"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
     
                        // // Close connection
                        // mysqli_close($link);
                        ?>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <div class="content" id="courses">
    <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Courses Details</h2>
                            <a href="createcourse.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Course</a>
                        </div>
                        <?php
                        // Include config file
                        require_once "../myAccount/config.php";
                        // Attempt select query execution
                        $sql = "SELECT * FROM courses";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table ">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Title</th>";
                                            echo "<th>Description</th>";
                                            echo "<th>Icon</th>";
                                            // echo "<th>Icon</th>";

                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['idCourse'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['icon'] . "</td>";
                                        // echo  "<td>" .'<img src="data:image/png;base64,'.$row['icon'] . '">'. "</td>";
                                        // echo "<td>" . $row['icon'] . "</td>";
                                    //    echo "<td>" .'<img src=' .$row['icon'] .'" width="100px" height="100px" >'. "</td>";
                                    //     echo "<td>" . '  <img src="icon/<?php echo $rows['icon'];  ' . "</td>";
                                            
                                    
                                            echo "<td>";
                                                echo '<a href="readcourse.php?id='. $row['idCourse'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a href="updatecourse.php?id='. $row['idCourse'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pen"></span></a>';
                                                echo '<a href="deletecours.php?id='. $row['idCourse'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
     
                        // // Close connection
                        // mysqli_close($link);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="content" id="requests">
    
    <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Requests list</h2>
                            <a href="createrequest.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Request/Ideea </a>
                        </div>
                        <?php
                        // Include config file
                        require_once "../myAccount/config.php";
                        // Attempt select query execution
                        $sql = "SELECT * FROM request";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table ">';
                                    echo "<thead>";
                                        echo "<tr>";
                    
                                            echo "<th>#</th>";
                                            echo "<th>Title</th>";
                                            echo "<th>Description</th>";
               
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['idRequest'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['text'] . "</td>";
                                      
                                       
                                            echo "<td>";
                                                echo '<a href="readrequest.php?id='. $row['idRequest'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a href="updaterequest.php?id='. $row['idRequest'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pen"></span></a>';
                                                echo '<a href="deleterequest.php?id='. $row['idRequest'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
     
                        // // Close connection
                        // mysqli_close($link);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>


    <div class="content" id="tutorials">
    
    <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Requests tutorials</h2>
                            <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Tutorial </a>
                        </div>
                        <?php
                        // Include config file
                        require_once "../myAccount/config.php";
                        // Attempt select query execution
                        $sql = "SELECT * FROM tutorials";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table ">';
                                    echo "<thead>";
                                        echo "<tr>";
                    
                                            echo "<th>#</th>";
                                            echo "<th>Link</th>";
                                            echo "<th>Name</th>";
                                            echo "<th>Description</th>";
                                            echo "<th>CourseType</th>";
                                            echo "<th>Icon</th>";
                                            
                                            
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['idTutorial'] . "</td>";
                                        echo "<td>" . $row['link'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['courseType'] . "</td>";
                                        echo "<td>" . $row['icon'] . "</td>";

                                        

                                        
                                        
                                      
                                       
                                            echo "<td>";
                                                echo '<a href="readtutorial.php?id='. $row['idTutorial'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a href="updatetutorial.php?id='. $row['idTutorial'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pen"></span></a>';
                                                echo '<a href="deletetutorial.php?id='. $row['idTutorial'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
     
                        // // Close connection
                        // mysqli_close($link);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
    <div class="content" id="whowatched">
    
    <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Information</h2>
                            
                        </div>
                        <?php
                        // Include config file
                        require_once "../myAccount/config.php";
                        // Attempt select query execution
                        $sql = "SELECT * FROM whowatched";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>idAccount</th>";
                                            echo "<th>reactions</th>";
                                            echo "<th>idTutorials</th>";
                                            
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . "</td>";
                                        echo "<td>" . $row['idAccount'] . "</td>";
                                        echo "<td>" . $row['reaction'] . "</td>";
                                        echo "<td>" . $row['idTutorials'] . "</td>";
                                      
                                            // echo "<td>";
                                            //     echo '<a href="read.php?id='. $row['idRequest'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            //     echo '<a href="update.php?id='. $row['idRequest'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pen"></span></a>';
                                            //     echo '<a href="delete.php?id='. $row['idRequest'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            // echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
     
                        // Close connection
                        mysqli_close($link);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>








</body>

</html>