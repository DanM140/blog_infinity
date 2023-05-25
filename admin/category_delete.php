<?php
include 'includes/session.php';
if (isset($_POST['delete'])) {
	$id =$_POST['id'];
	$conn =$pdo->open();
	try {
		$smtp=$conn->prepare("DELETE FROM category WHERE id=:id");
		$smtp->execute(['id'=>$id]);
$_SESSION['success']="Category has been deleted successfully";
	} catch (PDOException $e) {
		$_SESSION['error']=$e->getMessage();
	}
	$pdo->close();
}
else{
	$_SESSION['error']='Select category to delete first';
}
header('location: category.php');
?>