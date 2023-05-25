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
<h3 id='h2' class=w3-text-red><span><?php echo $row_cat['name'];?></span> </h3>
<div class="w3-center w3-text-red w3-xlarge">Top Scorer</div>
<div class="w3-container">
    <?php include 'includes/champ_leagues.php';?>
</div>
     <div  style="margin-bottom:50px;">
        <div >
            <div id='' > 
            <?php

$cache_instance =$cache->getItem('topscorerj');
if (is_null($cache_instance->get())) {
$baseUrl="http://api.football-data.org/v4/competitions/CL/scorers?limit=20";
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
<div class="w3-container w3-white w3-responsive " style="padding-top:20px;" >
                <table id="example1" class="w3-table-all " >
                <thead>
                  <th >Pos</th>
                  <th colspan="2">Player</th>
                                  <th>Goals</th>
                  <th>Assists</th>
                  <th>Penalties</th>
                </thead>
                <tbody>

<?php
    if (empty($scorer)) {
     echo "<p > 

        Something went wrong..Refresh the page 

    </p> ";
    echo "<p class='w3-button'> 

        Refresh  

    </p> "; 
    echo "<p id='spin' style='display: none;'><i class='fa fa-spinner w3-spin' style='font-size:64px'></i></p>
";
}
else{

for ($i=0; $i <20 ; $i++) { 
$pos=$i+1;
$image=$scorer['scorers'][$i]['team']['crest'];
$name=$scorer['scorers'][$i]['player']['name'];
$goals=$scorer['scorers'][$i]['goals'];
$assists=$scorer['scorers'][$i]['assists'];
$pen=$scorer['scorers'][$i]['penalties'];
            echo "<tr>
<td>".$pos."</td>
<td>
<img src='".$image."' height='20px' width='20px'>
</td>
<td>".$name."</td>
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
</div>
<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</body>
</html>