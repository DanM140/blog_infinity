<?php
include 'includes/session.php';
$search = $_POST['search']; 
header('Location: search.php?search='.$search);
?>