<?php 
  use PHPMailer\PHPMailer\PHPMailer;
include 'includes/session.php';
if (isset($_POST['signup'])) {
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$re_email=$_POST['email'];
	$password=$_POST['pass'];
	$repassword=$_POST['repass'];

	$_SESSION['firstname']=$firstname;
	$_SESSION['lastname']=$lastname;
	$_SESSION['email']=$email;
	$name="Blog";
	if ($password!=$repassword) {
		echo "Passwords did not match";
		header('location: signup.php');
	}
	else{
		$conn=$pdo->open();
		$stmt=$conn->prepare("SELECT *,COUNT(*) AS numrows FROM users WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row=$stmt->fetch();
		if ($row['numrows']>0) {
			$_SESSION['error']= "Email already exists in the database";
			header('Location: signup.php');
		}
		else{
			$now=date('Y-m-d');
			$password=password_hash($password, PASSWORD_DEFAULT);
			//generate code
			$set ="123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$code=substr(str_shuffle($set), 0,12);
			try {
				$stmt=$conn->prepare("INSERT INTO users(email, password, firstname, lastname, activate_code, created_on) VALUES(:email, :password, :firstname, :lastname, :code, :now)");
				$stmt->execute(['email'=>$email,'password'=>$password,'firstname'=>$firstname,'lastname'=>$lastname,'code'=>$code,'now'=>$now]);
				$userId=$conn->lastInsertId();
				$message="<h2>Thank you for Registering.</h2>
						<p>Your Account:</p>
						<p>Email: ".$email."</p>
						<p>Please click the link below to activate your account.</p>
						<a href='http://localhost/blog/activate.php?code=".$code."&user=".$userId."'>Activate Account</a>
					";
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
$mail = new PHPMailer();
//SMTP SETTINGS
try {
	$mail->isSMTP();
$mail->Host="smtp.gmail.com";
$mail->SMTPAuth=true;
$mail->Username="dansonmg1@gmail.com";
$mail->Password="dopzuzaslovqggrn";
$mail->Port=465;
$mail->SMTPSecure='ssl';
//EMAIL SETTINGS
$mail->isHTML(true);
$mail->setFrom($email,$name);
$mail->addAddress($email);
$mail->Subject="Blog Sign Up";
$mail->Body=$message;
$mail->send();
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['email']);
$_SESSION['success'] = 'Account created. Check your email to activate.';
header('location: signup.php');

} catch (Exception $e) {
$_SESSION['error']='<h1>Activation link not received?</h1>. 
<div>
<form>
<input name="email" type="hidden" value="'.$re_email.'"/>
<button id="re_send" type="submit" class="btn btn-primary btn-block btn-flat" name="resend">Re-Send</button>

</form>
 </div>
 ';
header('location: signup.php');	
}

			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				header('location: register.php');
			}
			$pdo->close();
		}

	}
}
else{
	echo "Fill up the registration form first";
	header('location: signup.php');

}
?>