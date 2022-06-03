<?php
// Include config file
require_once "../config/config.php";
 
// Define variables and initialize with empty values
$name = $latitude = $longitude = $totOxygen = $reqOxygen = $con1 = $con2 = "";
$name_err =  $latitude_err = $longitude_err = $totOxygen_err = $reqOxygen_err = $con1_err = $con2_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    // Get hidden input value
    $id = $_POST["id"];
     // Validate name
   // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    $input_latitude = trim($_POST["latitude"]);
    if(empty($input_latitude)){
        $latitude_err = "Please enter a latitude.";
    } elseif(!filter_var($input_latitude, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[1-9]\d*(\.\d+)?$/")))){
        $latitude_err = "Please enter a valid latitude.";
    } else{
        $latitude = $input_latitude;
    }

    $input_longitude = trim($_POST["longitude"]);
    if(empty($input_longitude )){
        $longitude_err = "Please enter a logitude.";
    } elseif(!filter_var($input_longitude , FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[1-9]\d*(\.\d+)?$/")))){
        $longitude_err = "Please enter a valid longitude.";
    } else{
        $longitude = $input_longitude ;
    }


    


              $input_con1 = trim($_POST["con1"]);
    if(empty($input_con1 )){
        $con1_err = "Please enter a contact number";
    } elseif(!filter_var($input_con1 , FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/")))){
        $con1_err = "Please enter a valid contact number";
    } else{
        $con1 = $input_con1 ;
    }

                $input_con2 = trim($_POST["con2"]);
    if(empty($input_con2 )){
        $con2_err = "Please enter second contact number";
    } elseif(!filter_var($input_con2 , FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/")))){
        $con2_err = "Please enter a vaild contact number";
    } else{
        $con2 = $input_con2 ;
    }
    // Check input errors before inserting in database
    if(empty($name_err) && empty($latitude_err) && empty($longitude_err) && empty($totOxygen_err) && empty($reqOxygen_err) && empty($con1_err) && empty($con2_err)){
        // Prepare an insert statement
        //$sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";
         $province=$_POST['province'];
          $level=$_POST['level'];
         $sql = "UPDATE location_tab SET locationLatitude ='$latitude', locationLongitude='$longitude', org_name='$name', contact1='$con1', contact2='$con2',
         province='$province',level='$level' WHere ID=$id";

        
            
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
                    $latitude = $row["locationLatitude"];
                    $longitude = $row["locationLongitude"];
                    $totOxygen = $row["totalOxygen"];
                    $reqOxygen = $row["requiredOxygen"];
                    $con1 = $row["contact1"];
                    $con2 = $row["contact2"];
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the hospital record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));  ?>" method="post">
                    <div style="display:none;">
                    <input type="text" name="id" class="form-control"  value="<?php echo $_GET['id']; ?>">
                           </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                         <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" name="latitude" class="form-control <?php echo (!empty($latitude_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $latitude; ?>">
                            <span class="invalid-feedback"><?php echo $latitude_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" name="longitude" class="form-control <?php echo (!empty($longitude_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $longitude; ?>">
                            <span class="invalid-feedback"><?php echo $longitude_err;?></span>
                        </div>
                        <div class="form-group">
                         <label for="province"   class="formlabel" style="margin-top: 9px;">Province</label>
                              <select id="province" name="province" class="selectbox">
                              <option value="1" selected>Province No. 1</option>
                              <option value="2">Province No. 2</option>
                              <option value="3">Bagmati Province</option>
                              <option value="4">Gandaki Province</option>
                              <option value="5">Lumbini Province</option>
                              <option value="6">Karnali Province</option>
                              <option value="7">Sudurpashchim Province</option>
                            </select>
                        </div>
                         <div class="form-group">
                         <label for="level"   class="formlabel" style="margin-top: 9px;">Hospital Level</label>
                              <select id="level" name="level" class="selectbox">
                              <option value="1" selected>1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                        </div>
                           <div class="form-group">
                            <label>Contact Number 1</label>
                            <input type="text" name="con1" class="form-control <?php echo (!empty($con1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $con1; ?>">
                            <span class="invalid-feedback"><?php echo $con1_err;?></span>
                        </div>
                           <div class="form-group">
                            <label>Contact Number 2</label>
                            <input type="text" name="con2" class="form-control <?php echo (!empty($con2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $con2; ?>">
                            <span class="invalid-feedback"><?php echo $con2_err;?></span>
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