<?php
include 'includes/session.php';
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$conn =$pdo->open();
	$smtp =$conn->prepare("SELECT * FROM category WHERE id=:id");
	$smtp->execute(['id'=>$id]);
	$row =$smtp->fetch();
	$pdo->close();
	echo json_encode($row);
}
?>