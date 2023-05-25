<?php
	include 'includes/session.php';
	if(isset($_POST['top_activate'])){
		$id = $_POST['id'];
		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("UPDATE updates SET top=:top WHERE id=:id");
			$stmt->execute(['top'=>1, 'id'=>$id]);
			$_SESSION['success'] = 'Operation is  successfully done';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select article  first';
	}
	header('location: updates.php');
?>