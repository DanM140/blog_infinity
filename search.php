<?php include 'includes/session.php';?>
<?php include 'includes/title.php';?>
  <?php include 'includes/header.php'; ?>
  <!--Grid-->
  <div class="w3-container" style="margin-bottom:50px;">
    <?php
$search =$_GET['search'];
     ?>
    
       
            <div class="w3-container w3-center w3-padding-top-16">
  <form >
    <p>      
    
    <input class="w3-round w3-border w3-sand " style="width:30%" name="search" type="text"  value="<?php echo $search; ?>">
<button class="w3-btn w3-brown" type="submit">Search</button>
  </p>  </form>
</div>
        <div id='search_updates' >
    <?php
    $conn=$pdo->open();
    try {
    $stmt=$conn->prepare("SELECT * ,category.name AS catname FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE updates.name like '%$search%' or description like '%$search%' ");  
    $stmt->execute(['status'=>1]);
if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';
              echo "<div  class='w3-card-4 w3-margin w3-white' >
        <div class='w3-row'>
          <div class='w3-half'  >
            <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
          </div>
          <div class='w3-half'>
            <div class='w3-container'>
              <h5><span class='w3-orange'> ".$row['catname'].",</span></h5>
            </div>
<div class='w3-container'>
  
  <a href='next.php?next=".$row['slug']."' class= 'w3-hover-text-yellow w3-text-red'style= 'text-decoration:none;overflow: hidden;
  overflow-wrap: break-word;
   text-overflow: ellipsis;
   display: -webkit-box;
   font-weight:bold;
   -webkit-line-clamp: 3; /* number of lines to show */
   -webkit-box-orient: vertical;' > ".$row['name']."
        </a>

        <div style=
 ' text-decoration:none;overflow: hidden;
  overflow-wrap: break-word;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 3; /* number of lines to show */
   -webkit-box-orient: vertical;'
  >".$row['description']." </div>
</div>

          </div>
        </div>

      </div>
    
    ";   
    }
}

    } catch (PDOException $e) {
      echo "Connection is broken:".$e->getMessage();
    }
  $pdo->close();
  
?>
        
    </div>

    </div>
        
    
   


<?php include 'includes/search_modal.php'; ?>
    </div>

  
    <?php include 'includes/scripts.php'; ?>
</body>
</html>


