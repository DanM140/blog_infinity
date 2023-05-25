<?php
include 'includes/session.php';
if (isset($_POST['unpublish'])) {
	$id=$_POST['id'];
	$conn =$pdo->open();
	$stmt=$conn->prepare("SELECT * FROM updates WHERE unpublished_id=:id");
	$stmt->execute(['id'=>$id]);
	$row=$stmt->fetch();
	if ($row['unpublished_id']>0) {
		try {
		$smtp =$conn->prepare("DELETE FROM updates WHERE unpublished_id=:id");
	$smtp->execute(['id'=>$row['unpublished_id']]);
	$_SESSION['success']='Update has been successfully deleted';
	} catch (Exception $e) {
		$_SESSION['error']=$e->getMessage();
	}
	$stmt = $conn->prepare("UPDATE published SET status=:status WHERE id=:id");
			$stmt->execute(['status'=>0, 'id'=>$id]);
	}
	$pdo->close();

	
}
else{
	$_SESSION['error']='Update is not selected';
}
header('location: publish.php');
?>