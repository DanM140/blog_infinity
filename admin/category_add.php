<?php 
include 'includes/session.php';
if (isset($_POST['add']))
{

	$name =$_POST['name'];
	$code =$_POST['code'];
	$class =$_POST['class'];
	$conn =$pdo->open();
	$smtp = $conn->prepare("SELECT *,COUNT(*) As numrows FROM category WHERE name=:name");
	$smtp->execute(['name'=>$name]);
	$row = $smtp->fetch();
	if ($row['numrows']>0) {
		$_SESSION['error'] = 'The category already exists';
	}
	else{
		try {
			$smtp = $conn->prepare("INSERT INTO category(name,code,class) values(:name,:code)");
			$smtp->execute(['name'=>$name,'code'=>$code,'class'=>$class]);
			$_SESSION['success'] ='The category has been added successfully';
		} catch (PDOException $e) {
					$_SESSION['error'] =$e->getMessage();
		}
	}
}
else{
	$_SESSION['error'] = 'Fill up the form first';
}
header('location: category.php');
?>