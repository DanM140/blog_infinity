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
<div class="w3-center w3-text-red w3-xlarge">Top Scorer</div>
<div  style="margin-bottom: 10px;margin-top: 10px;">

<?php include 'includes/epl_leagues.php';?>
             <div >
            <div id='' > 
            <?php

$cache_instance =$cache->getItem('topscorer'.$slug);
if (is_null($cache_instance->get())) {
$baseUrl="http://api.football-data.org/v4/competitions/".$slug."/scorers?limit=20";
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

$topscorer = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if (!$err) {
  $cache_instance->set($topscorer)->expiresAfter(60);
$cache->save($cache_instance);  
}
}
else{
$topscorer=$cache_instance->get();
}
$scorer=json_decode($topscorer, true)  ;
?>
<div class="w3-white w3-responsive " >
                <table id="example1" class="w3-table-all " >
                <thead>
                  <th >Pos</th>
                  <th colspan="2">Player</th>
                  <th>Matches</th>
                  <th>Goals</th>
                  <th>Assists</th>
                  <th>Penalties</th>
                </thead>
                <tbody>

<?php
    if (empty($scorer)) {
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
$total =count($scorer['scorers']);
for ($i=0; $i <$total ; $i++) { 
$pos=$i+1;
$image=$scorer['scorers'][$i]['team']['crest'];
$name=$scorer['scorers'][$i]['player']['name'];
$goals=$scorer['scorers'][$i]['goals'];
$assists=$scorer['scorers'][$i]['assists'];
$pen=$scorer['scorers'][$i]['penalties'];
$matches=$scorer['season']['currentMatchday'];
            echo "<tr>
<td>".$pos."</td>
<td>
<img src='".$image."' height='20px' width='20px'>
</td>
<td>".$name."</td>
<td>".$matches."</td>
<td>".$goals."</td>
<td>".$assists."</td>
<td>".$pen."</td>
</tr>";
}                   
}
    ?>

                </tbody>
            </table>

            </div>        
        </div>

        </div> 
        <?php include 'includes/search_modal.php'; ?>       
</div>
<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</body>
</html>