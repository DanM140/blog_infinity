
							<div class="w3-white w3-margin">
							
				 			 <div id = "tabs-1">
         <ul>
            <li><a href = "#tabs-2">Popular</a></li>
            <li><a href = "#tabs-3">Recent</a></li>
                     </ul>
                  <div id = "tabs-2" style="margin-left: 1px;">
           <ul  class="w3-ul w3-hoverable w3-white" id="t1" >
           	<?php
           	$conn=$pdo->open();
            $count=0;
                      	$stmt=$conn->prepare("SELECT * FROM updates WHERE category_id=11 ORDER BY counter DESC LIMIT 5");
           	$stmt->execute();
           	foreach($stmt as $row){
            $image=(!empty($row['photo']))?'images/'.$row['photo']:"images/noimage.jpg";   
echo"<li class='w3-padding-16'>
<div class='w3-row'>
  <div class='w3-col s3 l3'>
        <img src='".$image."' alt='Image' class='w3-left w3-margin-right' style='width:100%'>
  </div>
  <div class='w3-col s9 l9 w3-container'>
     <a href='pop.php?product=".$row['slug']."'>
            <span class='w3-large' style='word-wrap: break-word;         /* All browsers since IE 5.5+ */
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
           	?>
           </ul>
         </div>
         <div id = "tabs-3">
         	    <ul class="w3-ul w3-hoverable w3-white" id="t1"  >
           	<?php

           	$conn=$pdo->open();
                      	$stmt=$conn->prepare("SELECT * FROM updates WHERE category_id=11  ORDER BY date_posted DESC LIMIT 5");
           	$stmt->execute();
           	foreach($stmt as $row){
            $image=(!empty($row['photo']))?'images/'.$row['photo']:"images/noimage.jpg";   
echo"<li class='w3-padding-16'>
           <div class='w3-row'>
  <div class='w3-col s3 l3'>
        <img src='".$image."' alt='Image' class='w3-left w3-margin-right' style='width:100%'>
  </div>
  <div class='w3-col s9 l9 w3-container'>
     <a href='pop.php?product=".$row['slug']."'>
            <span class='w3-large' style='word-wrap: break-word;         /* All browsers since IE 5.5+ */
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
           	?>
           </ul>
                   </div>
               </div>

							</div> 