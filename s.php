<?php include 'includes/session.php'; ?>
<?php include 'includes/title.php';?>
<?php include 'includes/header.php'; ?>
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
 <?php
        $conn=$pdo->open();
        $currentDB=date('Y-m-d H:i:s');
        try { 
        $stmt=$conn->prepare("SELECT * ,updates.name AS update_name, category.name AS catname,category.code AS catcode FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE top=:top LIMIT 2 ");    
        $stmt->execute(['top'=>1]);

if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $seconds = abs(strtotime($currentDB) - strtotime($row['date_posted']));
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';

  "<div class='w3-row'>";
 echo" <div class='w3-half'>
    <div class='w3-row'>
      <div class='w3-col l6 m6 s6'><img src='".$image."' alt='blog image' style='width:100%;>
      </div>
      <div class='w3-col l6 m6 s6'><div class='w3-container'>
    
    <a href='next.php?next=".$row['slug']."' id='view'  class= 'w3-hover-text-yellow w3-text-red'style= 'text-decoration:none;overflow: hidden;
    overflow-wrap: break-word;
   text-overflow: ellipsis;
   display: -webkit-box;
   font-weight:bold;
   -webkit-line-clamp: 3; /* number of lines to show */
   -webkit-box-orient: vertical;' > ".$row['update_name']."
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
  </div>";

   
    } 
}

        } catch (PDOException $e) {
            echo "Connection is broken:".$e->getMessage();
        }
    $pdo->close();
    
?>

  </div>
  <div class="w3-container">
  
  
  <hr id="about">

  <!-- About Section -->
  <div class="w3-container w3-padding-32 w3-center">  
    <h3>About Me, The Food Man</h3><br>
    <img src="/w3images/chef.jpg" alt="Me" class="w3-image" style="display:block;margin:auto" width="800" height="533">
    <div class="w3-padding-32">
      <h4><b>I am Who I Am!</b></h4>
      <h6><i>With Passion For Real, Good Food</i></h6>
      <p>Just me, myself and I, exploring the universe of unknownment. I have a heart of love and an interest of lorem ipsum and mauris neque quam blog. I want to share my world with you. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
    </div>
  </div>
  <hr>
  
  <!-- Footer -->
  <footer class="w3-row-padding w3-padding-32">
    <div class="w3-third">
      <h3>FOOTER</h3>
      <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </div>
  
    <div class="w3-third">
      <h3>BLOG POSTS</h3>
      <ul class="w3-ul w3-hoverable">
        <li class="w3-padding-16">
          <img src="/w3images/workshop.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Lorem</span><br>
          <span>Sed mattis nunc</span>
        </li>
        <li class="w3-padding-16">
          <img src="/w3images/gondol.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Ipsum</span><br>
          <span>Praes tinci sed</span>
        </li> 
      </ul>
    </div>

    <div class="w3-third w3-serif">
      <h3>POPULAR TAGS</h3>
      <p>
        <span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Dinner</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Salmon</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">France</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Drinks</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Flavors</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Cuisine</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Chicken</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Dressing</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Fried</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Fish</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Duck</span>
      </p>
    </div>
  </footer>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
</html>