<?php
// Initialize the session
session_start();
 
// Check if the user is  logged in, if no then redirect him to login page
if((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] )=== false){
    header("location:../myAccount/login.php");
    exit;
}
// Include config file
require_once "../myAccount/config.php";
 
// Define variables and initialize with empty values
$title = $text= "";
$title_err =$text_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate title
    if(empty(trim($_POST["title"]))){
        $title_err = "Please write title.";     
    } else{
        $title= trim($_POST["title"]);
    }
    
    
 // Validate text
    if(empty($_POST["text"])){
        $text_err = "Please enter description.";     
    } else{
        $text= ($_POST["text"]);
    }

    // Check input errors before inserting in database
    if(empty($title_err) && empty($text_err)  ){
        
        // Prepare an insert statement
        $sql = "INSERT INTO request (title,text) VALUES (?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_title, $param_text);
            
            $param_title = $title;
            $param_text=$text;
    
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to request page
                header("location: request.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>











<!DOCTYPE html>

<html lang="en">

<head>
    <title>SkVi</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/loginstyle.css">
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
    <div class="login">

    <h2>Request</h2>
        <p>write a request.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
       

       <div class="form-group">
       <label for="title"><b>Title</b></label>
           <input type="text" placeholder="Enter Title" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
           
           <span class="invalid-feedback"><?php echo $title_err; ?></span>
       </div>    
       <div class="form-group">
       <label for="text"><b>Description</b></label>
           <input type="text" placeholder="Enter Description" name="text" class="form-control <?php echo (!empty($text_err)) ? 'is-invalid' : ''; ?>">
           <span class="invalid-feedback"><?php echo $text_err; ?></span>
       </div>
       <div class="form-group">
       <button type="submit">Send</button>
       
       </div>
      
    

       
   </form>
    </div>

</body>





</html>