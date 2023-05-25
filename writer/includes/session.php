<?php
include '../includes/conn.php';
session_start();
if(!isset($_SESSION['writer1']) || trim($_SESSION['writer1']) == ''){
		header('location: ../index.php');
		exit();
	}
$conn = $pdo->open();
$smtp = $conn->prepare("SELECT * FROM users WHERE id=:id");
$smtp->execute(['id'=>$_SESSION['writer1']]);
$admin = $smtp->fetch();
$pdo->close();
?>