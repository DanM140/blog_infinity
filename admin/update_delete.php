<?php
include 'includes/session.php';
$id=$_POST['id'];
$conn =$pdo->open();
$stmt=$conn->prepare("SELECT * FROM updates WHERE id=:id");
$stmt->execute(['id'=>$id]);
$update_row=$stmt->fetch();
$stmt=$conn->prepare("SELECT *,COUNT(*) AS numrows FROM updates WHERE unpublished_id=:id");
$stmt->execute(['id'=>$update_row['unpublished_id']]);
$row=$stmt->fetch();
if ($row['numrows']>0) {
		$stmt=$conn->prepare("UPDATE published SET status=:status WHERE id=:unpublished_id");
$stmt->execute(['status'=>0,'unpublished_id'=>$row['unpublished_id']]);
		
		
}
if (isset($_POST['delete'])) {
	
	
	try {
		$smtp =$conn->prepare("DELETE FROM updates WHERE id=:id");
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