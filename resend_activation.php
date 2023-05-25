<?php
	
	use PHPMailer\PHPMailer\PHPMailer;

	include 'includes/session.php';

	if(isset($_POST['resend'])){
		$email = $_POST['email'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
							
				
				$message = "
					<h2>Activation Resend</h2>
					<p>Your Account:</p>
					<p>Email: ".$row['email']."</p>
					<p>Please click the link below to reset your password.</p>
					<a href='http://localhost/blog/password_reset.php?code=".$row['activate_code']."&user=".$row['id']."'>Reset Password</a>
				";

				require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
$mail = new PHPMailer();                             
			    try {
			        //Server settings
			        $mail->isSMTP();                                     
			        $mail->Host = 'smtp.gmail.com';                      
			        $mail->SMTPAuth = true;                               
			        $mail->Username = 'dansonmg1@gmail.com';     
			        $mail->Password = 'dopzuzaslovqggrn';                    
			        $mail->SMTPOptions = array(
			            'ssl' => array(
			            'verify_peer' => false,
			            'verify_peer_name' => false,
			            'allow_self_signed' => true
			            )
			        );                         
			        $mail->SMTPSecure = 'ssl';                           
			        $mail->Port = 465;                                   

			        $mail->setFrom($email,$name);
			        
			        //Recipients
			        $mail->addAddress($email);              
			        
			       
			        //Content
			        $mail->isHTML(true);                                  
			        $mail->Subject = 'Blog Site Activation Resent';
			        $mail->Body    = $message;

			        $mail->send();

			        $_SESSION['success'] = 'Activation link resent';
			     
			    } 
			    catch (Exception $e) {
			        $_SESSION['error']='<h1>Activation link not received?</h1>. 
<div class="w3-container">
<form role="form" method="POST" action="resend_activation.php">
<input name="email" type="hidden" value="'.$row['email'].'"/>
<button id="re_send" type="submit" class="btn btn-primary btn-block btn-flat" name="resend">Re-Send</button>

</form>
 </div>
 ';
			    }
			
		}
		else{
			$_SESSION['error'] = 'Email not found';
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Input email associated with account';
	}

	header('location: signup.php');

?>