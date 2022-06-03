<?php
    include('config/config.php');
  

  $coordinates = array();
  $latitudes = array();
  $longitudes = array();
  $organization = array();
  $totaloxygen = array();
    $reqoxygen = array();
    $con1 = array();
    $con2 = array();
    $exlessoxygen=array();

  // Select all the rows in the markers table
  $query = "SELECT * FROM `location_tab` ";
  $result = $db->query($query) or die('data selection for google map failed: ' . $db->error);

  while ($row = mysqli_fetch_array($result)) {

    $latitudes[] = $row['locationLatitude'];
    $longitudes[] = $row['locationLongitude'];
    $coordinates[] = 'new google.maps.LatLng(' . $row['locationLatitude'] .','. $row['locationLongitude'] .'),';
    $organization[] =  $row['org_name'];
    $con1[]=$row['contact1'];
    $con2[]=$row['contact2'];
    $totaloxygen[]= $row['totalOxygen'];
    $reqoxygen[]= $row['requiredOxygen'];
    $exlessoxygen[]= $row['exlessOxygen'];

  }
    
  //remove the comaa ',' from last coordinate
  $lastcount = count($coordinates)-1;
  $coordinates[$lastcount] = trim($coordinates[$lastcount], ","); 

?>


<script>
      function initMap() {
        var mapOptions = {
          zoom: 6.6,
          center: {lat:28.2, lng:84},
          mapTypeId: google.maps.MapTypeId.SATELITE
        };

        var map = new google.maps.Map(document.getElementById('map'),mapOptions);

        var RouteCoordinates = [
          <?php
            $i = 0;
          while ($i < count($coordinates)) {
            echo $coordinates[$i];
            $i++;
          }
          ?>
        ];

        var RoutePath = new google.maps.Polyline({
          path: RouteCoordinates,
          geodesic: true,
          strokeColor: '#1100FF',
          strokeOpacity: 1.0,
          strokeWeight: 10
        });

        green='img/green-ico.png';
        blue='img/blue-ico.png';
        red='img/red-ico.png';
        orange='img/orange-ico.png';

        var infowindow = new google.maps.InfoWindow();
        var marker, i;
            
           <?php for ($i = 0; $i <  count($latitudes); $i++) {  
                    ?>
          lat= <?php echo $latitudes[$i]?>;
          lon= <?php echo $longitudes[$i]?>;
          org_name= "<?php echo $organization[$i]?>-";
          con1= "<?php echo $con1[$i]?>-";
          con2= "<?php echo $con2[$i]?>-";
          availableOx= "<?php echo $totaloxygen[$i]?>-";
          reqoxygen= "<?php echo $reqoxygen[$i]?>-";
          exlessoxygen= "<?php echo $exlessoxygen[$i]<0 ? $exlessoxygen[$i]*-1 : $exlessoxygen[$i] ;?>";      
           exlessoxygens= exlessoxygen+"-"; 
          <?php if($exlessoxygen[$i]<0){
            ?>
        
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lon),
            map: map,
            label: {
                     text: exlessoxygen,
                     color:"black",
                      fontSize: "12px",
                      fontWeight: "bold"
                  },
            icon: red,

          
        title:org_name+exlessoxygens+availableOx+reqoxygen+con1+con2,
         // animation: google.maps.Animation.BOUNCE
          });
               
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                    var data = marker.getTitle();
                    var detail=data.split("-");

                        var html = "<div style='padding-left: 10px;padding-right: 12px;'>"+
                                   "<p style='color:black;font-weight: 900;font-size:11px;'>"+detail[0]+"</p>"+ 
                                   "<p style='color:red;font-weight: 500;font-size:11px;'>"+detail[1]+" litres Needed</p>"+
                                  "<p style='color:black;font-size:12px;'><span style='font-weight:bold;font-size:12px;'>Total Oxygen Available</span><span style='color: black;font-weight: 500;display: block;margin-top: 0.5em;'>"+detail[2]+" litres</span></p><p style='color:black;'>"+
                                    "<span style='font-weight:900;font-size:12px;'>Total Oxygen Required</span><span style='color: black;font-weight: 500;display: block;margin-top: 0.5em;'>"+detail[3]+" litres</span></p><p style='color:black;font-weight:500;'>01452411 , 0144533</p></div>";
                        infowindow.setContent(html);
                        infowindow.open(map, marker, html);
            }
          })(marker, i));

          <?php
           }
else if(((($exlessoxygen[$i])<=10) && (($exlessoxygen[$i])>0) )|| $exlessoxygen[$i] =='0'){
            ?>
        
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lon),
            map: map,
            label: {
                     text: exlessoxygen,
                     color:"black",
                      fontSize: "12px",
                      fontWeight: "bold"
                  },
            icon: orange,

          
        title:org_name+exlessoxygens+availableOx+reqoxygen+con1+con2,
         // animation: google.maps.Animation.BOUNCE
          });
               
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                    var data = marker.getTitle();
                    var detail=data.split("-");

                        var html = "<div style='padding-left: 10px;padding-right: 10px;'>"+
                                   "<p style='color:black;font-weight: 900;font-size:12px;'>"+detail[0]+"</p>"+ 
                                   "<p style='color:orange;font-weight: 500;font-size:11px;'>"+detail[1]+" litres left</p>"+
                                  "<p style='color:black;font-size:12px;'><span style='font-weight:bold;font-size:12px;'>Total Oxygen Available</span><span style='color: black;font-weight: 500;display: block;margin-top: 0.5em;'>"+detail[2]+" litres</span></p><p style='color:black;'>"+
                                    "<span style='font-weight:900;font-size:12px;'>Total Oxygen Required</span><span style='color: black;font-weight: 500;display: block;margin-top: 0.5em;'>"+detail[3]+" litres</span></p><p style='color:black;font-weight:500;'>01452411 , 0144533</p></div>";
                        infowindow.setContent(html);
                        infowindow.open(map, marker, html);
            }
          })(marker, i));

         <?php
           }
else if(($exlessoxygen[$i]) >10 ){
            ?>
        
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lon),
            map: map,
            label: {
                     text: exlessoxygen,
                     color:"black",
                      fontSize: "12px",
                      fontWeight: "bold"
                  },
            icon: green,
            
          
        title:org_name+exlessoxygens+availableOx+reqoxygen+con1+con2,
         // animation: google.maps.Animation.BOUNCE
          });
               
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                    var data = marker.getTitle();
                    var detail=data.split("-");

                        var html = "<div style='padding-left: 13px;padding-right: 10px;'>"+
                                   "<p style='color:black;font-weight: 900;font-size:12px;'>"+detail[0]+"</p>"+ 
                                   "<p style='color:green;font-weight: 500;font-size:11px;'>"+detail[1]+" litres Excess</p>"+
                                  "<p style='color:black;font-size:12px;'><span style='font-weight:bold;font-size:12px;'>Total Oxygen Available</span><span style='color: black;font-weight: 500;display: block;margin-top: 0.5em;'>"+detail[2]+" litres</span></p><p style='color:black;'>"+
                                    "<span style='font-weight:900;font-size:12px;'>Total Oxygen Required</span><span style='color: black;font-weight: 500;display: block;margin-top: 0.5em;'>"+detail[3]+" litres</span></p><p style='color:black;font-weight:500;'>01452411 , 0144533</p></div>";
                        infowindow.setContent(html);
                        infowindow.open(map, marker, html);
            }
          })(marker, i));

          <?php
           }

            }
?>
          

       }
      
      //google.maps.event.addDomListener(window, 'load', initialize);
      </script>

      <!--remenber to put your google map key-->
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiw5_hZtvnSLsi_JGJ5lulbc2WkyCWomA&callback=initMap"></script>