<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['admin1'])){
		header('location: admin/home.php');
	}
	if(isset($_SESSION['writer1'])){
		header('location: writer/home.php');
	}

	if(isset($_SESSION['visitor'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
			$stmt->execute(['id'=>$_SESSION['visitor']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close();
	}
?>