
<!DOCTYPE html>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="img/Logo.png" type="image/png" sizes="16x16">
    <title>Oxygen Maps Covid 19 | View</title>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="tableactive.js"></script>

  </head>

<body>
<?php include('Map.php');?>



<nav class="navbar">
    <div class="container">
   <div class="row"><div class="covid-19-oxygen-map-text col-md-6" style="width: auto;">Covid-19 Oxygen Map Nepal</div>
   </div>
</div>
  </nav>

<div class="container">
       <div class="row">  
    <div class="col-md-6">
        <span class=" oxygen-status-in-hos d-block" style="font-weight:bold;">Oxygen Status in Hospitals in Nepal</span>
        <span style="margin-top: 1em; display: flex">
    <span class="lastupdatebox">

                  <span class="lastupdatetext">
              LAST UPDATE</span></span>
              <span class="timedate">
  
                    <?php
                   $lastTime ='';
                 $getlastdata = "SELECT timeupdated
            FROM   oxygenupdatehistory 
            ORDER  BY timeupdated DESC 
            LIMIT  1";
                                    if($result = mysqli_query($db, $getlastdata)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){

                                        echo ($row['timeupdated']);
                                        $lastTime=$row['timeupdated'];
                                    }}
                                    else{
                                        echo "some error occoured";
                                    }
                                }
                                    
                                    ?></span>
</span>
</div>
              <div class="col-md-6" style="position: relative;">   
                <button class="relodbtn" onclick="reloadPage()">
    <span><img src="img/refresh@2x.png" style="height: 15px;
    position: relative;
    top: -3px;"></span><span style=" color: #FFFFFF;
  font-family: Avenir;
  font-size: 12px;position: relative;left: 10px;">Reload Data</span></button> </div> 
</div>
</div>
                 
                 
 

                
      
    
<div class="container mob-map">
     <div class="row" >
                 <div class="col-md-8">
        
      <div id="map" style="height: 430px;"></div>
     
<div class="indicators row">
                 <div class="group-4 col-md-4"><span class="red-circle-copy-5-red-circle"><img src="img/green-ico.png">
                 </span><span class="oxygen-needed-hospit">Hospitals with Sufficient Oxygen</span></div>
                 <div class="group-4 col-md-4"><span class="red-circle-copy-5-red-circle"><img src="img/orange-ico.png">
                 </span><span class="oxygen-needed-hospit">Hospitals with Oxygen less than 10 litres</span></div>
                 <div class="group-4 col-md-4"><span class="red-circle-copy-5-red-circle"><img src="img/red-ico.png" style="
    height: 32px;
">
                 </span><span class="oxygen-needed-hospit" style="position: relative;left: 0.5em;top:6px;">Oxygen Needing Hospitals</span></div>
                 
            
        </div>
<div class="row indicator-mob" style=" display: none; ">
                 <div class="group-4 col-md-4"><span class="red-circle-copy-5-red-circle"><img src="img/green-ico.png" style="width: 60%;">
                 </span><span class="oxygen-needed-hospit">Hospitals with Sufficient Oxygen</span></div>
                 <div class="group-4 col-md-4"><span class="red-circle-copy-5-red-circle"><img src="img/orange-ico.png" style="width: 60%;">
                 </span><span class="oxygen-needed-hospit" style="position: relative;top: -1px;">Hospital with Oxygen less than 10 litres</span></div>
                 <div class="group-4 col-md-4"><span class="red-circle-copy-5-red-circle"><img src="img/red-ico.png" style="width: 60%;">
                 </span><span class="oxygen-needed-hospit">Oxygen Needed Hospitals</span></div>

            
        </div>
        </div>
      

      

  <div class="col-md-4" style=" height: 500px;
  border-radius: 8px;
  background-color: #FFFFFF;
  box-shadow: 0 4px 24px 0 rgba(0,0,0,0.1);">
    <div class="row" style="margin-top: 10px;">
        <div class="live-oxygen-status col-md-6">Live oxygen status</div> 
        <div class="time col-md-6"><?php echo $lastTime?></div>
    </div>

    <div class="row" style="margin-bottom: 5%;"><span class="hospitals-and-their">Hospitals and their Oxygen Status</span></div>
  <div class="row" >
      <div class="oxtextindicators">
<span class="rectangle-1 " style="margin-right: 4px;"></span><span  class="textOxygen">Adequate Oxygen </span>
<span class="rectangle-copy-6 " style="margin-right: 4px;"></span><span  class="textOxygen">Inadequate Oxygen </span>
<span class="orgrectangle-1" style="margin-right: 4px;"></span><span class="textOxygen">Sparse Oxygen</span>
</div>
</div>
   <div style="margin-top: 1%">
     <?php
                   
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM location_tab where hide=1 and exlessOxygen is not null order by  dateUpdated desc LIMIT 10 ";
                    if($result = mysqli_query($db, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="firsttable">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th class='hospital' style='width:2px;'>#</th>";
                                        echo "<th class='hospital'>Hospital</th>";
                                        echo "<th class='hospital'>Oxygen Status</th>";
                                       
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                $i=1;
                                while($row = mysqli_fetch_array($result)){
                                    
                        
                                      echo "<tr>";
                                        echo "<td class='namehos' style='width:2px;'>" . $i. "</td>";
                                        echo "<td class='namehos' style='text-transform: capitalize; white-space: break-spaces'>" . $row['org_name'] . "</td>";
                                        
                                       if($row['exlessOxygen']<0){
                                       
                                        echo "<td>
                                        <span  class='red-rectangle' style='display:block'><span style='position: relative;top: 5px;'>".($row['exlessOxygen']*-1)." Litres Needed</span></span></td>";
                                     }
                                     
                                     elseif ($row['exlessOxygen']>=0 && $row['exlessOxygen']<=10) {
                                       
                                       echo "<td >
                                        <span  class='orange-rectangle' style='display:block'> <span style='position: relative;top: 5px;'>".($row['exlessOxygen']*1)." Litres Left</span></span></td>";
                                     }
                                      elseif ( $row['exlessOxygen']>10) {
                                       
                                        echo "<td>
                                        <span  class='green-rectangle' style='display:block'> <span style='position: relative;top: 5px;'>".($row['exlessOxygen']*1)." Litres Available</span></span></td>";
                                     }
                                    
                                  
                                       $i=$i+1;
                                      
                                        
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } 
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 ?>



        </div>
        </div>
      </div>
    </div>
    


                     <div class="container">
 <div class="row" style="margin-top: 2%;">
            <div class="col-md-6">
              <p class="oxygen-status-around">Oxygen Status in Hospitals of Nepal</p>
            </div>
             <div id="provincebtns">
                <button class="disabledreqoxygenbtn active"  id="pp0"><span class="requestoxygenText" >All Provinces</span></button>
                <button class="disabledreqoxygenbtn"  id="pp1"><span class="requestoxygenText" >Province 1</span></button>
                <button class="disabledreqoxygenbtn"  id="pp2"><span class="requestoxygenText" >Province 2</span></button>
                <button class="disabledreqoxygenbtn"  id="pp3"><span class="requestoxygenText" >Bagmati</span></button>
                <button class="disabledreqoxygenbtn"  id="pp4"><span class="requestoxygenText" >Gandaki</span></button>
                <button class="disabledreqoxygenbtn"  id="pp5"><span class="requestoxygenText" >Lumbini</span></button>
                <button class="disabledreqoxygenbtn"  id="pp6"><span class="requestoxygenText" >Karnali</span></button>
                <button class="disabledreqoxygenbtn"  id="pp7"><span class="requestoxygenText" >Sudurpashchim</span></button>
              </div>
              <script type="text/javascript">
                // Add active class to the current button (highlight it)
                var header = document.getElementById("provincebtns");
                var btns = header.getElementsByClassName("disabledreqoxygenbtn");
                for (var i = 0; i < btns.length; i++) {
                  btns[i].addEventListener("click", function() {
                  var current = document.getElementsByClassName("active");
                  if (current.length > 0) { 
                    current[0].className = current[0].className.replace(" active", "");
                  }
                  this.className += " active";
                  });
                }
   

              </script>
<div class="row">
            <div class="form-group col-md-4" style="padding-top: 15px;" id='search'>
            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Search by Hospital Name" />
        </div>
         
         <div class="col-md-8" style="padding-top: 15px;position: relative;">
                    <div class="sort">
                        <label for="Sort_Hospitals_By" class="sort-hospitals-by" style="margin-top: 9px;/* position: absolute; */">Sort Hospitals by</label>
                        <select id="sortHospitals" name="sortHospitals" class="selectbox" style="margin-top: 0px;width: 20em;">
                        <option value="0" class="sortoptiontext">Show all</option>
                        <option value="1" class="sortoptiontext">Hospitals with Sufficient Oxygen</option>
                        <option value="2" class="sortoptiontext">Hospitals with Oxygen less than 10 litres</option>
                         <option value="3" class="sortoptiontext">Oxygen Needing Hospitals</option>
                      </select>
          </div>
</div>
  
  </div>

        
           
           </div>


          <div class="table-responsive" id="dynamic_content" style="padding-top: 1.5%;"></div>


</div>
                   
                 


<div class="container">
<form class="formview" method="post" action="volunteerdata.php">
                     <div class="row">
                       
 <div class="detail_1 col-md-6" style="padding-left: 5%;padding-top: 3%;">
  
  <div style="padding-top: 15px;">
    <span>
        <img src="img/handsharke.png" style="font-size:40px;color:#3278a1" alt="handshake">
      <!-- <img src=""> -->
    </span>
    <span class="formdesc1"> Call for Volunteers</span></div> 
    <div style="padding-top: 15px;">
      <span class="formdesc2">If you want to help in an any kind possible. Fill up the form below. We will contact you.</span>
    </div>
    <div style="padding-top: 15px;"><span class="formdesc3">* All fields are compulsory</span></div>
        
    <div class="detail_1" style="margin-top: 38px;">    
    <label for="name" class="formlabel">Full Name*</label>

    <input type="text" id="name" name="name" placeholder="Your name.." class="inputform" required="">
    </div>
    <div class="detail_1"> 
    <label for="phone" class="formlabel">Phone Number*</label>
    <input type="text" id="phone" name="phone" placeholder="9841000000" class="inputform" required="">
    </div>
    <div>
    <label for="Email" class="formlabel">Email Address*</label>
    <input type="email" id="email" name="email" placeholder="johndoe@gmail.com" class="inputform" required="">
        </div>
           <div>
    <label for="address" class="formlabel">Current Address*</label>
</div>
  <div>
    <input type="text" id="address" name="address" placeholder="Ward No., Muncipality/VDC, District, Provinence" class="inputform" required="">
    </div> 
       
       </div> 

    <div class="detail_2 col-md-6" style="margin-top: 13.5%; padding-left:5% ">
       <div>
    <label for="gender" class="formlabel">Gender</label>
    <div style="    margin-top: 15px;">
        <input type="radio" value="male">
        <span class="formlabel" style="display: contents;">Male</span>
  <span style="margin-left: 30px;"></span>
        <input type="radio" value="female"><span class="formlabel" style="display: contents;">Female</span>
    </div>
    </div>

    <div>
    <label for="age" class="formlabel" style="margin-top: 2.5%;">Age</label>
      <select id="Age" name="Age" class="selectbox" style="    margin-top: 7px;">
      <option value="10">18</option>
      <option value="11">19</option>
      <option value="12">20</option>
      <option value="12">21</option>
      <option value="12">22</option>
      <option value="12">23</option>
      <option value="10">24</option>
      <option value="11">25</option>
      <option value="12">26</option>
      <option value="12">27</option>
      <option value="12">28</option>
      <option value="12">29</option>
      <option value="12">30</option>
    </select>
        </div>

        <div>
      <label for="Blood_group" class="formlabel" style="margin-top: 9px;">Blood Group</label>
      <select id="blood" name="blood" class="selectbox">
      <option value="A +ve">A +ve</option>
      <option value="B +ve">B +ve</option>
      <option value="AB +ve">AB +ve</option>
      <option value="O + ve">O + ve</option>
      <option value="A -ve">A -ve</option>
      <option value="B -ve">B -ve</option>
      <option value="AB -ve">AB -ve</option>
      <option value="O -ve">O -ve</option>
    </select>
        </div>

        <div>
    <label for="Transportation" class="formlabel" style="    margin-top: 12px;">Means of Transportation</label>
      <select id="transportation" name="transportation" class="selectbox">
      <option value="cycle">Cycle</option>
      <option value="Motorcycle">Motorcycle</option>
      <option value="Bus">Bus</option>
    </select>
       </div>
   
 
</div>
<div class="col-md-12" style="padding-left: 6%;">
       <input type="submit" value="Submit" class="submitbtn" style="height: 35px;
    width: 13%;">
    <div><?php 
error_reporting(0);
    if($_GET['msg']){
     echo "<div style='color: green;margin-top: 51px;padding: 2em;'>We have got your request. We will contact you as fast as possible. Stay Safe !</div>";
    }
    else{

echo "";
    }?>
    </div>
</div>
    </form></div>

<div class="container">
                      <div class="row" style="padding-top: 20%;">
                        <div class="col-md-6">
                            <div class="col-sm-12"><p class="purpose-of-this-site">Purpose of this site</p></div>
                            <div class="col-sm-12"><p class="main-purpose-of-this">Main purpose of this site is to make available the data and status of Oxygen needed and required around the Hospitals inside Kathmandu Valley. Data uploaded here is real-time updated.</p></div>
                             <div style="margin-top: 2em" class="col-sm-12"><p class="main-purpose-of-this">This site is voluntarily developed and maintained by  Kshitiz Basnet in coordination with Bisheshwor Bhatta.</p></div>
                           
                        </div>
                        
                            <div class="col-md-6"><img src="img/purpose.png" alt="purposeImage" class="purposeImage"></div>
           
                      </div>
              
                 
</div>
            <div class="container">
                    <div class="row" style="padding-top: 10%;">
                        <div class="col-md-4">
                            <p class="footertext">Covid 19 Oxygen Map</p>
                        </div>
                        <div class="col-md-2">
                            <p class="footertext">Terms of Use</p>
                        </div>
                        <div class="col-md-2">
                            <p class="footertext">Terms of Service</p>
                        </div>
                        <div class="col-md-2">
                            <p class="footertext">Privacy Policy</p>
                        </div>
                        <div class="col-2">
                            <p class="footertext" style="white-space: nowrap;"> © 2021 Oxygen Map All rights Reserved</p>
                        </div>
                    </div>
                     </div>
</div>

                      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
 <script type="text/javascript">
                         function  reloadPage(){
                            location.reload();
                         }

                       </script>


  </body>
</html>