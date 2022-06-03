
<?php
error_reporting(0);
include("config/config.php");

/*function get_total_row($connect)
{
  $query = "
  SELECT * FROM tbl_webslesson_post
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  return $statement->rowCount();
}

$total_record = get_total_row($connect);*/
//error_reporting(0);

$limit = '5';
$page = 1;

if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}


 $query = 'SELECT * FROM location_tab where hide=1';
 $output = "<b>ALL Hospitals</b>";

if($_POST['query'] != '')
{
   $search=mysqli_real_escape_string($db,$_POST['query']);
   $query = 'SELECT * FROM location_tab WHERE org_name LIKE "'.$search.'%"';
   $output = "<b>Search Results</b>";
}
if($_POST['query'] == 'p0')
{
   $query = 'SELECT * FROM location_tab where  hide=1';
    $output = "<b>All Hospitals</b>";
}
if($_POST['query'] == 'p1')
{
   $query = 'SELECT * FROM location_tab where province=1 and hide=1';
   $output = "<b>Hospitals in Province 1</b>";
}


if($_POST['query'] == 'p2')
{
   $query = 'SELECT * FROM location_tab where province=2 and hide=1';
   $output = "<b>Hospitals in Province 2</b>";
}
  


if($_POST['query'] == 'p3')
{
   $query = 'SELECT * FROM location_tab where province=3 and hide=1';
  $output = "<b>Hospitals in Bagmati Province</b>";
}


if($_POST['query'] == 'p4')
{
   $query = 'SELECT * FROM location_tab where province=4 and hide=1';
   $output = "<b>Hospitals in Gandaki Province</b>";
}
  


if($_POST['query'] == 'p5')
{
   $query = 'SELECT * FROM location_tab where province=5 and hide=1';
  $output = "<b>Hospitals in Lumbini Province</b>";
}

if($_POST['query'] == 'p6')
{
   $query = 'SELECT * FROM location_tab where province=6 and hide=1';
   $output = "<b>Hospitals in Karnali Province</b>";
}
  


if($_POST['query'] == 'p7')
{
   $query = 'SELECT * FROM location_tab where province=7 and hide=1';
   $output = "<b>Hospitals in Sudurpashchim Province</b>";
}
  
if($_POST['query'] == 'a0')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>10 and hide=1";
 $output = "<b>Oxygen Available Hospitals</b>";
  
}

if($_POST['query'] == 'a1')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>10 and province=1 and hide=1";
 $output = "<b>Oxygen Available Hospitals</b>";
  
}

if($_POST['query'] == 'a2')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>10 and province=2 and hide=1";
 $output = "<b>Oxygen Available Hospitals</b>";
  
}
if($_POST['query'] == 'a3')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>10 and province=3  and hide=1";
 $output = "<b>Oxygen Available Hospitals</b>";
  
}
if($_POST['query'] == 'a4')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>10 and province=4  and hide=1";
 $output = "<b>Oxygen Available Hospitals</b>";
  
}
if($_POST['query'] == 'a5')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>10 and province=5  and hide=1";
 $output = "<b>Oxygen Available Hospitals</b>";
  
}
if($_POST['query'] == 'a6')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>10 and province=6  and hide=1";
 $output = "<b>Oxygen Available Hospitals</b>";
  
}
if($_POST['query'] == 'a7')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>10 and province=7  and hide=1";
 $output = "<b>Oxygen Available Hospitals</b>";
  
}

if($_POST['query'] == 'n0')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen<10   and hide=1";
  $output = "<b>Hospitals which need Oxygen</b>";
  
}

if($_POST['query'] == 'n1')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen<0 and province=1  and hide=1";
  $output = "<b>Hospitals which need Oxygen</b>";
  
}

if($_POST['query'] == 'n2')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen<0 and province=2  and hide=1";
  $output = "<b>Hospitals which need Oxygen</b>";
  
}

if($_POST['query'] == 'n3')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen<0 and province=3  and hide=1";
  $output = "<b>Hospitals which need Oxygen</b>";
  
}

if($_POST['query'] == 'n4')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen<0 and province=4  and hide=1";
  $output = "<b>Hospitals which need Oxygen</b>";
  
}

if($_POST['query'] == 'n5')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen<0 and province=5  and hide=1";
  $output = "<b>Hospitals which need Oxygen</b>";
  
}

if($_POST['query'] == 'n6')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen<0 and province=6  and hide=1";
  $output = "<b>Hospitals which need Oxygen</b>";
  
}

if($_POST['query'] == 'n7')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen<0 and province=7  and hide=1";
  $output = "<b>Hospitals which need Oxygen</b>";
  
}

if($_POST['query'] == 'o0')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>0 and exlessOxygen<10   and hide=1";
  $output = "<b>Hospitals which need Oxygen</b>";
  
}

if($_POST['query'] == 'o1')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>0 and exlessOxygen<10 and province=1   and hide=1";
  $output = "<b>Hospitals in Province 1 having oxygen less than 10 Litres.</b>";
  
}

if($_POST['query'] == 'o2')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>0 and exlessOxygen<10 and province=2   and hide=1";
  $output = "<b>Hospitals in Province 2 having oxygen less than 10 Litres.</b>";
  
}

if($_POST['query'] == 'o3')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>0 and exlessOxygen<10 and province=3   and hide=1";
  $output = "<b>Hospitals in Province 3 having oxygen less than 10 Litres.</b>";
  
}

if($_POST['query'] == 'o4')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>0 and exlessOxygen<10 and province=4   and hide=1";
  $output = "<b>Hospitals in Province 4 having oxygen less than 10 Litres.</b>";
  
}

if($_POST['query'] == 'o5')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>0 and exlessOxygen<10 and province=5   and hide=1";
   $output = "<b>Hospitals in Province 5 having oxygen less than 10 Litres.</b>";
  
}

if($_POST['query'] == 'o6')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>0 and exlessOxygen<10 and province=6  and hide=1";
  $output = "<b>Hospitals in Province 6 having oxygen less than 10 Litres.</b>";
  
}

if($_POST['query'] == 'o7')
{
 $query  = "SELECT * FROM location_tab where exlessOxygen>0 and exlessOxygen<10 and province=7   and hide=1";
  $output = "<b>Hospitals in Province 7 having oxygen less than 10 Litres.</b>";
  
}

$query .= ' ORDER BY dateUpdated ASC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$result=mysqli_query($db,$query);
$total_data = mysqli_num_rows($result);



$result=mysqli_query($db,$filter_query);


$output .= '
<label><i style="font-size: 11px;">(Total Records - '.$total_data.')</i></label>
<table class="table table-bordered table-striped green" >
  <thead>
    <tr style="background-color: rgb(232 230 167 / 60%);height:50px;">
        <th class="tablebelow" style="text-align:left">Oxygen Status</th>
        <th class="tablebelow" style="text-align:left">Hospital</th>
        <th class="tablebelow">Total Oxygen Available<sub style="bottom: -10px;font-weight:500">(Ltr)</sub></th>
        <th class="tablebelow" style="padding: 1.5rem .5rem;">Total Oxygen Required<sub style="bottom: -10px;font-weight:500">(Ltr)</sub></th>
        <th class="tablebelow">Contact Number</th>
    </tr>
  </thead>
 <tbody>
';
if($total_data > 0)
{
  foreach($result as $row)
  {

                if($row['exlessOxygen']<0){
                                     $output .="<tr style=' background-color: rgba(241,83,102,0.05);'>";
                                      $output .= "<td class='needed' style='color:red'>
                                        <span>".($row['exlessOxygen']*-1)." Litres </span>Needed
                                        <span style='display:block;font-size:10px;color: rgb(0 0 0);'>Last Updated ".($row['dateUpdated'])."</span>
                                        </td>";
                                     }
                                     
                                     elseif ($row['exlessOxygen']>0 && $row['exlessOxygen']<=10 ) {

                                      $output .= "<tr style='background-color: rgba(255, 246, 220, 0.05);'>";
                                        $output .= "<td class='needed' style='color:orange'>
                                         <span>".$row['exlessOxygen']." Litres</span>
                                       Oxygen  Left 
                                        <span style='display:block;font-size:10px;color: rgb(0 0 0);'>Last Updated ".($row['dateUpdated'])."</span>
                                       </td>";
                                     }
                                      elseif ( $row['exlessOxygen']>10) {
                                        $output .= "<tr style= 'background-color: rgb(57 201 167 / 14%);'>";
                                        $output .= "<td class='needed' style='color: #39C9A7;'>
                                         <span>".$row['exlessOxygen']." Litres</span>
                                       Available
                                         <span style='display:block;font-size:10px;color: rgb(0 0 0);'>Last Updated ".($row['dateUpdated'])."</span>
                                        </td>";
                                     }
                                      elseif (is_null($row['totalOxygen'])) {
                                        $output .= "<tr style= 'background-color: rgb(12 117 248 / 14%);'>";
                                        $output .= "<td class='needed' style='color: rgb(59 57 201);'>NA</td>";
                                     }

                                   elseif ($row['exlessOxygen']==0) {

                                        $output .= "<tr style='background-color: rgba(255, 246, 220, 0.05);'>";
                                        $output .= "<td class='needed' style='color: rgb(126 54 180);'>
                                         <span style='display:block'>".$row['exlessOxygen']." Litres in stock</span>
                                         <span style='display:block;font-size:10px;color: rgb(0 0 0);'>Last Updated ".($row['dateUpdated'])."</span>
                                        </td>";

                                     }
    
                                  
                                        $output .="<td class='leftaligntd' style='text-transform: capitalize;'>" . $row['org_name'];

                                        if ($row['province']==1){
                                            $output .="<div><span style='display: block;font-size: 10px;'>Province 1</span></div>";
                                         }
                                         elseif ($row['province']==2){
                                           $output .="<div><span style='display: block;font-size: 10px;'>Province 2</span></div>";
                                         }
                                         elseif ($row['province']==3){
                                            $output .= "<div><span style='display: block;font-size: 10px;'>Bagmati Province</span></div>";
                                         }
                                         elseif ($row['province']==4){
                                          $output .= "<div><span style='display: block;font-size: 10px;'>Gandaki Province</span></div>";
                                         }
                                         elseif ($row['province']==5){
                                         $output .= "<div><span style='display: block;font-size: 10px;'>Lumbini Province</span></div>";
                                         }
                                         elseif ($row['province']==6){
                                            $output .= "<div><span style='display: block;font-size: 10px;'>Karnali Province</span></div>";
                                         }
                                         elseif ($row['province']==7){
                                           $output .= "<div><span style='display: block;font-size: 10px;'>Sudurpashchim Province</span></div>";
                                         }
                                        $output .= "</td>";
                                        $output .= "<td class='centertbltext'>";  
                                        if(is_null($row['totalOxygen'])) 
                                            {$output .= '-';}
                                        else{
                                           $output .= $row['totalOxygen']; 
                                        }
                                        $output .="</td>";
                                        $output .= "<td class='centertbltext'>";  
                                        if(is_null($row['requiredOxygen'])) 
                                            {$output .='-';}
                                        else{
                                            $output .= $row['requiredOxygen']; 
                                        }
                                        $output .="</td>";
                                         if(($row['contact1']=='999'&& $row['contact2']=='999')) 
                                           $output .= "<td class='centertbltext'>-</td>";
                                        else{
                                           $output .= "<td class='centertbltext'>" . $row['contact1']. "<br/> ".$row['contact2'] . "</td>";
                                        }

                                   $output .= "</tr>";
                                }
                                $output .="</tbody>";                            
                           $output .= "</table>";

              
  
}
else
{
  $output .= '
  <tr>
    <td colspan="5" align="center">No Data Found</td>
  </tr>
  ';
}

$output .= '
</table>
<br />
<div align="center">
  <ul class="pagination">
';

$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 4)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' </a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id >= $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>


