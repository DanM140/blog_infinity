<?php
include '../includes/conn.php';
session_start();
if(!isset($_SESSION['admin1']) || trim($_SESSION['admin1']) == ''){
		header('location: ../index.php');
		exit();
	}
$conn = $pdo->open();
$smtp = $conn->prepare("SELECT * FROM users WHERE id=:id");
$smtp->execute(['id'=>$_SESSION['admin1']]);
$admin = $smtp->fetch();
$pdo->close();
?>