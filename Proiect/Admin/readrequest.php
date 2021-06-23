<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../myAccount/config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM request WHERE idRequest = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                // Retrieve individual field value
                $title = $row["title"];
                $text = $row["text"];
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    
     
    }
    // Close connection
    mysqli_close($link);
   
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="../css/style.css" />
    <style>
                   .wrapper{
            width: 600px;
            margin: 50px auto;
        }
        input[type=text],
input[type=password] {
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



/* The "Forgot password" text */

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
                    <h1 class="mt-6 mb-5">View Record</h1>
                    
                    <div class="form-group">
                        <label>Title</label>
                        <p><b><?php echo $row["title"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $row["text"]; ?></b></p>
                    </div>
                    

                    <p><a href="admin.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>