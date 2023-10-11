<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');
$ids=$_GET['id'];
$sql="SELECT * FROM `categories_tbl` WHERE id=$ids";
$result=mysqli_query($db,$sql);
$arr=mysqli_fetch_array($result);
if(isset($_POST['update']))
{
   if(!empty($_POST['name']))
   {
   $upid=$_GET['id'];
   $name=$_POST['name'];

   $img_name = $_FILES['my_image']['name'];
   $img_size = $_FILES['my_image']['size'];
   $tmp_name = $_FILES['my_image']['tmp_name'];
   $error = $_FILES['my_image']['error'];

   if ($error === 0) {
       if ($img_size > 125000) {
        ?>
        <script>
            alert("image error")
        </script>
    <?php
           header("Location: upcat.php?error=$em");
       }else {
           $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
           $img_ex_lc = strtolower($img_ex);

           $allowed_exs = array("jpg", "jpeg", "png","webp"); 

           if (in_array($img_ex_lc, $allowed_exs)) {
               $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
               $img_upload_path = 'categories/'.$new_img_name;
               move_uploaded_file($tmp_name, $img_upload_path);

               // Insert into Database
               $sql1="UPDATE `categories_tbl` SET `name`='$name',`image`='$img_upload_path' WHERE id=$upid";
                        mysqli_query($db,$sql1);
                        header("Location: viewcat.php");
            }
           else 
           {
            ?>
            <script>
                alert("You can't upload files of this type")
            </script>
        <?php
               header("Location: upcat.php?error=$em");
           }
       }
   }
  }
  else
{?>
    <script>
        alert("enter all values")
    </script>
<?php
}
}
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
                <h1>UPDATE CATEGORIES</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="adminindex.php">Home</a></li>
                        <li class="breadcrumb-item">Forms</li>
                        <li class="breadcrumb-item active">Update categories</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <form action="" enctype="multipart/form-data" method="post">
            <section class="section">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">General Form Elements</h5>

                                <!-- General Form Elements -->
                                <form action="" method="post">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Categories Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" value="<?php echo $arr['name'];?>" >
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Brand Image</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="my_image" id="fileToUpload" value="<?php echo $arr['image'];?>" required="">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Submit</label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary" name="update">UPDATE CATEGORIES</button>
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