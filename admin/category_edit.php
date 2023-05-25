<?php 
include 'includes/session.php';
if (isset($_POST['edit'])) {
	$id =$_POST['id'];
	$name =$_POST['name'];
	$code =$_POST['code'];
	$class =$_POST['class'];
	$conn =$pdo->open();
	try {
		$smtp = $conn->prepare("UPDATE category SET name=:name ,code=:code,class=:class WHERE id=:id");
		$smtp->execute(['name'=>$name,'code'=>$code, 'id'=>$id,'class'=>$class]);
		$_SESSION['success'] = 'category updated successfully';
	} catch (PDOException $e) {
		$_SESSION['error']=$e->getMessage();
	}
$pdo->close();
}
else{
	$_SESSION['error'] ='Cant update category';
}
header('location: category.php');

?>