<?php 
include 'includes/session.php';
include 'includes/slugify.php';
if (isset($_POST['edit'])) {
	$id =$_POST['id'];
	$name =$_POST['name'];
	$slug =slugify($name);
	$category = $_POST['category'];
	$description =$_POST['description'];
	$image_description=$_POST['image_description'];
	$conn = $pdo->open();
	try {
	$smtp = $conn->prepare("UPDATE published SET name=:name ,slug=:slug,category_id=:category,description=:description WHERE id =:id");
	$smtp->execute(['name'=>$name,'slug'=>$slug,'category'=>$category,'image_description'=>$image_description,'description'=>$description,'id'=>$id]);
	$_SESSION['success']='Update Updated Successfully';
	
	} catch (PDOException $e) {
		$_SESSION['error']=$e->getMessage();
	}
	$pdo->close();
	
}
else{
		$_SESSION['error'] = 'Fill up edit property form first';
	}
header('location: updates.php');
?>