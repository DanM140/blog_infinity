<?php include 'includes/session.php'; ?>
<?php 
$slug =$_GET['article'];
$baseUrl="http://localhost/blog?article=";
$conn =$pdo->open();
try {
	$stmt =$conn->prepare("SELECT *, updates.name AS updatename , category.name AS catname ,updates.id AS updateId FROM updates LEFT JOIN category ON category.id = updates.category_id WHERE slug=:slug");
	$stmt->execute(['slug'=>$slug]);
	$updates=$stmt->fetch();
$updateId=$updates['updateId'];
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
		$stmt = $conn->prepare("UPDATE views SET  counter=counter+1 WHERE article_id=:id");
		$stmt->execute(['id'=>$updates['updateId']]);

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
		<div class="w3-container">
			<h1>‘<?php echo $updates['updatename'] ;?></h1>
		</div>
			<div class="w3-container"> 
<div class="w3-row-padding">
	<div class="w3-half">
		<div class="w3-bar ">
			<div class="w3-bar-item ">
								<p>By <span class="w3-orange">Writer</span></p>
								<p class="w3-small"> <i class=" w3-large fa fa-clock-o" aria-hidden="true" style="padding-right: 1px;"></i>Published on: <?php echo $postDate; ?> (EAT)</p>

			</div>
		</div>
	</div>
	<div class="w3-half">
		<div class="w3-bar ">
  <p style="font-weight: bold;font-size: 20px;"> Share:<i class="fa fa-arrow-down" aria-hidden="true"></i></p>
  <a target="_blank" class="click" data-id='f'  href="http://www.facebook.com/sharer.php?u=<?php echo $baseUrl.$slug ?>"> <img src="images/facebook.png" class="myDIV" style="width:30px;height:30px" ></a>
  <a target="_blank" class="click1" data-id='t'  href="http://twitter.com/share?text=Visit the link &url=<?php echo $baseUrl.$slug ?>&hashtags=blog,technosmarter,programming,tutorials,codes,examples,language,development">
 <img src="images/twitter.png" style="width:30px;height:30px" ></a>
    <a target="_blank" class="click2" data-id='w'  href="whatsapp://send?text=<?php echo $baseUrl.$slug; ?>" data-action="share/whatsapp/share"> <img src="images/whatsapp.png" style="width:30px;height:30px" ></a>
</div>
		</div>

</div>
		</div>
	<div class="w3-container">
			<img src="<?php echo (!empty($updates['photo']))? 'images/'.$updates['photo']:'images/noimage.jpg'; ?>" style="width:100%;height:250px">
			<p>Picture Description</p>
		</div>
		<div class="w3-container w3-white" style="margin-bottom: 70px;" >
			<p> <?php echo $updates['description']; ?>   </p>
			<a href="h" class="w3-black w3-button w3-right" style="margin-right:10px;list-style: none;"><b>Replies  </b> <span class="w3-tag w3-white">3</span></a>
		</div>
		<div class="w3-container w3-padding-16">
<div class="w3-bar">
	<?php 
$conn=$pdo->open();
$stmt=$conn->prepare("SELECT *, updates.slug,updates.name AS updatename FROM updates LEFT JOIN category ON category.id = updates.category_id WHERE  updates.id  > ? ORDER BY updates.id  ASC ");
$stmt->execute(array($updateId));
$prev = $stmt->fetch();
?>
  <a href=" previous.php?prev=<?php echo $prev['slug'];?>" style="text-decoration:none" class="w3-button w3-left w3-light-grey">&laquo; Previous</a>
  <?php 
$conn=$pdo->open();  
$stmt=$conn->prepare("SELECT *, updates.slug,updates.name AS updatename FROM updates   LEFT JOIN category ON category.id = updates.category_id WHERE  updates.id  < ? ORDER BY updates.id DESC ");
$stmt->execute(array($updateId));
$next = $stmt->fetch();
?>
   <a href=" next.php?next=<?php echo $next['slug'];?>" style="text-decoration:none" class="w3-button w3-right w3-green">Next &raquo;</a>
</div>
	</div>
<div class="w3-container">
	<h1>You might also like:</h1>

<?php 
$conn =$pdo->open();
try {
	$inc=3;
	$stmt=$conn->prepare("SELECT * FROM updates WHERE  updates.id != ? ORDER BY updates.id DESC limit 3");
	$stmt->execute(array($updateId));
	foreach ($stmt as $row) {
		$image = (!empty($row['photo']))? 'images/'.$row['photo']:'images/noimage.jpg';
		$inc = ($inc==3)? 1 : $inc+1;
		if ($inc==1) echo "<div class='w3-row-padding'>";
		echo "<div class= 'w3-col l3'>
			<a href='h'><img src='".$image."' style='width:100%;' alt='suggestion'></a>
						<a href='u.php?product=".$row['slug']."' style='text-decoration:none;'><p>".$row['name']."</p></a>
		</div>
";
	if($inc == 3) echo "</div>";
	}
if ($inc==1) echo "<div class='w3-col l3'></div><div class='w3-col l3'></div><div class='w3-col l3'></div></div>";

} catch (PDOException $e) {
	echo "Connection is broken:".$e->getMessage();
}
$pdo->close();
?>
	</div>
<div class="w3-container">
	<div class="w3-row">
		<div class="w3-col l6 m6 s6">
			<div class="w3-container w3-padding ">
          <h3 style="
		text-align: center;
		font-size: 30px;
">Subscribe</h3>
        </div>
<div class="w3-container w3-white">
          <p>Enter your e-mail below and get notified on the latest blog posts.</p>
          <form>
          	<p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail" style="width:100%"></p>
          <p><button type="button"   class="w3-button w3-block w3-red">Subscribe</button></p>
          </form>
          
        </div>


		</div>
		<div class="w3-col l6 m6 s6">
			<div class="w3-container w3-border "  style="height: 130px;width:60%;border-radius: 50%;margin-top: 20px;padding-left: 10px;" >
        		<?php 
$conn=$pdo->open();
$stmt=$conn->prepare(" SELECT * FROM updates
ORDER BY RAND()
LIMIT 1");
$stmt->execute();
$random = $stmt->fetch();
?>
        		<p class="w3-center " style="margin-top: 30px;font-size: 20px;"><a href="random.php?next=<?php echo $random['slug'];?>"  style="text-decoration: none;"><span class="w3-text-red w3-xlarge">Random <br/>Article</span></a></p>

        	</div>
		</div>
	</div>
</div>
	</div>
	<div class="w3-col l4">
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
                      	$stmt=$conn->prepare("SELECT *, updates.id AS updateid FROM updates LEFT JOIN views ON updates.id=views.article_id ORDER BY counter DESC LIMIT 10");
           	$stmt->execute();
           	foreach($stmt as $row){
            $image=(!empty($row['photo']))?'images/'.$row['photo']:"images/noimage.jpg";   
echo"<li class='w3-padding-16'>
<div class='w3-row'>
  <div class='w3-col s3 l3'>
        <img src='".$image."' alt='Image' class='w3-left w3-margin-right' style='width:100%'>
  </div>
  <div class='w3-col s9 l9 w3-container'>
     <a href='pop.php?product=".$row['slug']."' style='text-decoration:none;'>
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
           	?>
           </ul>
         </div>

         <div id = "tabs-3">
         	     <ul class="w3-ul w3-hoverable w3-white" id="t1"  >
           	<?php

           	$conn=$pdo->open();
                      	$stmt=$conn->prepare("SELECT * FROM updates ORDER BY date_posted DESC LIMIT 10");
           	$stmt->execute();
           	foreach($stmt as $row){
            $image=(!empty($row['photo']))?'images/'.$row['photo']:"images/noimage.jpg";   
echo"<li class='w3-padding-16'>
           <div class='w3-row'>
  <div class='w3-col s3 l3'>
        <img src='".$image."' alt='Image' class='w3-left w3-margin-right' style='width:100%'>
  </div>
  <div class='w3-col s9 l9 w3-container'>
     <a href='pop.php?product=".$row['slug']."' style='text-decoration:none;'>
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
           	?>
           </ul>
                   </div>
         
      </div>

							</div> 

	</div>
</div>

	<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
 </body>
</html>