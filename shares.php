<?php 
include 'includes/session.php';
$conn=$pdo->open();
	$now = date('Y-m-d');
	if (isset($_POST['id'])) {
		$id=$_POST['id'];

		$stmt=$conn->prepare("SELECT *,COUNT(*) AS numrows FROM shares WHERE share_id=:id AND date_shared=:now ");
	$stmt->execute(['id'=>$id,'now'=>$now]);
	$vrow=$stmt->fetch();
	if ($vrow['numrows']>0) {
		$stmt = $conn->prepare("UPDATE shares SET  counter=counter+1 WHERE share_id=:id");
		$stmt->execute(['id'=>$id]);
	}
	else{
		try {
		$stmt = $conn->prepare("INSERT INTO shares(share_id,date_shared,counter) VALUES(:share_id,:date_shared,:counter)");
		$stmt->execute(['share_id'=>$id,'date_shared'=>$now,'counter'=>1]);		
} catch (PDOException $e) {
	echo "There is some problem in connection: " . $e->getMessage();
}
	}

	}

	$pdo->close();
?>