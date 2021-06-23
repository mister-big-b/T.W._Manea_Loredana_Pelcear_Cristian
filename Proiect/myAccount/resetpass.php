<?php
// Initialize the session
session_start();
 
// // Check if the user is logged in, otherwise redirect to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: ../myAccount/login.php");
//     exit;
// }


if((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] )=== false){
    header("location:../myAccount/login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE accounts SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: ../myAccount/login.php");
                exit();
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
    <meta charset="UTF-8">
    <title>SkVi</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/registerstyle.css">
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


       

<div class="register">

        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
    <div class="form-group">
            <label for="psw"><b> New Password</b></label>
                <input type="password" placeholder="Enter  new password" name="new_password" class="form-control
                 <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
     </div>
            

        <div class="form-group">
            <label for="psw-repeat"><b>Confirm Password</b></label>
                <input type="password" placeholder="Repet new  password" name="confirm_password" class="form-control 
                <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            

        <div class="form-group">
            <div class="clearfix">
                    <button type="submit" class="signupbtn">Submit</button>
                    
                </div>
                <span class="psw">Back to <a href="login.php">login.</a></span>
            </div>

            <!-- <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="../html/front_page.php">Cancel</a>
            </div> -->
            </form>
    </div>    
</body>
</html>