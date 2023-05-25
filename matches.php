
<?php include 'includes/session.php'; 
include 'includes/init.php';
require 'func/func.php';
$slug=$_GET['slug'];
$conn=$pdo->open();
$stmt=$conn->prepare("SELECT * FROM category WHERE code=:code");
$stmt->execute(['code'=>$slug]);
$row_cat=$stmt->fetch();
?>
<?php include 'includes/title.php';?>
<?php include 'includes/header.php';?>

<h3 id='h2' class=w3-text-red><span><?php echo $row_cat['name'];?></span> </h3>
<div class="w3-center w3-text-red w3-xlarge">Matches</div>
<div  style="margin-bottom: 10px;margin-top: 10px;">

<?php include 'includes/epl_leagues.php';?>
     <div  style="margin-bottom:10px;">
        <div >
            <div  >
        <?php
            $cache_instance =$cache->getItem("matches".$slug);
if (is_null($cache_instance->get())) {
$now=date('Y-m-d'); 
$to= date('Y-m-d', strtotime($now. ' +10 days')); 
$from =date('Y-m-d', strtotime($now. ' -10 days'));
$baseUrl="https://api.football-data.org/v4/competitions/".$slug."/matches?season=2022&";
$dateFrom='dateFrom='.$from;
$dateTo='&dateTo='.$to;
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL =>$baseUrl. $dateFrom.$dateTo ,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        
        "X-Auth-Token: 52d9d284e39c4bce80d903c4a3ff222d"
    ],
]);

$curl_matches = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);  
if (!$err) {
  $cache_instance->set($curl_matches)->expiresAfter(60);
$cache->save($cache_instance);  
}

}
else{
$curl_matches=$cache_instance->get();
}
$matches=json_decode($curl_matches, true)  ;

?>
            <div class="w3-white w3-responsive" >
                <?php
            

    if (empty($matches)) {
     echo "<p  id='janice'> 

        Something went wrong..Refresh the page 

    </p> ";
    echo "<p class='w3-button' id='janice'> 

        Refresh  

    </p> "; 
    echo "<p id='spin' style='display: none;'><i class='fa fa-spinner w3-spin' style='font-size:64px'></i></p>
";
}
else{           

  //main table 
$ct=count($matches['matches'])-1;
echo "<div class='w3-white w3-responsive' >

    <table id='example1' class='w3-table-all' >
                <thead>
                  <th >Date</th>
                  <th>Time</th>
                  <th >Status</th>
                  <th>H.Team</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>A.Team</th>
                </thead>
                <tbody>";
for ($i=0; $i<$ct ; $i++) {
$date = new DateTime($matches['matches'][$i]['utcDate'], new DateTimeZone('UTC'));
$date->setTimezone(new DateTimeZone('EAT'));
$dateg=$date->format('Y-m-d');
$prevdate=new DateTime($matches['matches'][$i+1]['utcDate'], new DateTimeZone('UTC'));
$prevdate->setTimezone(new DateTimeZone('EAT'));
$prev=$prevdate->format('Y-m-d');
$datespec=new DateTime($matches['matches'][$i]['utcDate'], new DateTimeZone('UTC'));
$datespec->setTimezone(new DateTimeZone('EAT'));
$game=$datespec->format(' D, jS M ');
$spec=$datespec->format('H:i:s');
$day=$matches['matches'][$i]['matchday'];
$homeTeam=$matches['matches'][$i]['homeTeam']['name'];
$awayTeam=$matches['matches'][$i]['awayTeam']['name'];
$homescore=$matches['matches'][$i]['score']['fullTime']['home'];
$awayscore=$matches['matches'][$i]['score']['fullTime']['away'];
$st=$matches['matches'][$i]['status'];

$gameStatus =gstatus($st);

    echo "

                 
      <tr>
<td>".$game."</td>
<td >
".$spec."
</td>
<td >
".$gameStatus."
</td>
<td>".$homeTeam."</td>
<td>".$homescore." </td>
<td>-</td>
<td>".$awayscore."</td>
<td>".$awayTeam."</td>
</tr>

                ";
      
}
  
  echo "</tbody>
            </table>
            </div>
";  }?>
                
        </div>

        </div>
                
   <?php include 'includes/search_modal.php'; ?>       
</div>
</div>

<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</body>
</html>