<?php
 $db=mysqli_connect('localhost','root','','sports');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / Data - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

 
<?php include 'adminheader.php'; ?>
<?php include 'adminsidebar.php'; ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="adminindex.php">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Update Customer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <form action="" method="post">
            <section class="section">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">General Form Elements</h5>

                                <!-- General Form Elements -->
                                <form action="" method="post">
                                    <?php
                                $ids=$_GET['id'];
                                $sql="SELECT * FROM `customertbl` WHERE id={$ids}";
                                $result=mysqli_query($db,$sql);
                                $arr=mysqli_fetch_array($result);
                                $email2=$arr['email'];
                                
                                if(isset($_POST['update']))
                                {
                                    if(!empty($_POST['name'])&& !empty($_POST['gender'])&& !empty($_POST['add'])&& !empty($_POST['city'])&& !empty($_POST['state'])&& !empty($_POST['country'])&& !empty($_POST['pin'])&& !empty($_POST['phone']) && !empty($_POST['email']))
                                    {
                                        $name=$_POST['name'];
                                        $gender=$_POST['gender'];
                                        $address=$_POST['add'];
                                        $city=$_POST['city'];
                                        $state=$_POST['state'];
                                        $country=$_POST['country'];
                                        $pincode=$_POST['pin'];
                                        $phone=$_POST['phone'];
                                        $email=$_POST['email'];

                                        $sql3="UPDATE `customertbl` SET `name`='$name',`gender`='$gender',`address`='$address',`city`='$city',`state`='$state',`country`='$country',`pincode`='$pincode',`phone`='$phone' ,`email`='$email' WHERE id='$ids'";
                                        $result2=mysqli_query($db,$sql3);
                                        $sql6="UPDATE `users` SET `username`='$name',`email`='$email' WHERE email='$email2'";
                                        $result6=mysqli_query($db,$sql6);
                                        
                                    }
                                }

                                    ?>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="id" value=<?php echo $arr['id'];?> readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">FULL NAME</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" value="<?php echo $arr['name'];?>">
                                        </div>
                                    </div>
                                   
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">ADDRESS</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="add" value="<?php echo $arr['address'];?>">
                                        </div>
                                    </div>
                                 
                                    <div class="row mb-3">
                                    <label for="inputtext" class="col-sm-2 col-form-label">gender</label>
                                    <div class="col-sm-5">
                                       Male:<input style="width: 50px;" type="radio" value="Male" name="gender" <?php if($arr['gender']==="Male"){ echo "Checked";}?>>
                                       Female:<input style="width: 50px;" type="radio" value="Female" name="gender" <?php if($arr['gender']==="Female"){ echo "Checked";}?>>
                                    </div>
                                    <!-- <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">GENDER</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="gender">
                                        </div>
                                    </div> -->
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">CITY</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="city" value="<?php echo $arr['city'];?>">
                                        </div>
                                    </div>
                                    <!-- <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Buy Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="bdate">
                                        </div>
                                    </div> -->
                                    <!-- <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Color</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="color">
                                        </div>
                                    </div> -->
                                    <!-- <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Material</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="mtrl">
                                        </div>
                                    </div> -->
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">STATE</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="state" value="<?php echo $arr['state'];?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">COUNTRY</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="country" value="<?php echo $arr['country'];?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">PINCODE</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pin" value=<?php echo $arr['pincode'];?>>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">EMAIL</label>
                                        <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" value=<?php echo $arr['email'];?>>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">PHONE</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phone" value=<?php echo $arr['phone'];?>>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Submit</label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary" name="update">UPDATE</button>
                                        </div>
                                    </div>

                                </form><!-- End General Form Elements -->

                            </div>
                        </div>

                    </div>


                </div>
            </section>
  </main><!-- End #main -->

  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>