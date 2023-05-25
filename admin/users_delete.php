<?php
include 'includes/session.php';
if (isset($_POST['delete'])) {
$id=$_POST['id'];
$conn=$pdo->open();
try {
$stmt=$conn->prepare("DELETE FROM users WHERE id=:id");
$stmt->execute(['id'=>$id]);
$_SESSION['success']="User has been deleted";

} catch (PDOException $e) {
	$_SESSION['error']=$e->getMessage();
}

$pdo->close();
}
else{
$_SESSION['error'] = 'Select user to delete first';
}
header('Location : admin/users.php');
?>