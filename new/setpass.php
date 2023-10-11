<?php
session_start();
?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');

$errors = array(); 
if(isset($_POST['change']))
  {
  $newpassword=$_POST['pass'];
  $renewpassword=$_POST['repass'];
  $email=$_SESSION['email_2'];
  if(empty($_POST["pass"]) && $_POST["repass"] != "" )
  {
  array_push($errors, "Please Enter your password");
  }
  else
  {
    if (strlen($_POST["pass"]) <= '8') 
    {
         array_push($errors,"Your Password Must Contain At Least 8 Digits !"); 
    }
    elseif(!preg_match("#[0-9]+#",$_POST["pass"])) {
        array_push($errors, "Your Password Must Contain At Least 1 Number !");
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["pass"])) {
         array_push($errors, "Your Password Must Contain At Least 1 Capital Letter !");
    }
    elseif(!preg_match("#[a-z]+#",$_POST["pass"])) {
        array_push($errors,"Your Password Must Contain At Least 1 Lowercase Letter !");
    }
    elseif(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $_POST["pass"])) {
        array_push($errors,"Your Password Must Contain At Least 1 Special Character !");
    }
    else
    {
        $newpassword=$_POST['pass'];
        $renewpassword=$_POST['repass'];
    }
  }
  if ($newpassword != $renewpassword) {
    array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
      $update=md5($newpassword);
      $sql5="UPDATE `users` SET `password`='$update' WHERE email='$email'";
      $set=mysqli_query($db,$sql5);
      header("location:login.php");
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
                    <?php include('errors.php'); ?>
				<span class="login100-form-title p-b-37">
          SET NEW PASSWORD
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter new password">
					<input class="input100" type="password" name="pass" placeholder="Enter new password">
					<span class="focus-input100"></span>
				</div>

                <div class="wrap-input100 validate-input m-b-20" data-validate="Reenter new password">
					<input class="input100" type="password" name="repass" placeholder="Reenter new password">
					<span class="focus-input100"></span>
				</div>

				<div class="login100-form-btn">
                                    <button class="login100-form-btn" name="change">
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