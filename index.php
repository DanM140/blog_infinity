<?php include 'includes/session.php'; ?>
<?php include 'includes/title.php';?>
<!-- Page content -->
<?php include 'includes/header.php'; ?>
<div class="w3-row">
<div class="w3-col l8">
<div  style="margin-bottom: 10px;margin-top: 10px;">
<div class="scrollmenu">
<a href='champions.php?champ=CL' style='text-decoration:none' class='w3-button w3-border w3-round-xxlarge '>Champions League</a>
<a href='league.php?league=PL' style='text-decoration:none' class='w3-button w3-border w3-round-xxlarge  '>EPL</a>
<a href='league.php?league=BL1' style='text-decoration:none' class='w3-button w3-border w3-round-xxlarge  '>Bundesliga</a>
<a href='league.php?league=SA' style='text-decoration:none' class='w3-button w3-border w3-round-xxlarge '>Serie A</a>
  <a href='league.php?league=DED' style='text-decoration:none' class='w3-button w3-border w3-round-xxlarge  '>Eredivisie</a>
  <a href='league.php?league=FL1' style='text-decoration:none' class='w3-button w3-border w3-round-xxlarge  '>French Ligue One</a>
  
</div>
 </div>
        
     <div  style="margin-bottom:10px;">
        <h3 id='h2' class=w3-text-red><span>Top Stories</span></h3>
            <div id='updates' >
        <?php
        $conn=$pdo->open();

        try { 
        $stmt=$conn->prepare("SELECT * ,updates.name AS update_name, category.name AS catname,category.code AS catcode FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE top=:top LIMIT 2 ");    
        $stmt->execute(['top'=>1]);

if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';

 "<div class='row'>";
echo "
<div class='w3-col l6 '>
<div  class='w3-card-4 w3-margin w3-white' >
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6'  >
                        <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
                    </div>
                    <div class='w3-col l6 m6 s6'>
                        <div class='w3-container w3-right'>
                            <button style='text-decoration:none' class='w3-button w3-round  w3-orange'>Top Stories</button>
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
  <div class="w3-row  w3-center" >
    <h3 id='h2' class=w3-text-red><span>Football</span> <span class="w3-right"><a href='football.php' style='text-decoration:none' class='w3-button  '>View More</a></span></h3>            
            <div id='Football' >
        <?php
        $conn=$pdo->open();
        $class="f";
                try { 
        $stmt=$conn->prepare("SELECT *,updates.name AS update_name, category.name AS catname,category.code AS catcode FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE status=:status AND category.class=:class LIMIT 2 ");    
        $stmt->execute(['status'=>1,'class'=>$class]);
if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';

     "<div class='row'>";
echo "
<div class='w3-col l6 '>
<div  class='w3-card-4 w3-margin w3-white' >
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6'  >
                        <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
                    </div>
                    <div class='w3-col l6 m6 s6'>
                        <div class='w3-container w3-right'>
                            <a href='league.php?league=".$row['catcode']."' style='text-decoration:none' class='w3-button w3-round-xlarge  w3-orange'>".$row['catname']."</a>
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
  <div class="w3-row  w3-center" >
    <h3 id='h2' class=w3-text-red><span>Athletics</span> <span class="w3-right"><a href='others.php?gen=athletics' style='text-decoration:none' class='w3-button  '>View More</a></span></h3>            
            <div  >
        <?php
        $conn=$pdo->open();
        $code="athletics";
                try { 
        $stmt=$conn->prepare("SELECT *,updates.name AS update_name, category.name AS catname,category.code AS catcode FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE status=:status AND category.code=:code LIMIT 2 ");    
        $stmt->execute(['status'=>1,'code'=>$code]);
if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';

     "<div class='row'>";
echo "
<div class='w3-col l6 '>
<div  class='w3-card-4 w3-margin w3-white' >
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6'  >
                        <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
                    </div>
                    <div class='w3-col l6 m6 s6'>
                        <div class='w3-container w3-right'>
                            <a href='league.php?league=".$row['catcode']."' style='text-decoration:none' class='w3-button w3-round-xlarge  w3-orange'>".$row['catname']."</a>
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
<div class="w3-row  w3-center" >
    <h3 id='h2' class=w3-text-red><span>Boxing</span> <span class="w3-right"><a href='others.php?gen=boxing' style='text-decoration:none' class='w3-button  '>View More</a></span></h3>            
            <div  >
        <?php
        $conn=$pdo->open();
        $code="boxing";
                try { 
        $stmt=$conn->prepare("SELECT *,updates.name AS update_name, category.name AS catname,category.code AS catcode FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE status=:status AND category.code=:code LIMIT 2 ");    
        $stmt->execute(['status'=>1,'code'=>$code]);
if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';

     "<div class='row'>";
echo "
<div class='w3-col l6 '>
<div  class='w3-card-4 w3-margin w3-white' >
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6'  >
                        <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
                    </div>
                    <div class='w3-col l6 m6 s6'>
                        <div class='w3-container w3-right'>
                            <a href='league.php?league=".$row['catcode']."' style='text-decoration:none' class='w3-button w3-round-xlarge  w3-orange'>".$row['catname']."</a>
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
<div class="w3-row  w3-center" >
    <h3 id='h2' class=w3-text-red><span>MMA</span> <span class="w3-right"><a href='others.php?gen=mma' style='text-decoration:none' class='w3-button  '>View More</a></span></h3>            
            <div id='Football' >
        <?php
        $conn=$pdo->open();
        $code="mma";
                try { 
        $stmt=$conn->prepare("SELECT *,updates.name AS update_name, category.name AS catname,category.code AS catcode FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE status=:status AND category.code=:code LIMIT 2 ");    
        $stmt->execute(['status'=>1,'code'=>$code]);
if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';

     "<div class='row'>";
echo "
<div class='w3-col l6 '>
<div  class='w3-card-4 w3-margin w3-white' >
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6'  >
                        <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
                    </div>
                    <div class='w3-col l6 m6 s6'>
                        <div class='w3-container w3-right'>
                            <a href='league.php?league=".$row['catcode']."' style='text-decoration:none' class='w3-button w3-round-xlarge  w3-orange'>".$row['catname']."</a>
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
<div class="w3-row  w3-center" >
    <h3 id='h2' class=w3-text-red><span>Rugby</span> <span class="w3-right"><a href='others.php?gen=rugby' style='text-decoration:none' class='w3-button  '>View More</a></span></h3>            
            <div >
        <?php
        $conn=$pdo->open();
        $code="rugby";
                try { 
        $stmt=$conn->prepare("SELECT *,updates.name AS update_name, category.name AS catname,category.code AS catcode FROM updates LEFT JOIN category ON category.id=updates.category_id WHERE status=:status AND category.code=:code LIMIT 2 ");    
        $stmt->execute(['status'=>1,'code'=>$code]);
if($stmt->rowCount() == 0){
    echo "No Updates Found.";
}
else{
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $image =(!empty($row['photo'])) ? 'images/'.$row['photo']:'images/noimage.jpg';

     "<div class='row'>";
echo "
<div class='w3-col l6 '>
<div  class='w3-card-4 w3-margin w3-white' >
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6'  >
                        <img src='".$image."' alt='blog image' style='width:100%;height:200px'>
                    </div>
                    <div class='w3-col l6 m6 s6'>
                        <div class='w3-container w3-right'>
                            <a href='league.php?league=".$row['catcode']."' style='text-decoration:none' class='w3-button w3-round-xlarge  w3-orange'>".$row['catname']."</a>
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
        <?php include 'includes/sidebar.php'; ?>

    </div>
</div>
    <?php include 'includes/search_modal.php'; ?>  


    <?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
 </body>
</html>