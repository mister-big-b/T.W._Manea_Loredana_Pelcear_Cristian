<?php
// Include config file
require_once "../myAccount/config.php";
    
 
// Define variables and initialize with empty values
$title = $description=$icon  ="";
$title_err = $description_err =$icon_err="";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate title
   // Validate name
   $input_title = trim($_POST["title"]);
   if(empty($input_title)){
       $title_err = "Please enter title.";
   } elseif(!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
       $title_err = "Please enter a valid title.";
   } else{
       $title = $input_title;
   }

    // description



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




//iAdmin



    
    // Check input errors before inserting in database
    if(empty($title_err) && empty($description_err) && empty($icon_err)){
        // Prepare an update statement
        $sql = "UPDATE courses SET title=?, description=? ,icon=?  WHERE idCourse=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_title, $param_description, $param_icon ,$param_id);
            
            // Set parameters
            $param_title = $title;
            $param_description = $description;
            $param_icon = $icon;
            $param_id = $id;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location:admin.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
    
       
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM courses WHERE idCourse= ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $title = $row["title"];
                    $description = $row["description"];
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location:error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="../css/style.css" />
    
    <style>
               .wrapper{
            width: 600px;
            margin: 50px auto;
        }
        input[type=text],
input[type=icon] {
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



/* The "Forgot icon" text */

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
                    <h2 class="mt-6">Update Record</h2>
                    <p>Please edit the input values and submit to update the courses record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                            <label>IconNama.Type</label>
                            <input type="text" name="icon" class="form-control <?php echo (!empty($icon_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $icon; ?>">

                            <span class="invalid-feedback"><?php echo $icon_err;?></span>
                        </div>
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>