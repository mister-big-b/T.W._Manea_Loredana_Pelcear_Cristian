<?php
// Include config file
require_once "../myAccount/config.php";
    
 
// Define variables and initialize with empty values
$title = $description=$icon  ="";
$title_err = $description_err =$icon_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title.";
    } elseif(!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $title_err = "Please enter a valid title.";
    } else{
        $title = $input_title;
    }
   
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter an description.";     
    } else{
        $description = $input_description;
    }

  
    $input_icon = trim($_POST["icon"]);
    if(empty($input_description)){
        $description_err = "icon name.";     
    } else{
        $description = $input_description;
    }

    
   // Check input errors before inserting in database
   if(empty($title_err)  && empty($text_err)&& empty($icon_err)){
    // Prepare an insert statement
    $sql = "INSERT INTO courses (title,  text,icon) VALUES ( ?, ?,?)";
     
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sss", $param_title,   $param_description , $param_icon);
        
        // Set parameters
        $param_title = $title;
        $param_description = $description;
        $param_icon = $icon;
      
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records created successfully. Redirect to landing page
            header("location: admin.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Record</title>
<link rel="stylesheet" href="../css/style.css" />

<style>
    .wrapper{
        width: 600px;
        margin: 50px auto;
    }
    input[type=text],
input[type=text] {
width: 100%;
padding: 15px 2px;
margin: 12px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
position: relative;
}


/* Set a style for all buttons */

button {
background-color: #04AA6D;
color: white;
padding: 10px 20px;
margin: auto;
border: none;
cursor: pointer;
width: 100%;
position: relative;
float: none;
}


/* Add a hover effect for buttons */

button:hover {
opacity: 0.8;
}


/* Extra style for the cancel button (red) */

.cancelbtn {
width: 100%;
padding: 10px 20px;
background-color: #f44336;
}



/* The "Forgot text" text */

span.psw {
float: inline-start;
padding-top: 20px;
}


/* Change styles for span and cancel button on extra small screens */

@media screen and (max-width: 1200px) {
.login {
    width: 50%;
    height: 20vh;
}
span.psw {
    display: inline;
    float: inherit;
}
.cancelbtn {
    width: 100%;
}
.wrapper{
    width: 50%;
}

}




</style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Create Record</h2>
                <p>Please fill this form and submit to add cousesrecord to the database.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                        <span class="invalid-feedback"><?php echo $title_err;?></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                        <span class="invalid-feedback"><?php echo $description_err;?></span>
                    </div>

                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" name="icon" class="form-control <?php echo (!empty($icon_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $icon; ?>">
                        <span class="invalid-feedback"><?php echo $icon_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="admin.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>        
    </div>
</div>
</body>
</html>