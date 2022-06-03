<?php
// Include config file
require_once "../config/config.php";
 
// Define variables and initialize with empty values
 $name=$totOxygen = $reqOxygen  ="";
 $totOxygen_err = $reqOxygen_err =$remarks   ="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    // Get hidden input value
    $id = $_POST["id"];
     $remarks=mysqli_real_escape_string($db,$_POST["remarks"]);
    
    $input_totOxygen = trim($_POST["totOxygen"]);
    if(empty($input_totOxygen)){
        $totOxygen_err = "Please enter Total Oxygen.";
    } elseif(!filter_var($input_totOxygen, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/")))){
        $totOxygen_err = "Please enter a valid totalOxygen in litres.";
    } else{
        $totOxygen = $input_totOxygen;
    }



          $input_reqOxygen = trim($_POST["reqOxygen"]);
    if(empty($input_reqOxygen)){
        $reqOxygen_err = "Please enter req .";
    } elseif(!filter_var($input_reqOxygen, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^-?[0-9]*$/")))){
        $reqOxygen_err = "Please enter a valid exlessOxygenn in litres.";
    } else{
        $reqOxygen = $input_reqOxygen;
    }

    // Check input errors before inserting in database
    if(empty($totOxygen_err) && empty($reqOxygen_err)) {
        // Prepare an insert statement
        //$sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";
         $exlessOxygen=$totOxygen-$reqOxygen;
         $sql = "UPDATE location_tab SET totalOxygen='$totOxygen',exlessOxygen='$exlessOxygen',requiredOxygen= '$reqOxygen' WHere ID=$id";
        
        
$sq2 = "INSERT INTO oxygenupdatehistory (hospitalid, remarks, demandedOxygen, totalOxygen, exlessOxygen ) VALUES($id, '$remarks','$reqOxygen','$totOxygen','$exlessOxygen')";

        
            
            // Attempt to execute the prepared statement
           if (mysqli_query($db, $sq2)) {
  echo "New record created successfully";
}
            // Attempt to execute the prepared statement
           if (mysqli_query($db, $sql)) {
  echo "Data Updated Sucecssfully";
   header("location: index.php");
                    exit();
}  else{
                echo  $db-> error;
            }
        
         
        // Close statement
    mysqli_close($db);
    }
    
    // Close connection
   
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM location_tab WHERE id = ?";
        if($stmt = mysqli_prepare($db, $sql)){
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
                    $name = $row["org_name"];
                    $totOxygen = $row["totalOxygen"];
                    $reqOxygen = $row["requiredOxygen"];
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($db);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Oxygen Record for <?php echo $name;?></h2>
                    <p>Please edit the input values and submit to update the Oxygen record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));  ?>" method="post">
                    <div style="display:none;">
                    <input type="text" name="id" class="form-control"  value="<?php echo $_GET['id']; ?>">
                           </div>
                        <div class="form-group">
                            <label>Available Oxygen</label>
                            <input type="text" name="totOxygen" class="form-control <?php echo (!empty($totOxygen_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $totOxygen; ?>">
                            <span class="invalid-feedback"><?php echo $totOxygen_err;?></span>
                        </div>
                         <div class="form-group">
                            <label>Oxygen Required</label>
                            <input type="text" name="reqOxygen" class="form-control <?php echo (!empty($reqOxygen_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $reqOxygen ?>">
                            <span class="invalid-feedback"><?php echo $reqOxygen_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                            <input type="text" name="remarks" class="form-control" value="<?php echo $remarks ?>">
                            
                        </div>   
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>