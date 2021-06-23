
<?php
// Include config file
require_once "../myAccount/config.php";
    
 
// Define variables and initialize with empty values
$link1 = $name =$description=$courseType =$icon="";
$link1_err = $name_err =$description_err=$courseType_err =$icon_err="";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
   // Validate link
   if(empty(trim($_POST["link"]))){
    $link1_err = "Please enter a link1.";     
} else{
    $link1 = trim($_POST["link"]);
}
   
    // Validate description
    if(empty(trim($_POST["description"]))){
        $description_err = "Please enter a description.";     

    } else{
        $description = trim($_POST["description"]);
    }
    
     // Validate text
     if(empty(trim($_POST["icon"]))){
        $icon_err = "Please enter a icon.";     
    } else{
        $icon = trim($_POST["icon"]);
    }

    if(empty(trim($_POST["courseType"]))){
        $courseType_err = "Please enter a courseType.";     
    } else{
        $icon = trim($_POST["courseType"]);
    }
    


    
    // Check input errors before inserting in database
    if(empty($link1_err)  && empty($name_err) && empty($description_err) && empty($courseType_err) && empty($icon_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tutorials (link,name,description,courseType,icon) VALUES ( ?, ?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_link, $param_name,$param_description,$param_courseType,$param_icon);
            
            // Set parameters
            $param_link = $link1;
            $param_description = $description;
            $param_name = $name;
            $param_description = $description;
            $param_courseType = $courseType;
            
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
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Link</label>
                            <input type="text" name="link" class="form-control <?php echo (!empty($link1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $link1; ?>">
                            <span class="invalid-feedback"><?php echo $link1_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>


                        <div class="form-group">
                        <label>Description</label>
                            <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>CourseType</label>
                            <input type="text" name="courseType" class="form-control <?php echo (!empty($courseType_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $courseType; ?>">
                            <span class="invalid-feedback"><?php echo $courseType_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>IconName.type</label>
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