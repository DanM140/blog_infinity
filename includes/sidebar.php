    <div class="w3-container " style="margin-top:20px">
        <div class="w3-white ">
        <div class="w3-container w3-padding w3-black">
          <h3>Follow Me</h3>
        </div>
        <div class="w3-container w3-xlarge w3-padding">
         <a class="w3-bar-item w3-text-black" href="https://twitter.com/Dan11157094"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
    <a href="" class="w3-bar-item w3-text-black "><i class="fa fa-facebook-square" aria-hidden="true" ></i></a>
   <a href="" class="w3-bar-item w3-text-black"><i class="fa fa-whatsapp" aria-hidden="true" ></i></a>
        </div>
      </div>

              </div>
              <div class="w3-white">
                <div class="w3-container  " >
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