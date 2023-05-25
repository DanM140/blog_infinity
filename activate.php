<?php include 'includes/session.php';?>

<?php include 'includes/title.php';?>
<?php include 'includes/nav.php'; ?>
<?php 
$output='';
if (!isset($_GET['code']) OR !isset($_GET['user'])) {
	$output.="<div class='w3-panel w3-yellow'>
            <h3 class='w3-center'>Error</h3>
            Code to activate account cannot be found 
          </div>
<h4>You may <a href='signup.php'>Signup</a> or back to <a href='index.php'>Homepage</a>.</h4>

";

	}
else{
$conn=$pdo->open();
$stmt=$conn->prepare("SELECT *,COUNT(*) AS numrows FROM users WHERE activate_code=:code AND id=:id ");
$stmt->execute(['id'=>$_GET['user'],'code'=>$_GET['code']]);
$row=$stmt->fetch();
if ($row['numrows']>0) {
	if ($row['status']) {
		$output.="<div class='w3-panel w3-red'>
            <h3 class='w3-center'>Error</h3>
            Account already activated 
          </div>
<h4>You may <a href='login.php'>Sign In</a> or back to <a href='index.php'>Homepage</a>.</h4>
";
}
	else{
		try {
		$stmt =	$conn->prepare("UPDATE users SET status =:status WHERE id=:id");
			$stmt->execute(['status'=>1,'id'=>$row['id']]);
	$output.="<div class='w3-panel w3-green'>
            <h3 class='w3-center'>Success</h3>
            Account successfuly activated  - Email: <b>".$row['email']."</b>.
          </div>
<h4>You may <a href='login.php'>Sign In</a> or back to <a href='index.php'>Homepage</a>.</h4>
";
		} catch (PDOException $e) {
				$output.="<div class='w3-panel w3-red'>
            <h3 class='w3-center'>Error</h3>
            ".$e->getMessage()."
            ubwakin
          </div>
<h4>You may <a href='signup.php'>Sign In</a> or back to <a href='index.php'>Homepage</a>.</h4>
";

		}

	}
}
else{
$output.="<div class='w3-panel w3-red'>
            <h3 class='w3-center'>Error</h3>
            Cannot activate account (wrong code) 
          </div>
<h4>You may <a href='signup.php'>Sign Up</a> or back to <a href='index.php'>Homepage</a>.</h4>
";
}
$pdo->close();
}
?>
<!-- Page content -->
<div class="w3-content" style="max-width:1200px">
	<?php include 'includes/header.php'; ?>
			<div class="w3-row">
		<div id='updates' class="w3-col l8  s12">
<?php echo $output; ?>
		</div>
		<div class="w3-col l4">
				<?php include'includes/sidebar.php'; ?>

		</div>
	</div>
</div>	
		<?php include 'includes/loginmodal.php'; ?>
<?php include 'includes/signupmodal.php'; ?>
	</div>
<?php include 'includes/scripts.php'; ?>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
 <?php include 'includes/scripts.php'; ?>

</body>
</html>


