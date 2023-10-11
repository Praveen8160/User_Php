<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer.php');
require('Exception.php');
require('SMTP.php');


if(isset($_POST['mail']))
{
	$email=$_POST['email'];
	$sql="SELECT * FROM `users` WHERE email='$email'";
	$res=mysqli_query($db,$sql);
	$result=mysqli_fetch_array($res);
	// $email2=$result['email'];
	if($result['email'] === $email)
	{
		$email = $_POST['email'];
		$otp = rand(100000, 999999);
		$mail = new PHPMailer(true);
		try 
		{
		  $mail->isSMTP();
		  $mail->Host       = 'smtp.gmail.com';
		  $mail->SMTPAuth   = true;
		  $mail->Username   = 'sportsequ@gmail.com';
		  $mail->Password   = 'kpuxdvticllwipev';
		  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		  $mail->Port       = 465;
		  $mail->setFrom('sportsequ@gmail.com', 'otp');
		  $mail->addAddress($email);
		  $mail->Subject = 'Otp';
		  $mail->Body    =  $otp;
		  $mail->MsgHTML = ($otp);
		  $mail->send();
		  $sql = "insert into otp(otp) value ($otp)";
		  $run = mysqli_query($db,$sql);
		  $_SESSION['email_2']=$result['email'];
		  header("location:otp2.php");
		} 
		catch (Exception $e) 
		{
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	else	
	{
		echo "<script>alert('enter proper email')</script>";
	}
	
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edgecut</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css"> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css1/util.css">
	<link rel="stylesheet" type="text/css" href="css1/main.css">
<!--===============================================================================================-->
</head>
<style>
body {
  background-color: orange;
}
.forget{
	width: 36%;
	border: 2px solid;
	margin-left:370px;
	margin-top:50px;
}
.col{
	background-color:#dc3545;
}
</style>
<body>
	<?php
            include 'head.php';
        ?>
	<div class="container">
	<div class="forget">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
                    <form class="login100-form validate-form" action="" method="post">
				<span class="login100-form-title p-b-37">
					Forget password
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter Email">
					<input class="input100" type="email" name="email" placeholder="Email Id">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
                                    <button class="login100-form-btn" name="mail">
						SEND
					</button>
				</div>

                                <br><br><br>
                               

			</form>
                </div>
</div>
	</div>
	
	<?php
         include 'footer.php';
                   ?>
	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>