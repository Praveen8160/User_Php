<?php 
  session_start();  
?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');
?>
<?php
if (!isset($_SESSION['email'])) {
  header('location:../new/login.php');
}
?>
<?php
if(isset($_POST['submit'])&&!empty($_POST['name'])&&!empty($_POST['price'])&&!empty($_POST['dec'])&&!empty($_POST['qty'])&&!empty($_POST['size'])&&!empty($_FILES['file1']))
{
    $name=$_POST['name'];
    $price1=($_POST['price']*$_POST['offer'])/100;
    $price=$_POST['price']-$price1;
    $dec=$_POST['dec'];
    $qty=$_POST['qty'];
    $size=$_POST['size'];
    $offer=$_POST['offer'];
    $size1=implode(',', $size);
    $brand=$_POST['brand'];
    $cat=$_POST['cat'];

	$img_name = $_FILES['file1']['name'];
	$img_size = $_FILES['file1']['size'];
	$tmp_name = $_FILES['file1']['tmp_name'];
	$error = $_FILES['file1']['error'];

	if ($error === 0) {
		if ($img_size > 125000) {
			$em = "Sorry, your file is too large.";
		    header("Location: addproduct.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png","webp"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'product/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
                $sql="INSERT INTO `product_master`(`name`, `price`, `brand`, `categories`, `description`, `quantity`, `size`, `image`, `offer`) VALUES ('$name','$price','$brand','$cat','$dec','$qty','$size1','$img_upload_path','$offer')";
                $res=mysqli_query($db,$sql);
				header("Location: addproduct.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: viewproduct.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: addcat.php?error=$em");
	}

}



?>
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

    <body>


        <?php include 'adminheader.php'; ?>
        <?php include 'adminsidebar.php'; ?>
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>ADD PRODUCT</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="adminindex.php">Home</a></li>
                        <li class="breadcrumb-item">Forms</li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
           
            <section class="section">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">General Form Elements</h5>

                                <!-- General Form Elements -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Product Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" >
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="price">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">offer(%)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="offer">
                                        </div>
                                    </div>
                                   
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Brand</label>
                                        <div class="col-sm-10">
                                        <select class="form-control" name="brand">
                                        <?php  
                                        $sql="SELECT * FROM `brand_tbl`";
                                        $result=mysqli_query($db,$sql);
                                        while($res=mysqli_fetch_array($result))
                                        {?>
                                        <option><?php echo $res['name'];?></option>
                
                                        <?php
                                    }
                                    ?>
                                     </select>
                                        </div>
                                    </div>
                                 

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Categories</label>
                                        <div class="col-sm-10">
                                        <select class="form-control" name="cat">
                                        <?php  
                                        $sql="SELECT * FROM `categories_tbl`";
                                        $result=mysqli_query($db,$sql);
                                        while($res=mysqli_fetch_array($result))
                                        {?>
                                        <option><?php echo $res['name'];?></option>
                
                                        <?php
                                    }
                                    ?>
                                     </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Size</label>
                                        <div class="col-sm-7">
                                        <select name="size[]" class="form-control" multiple>
                                        <?php  
                                        $sql="SELECT * FROM `size_tbl`";
                                        $result=mysqli_query($db,$sql);
                                        while($res=mysqli_fetch_array($result))
                                        {?>
                                        <option><?php echo $res['size'];?></option>
                
                                        <?php
                                    }
                                    ?> 
                                        </select>
                                        </div>
                                        <div class="col-sm-3">
                                        <a href="size.php" ><button type="button" class="btn btn-primary" name="addimage">ADD SIZE</button></a>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="dec">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Quantity</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="qty">
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
                                        <label for="inputText" class="col-sm-2 col-form-label">Product Image</label>
                                        <div class="col-sm-10"  id="image_box">
                                            <input class="form-control" type="file" name="file1" id="fileToUpload">
                                            
                                        </div>
                                        <!-- <div class="col-sm-3">
                                        <button type="button" class="btn btn-primary" onclick="add_more_images()" name="addimage">ADD IMAGE</button>
                                        </div> -->
                                    </div>
                                    <!-- <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Product Image2</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="file2" id="fileToUpload">
                                        </div>
                                    </div> -->

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Submit</label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary" name="submit">ADD PRODUCT</button>
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
        <!-- <script>
            function add_more_images()
            {
                var html='<div class="col-sm-8"><input class="form-control" type="file" name="file1" id="fileToUpload"></div>';
                jQuery('#image_box').append(html);
            }
            </script> -->
   
    </body>

</html>