<?php include 'includes/session.php'; ?>
<?php 
$slug =$_GET['prev'];
$baseUrl="https://sports-hobbyist.lovestoblog.com/previous.php?prev=";
$conn =$pdo->open();
try {
  $stmt =$conn->prepare("SELECT *, updates.name AS updatename , category.name AS catname ,category.id AS catid, updates.id AS updateId FROM updates LEFT JOIN category ON category.id = updates.category_id WHERE slug=:slug");
  $stmt->execute(['slug'=>$slug]);
  $updates=$stmt->fetch();
$updateId=$updates['updateId'];
$catid=$updates['catid'];
} catch (PDOException $e) {
  echo "Connection is broken:".$e->getMessage();

}
$image=(!empty($updates['photo']))?"images/".$updates['photo']:"images/noimage.jpg";
$date=new DateTime($updates['date_posted']);
$postDate=$date->format('D, jS M Y h:i:sa');

  $pdo->close();
?>
<?php 
$conn=$pdo->open();

  $now = date('Y-m-d');
  $stmt=$conn->prepare("SELECT *,COUNT(*) AS numrows FROM views WHERE article_id=:id AND date_view=:now ");
  $stmt->execute(['id'=>$updates['updateId'],'now'=>$now]);
  $vrow=$stmt->fetch();
  if ($vrow['numrows']>0) {
    $stmt = $conn->prepare("UPDATE views SET  counter=counter+1 WHERE article_id=:id AND date_view=:now");
    $stmt->execute(['id'=>$updates['updateId'],'now'=>$now]);

  }
  else{
    try {
    $stmt = $conn->prepare("INSERT INTO views(article_id,date_view,counter) VALUES(:article_id,:date_view,:counter)");
    $stmt->execute(['article_id'=>$updates['updateId'],'date_view'=>$now,'counter'=>1]);    
} catch (PDOException $e) {
  echo "There is some problem in connection: " . $e->getMessage();
}
  }
$pdo->close();
?>
<?php include 'includes/title.php';?>
<!-- Page content -->


  <?php include 'includes/header.php'; ?>

<div class="w3-row-padding">
  <div class="w3-col l8">
    <div >
      <h1>‘<?php echo $updates['updatename'] ;
?></h1>
    </div>
      <div > 
<div class="w3-row-padding">
  <div class="w3-half">
    <div class="w3-bar ">
      <div class="w3-bar-item ">
                <p>By <span class="w3-orange"><?php echo $updates['writers_name'] ;
?></span></p>
                <p class="w3-small"> <i class=" w3-large fa fa-clock-o" aria-hidden="true" style="padding-right: 1px;"></i>Published on: <?php echo $postDate; ?> (EAT)</p>

      </div>
    </div>
  </div>
  <div class="w3-half">
    <div class="w3-bar ">
  <a style="text-decoration: none;" class='w3-xxlarge w3-white w3-button'style="font-weight: bold;font-size: 20px;"> Share:</a>
  <a target="_blank" class="click" data-id='f'  href="http://www.facebook.com/sharer.php?u=<?php echo $baseUrl.$slug ?>"> <img src="images/facebook.png" class="myDIV" style="width:30px;height:30px" ></a>
  <a target="_blank" class="click1" data-id='t'  href="http://twitter.com/share?text=Visit the link &url=<?php echo $baseUrl.$slug ?>&hashtags=blog,technosmarter,programming,tutorials,codes,examples,language,development">
 <img src="images/twitter.png" style="width:30px;height:30px" ></a>
    <a target="_blank" class="click2" data-id='w'  href="whatsapp://send?text=<?php echo $baseUrl.$slug; ?>" data-action="share/whatsapp/share"> <img src="images/whatsapp.png" style="width:30px;height:30px" ></a>
</div>
    </div>

</div>
    </div>
    <div>
      <div >
      <img src="<?php echo (!empty($updates['photo']))? 'images/'.$updates['photo']:'images/noimage.jpg'; ?>" style="width:100%;height:250px">
      <p style=
 ' text-decoration:none;overflow: hidden;
  overflow-wrap: break-word;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 3; /* number of lines to show */
   -webkit-box-orient: vertical;'><?php echo $updates['image_description']; ?></p>
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
  
    <div class="w3-container w3-padding-16">
<div class="w3-bar">
  <?php 
$conn=$pdo->open();
$stmt=$conn->prepare("SELECT *, updates.slug,updates.name AS updatename FROM updates LEFT JOIN category ON category.id = updates.category_id WHERE  updates.id  > ? ORDER BY updates.id  ASC ");
$stmt->execute(array($updateId));
$next = $stmt->fetch();
$stmt=$conn->prepare("SELECT MAX(ID) AS s
FROM updates; "); 
$stmt->execute();
$s=$stmt->fetch();
$next=($s['s']==$updateId)?"":"<a href='next.php?next=".$next['slug']."' style='text-decoration:none' class='w3-button w3-right w3-green'>Next &raquo;</a>"
  ;

$pdo->close();
?>
   
  <?php 
$conn=$pdo->open();  
$stmt=$conn->prepare("SELECT *, updates.slug,updates.name AS updatename FROM updates   LEFT JOIN category ON category.id = updates.category_id WHERE  updates.id  < ? ORDER BY updates.id DESC ");
$stmt->execute(array($updateId));
$prev = $stmt->fetch();
$pdo->close();
?>
<?php
$conn=$pdo->open();
$stmt=$conn->prepare("SELECT MIN(ID) AS b
FROM updates; "); 
$stmt->execute();
$b=$stmt->fetch();

$pdo->close();
?>
<?php 
$previous=($b['b']==$updateId)?"":"<a href='previous.php?prev=".$prev['slug']."' style='text-decoration:none' class='w3-button w3-left w3-light-grey'>&laquo; Previous</a>"
  
  ;
 
 ?>
</div>
  </div>
  <div class=" w3-padding-16">
    <div class="w3-bar">
      <?php echo $previous;echo $next; ?>
    </div>
  </div>
<div >
  <h1>You might also like:</h1>

<?php 
$conn =$pdo->open();
try {
  $inc=3;
  $stmt=$conn->prepare("SELECT * ,updates.name AS update_name, category.name AS catname,category.code AS catcode FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE updates.status=1 AND  updates.id != ? AND category.id!=? ORDER BY updates.id DESC limit 3 ");    $stmt->execute(array($updateId,$catid));
  foreach ($stmt as $row) {
    "<div class='row'>";
echo "
<div class='w3-col l4 m4 '>
<div  class='w3-card-4 w3-margin w3-white' >
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6'  >
                        <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
                    </div>
                    <div class='w3-col l6 m6 s6'>
                        
<div class='w3-container'>
    
    <a href='next.php?next=".$row['slug']."' id='view'  class= 'w3-hover-text-yellow w3-text-red'style= 'text-decoration:none;overflow: hidden;
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

</div>

";
  }

} catch (PDOException $e) {
  echo "Connection is broken:".$e->getMessage();
}
$pdo->close();
?>
  </div>
   <div  style="margin-bottom:10px;">
        <h1  class=w3-text-black><span>Recommended Article</span></h1>
        <div >
            <div id='updates' >
        <?php
        $conn=$pdo->open();
        $currentDB=date('Y-m-d H:i:s');
         try { 
        $stmt=$conn->prepare("SELECT * ,updates.name AS update_name, category.name AS catname,category.code AS catcode FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE updates.status=1 AND  updates.id != ? AND category.id=? ORDER BY updates.id DESC limit 3 ");    $stmt->execute(array($updateId,$catid));

if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $seconds = abs(strtotime($currentDB) - strtotime($row['date_posted']));
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';

 "<div class='row'>";
echo "
<div class='w3-col l4 m4'>
<div  class='w3-card-4 w3-margin w3-white' >
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6'  >
                        <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
                    </div>
                    <div class='w3-col l6 m6 s6'>
                        <div class='w3-container w3-right'>
                            <button style='text-decoration:none' class='w3-button w3-round-xlarge  w3-orange'>Recommended</button>
                        </div>
<div class='w3-container'>
    
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
    <div  style="margin-top:20px">
        <div class="w3-white ">
        <div class=" w3-padding w3-black">
          <h3>Follow Me</h3>
        </div>
        <div class="w3-xlarge w3-padding">
         <a class="w3-bar-item w3-text-black" href="https://twitter.com/Dan11157094"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
    <a href="" class="w3-bar-item w3-text-black "><i class="fa fa-facebook-square" aria-hidden="true" ></i></a>
   <a href="" class="w3-bar-item w3-text-black"><i class="fa fa-whatsapp" aria-hidden="true" ></i></a>
        </div>
      </div>

              </div>
              <div class="w3-white">
                <div  >
<p style="font-weight: bold;font-size: 20px;">Welcome Sports Enthusiat</p>
<p>We are here to bring you news and information about your favorite teams and players. Expect nothing but the best sports coverage; buckle up and enjoy the ride. </p>
              </div>
              </div>
              <div class="w3-white w3-margin">
              
               <div id = "tabs-1" style="overflow-y: scroll;">
         <ul>
            <li><a href = "#tabs-2">Popular</a></li>
            <li><a href = "#tabs-3">Recent</a></li>
            
         </ul>
                  <div id = "tabs-2" style="margin-left: 1px;">
           <ul  class="w3-ul w3-hoverable w3-white" id="t1" >
            <?php
            $conn=$pdo->open();
            $count=0;
                        $stmt=$conn->prepare("SELECT *, updates.id AS updateid FROM updates
LEFT JOIN (SELECT article_id, SUM(counter) as total
FROM views  GROUP BY article_id ) v  ON updates.id=v.article_id  WHERE updates.status=:status ORDER BY total DESC LIMIT 10");

            $stmt->execute(['status'=>1]);
            foreach($stmt as $row){
            $image=(!empty($row['photo']))?'images/'.$row['photo']:"images/noimage.jpg";   
echo"<li class='w3-padding-16'>
<div class='w3-row'>
  <div class='w3-col s3 l3'>
        <img src='".$image."' alt='Image' class='w3-left w3-margin-right' style='width:100%'>
  </div>
  <div class='w3-col s9 l9 w3-container'>
     <a href='page.php?page=".$row['slug']."' style='text-decoration:none;'>
            <span class='w3-large w3-text-black' style='word-wrap: break-word;         /* All browsers since IE 5.5+ */
    overflow-wrap: break-word; 
overflow: hidden;
        /* Renamed property in CSS3 draft spec */
    width: 80%;
    text-decoration:none;
    -webkit-line-clamp: 2; /* number of lines to show */
   -webkit-box-orient: vertical;
   text-overflow: ellipsis;line-clamp: 2;
   '>
            ".$row['name']."
            </span>
             </a>         
  </div>
</div>
          </li>";
            }
            $pdo->close();
            ?>
           </ul>
         </div>

         <div id = "tabs-3">
               <ul class="w3-ul w3-hoverable w3-white" id="t1"  >
            <?php

            $conn=$pdo->open();
                        $stmt=$conn->prepare("SELECT * FROM updates WHERE status=:status ORDER BY date_posted DESC LIMIT 10");
            $stmt->execute(['status'=>1]);
            foreach($stmt as $row){
            $image=(!empty($row['photo']))?'images/'.$row['photo']:"images/noimage.jpg";   
echo"<li class='w3-padding-16'>
           <div class='w3-row'>
  <div class='w3-col s3 l3'>
        <img src='".$image."' alt='Image' class='w3-left w3-margin-right' style='width:100%'>
  </div>
  <div class='w3-col s9 l9 w3-container'>
     <a href='page.php?page=".$row['slug']."' style='text-decoration:none;'>
            <span class='w3-large w3-text-black' style='word-wrap: break-word;         /* All browsers since IE 5.5+ */
    overflow-wrap: break-word; 
overflow: hidden;
        /* Renamed property in CSS3 draft spec */
    width: 80%;

    -webkit-line-clamp: 2; /* number of lines to show */
   -webkit-box-orient: vertical;
   text-overflow: ellipsis;line-clamp: 2;
   '>
            ".$row['name']."
            </span>
             </a>         
  </div>
</div>
         
          </li>";
  }
           
           $pdo->close(); ?>
           </ul>
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