<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../myAccount/config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM tutorials WHERE idTutorial = ?";
    
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
                $description = $row["description"];
                $icon =  $row['icon'] ;
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location:error.php");
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
            margin: 0 auto;
        }
        .image_ceva{
            width: 600px;
            height: 600px;
        }
.form-image{
    width: 600px;
            height: 600px;
}
@media screen and (max-width: 1200px) {
    .wrapper{
        width: 100%;
        margin: 0 auto;
    }
    form-image{
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
                        <p><b><?php echo $row["description"]; ?></b></p>
                    </div>
                   
                    <div class="form-image">
                        <label>Icon</label>
                        <!-- <img src="php echo $icon; >" width="200px" height="200px"    > -->
                       <div class=image_ceva>
                     <!-- <img src="<?php echo $row['icon'];?> "> -->
                   <?php  echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['icon'] ).'"/>'; ?>
                       </div>
                      
                    </div>

                    <p><a href="../Admin/admin.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>