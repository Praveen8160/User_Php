<?php
session_start();
?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');
if (!isset($_SESSION['email'])) {
  header('location:register.php');
}

// $password="";
// $new="";
// $renew="";

// $password=$_POST['password'];
// $new=$_POST['newpassword'];
// $renew=$_POST['renewpassword'];

// if(isset($_POST['change']))
// {
//   echo "hdsjdsjcs";

// }
$errors = array(); 
$errors2 = array(); 
if(isset($_SESSION['username']))
{
  if(isset($_POST['change']))
  {
  $newpassword=$_POST['newpassword'];
  $renewpassword=$_POST['renewpassword'];
  $checkpass=md5($_POST['password']);
  $email=$_SESSION['email'];
  $sql="SELECT * FROM `users` WHERE email='$email'";
  $res=mysqli_query($db,$sql);
  $result4=mysqli_fetch_array($res);
  $pass=$result4['password'];
  if($checkpass===$pass)
  {
    if(empty($_POST["newpassword"]) && $_POST["renewpassword"] != "" )
    {
    array_push($errors2, "Please Enter your password");
    }
    else
    {
      if (strlen($_POST["newpassword"]) <= '8') 
      {
           array_push($errors2,"Your Password Must Contain At Least 8 Digits !"); 
      }
      elseif(!preg_match("#[0-9]+#",$_POST["newpassword"])) {
          array_push($errors2, "Your Password Must Contain At Least 1 Number !");
      }
      elseif(!preg_match("#[A-Z]+#",$_POST["newpassword"])) {
           array_push($errors2, "Your Password Must Contain At Least 1 Capital Letter !");
      }
      elseif(!preg_match("#[a-z]+#",$_POST["newpassword"])) {
          array_push($errors2,"Your Password Must Contain At Least 1 Lowercase Letter !");
      }
      elseif(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $_POST["newpassword"])) {
          array_push($errors2,"Your Password Must Contain At Least 1 Special Character !");
      }
      else
      {
          $newpassword=$_POST['newpassword'];
          $renewpassword=$_POST['renewpassword'];
      }
    }
  }
  else
  {
    array_push($errors2, "enter correct current password ");
  }
  if ($newpassword != $renewpassword) {
    array_push($errors2, "The two passwords do not match");
    }

    if (count($errors2) == 0) {
      $update=md5($newpassword);
      $sql5="UPDATE `users` SET `password`='$update' WHERE email='$email'";
      $set=mysqli_query($db,$sql5);
    }
}

}

if (isset($_SESSION['email'])) {
if(isset($_POST['save']))
{
  if(!empty($_POST['name'])&& !empty($_POST['gender'])&& !empty($_POST['address'])&& !empty($_POST['city'])&& !empty($_POST['state'])&& !empty($_POST['country'])&& !empty($_POST['pincode'])&& !empty($_POST['phone']))
  {
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $country=$_POST['country'];
    $pincode=$_POST['pincode'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $sql="SELECT * FROM `customertbl`";
    $res=mysqli_query($db,$sql);
    $con=0;
    while($result=mysqli_fetch_array($res))
    {
      if($email==$result['email'])
      {
        $con=$con+1;
      }
    }
    if($con==0)
    {
      $sql2="INSERT INTO `customertbl`(`name`, `gender`, `address`, `city`, `state`, `country`, `pincode`, `phone`, `email`) VALUES ('$name','$gender','$address','$city','$state','$country','$pincode','$phone','$email')";
      $result1=mysqli_query($db,$sql2);
      $sql7="UPDATE `users` SET `username`='$name' WHERE email='$email'";
      $result6=mysqli_query($db,$sql7);
      $email=$_SESSION['email'];
      $sql4="SELECT * FROM `customertbl` WHERE email='$email'";
      $res1=mysqli_query($db,$sql4);
      $con=0;
//       $email=$_SESSION['email'];
// $sql4="SELECT * FROM `customertbl` WHERE email='$email'";
// $res1=mysqli_query($db,$sql4);
// while($result3=mysqli_fetch_array($res1))
// {
// $_SESSION['username']=$result3['name'];
// $_SESSION['gender']=$result3['gender'];
// $_SESSION['address']=$result3['address'];
// $_SESSION['city']=$result3['city'];
// $_SESSION['state']=$result3['state'];
// $_SESSION['country']=$result3['country'];
// $_SESSION['pincode']=$result3['pincode'];
// $_SESSION['phone']=$result3['phone'];
// }
    }
    else
    {
      $sql3="UPDATE `customertbl` SET `name`='$name',`gender`='$gender',`address`='$address',`city`='$city',`state`='$state',`country`='$country',`pincode`='$pincode',`phone`='$phone' WHERE email='$email'";
      $result2=mysqli_query($db,$sql3);
      $sql6="UPDATE `users` SET `username`='$name' WHERE email='$email'";
      $result6=mysqli_query($db,$sql6);
      $email=$_SESSION['email'];
      $sql4="SELECT * FROM `customertbl` WHERE email='$email'";
      $res1=mysqli_query($db,$sql4);
    $con=0;
//     $email=$_SESSION['email'];
// $sql4="SELECT * FROM `customertbl` WHERE email='$email'";
// $res1=mysqli_query($db,$sql4);
// while($result3=mysqli_fetch_array($res1))
// {
// $_SESSION['username']=$result3['name'];
// $_SESSION['gender']=$result3['gender'];
// $_SESSION['address']=$result3['address'];
// $_SESSION['city']=$result3['city'];
// $_SESSION['state']=$result3['state'];
// $_SESSION['country']=$result3['country'];
// $_SESSION['pincode']=$result3['pincode'];
// $_SESSION['phone']=$result3['phone'];
// }
    }
  }
else
{
  array_push($errors, "fill all detail");
}
}
}

 ?>

<?php
 if (isset($_SESSION['email'])) {

$email=$_SESSION['email'];
$sql4="SELECT * FROM `customertbl` WHERE email='$email'";
$res1=mysqli_query($db,$sql4);
while($result3=mysqli_fetch_assoc($res1))
{
$_SESSION['username']=$result3['name'];
$_SESSION['gender']=$result3['gender'];
$_SESSION['address']=$result3['address'];
$_SESSION['city']=$result3['city'];
$_SESSION['state']=$result3['state'];
$_SESSION['country']=$result3['country'];
$_SESSION['pincode']=$result3['pincode'];
$_SESSION['phone']=$result3['phone'];
}
 }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sports</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets1/img/favicon.png" rel="icon">
  <link href="assets1/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets1/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets1/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets1/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets1/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets1/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    .main{
        margin-right:2000px;
    }
    </style>
<body>
<?php
            include 'head.php';
        ?>
  <main id="main">
    
    <div class="pagetitle" class="profile">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="adminindex.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
              <h1> <?php
               if (isset($_SESSION['username'])) {
                echo $_SESSION['username'];
            }
            else{
              echo "login your account";
            } ?></h1>
            <h3><?php 
                     if (isset($_SESSION['username'])) {
                      echo $_SESSION['email'];
                  } ?><h3>
              <!-- <h3>Web Designer</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>


                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" name="change">Change Password</button>
                </li>

                
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#order" name="change">Order</button>
                </li>

              </ul>
        
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php 
                      if (isset($_SESSION['username'])) {
                        echo  $_SESSION['username'];
                    }
                    else
                    {
                      echo '';
                    } ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">address</div>
                    <div class="col-lg-9 col-md-8"><?php 
                      if (isset($_SESSION['address'])) {
                        echo  $_SESSION['address'];
                    }
                    ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?php 
                      if (isset($_SESSION['gender'])) {
                        echo  $_SESSION['gender'];
                    }
                    else
                    {
                      echo '';
                    } ?></div>
                  </div>
                
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">city</div>
                    <div class="col-lg-9 col-md-8"><?php 
                      if (isset($_SESSION['city'])) {
                        echo  $_SESSION['city'];
                    }
                    else
                    {
                      echo '';
                    } ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">state</div>
                    <div class="col-lg-9 col-md-8"><?php 
                      if (isset($_SESSION['state'])) {
                        echo  $_SESSION['state'];
                    }
                    else
                    {
                      echo '';
                    } ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8"><?php 
                      if (isset($_SESSION['country'])) {
                        echo  $_SESSION['country'];
                    }
                    else
                    {
                      echo '';
                    } ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">pincode</div>
                    <div class="col-lg-9 col-md-8"><?php 
                      if (isset($_SESSION['pincode'])) {
                        echo  $_SESSION['pincode'];
                    }
                    else
                    {
                      echo '';
                    } ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php 
                     if (isset($_SESSION['email'])) {
                      echo $_SESSION['email'];
                  } ?> </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php 
                      if (isset($_SESSION['phone'])) {
                        echo  $_SESSION['phone'];
                    }
                    else
                    {
                      echo '';
                    } ?></div>
                  </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  
                    <!-- <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div> -->
                   
                    <form method="post">
                  
                    <?php include('errors.php'); ?>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" value="<?php 
                     if (isset($_SESSION['username'])) {
                      echo  $_SESSION['username'];
                  }
                 ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                    <div class="col-md-8 col-lg-9">
                      <div class = "radio">
                        <label>
                          <input type = "radio" name = "gender" id = "optionsRadios1" value ="Male" 
                          <?php 
                          if(isset($_SESSION['gender'])){
                          if ($_SESSION['gender'] === "Male") 
                          {
                            echo "Checked";
                          }}?>
                          >Male
                        </label>
          
                        <label>
                          <input type = "radio" name = "gender" id = "optionsRadios2" value ="Female"
                          <?php 
                          if(isset($_SESSION['gender'])){
                          if ($_SESSION['gender'] === "Female") 
                          {
                            echo "Checked";
                          }}?>
                          >
                          Female
                        </label>
                      </div>
                    </div>
                  </div>
                    

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">address</label>
                      <div class="col-lg-9 col-md-8">
                        <input name="address" type="text" class="form-control" id="company" value="<?php 
                     if (isset($_SESSION['address'])) {
                      echo  $_SESSION['address'];
                  }
                 ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">city</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="city" type="text" class="form-control" id="Job" value="<?php 
                     if (isset($_SESSION['city'])) {
                      echo  $_SESSION['city'];
                  }
                  else
                  {
                    echo '';
                  } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">state</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="state" type="text" class="form-control" id="Job" value="<?php 
                     if (isset($_SESSION['state'])) {
                      echo  $_SESSION['state'];
                  }
                  else
                  {
                    echo '';
                  } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" value="<?php 
                     if (isset($_SESSION['country'])) {
                      echo  $_SESSION['country'];
                  }
                  else
                  {
                    echo '';
                  } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">pincode</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pincode" type="text" class="form-control" id="Address" required pattern="[0-9]{6}" oninvalid="this.setCustomValidity('enter 6 digit number')"  oninput="this.setCustomValidity('')" value="<?php 
                     if (isset($_SESSION['pincode'])) {
                      echo  $_SESSION['pincode'];
                  }
                  else
                  {
                    echo '';
                  } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" required pattern="[0-9]{11}" oninvalid="this.setCustomValidity('enter 11 digit number')"  oninput="this.setCustomValidity('')" value="<?php 
                     if (isset($_SESSION['phone'])) {
                      echo  $_SESSION['phone'];
                  }
                  else
                  {
                    echo '';
                  } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email"  readonly value="<?php 
                     if (isset($_SESSION['username'])) {
                      echo $_SESSION['email'];
                  }
                  else
                  {
                    echo '';
                  } ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="save">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

              

               

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post">
                  <?php include('errors1.php'); ?>
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="change">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>
                

                <!-- order start -->

                <div class="tab-pane fade pt-3" id="order">
                  
                <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <h3><a class="breadcrumb-item text-dark" href="#">ORDERS</a></h3>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

                <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>quantity</th>
                            
                            <th>total</th>
                            <th>Payment</th>
                            <th>date</th>
                            <th>order ststus</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                      <?php
                     $email=$_SESSION['email'];
                     $sql="SELECT `id` FROM `users` WHERE email='$email'";
                     $res=mysqli_query($db,$sql);
                     $result=mysqli_fetch_array($res);
                     $id=$result['id'];
                     $sql1="SELECT * FROM `order_tbl` WHERE cid=$id";
                     $res2=mysqli_query($db,$sql1);
                     while($res1=mysqli_fetch_array($res2))
                     {?> 
                        <tr>     
                            <td class="align-middle"><?php echo $res1['pname'];?> </td>
                            <td class="align-middle"><?php echo $res1['quantity'];?></td>
                          
                            <td class="align-middle"><?php echo $res1['total'];?></td>
                            <td class="align-middle"><?php echo $res1['payment'];?></td>
                            <td class="align-middle"><?php echo $res1['date'];?></td>
                            <td class="align-middle"><?php echo $res1['status'];?></td>

                        </tr>
                        <?php
                        }
                        ?>
                       
                        
                    </tbody>
                </table>
            </div>
          
        </div>
    </div>

                </div>


        
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
      
  </main><!-- End #main -->

  <?php include 'footer.php'; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets1/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets1/vendor/php-email-form/validate.js"></script>
  <script src="assets1/vendor/quill/quill.min.js"></script>
  <script src="assets1/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets1/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets1/vendor/chart.js/chart.min.js"></script>
  <script src="assets1/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets1/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets1/js/main.js"></script>

</body>

</html>


