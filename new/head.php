<?php
// session_start();
?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sports jamm.in</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body style="overflow-x: hidden">
      <!-- Topbar Start -->
      <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="index.php" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Sports</span>jam.in</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <!-- <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form> -->
        </div>
        <div class="col-lg-3 col-6 text-right">
        
            <a href="profile.php" class="btn border">
           
                <i class="fas fa-user text-primary"></i>
                <?php 
                    if (isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    }
                ?>
            </a>
            <?php
            if(isset($_SESSION['username']))
            {
                            $email=$_SESSION['email'];
                            $sql="SELECT `id` FROM `users` WHERE email='$email'";
                            $res=mysqli_query($db,$sql);
                            $result=mysqli_fetch_array($res);
                            $id=$result['id'];
                            $sql1="SELECT * FROM `cart__tbl` WHERE cid=$id";
                            $res1=mysqli_query($db,$sql1);
                            $rowcount = mysqli_num_rows($res1);
            }
                            ?>
            <a href="cart.php" class="btn border">
               <i class="fas fa-shopping-cart text-primary"></i>
                <span><?php if(isset($_SESSION['username'])) {
                        echo $rowcount ;
                    }?></span>
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100" style="height: 300px">
                       
                        <?php  
                       $sql="SELECT * FROM `categories_tbl`";
                       $result=mysqli_query($db,$sql);
                       while($res=mysqli_fetch_array($result))
                       {?>
                        <a href="product2.php?id=<?php echo $res['id'];?>" class="nav-item nav-link"><?php echo $res['name'];?></a>
                        <?php
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="index.php" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Sports</span>jam.in</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <!-- <a href="shop.html" class="nav-item nav-link active">Shop</a> -->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">brands</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                <?php  
                                    $sql="SELECT * FROM `brand_tbl`";
                                    $result=mysqli_query($db,$sql);
                                    while($res=mysqli_fetch_array($result))
                                    {?>
                                    <a href="product.php?id=<?php echo $res['id'];?>" class="dropdown-item"><?php echo $res['name'];?></a>
                                    <?php
                                    }
                                    ?>
                                    <!-- <a href="Adidas.php" class="dropdown-item">Adidas</a>
                                    <a href="Puma.php" class="dropdown-item">Puma</a>
                                    <a href="Kookaburra.php" class="dropdown-item">Kookaburra</a>
                                    <a href="cosco.php" class="dropdown-item">Cosco</a>
                                    <a href="slazenger.php" class="dropdown-item">Slazenger</a>
                                    <a href="spalding.php" class="dropdown-item">Spalding</a>
                                    <a href="Evelast.php" class="dropdown-item">Everlast</a> -->
                                </div>
                            </div>
                            <!-- <a href="detail.html" class="nav-item nav-link">Shop Detail</a> -->
                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a> -->
                                <!-- <div class="dropdown-menu rounded-0 m-0"> -->
                                    <a href="cart.php" class="nav-item nav-link">Shopping Cart</a>
                                    <!-- <a href="checkout.html" class="dropdown-item">Checkout</a> -->
                                <!-- </div> -->
                            <!-- </div> -->
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                      <?php  if (isset($_SESSION['username'])) {
                       ?>
                        <a href="logout.php" class="nav-item nav-link" >logout</a>
                        <?php
                    }
                ?> 
                        <?php 
                    if (!isset($_SESSION['username'])) {
                       ?>
                       <a href="login.php" class="nav-item nav-link">Login</a>
                       <a href="register.php" class="nav-item nav-link">Register</a>
                       <?php
                    }
                ?> 
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
      <script src="lib/easing/easing.min.js"></script>
      <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  
      <!-- Contact Javascript File -->
      <script src="mail/jqBootstrapValidation.min.js"></script>
      <script src="mail/contact.js"></script>
  
      <!-- Template Javascript -->
      <script src="js/main.js"></script>
  </body>
  
  </html>