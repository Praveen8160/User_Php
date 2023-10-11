<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Admin</title>
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




    <?php include 'adminheader.php'; ?>
    <?php include 'adminsidebar.php'; ?>
    <main id="main" class="main">

        <section class="section">

            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add staff</h5>

                            <!-- General Form Elements -->
                            <form  method="post" enctype="multipart/form-data" >
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label"> Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sfname" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputtext" class="col-sm-2 col-form-label">gender</label>
                                    <div class="col-sm-5">
                                       Male:<input style="width: 50px;" type="radio" name="gender">
                                       Female:<input style="width: 50px;" type="radio" name="gender">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputtext" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="city">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Pincode</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pcode">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Contact No</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="cno">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Date Of Join </label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="sdoj">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email address</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="semail">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="pass">
                                    </div>
                                </div>


                                
                                <div class="row mb-3">

                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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

    <?php
    if (isset($_REQUEST['submit'])) {
        $fname = $_REQUEST['sfname'];
        $gender = $_REQUEST['gender'];
        $dob = $_REQUEST['dob'];
        $add = $_REQUEST['address'];
        $city = $_REQUEST['city'];
        $pcode = $_REQUEST['pcode'];
        $cno = $_REQUEST['cno'];
        $desig = $_REQUEST['desig'];
        $doj = $_REQUEST['sdoj'];
        $ema = $_REQUEST['semail'];
        $passw = $_REQUEST['pass'];
        include '../edgecut-html/db.php';
        mysqli_query($con, "insert into tbl_staff( Name, Gender, Dob, Address, City, Pincode, Contact_No, Designation, Dateofjoin, EmailId, Password) values('$fname','$gender','$dob','$add','$city', $pcode,'$cno','$desig','$doj','$ema','$passw')");
        echo '<script>alert("staff added successfully")</script>';
    }
    ?>

</html>