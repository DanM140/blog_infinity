<?php include'includes/session.php' ?>
<?php 
$id =$_GET['prev'];
$baseUrl="http://localhost/preview?prev=";
$conn =$pdo->open();
try {
  $stmt =$conn->prepare("SELECT *, published.name AS updatename , category.name AS catname ,published.id AS updateId FROM published LEFT JOIN category ON category.id = published.category_id WHERE published.id=:id");
  $stmt->execute(['id'=>$id]);
  $updates=$stmt->fetch();
$updateId=$updates['updateId'];
} catch (PDOException $e) {
  echo "Connection is broken:".$e->getMessage();

}
$image=(!empty($updates['photo'])) ? '../images/'.$updates['photo'] : '../images/noimage.jpg';
$date=new DateTime($updates['date_posted']);
$postDate=$date->format('D, jS M Y h:i:sa');

  $pdo->close();
?>
<?php 
include 'includes/title.php';
?>
  <?php include 'includes/menu.php'; ?>
<body class="w3-light-grey">
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
    <div class="w3-container">
      <h1>‘<?php echo $updates['updatename'] ;?></h1>
    </div>
     
    <div class="w3-container">
      <div class="w3-container">
      <img src="<?php echo (!empty($updates['photo']))? '../images/'.$updates['photo']:'../images/noimage.jpg'; ?>" style="width:100%;height:250px">
      <p>Picture Description</p>
    </div>
    <div style=
 ' text-decoration:none;overflow: hidden;
  overflow-wrap: break-word;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1000; /* number of lines to show */
   -webkit-box-orient: vertical;'
  > <?php echo $updates['description']; ?></div>
    </div>
  
   

 
    
 
<?php include 'includes/profile_modal.php';?>
   
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    
    <p>Powered by <a href="#" target="_blank">Me and myself</a></p>
  </footer>

  <!-- End page content -->
</div>
 
 <?php include 'includes/scripts.php'; ?><script>


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

</body>
</html>
