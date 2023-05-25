<?php 
include 'includes/session.php';
if (isset($_POST['upload'])) {
	$id =$_POST['id'];
	$filename =$_FILES['photo']['name'];
	$conn =$pdo->open();
	$smtp =$conn->prepare("SELECT * FROM updates WHERE id=:id");
	$smtp->execute(['id'=>$id]);
	$row=$smtp->fetch();
	if (!empty($filename)) {
	$ext =pathinfo($filename, PATHINFO_EXTENSION);
	$new_file_Name = $row['slug'].'_'.time().'.'.$ext;
move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_file_Name);
}
try {
	$smtp =$conn->prepare('UPDATE  updates SET photo=:photo WHERE id=:id');
	$smtp->execute(['photo'=>$new_file_Name,'id'=>$id]);
	$_SESSION['success']='Photo has been updated successfully';
} catch (PDOException $e) {
	$_SESSION['error']=$e->getMessage();
}
$pdo->close();
}
else{
		$_SESSION['error'] = 'Select Blog to update photo first';
	}
header('location: updates.php');
?>