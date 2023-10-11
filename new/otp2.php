<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer.php');
require('Exception.php');
require('SMTP.php');

// $username = $_SESSION['username_1'];

// $email = $_SESSION['email_1'];

// $password = md5($_SESSION['password_1']);


if (isset($_POST['resend']))
{
  header("location:otp2.php");
//   $email = $_POST['email'];
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
    $mail->setFrom('sportsequ@gmail.com', '');
    $mail->addAddress($email);
    $mail->Subject = 'Otp';
    $mail->Body    =  $otp;
    $mail->MsgHTML = ($otp);
    $mail->send();
    $sql = "insert into otp(otp) value ($otp)";
    $run = mysqli_query($db,$sql);
    // header("location:index.php");
  } 
  catch (Exception $e) 
  {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

if (!empty($_POST['otppass']))
{
  $verify = $_POST['otppass'];
  $result = mysqli_query($db, "SELECT * FROM otp WHERE otp='" . $_POST['otppass'] . "' ");
  $result2= mysqli_query($db,"SELECT * FROM otp WHERE datetime BETWEEN DATE_ADD(NOW(),INTERVAL -1 MINUTE) AND NOW() ");

  $stat = mysqli_num_rows($result);
  $stat2 = mysqli_num_rows($result2);
  
  if ($stat != 0) 
  {
    if ($stat2 != 0)
	  {
      $news = mysqli_query($db, "update otp set exp=1 where otp='". $_POST['otppass'] ."'");

      // $run = mysqli_query($db,"INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')");
     
      // $rid1 = mysqli_query($db, "select id from users where email='" . $email . "' and password='" . $password . "'");
      // $result = mysqli_fetch_array($rid1);

      // $mrid = $result['id'];
      //echo $mrid;
      // $_SESSION['username']=$username;
      // $_SESSION['email']=$email;
    //   $sql = "insert into Login(username,password) values ('$email','$password')";
    //   $run1 = mysqli_query($con, $sql);

      header('location:setpass.php'); 
    }
  	else
	{
      $news = mysqli_query($db, "update otp set exp=1 where otp='" . $_POST['otppass'] . "'");
      echo "timer out";
    }
	}
	else 
	{
    	$news = mysqli_query($db, "update otp set exp=1 where otp='".$_POST['otppass'] . "'");
    	$inmsg = 1;
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
          ENTER OTP
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter Email">
					<input class="input100" type="text" name="otppass" placeholder="OTP">
					<span class="focus-input100"></span>
				</div>

				<div class="login100-form-btn">
                                    <button class="login100-form-btn" name="send">
						SEND
					</button>
          </div>
          <br>
          <div class="login100-form-btn">
                            <button class="login100-form-btn" name="resend">
						RESEND
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