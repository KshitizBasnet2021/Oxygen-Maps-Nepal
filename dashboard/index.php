<?php
 // Include config file
    include('../config/session.php');
    

    $coordinates = array();
    $latitudes = array();
    $longitudes = array();
    $organization = array();
    $totaloxygen = array();
    $reqoxygen = array();
    $con1 = array();
    $con2 = array();

    // Select all the rows in the markers table
    $query = "SELECT * FROM `location_tab` where hide=1";
    $result = $db->query($query) or die('data selection for google map failed: ' . $mysqli->error);

    while ($row = mysqli_fetch_array($result)) {

        $latitudes[] = $row['locationLatitude'];
        $longitudes[] = $row['locationLongitude'];
        $coordinates[] = 'new google.maps.LatLng(' . $row['locationLatitude'] .','. $row['locationLongitude'] .'),';
        $organization[] =  $row['org_name'];
        $con1[]=$row['contact1'];
        $con2[]=$row['contact2'];
        $totaloxygen[]= $row['totalOxygen'];
        $reqoxygen[]= $row['requiredOxygen'];

    }
    
    //remove the comaa ',' from last coordinate
    $lastcount = count($coordinates)-1;
    $coordinates[$lastcount] = trim($coordinates[$lastcount], ","); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>

    
        <div style="
    position: absolute;
    top: 3px;
    left: 19px;
"> <a href="logout.php" class="btn btn-danger pull-right"><i class="fa fa-sign-out"></i> Logout</a></div>
        <div style="margin-top: 30px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Hospitals which can Donate</h2>
                        <a href="addhospital.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Hospital</a>
                    </div>
                    <?php
                   
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM location_tab where exlessOxygen>0 and hide=1";
                    if($result = mysqli_query($db, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Oxygen Upadates</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Available Oxygen<sub>(in litres)</sub></th>";
                                        echo "<th>Oxygen Required<sub>(in litres)</sub></th>";
                                        echo "<th>Leftover Oxygen<sub>(in litres)</sub></th>";
                                        echo "<th>Contact</th>";
                                        echo "<th>Actions</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    
                        
                                      echo "<tr>";
                                      echo "<td>";
                                            echo '<a href="updateOxygen.php?id='. $row['ID'] .'" class="ml-2 mr-3" title="Update Oxygen Level" data-toggle="tooltip"><span class="fa fa-oxygen">Update Oxygen Level</span></a>';

                                
                                        echo "<td>" . $row['org_name'] . "</td>";
                                        echo "<td>" . $row['totalOxygen'] . "</td>";
                                        echo "<td>" . $row['requiredOxygen'] . "</td>";
                                         echo "<td style='color:green'>" .  $row['exlessOxygen']  . "</td>";  
                                        echo "<td>" . $row['contact1']. " - ".$row['contact2'] . "</td>";

                                      
                                        echo "<td>";
                                            echo '<a href="updateHospital.php?id='. $row['ID'] .'" class="ml-2 mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="deleteHospital.php?id='. $row['ID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger" style="margin-top: 4em;"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    
                    ?>

                     <h2 class="pull-left">Hospitals which Need Oxygen</h2>
                    <?php
                   
                    
                    // Attempt select query execution
                    $sql2 = "SELECT * FROM location_tab where exlessOxygen<0 and hide=1";
                    if($result = mysqli_query($db, $sql2)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Oxygen Upadates</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Available Oxygen<sub>(in litres)</sub></th>";
                                        echo "<th>Oxygen Required<sub>(in litres)</sub></th>";
                                        echo "<th>Oxygen Needed<sub>(in litres)</sub></th>";
                                        echo "<th>Contact</th>";
                                        echo "<th>Actions</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    
                        
                                      echo "<tr>";
                                      echo "<td>";
                                            echo '<a href="updateOxygen.php?id='. $row['ID'] .'" class="ml-2 mr-3" title="Update Oxygen Level" data-toggle="tooltip"><span class="fa fa-oxygen">Update Oxygen Level</span></a>';
                                
                                        echo "<td>" . $row['org_name'] . "</td>";
                                        echo "<td>" . $row['totalOxygen'] . "</td>";
                                        echo "<td>" . $row['requiredOxygen'] . "</td>";
                                         echo "<td style='color:red'>" .  $row['exlessOxygen']*-1  . "</td>";  
                                        echo "<td>" . $row['contact1']. " - ".$row['contact2'] . "</td>";

                                      
                                        echo "<td>";
                                            echo '<a href="updateHospital.php?id='. $row['ID'] .'" class="ml-2 mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="deleteHospital.php?id='. $row['ID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger" style="margin-top: 4em;"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                   
                    ?>
             

                <h2 class="pull-left">Hospitals With No Data</h2>
                    <?php
                   
                    
                    // Attempt select query execution
                    $sql3 = "SELECT * FROM location_tab where exlessOxygen IS NULL and hide=1";
                    if($result = mysqli_query($db, $sql3)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Oxygen Updates</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Oxygen Required<sub>(in litres)</sub></th>";
                                        echo "<th>Available Oxygen<sub>(in litres)</sub></th>";
                                        echo "<th>Oxygen Needed<sub>(in litres)</sub></th>";
                                        echo "<th>Contact</th>";
                                        echo "<th>Actions</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    
                        
                                      echo "<tr>";
                                      echo "<td>";
                                            echo '<a href="updateOxygen.php?id='. $row['ID'] .'" class="ml-2 mr-3" title="Update Oxygen Level" data-toggle="tooltip"><span class="fa fa-oxygen">Update Oxygen Level</span></a>';
                                
                                        echo "<td>" . $row['org_name'] . "</td>";
                                        echo "<td> No Data Available </td>";
                                        echo "<td>No Data Available</td>";
                                         echo "<td>No Data Available</td>";  
                                        echo "<td>" . $row['contact1']. " - ".$row['contact2'] . "</td>";

                                      
                                        echo "<td>";
                                            echo '<a href="updateHospital.php?id='. $row['ID'] .'" class="ml-2 mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="deleteHospital.php?id='. $row['ID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger" style="margin-top: 4em;"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($db);
                    ?>
                       </div>
            </div>   

        </div>

    </div>


       

    </body>
</html>