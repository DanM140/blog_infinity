<?php 
include 'includes/session.php';
include 'includes/slugify.php';
if (isset($_POST['edit'])) {
	$user_id=$_POST['user_id'];
	$id =$_POST['id'];
	$name =$_POST['name'];
	$slug =slugify($name);
	$category = $_POST['category'];
	$description =$_POST['description'];
	$conn = $pdo->open();
	try {
	$smtp = $conn->prepare("UPDATE updates SET name=:name ,slug=:slug,category_id=:category,description=:description WHERE id =:id");
	$smtp->execute(['name'=>$name,'slug'=>$slug,'category'=>$category,'description'=>$description,'id'=>$id]);
	$_SESSION['success']='article Updated Successfully';
	
	} catch (PDOException $e) {
		$_SESSION['error']=$e->getMessage();
	}
	$pdo->close();
	
}
else{
		$_SESSION['error'] = 'Fill up edit article form first';
	}
header('location: article.php?user='.$user_id);
?>