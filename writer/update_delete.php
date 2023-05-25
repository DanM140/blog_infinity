<?php
include 'includes/session.php';
if (isset($_POST['delete'])) {
	$id=$_POST['id'];
	$conn =$pdo->open();
	try {
		$smtp =$conn->prepare("DELETE FROM published WHERE id=:id");
	$smtp->execute(['id'=>$id]);
	$_SESSION['success']='Update has been successfully deleted';
	} catch (Exception $e) {
		$_SESSION['error']=$e->getMessage();
	}
	$pdo->close();

	// code...
}
else{
	$_SESSION['error']='Update is not selected';
}
header('location: updates.php');
?>