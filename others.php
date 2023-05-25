<?php include 'includes/session.php'; 
$slug=$_GET['gen'];
$conn=$pdo->open();
$stmt=$conn->prepare("SELECT * FROM category WHERE code=:code");
$stmt->execute(['code'=>$slug]);
$row_cat=$stmt->fetch();
?>
<?php include 'includes/title.php';?>
<?php include 'includes/header.php';?>
<h3 id='h2' class=w3-text-red><span><?php echo $row_cat['name'];?></span></h3>
<div  style="margin-bottom: 10px;margin-top: 10px;">
<div class="w3-row-padding">
    <div class="w3-col l8">
     <div  style="margin-bottom:10px;">
        <div>
            <div id='epl' >
        <?php
        
        
                try {   
        $stmt=$conn->prepare("SELECT *,updates.name AS update_name, category.name AS catname FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE status=:status AND category.code =:epl ");    
        $stmt->execute(['status'=>1,'epl'=>$slug]);
if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';

 "<div class='row'>";
echo "
<div class='w3-col l6 m6 '>
<div  class='w3-card-4  w3-white' >
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6 '  >
                        <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
                    </div>
                    <div class='w3-col l6 m6 s6'>
                        <div class='w3-container'>
                            <h5><span class='w3-orange'> ".$row['catname'].",</span></h5>
                        </div>
<div >
    
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
                
        
</div>
</div>
<div class="w3-col l4">
 <?php include 'includes/sidebar.php'; ?>
  
</div>
<?php include 'includes/search_modal.php'; ?>  
</div>
</div>
<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</body>
</html>