<?php include'includes/session.php';
 include 'includes/format.php'; 
 ?>
<?php 
include 'includes/title.php';
?>
<?php 
$year=date('Y');
$now=date('Y-m-d');
$curr_year=date('Y');
$month=date('m');
$week = date("W");
if(isset($_GET['year'])){
    $year = $_GET['year'];
  }

?>


  <?php include 'includes/menu.php'; ?>
<body class="">
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
 <?php include 'includes/header.php' ;?>
    <div class="w3-row-padding " style="margin:0 -16px">
      <div class="w3-container">
        <div class="w3-row-padding">
          <div class="w3-col l4 m4 s4">
            <div class="w3-bar">
              <div class="w3-bar-item"><p>Facebook</p></div>
               <div class="w3-bar-item "><p class="w3-red" style="width:50px;height: 30px;"></p></div>
          </div>

        </div>
        <div class="w3-col l4 m4 s4">
            <div class="w3-bar">
              <div class="w3-bar-item"><p>Whatsapp</p></div>
               <div class="w3-bar-item "><p class="w3-green" style="width:50px;height: 30px;"></p></div>
          </div>
        </div>
<div class="w3-col l4 m4 s4">
            <div class="w3-bar">
              <div class="w3-bar-item"><p>Twitter</p></div>
               <div class="w3-bar-item "><p class="w3-blue" style="width:50px;height: 30px;"></p></div>
          </div>

        </div>

        <canvas id="bar_b" style="height:350px"></canvas>
      </div>
      <div class="w3-container">
        <canvas id="bar" style="height:350px"></canvas>

      </div>
              <div class="w3-container">
            <div class="w3-large w3-left"><b>Monthly Clicks Graph</b></div>
<div class=" w3-right" >
   <label>Select Year: </label>
<select class="w3-select w3-border"  name="year" id="select_year"required>
                      <?php
                        for($i=2023; $i<=2065; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "
                            <option value='".$i."' ".$selected.">".$i."</option>
                          ";
                        }
                      ?>
                                         </select></div>
              <div class="w3-container">
                <br>
                                <canvas id="barChart" style="height:350px"></canvas>
              </div>

            </div>  
                
                              
         </div>
  </div>
  

  <!-- End page content -->
 
  <?php include 'includes/profile_modal.php'; ?>
    
</div>
<!--First and Last Day-->
<?php

$fd = date('d', strtotime("this week"));
 $ld=$fd+6;

?>
<!--daily whatsapp shares -->
<?php 
$conn=$pdo->open();

$whatsapp_shares=array();
$days_w=array();
$w="w";
for ($d_w=$fd; $d_w <=$ld ; $d_w++) { 
  try {
    $stmt=$conn->prepare("SELECT *, WEEK(date_shared,7) FROM shares WHERE
YEARWEEK(date_shared) = YEARWEEK(NOW()) AND DAY(date_shared)=:day_w 
   AND share_id=:w AND EXTRACT(WEEK FROM date_shared)=:week ");
    $stmt->execute(['day_w'=>$d_w,'w'=>$w,'week'=>$week]);
    $total_w=0;
    foreach($stmt as $wrow){
$total_w+=$wrow['counter'];
    }
    array_push($whatsapp_shares, round($total_w,2));
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
$num_w=str_pad($d_w, 2, 0, STR_PAD_LEFT);
$day_w=date('l',mktime(0,0,0,$month,$num_w,$curr_year));
array_push($days_w,$day_w);
}
$days_w = json_encode($days_w);
  $whatsapp_shares = json_encode($whatsapp_shares);
 $pdo->close();  
?>

<?php 
$facebook_shares=array();
$f="f";
for ($d_f=$fd; $d_f <=$ld ; $d_f++) { 
  try {
    $stmt=$conn->prepare("SELECT *, WEEK(date_shared,7) FROM shares WHERE YEARWEEK(date_shared) = YEARWEEK(NOW()) AND
DAY(date_shared)=:day_f 
   AND share_id=:f ");
    $stmt->execute(['day_f'=>$d_f,'f'=>$f]);
    $total_f=0;
    foreach($stmt as $frow){
$total_f+=$frow['counter'];
    }
    array_push($facebook_shares, round($total_f,2));
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}
  $facebook_shares = json_encode($facebook_shares);
  
?>

<?php 
$t_shares=array();
$t="t";
for ($d_t=$fd; $d_t <=$ld ; $d_t++) { 
  try {
    $stmt=$conn->prepare("SELECT *, WEEK(date_shared,7) FROM shares WHERE YEARWEEK(date_shared) = YEARWEEK(NOW()) AND
DAY(date_shared)=:day_t 
   AND share_id=:t ");
    $stmt->execute(['day_t'=>$d_t,'t'=>$t]);
    $total_t=0;
    foreach($stmt as $trow){
$total_t+=$trow['counter'];
    }
    array_push($t_shares, round($total_t,2));
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

}
  $t_shares = json_encode($t_shares);
 $pdo->close(); 
?>
<!--daily views per week-->
<?php 
$conn=$pdo->open();
$days=array();
$daily_views=array();

for ($d=$fd; $d <=$ld ; $d++) { 
  try {
    $stmt=$conn->prepare("SELECT *, WEEK(date_view,7) FROM views WHERE
 YEARWEEK(date_view) = YEARWEEK(NOW()) AND DAY(date_view)=:d    ");
    $stmt->execute(['d'=>$d]);
    $total_d=0;
    foreach($stmt as $drow){
     
$total_d+=$drow['counter'];
     
    }
    array_push($daily_views, round($total_d,2));
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
$num=str_pad($d, 2, 0, STR_PAD_LEFT);
$day=date('l',mktime(0,0,0,$month,$num,$curr_year));
array_push($days,$day);
}
$days = json_encode($days);
  $daily_views = json_encode($daily_views);
   
?>
<!--monthly views-->

<?php 

$months=array();
$views=array();
for ($m=1; $m <=12 ; $m++) { 
  try {
    $stmt=$conn->prepare("SELECT * FROM views WHERE
MONTH(date_view)=:month AND YEAR(date_view)=:year
    ");
    $stmt->execute(['month'=>$m,'year'=>$year]);
    $total=0;
    foreach($stmt as $vrow){
$total+=$vrow['counter'];

    }
    array_push($views, round($total,2));
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
$num=str_pad($m, 2, 0, STR_PAD_LEFT);
$month=date('M',mktime(0,0,0,$num,1));
array_push($months,$month);
}
$months = json_encode($months);
  $views = json_encode($views);
   $pdo->close();
?>
<script>
  var cty = $('#bar'); // jQuery instance
new Chart(cty, {
  type: "bar",
  data: {
    labels: <?php echo $days;?>,
    datasets: [{
      backgroundColor: "brown",
      data: <?php echo $daily_views;?>
    },]
  },
  options: {
    legend: {display: false},
    responsive: true,
    title: {
      display: true,
      text: "Current Week's daily Clicks",
      font: {
                    weight: 'bold'
                }
    }
  }
});
</script>
<script>
  var ctd = $('#bar_b'); // jQuery instance

new Chart(ctd, {
  type: "bar",
  data: {
    labels: <?php echo $days_w;?>,
    datasets: [{
      backgroundColor: "red",
      data: <?php echo $facebook_shares;?>
    },{
      backgroundColor: "green" ,
      data: <?php echo $whatsapp_shares;?>
    },{
      backgroundColor: "blue",
      data: <?php echo $t_shares;?>
    }]
  },
  options: {
    legend: {display: false},
    responsive: true,
    title: {
      display: true,
      text: "Current Week's shares s",
      font: {
                    weight: 'bold'
                }
    }
  }
});
</script>

<script>
  var ctx = $('#barChart'); // jQuery instance
var barColors = ["red", "green","blue","orange","brown"];

new Chart(ctx, {
  type: "bar",
  data: {
    labels: <?php echo $months;?>,
    datasets: [{
      backgroundColor: barColors,
      data: <?php echo $views;?>
    }]
  },
  options: {
    legend: {display: false},
    responsive: true,
    title: {
      display: true,
      text: "Number of Clicks In A Given Month",
      font: {
                    weight: 'bold'
                }
    }
  }
});
</script>
<script type="text/javascript">
          $(function(){
  $('#select_year').change(function(){
    window.location.href = 'home.php?year='+$(this).val();
  });
});
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
      </script>
    
</body>
</html>
