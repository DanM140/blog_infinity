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
<div class="w3-center w3-text-red w3-xlarge">Standings</div>
<div style="margin-bottom: 10px;margin-top: 10px;">

<?php include 'includes/epl_leagues.php';?>
            <div >
            <div id='epl' >
       <?php
$cache_instance =$cache->getItem('standings'.$slug);
if (is_null($cache_instance->get())) {

$baseUrl="http://api.football-data.org/v4/competitions/".$slug."/standings?season=2022";
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
            <div class="w3-white w3-responsive " >
 <div id = "tabs-1">
         <ul>
            <li><a href = "#tabs-2">Total</a></li>
            <li><a href = "#tabs-3">Home</a></li>
            <li><a href = "#tabs-4">Away</a></li>
         </ul>
                  <div id = "tabs-2" style="margin-left: 1px;">
           <ul  class="w3-ul w3-hoverable w3-white" id="t1" >
            <table id="example1" class="w3-table-all  " >
                <thead>
                  <th >Rank</th>
                  <th colspan="2">Name</th>
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
                <tbody>

<?php
    if (empty($data)) {
     echo "<p  > 

        Something went wrong..Refresh the page 

    </p> ";
    echo "<p class='w3-button' > 

        Refresh  

    </p> "; 
    echo "<p id='spin' style='display: none;'><i class='fa fa-spinner w3-spin' style='font-size:64px'></i></p>
";
}
else{
    

    
        $position=count($data['standings'][0]['table']);    
            


        for ($i=0; $i <$position ; $i++) { 
            echo "<tr>
<td>".$data['standings'][0]['table'][$i]['position']."</td>
<td>
<img src='".$data['standings'][0]['table'][$i]['team']['crest']."' height='15px' width='20px'>
</td>
<td>
".$data['standings'][0]['table'][$i]['team']['tla']."
</td>
<td>".$data['standings'][0]['table'][$i]['playedGames']."</td>
<td>".$data['standings'][0]['table'][$i]['won']."</td>
<td>".$data['standings'][0]['table'][$i]['draw']."</td>
<td>".$data['standings'][0]['table'][$i]['lost']."</td>
<td>".$data['standings'][0]['table'][$i]['points']."</td>
<td>".$data['standings'][0]['table'][$i]['goalsFor']."</td>
<td>".$data['standings'][0]['table'][$i]['goalsAgainst']."</td>
<td>".$data['standings'][0]['table'][$i]['goalDifference']."</td>
<td>".$data['standings'][0]['table'][$i]['form']."</td>
</tr>";
        }

}
    ?>

                </tbody>
            </table>
           </ul>
         </div>
         <div id = "tabs-3">
                <ul class="w3-ul w3-hoverable w3-white" id="t1"  >
            <table id="example1" class="w3-table-all " >
                <thead>
                  <th >Rank</th>
                  <th colspan="2">Name</th>
                  <th>Played</th>
                  <th>Won</th>
                  <th>Draw</th>
                  <th>Lost</th>
                  <th>Points</th>
                  <th>GF</th>
                  <th>GA</th>
                  <th >GD</th>
                                  
              </thead>
                <tbody>

<?php
    if (empty($data)) {
     echo "<p  > 

        Something went wrong..Refresh the page 

    </p> ";
    echo "<p class='w3-button' > 

        Refresh  

    </p> "; 
    echo "<p id='spin' style='display: none;'><i class='fa fa-spinner w3-spin' style='font-size:64px'></i></p>
";
}
else{

$position=count($data['standings'][1]['table']);
        
        for ($i=0; $i <$position ; $i++) { 
            echo "<tr>
<td>".$data['standings'][1]['table'][$i]['position']."</td>
<td>
<img src='".$data['standings'][0]['table'][$i]['team']['crest']."' height='15px' width='20px'>
</td>
<td>
".$data['standings'][0]['table'][$i]['team']['tla']."
</td>
<td>".$data['standings'][1]['table'][$i]['playedGames']."</td>
<td>".$data['standings'][1]['table'][$i]['won']."</td>
<td>".$data['standings'][1]['table'][$i]['draw']."</td>
<td>".$data['standings'][1]['table'][$i]['lost']."</td>
<td>".$data['standings'][1]['table'][$i]['points']."</td>
<td>".$data['standings'][1]['table'][$i]['goalsFor']."</td>
<td>".$data['standings'][1]['table'][$i]['goalsAgainst']."</td>
<td>".$data['standings'][1]['table'][$i]['goalDifference']."</td>
</tr>";
        }
}





    ?>

                </tbody>
            </table>
           </ul>
                   </div>
                    <div id = "tabs-4">
                <ul class="w3-ul w3-hoverable w3-white" id="t1"  >
            <table id="example1" class="w3-table-all " >
                <thead>
                  <th >Rank</th>
                  <th colspan="2">Name</th>
                  <th>Played</th>
                  <th>Won</th>
                  <th>Draw</th>
                  <th>Lost</th>
                  <th>Points</th>
                  <th>GF</th>
                  <th>GA</th>
                  <th >GD</th>
                  
                </thead>
                <tbody>

<?php
    if (empty($data)) {
     echo "<p  > 

        Something went wrong..Refresh the page 

    </p> ";
    echo "<p class='w3-button' > 

        Refresh  

    </p> "; 
    echo "<p id='spin' style='display: none;'><i class='fa fa-spinner w3-spin' style='font-size:64px'></i></p>
";
}
else{
    
$position=count($data['standings'][2]['table']);
        
        for ($i=0; $i <$position ; $i++) { 
            echo "<tr>
<td>".$data['standings'][2]['table'][$i]['position']."</td>
<td>
<img src='".$data['standings'][0]['table'][$i]['team']['crest']."' height='15px' width='20px'>
</td>
<td>
".$data['standings'][0]['table'][$i]['team']['tla']."
</td>
<td>".$data['standings'][2]['table'][$i]['playedGames']."</td>
<td>".$data['standings'][2]['table'][$i]['won']."</td>
<td>".$data['standings'][2]['table'][$i]['draw']."</td>
<td>".$data['standings'][2]['table'][$i]['lost']."</td>
<td>".$data['standings'][2]['table'][$i]['points']."</td>
<td>".$data['standings'][2]['table'][$i]['goalsFor']."</td>
<td>".$data['standings'][2]['table'][$i]['goalsAgainst']."</td>
<td>".$data['standings'][2]['table'][$i]['goalDifference']."</td>

</tr>";
        }
}


    ?>

                </tbody>
            </table>
           </ul>
                   </div>
            </div>
            </div>                
        </div>

        </div>
                
   <?php include 'includes/search_modal.php'; ?>       
</div>


<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</body>
</html>