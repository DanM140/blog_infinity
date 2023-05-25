<?php include 'includes/session.php'; 
include 'includes/init.php';
$slug=$_GET['champ'];
$conn=$pdo->open();
$stmt=$conn->prepare("SELECT * FROM category WHERE code=:code");
$stmt->execute(['code'=>$slug]);
$row_cat=$stmt->fetch();

?>
<?php include 'includes/title.php';?>
<?php include 'includes/header.php';?>
<div  style="margin-bottom: 10px;margin-top: 10px;">
<h3 id='h2' class=w3-text-red><span> <?php echo $row_cat['name'];?></span> </h3>
<div class="w3-center w3-text-red w3-xlarge">Group Standings</div>
<div class="w3-container">
    <?php include 'includes/champ_leagues.php';?>
</div>
<div >
            <div id='epl' >
       <?php
$cache_instance =$cache->getItem('standings'.$slug);
if (is_null($cache_instance->get())) {

$baseUrl="http://api.football-data.org/v4/competitions/CL/standings";
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL =>$baseUrl ,
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

$curl_response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if (!$err) {
  $cache_instance->set($curl_response)->expiresAfter(60);
$cache->save($cache_instance);  
}
}
else{
      $curl_response=$cache_instance->get();

}
$data=json_decode($curl_response, true)  ;

?>
            <div class="w3-container w3-white w3-responsive " style="padding-top:20px;"  >
<?php
    if (empty($data)) {
     echo "<p  > 

        Something went wrong..Refresh the page 

    </p> ";
    echo "<p class='w3-button'> 

        Refresh  

    </p> "; 
    echo "<p id='spin' style='display: none;'><i class='fa fa-spinner w3-spin' style='font-size:64px'></i></p>
";
}
else{
    
        $position=8;    
        for ($i=0; $i <$position ; $i++) {
            echo
            "<table id='example1' class='w3-table-all' >
                <thead>
                  <th ></th>
                 <th ></th>
                 <th ></th>
                 <th ></th>
                 <th ></th>
                 <th ></th>
                 <th ></th>
                 <th ></th>
                 <th ></th>
                 <th ></th>
                 <th ></th>
                </thead>
                <tbody>"; 
        echo "
        <tr>
  <td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>".$data['standings'][$i]['group']."</td>
<td></td> 
<td></td>
<td></td>
<td></td>
</tr>";
            
            echo " </tbody>
            </table>";
        echo "<table id='example1' class='w3-table-all' >
                <thead>
                  <th >Rank</th>
                  <th colspan='2'>Name</th>
                  <th>Played</th>
                  <th>Won</th>
                  <th>Draw</th>
                  <th>Lost</th>
                  <th>Points</th>
                  <th>GF</th>
                  <th>GA</th>
                  <th >GD</th>
                  <th>Last 5</th>
                </thead>
                <tbody>"; 

           for ($x=0; $x <4 ; $x++) {
        echo "
        <tr>
        
<td>".$data['standings'][$i]['table'][$x]['position']."</td>
<td>
<img src='".$data['standings'][$i]['table'][$x]['team']['crest']."' height='15px' width='20px'>
</td>
<td>
".$data['standings'][$i]['table'][$x]['team']['tla']."
</td>
<td>".$data['standings'][$i]['table'][$x]['playedGames']."</td>
<td>".$data['standings'][$i]['table'][$x]['won']."</td>
<td>".$data['standings'][$i]['table'][$x]['draw']."</td>
<td>".$data['standings'][$i]['table'][$x]['lost']."</td>
<td>".$data['standings'][$i]['table'][$x]['points']."</td>
<td>".$data['standings'][$i]['table'][$x]['goalsFor']."</td>
<td>".$data['standings'][$i]['table'][$x]['goalsAgainst']."</td>
<td>".$data['standings'][$i]['table'][$x]['goalDifference']."</td>
<td>".$data['standings'][$i]['table'][$x]['form']."</td>
</tr>";
            }
            echo " </tbody>
            </table>";
        }

}
    ?>

                               
        </div>

        </div>
                
   <?php include 'includes/search_modal.php'; ?>       
</div>
</div>

<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</body>
</html>