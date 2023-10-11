<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer.php');
require('Exception.php');
require('SMTP.php');

session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database


// REGISTER USER

if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  	$email =$_POST['email'];
  	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
  	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
  	}
  

  if(empty($_POST["password_1"]) && $_POST["password_1"] != "" )
  {
	array_push($errors, "Please Enter your password");
  }
  else
  {
	if (strlen($_POST["password_1"]) <= '8') {
		array_push($errors,"Your Password Must Contain At Least 8 Digits !"); 
    }
	elseif(!preg_match("#[0-9]+#",$_POST["password_1"])) {
		array_push($errors, "Your Password Must Contain At Least 1 Number !");
    }
	elseif(!preg_match("#[A-Z]+#",$_POST["password_1"])) {
		array_push($errors, "Your Password Must Contain At Least 1 Capital Letter !");
    }
	elseif(!preg_match("#[a-z]+#",$_POST["password_1"])) {
        array_push($errors,"Your Password Must Contain At Least 1 Lowercase Letter !");
    }
    elseif(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $_POST["password_1"])) {
        array_push($errors,"Your Password Must Contain At Least 1 Special Character !");
    }
	else
	{
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	}
  }
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){ array_push($errors, "Email is invalid"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

	
	  $email = $_POST['email'];
      $otp = rand(100000, 999999);
      $mail = new PHPMailer(true);
      try 
      {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sportsequ@gmail.com';
        $mail->Password   = 'apwqqkelsfgclctz';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->setFrom('sportsequ@gmail.com', 'otp');
        $mail->addAddress($email);
        $mail->Subject = 'Otp';
        $mail->Body    =  $otp;
        $mail->MsgHTML = ($otp);
        $mail->send();
		$_SESSION['username_1']=$username;
		$_SESSION['email_1']=$email;
		$_SESSION['password_1']=$password_1;
        $sql = "insert into otp(otp) value ($otp)";
        $run = mysqli_query($db,$sql);
        header("location:otp.php");
      } 
      catch (Exception $e) 
      {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

  	// $password = md5($password_1);//encrypt the password before saving in the database
	// //   $password = password_hash($password_1,PASSWORD_DEFAULT);//encrypt the password before saving in the database
  	// $query = "INSERT INTO users (username, email, password) 
  	// 		  VALUES('$username', '$email', '$password')";
  	// mysqli_query($db, $query);
  	// $_SESSION['username'] = $username;
	//   $_SESSION['username'] = $email;
  	// $_SESSION['success'] = "You are now logged in";
  	// header('location: login.php');
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
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
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
.login{
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
		<div class="login">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
                    <form class="login100-form validate-form" action="" method="post">
					<?php include('errors.php'); ?>
				<span class="login100-form-title p-b-37">
					Sign up
				</span>
				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
					<input class="input100" type="text" name="username" placeholder="username">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
					<input class="input100" type="text" name="email" placeholder="Email Id">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="password_1" placeholder="password">
					<span class="focus-input100"></span>
				</div>
                
                <div class="wrap-input100 validate-input m-b-25" data-validate = "Reenter password">
					<input class="input100" type="password" name="password_2" placeholder="Reenter password">
					<span class="focus-input100"></span>
				</div>

				<!-- <div class="wrap-input100 validate-input m-b-25" data-validate = "enter address">
					<input class="input100" type="text" name="address" placeholder="address">
					<span class="focus-input100"></span>
				</div> -->

				<!-- <div class="wrap-input100 validate-input m-b-25" data-validate = "date">
					<input class="input100" type="date" name="date" placeholder="date">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-25" style="font-size: 20px; color: black; padding: 13px;" data-validate = "gender">
					Male:<input class="input90" type="radio" name="gender" value="male" placeholder="gender">
					Female:<input class="input90" type="radio" name="gender" value="frmale" placeholder="gender">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-25" data-validate = "city">
					<input class="input100" type="text" name="city" placeholder="city">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-25" data-validate = "pincode">
					<input class="input100" type="text" name="pincode" placeholder="pincode">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-25" data-validate = "concat">
					<input class="input100" type="text" name="contact" placeholder="contact">
					<span class="focus-input100"></span>
				</div> -->

				<div class="container-login100-form-btn">
                                    <button class="login100-form-btn" class="col" name="reg_user">
						Sign up
					</button>
				</div><br>
				<div class="text-center">already account?
                                    <a href="login.php" class="txt2 hov1">
				
				Sign in
					</a>
				</div>
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