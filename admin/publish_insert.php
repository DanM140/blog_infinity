<?php include 'includes/session.php';
 include 'includes/slugify.php';
if (isset($_POST['add'])) {
$id=$_POST['id'];
$conn = $pdo->open();
$stmt = $conn->prepare("UPDATE published SET status=:status WHERE id=:id");
			$stmt->execute(['status'=>1, 'id'=>$id]);		
$stmt=$conn->prepare("SELECT * FROM published WHERE id=:id");
$stmt->execute(['id'=>$id]);
$row=$stmt->fetch();


	try {

		$smtp = $conn->prepare("INSERT INTO updates(category_id,name, description,user_id, slug,writers_name, date_posted,unpublished_id,image_description) values (:category, :name, :description,:user_id, :slug,:writers_name, :date_posted,:unpublished_id,:image_description)");
		$smtp->execute(['category'=>$row['category_id'],'name'=>$row['name'],'description'=>$row['description'],'user_id'=>$row['user_id'],'slug'=>$row['slug'],'writers_name'=>$row['writers_name'],'date_posted'=>$row['date_posted'],'unpublished_id'=>$id,'image_description'=>$row['image_description']]);
		$_SESSION['success'] = 'Article published added successfully';
	} catch (PDOException $e) {
		$_SESSION['error']=$e->getMessage();
	}
$pdo->close();

}
else{
	$_SESSION['error']="Fill up the form first";
}
header('location: publish.php');
 ?>
