<?php
include 'includes/session.php';
$output ='';
$conn =$pdo->open();
$smtp =$conn->prepare("SELECT * FROM category");
$smtp->execute();
foreach ($smtp as $row) {
	$output .="<option value='".$row['id']."' class='append_items'>".$row['name']."</option>";
}
$pdo->close();
echo json_encode($output);

?>