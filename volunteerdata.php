
<?php
   include('config/config.php');
   echo "hi";
$name =$phone = $email = $currentAddress=  $gender=$age= $blood= $transport="";

 $name_err =$phone_err = $email_err = $currentAddress_err= "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate name
    $input_name = mysqli_real_escape_string($db,trim($_POST["name"]));
   
    $name = $input_name;

    
    $input_phone = mysqli_real_escape_string($db,trim($_POST["phone"]));
   
    $phone = $input_phone;


    $input_email = mysqli_real_escape_string($db,trim($_POST["email"]));
   
    $email = $input_email ;


    $input_currentAddress = mysqli_real_escape_string($db,trim($_POST["currentAddress"]));
  
    $currentAddress = $input_currentAddress ;
    $gender=mysqli_real_escape_string($db,$_POST['gender']);
     $age=mysqli_real_escape_string($db,$_POST['age']);
     $blood=mysqli_real_escape_string($db,$_POST['blood']);
     $transport=mysqli_real_escape_string($db,$_POST['transport']);
echo $gender;


$sql = "INSERT INTO volunteer (name, phone, email, address, gender, age,blood,transport) VALUES
         ('$name', '$phone', '$email',  '$currentAddress','$gender', '$age','$blood','$transport')";

        
            
            // Attempt to execute the prepared statement
           if (mysqli_query($db, $sql)) {
  echo "New record created successfully";
  header("Location: index.php?msg=added");
                    exit();
}  else{
                echo "Oops! Something went wrong. Please try again later.". $db-> error;
            }
        
         
        // Close statement
    mysqli_close($db);
    
    
    // Close connection
   }
?>
