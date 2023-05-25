
<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, updates.id AS prodid, updates.name AS prodname,updates.image_description AS image, category.name AS catname FROM updates LEFT JOIN category ON category.id= updates.category_id WHERE updates.id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>