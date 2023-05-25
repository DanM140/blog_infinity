<?php
	include 'includes/session.php';

	if(isset($_POST['top_deactivate'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE updates SET top=:top WHERE id=:id");
			$stmt->execute(['top'=>0, 'id'=>$id]);
			$_SESSION['success'] = 'Updates activated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Select updates to activate first';
	}

	header('location: updates.php');
?>