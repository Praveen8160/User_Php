<?php
session_start();
?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');
?>
<?php
$did=$_GET['id'];
$sql="SELECT size FROM `product_master` where id='$did'";
$result=mysqli_query($db,$sql);
$res1=mysqli_fetch_array($result);
$str=$res1['size'];
$arr=explode(",",$str);
// echo "<pre>";
// print_r($arr);
// echo "</pre>";
?>
<?php
if(isset($_POST['submit']))
{
    if (isset($_SESSION['email'])) 
{
    if(!empty($_POST['review']))
    {
        $review=$_POST['review'];
        $name=$_POST['name'];
        $email=$_POST['email'];
       $sql5="INSERT INTO `review_tbl`(`pid`, `review`, `name`, `email`) VALUES ('$did','$review','$name','$email')";
       $res5=mysqli_query($db,$sql5);
       $review="";
    }
    else
    {?>
        <script>
            alert('enter all detail')
            </script>
    <?php

    }
}
else
    {?>
        <script>
            alert('login your account')
            </script>
    <?php

    }
}
?>
<?php
 if(isset($_POST['cart']))
 {
if (isset($_SESSION['email'])) 
{
        if(!empty($_POST['brand'])&&!empty($_POST['qty']))
        {
            $email=$_SESSION['email'];
            $sql="SELECT `id` FROM `users` WHERE email='$email'";
            $res=mysqli_query($db,$sql);
            $result=mysqli_fetch_array($res);
            $id=$result['id'];
            $size=$_POST['brand'];
            $qty=$_POST['qty'];

            $sql3="SELECT `quantity` FROM `product_master` where id=$did";
            $res3=mysqli_query($db,$sql3);
            $result3=mysqli_fetch_array($res3);
            $quentity=$result3['quantity'];
            if($quentity>=$qty)
            {
            $sql1="SELECT * FROM `product_master` where id=$did";
            $res1=mysqli_query($db,$sql1);
             $result1=mysqli_fetch_array($res1);
            
                $name=$result1['name'];
                // $price1=$result1['price'];
                $price1=($result1['price']*$result1['offer'])/100;
                    $price=$result1['price']- $price1;
                $image=$result1['image'];
            
            $sql2="INSERT INTO `cart__tbl`(`cid`, `pname`, `quantity`, `size`, `price`, `image`) VALUES ('$id','$name','$qty','$size','$price','$image')";
            $res2=mysqli_query($db,$sql2);?>
            <script>
            alert('product are added in cart')
            </script>
            <?php
            $qu=$quentity-$qty;
            $sql4="UPDATE `product_master` SET `quantity`='$qu' where id=$did";
            $res4=mysqli_query($db,$sql4);
            }
            else
            {?>
                <script>
                    alert('stock are less')
                    </script>
            <?php
            }
            
        }
        else
        {?>
        <script>
            alert('enter the quentity')
            </script>
        <?php
        }
    }
else
{?>
    <script>
        alert('login account')
        </script>  
    <?php
     header('location:login.php');

}
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
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
<style>
.button {
    color:crimson;
    font-family:cursive;
    text-decoration:none;
}
</style>
<body style="overflow-x: hidden">
    <!-- Topbar Start -->
    <?php
     include 'head.php';
     ?>



    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Product Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Product Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <!-- <div id="product-carousel" class="carousel slide" data-ride="carousel"> -->
                <?php
                $sql="SELECT * FROM `product_master` where id='$did'";
                $result=mysqli_query($db,$sql);
                while($res1=mysqli_fetch_array($result))
                {?>
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="../Admin/<?php echo $res1['image'];?>" alt="Image">
                        </div>
                        <!-- <div class="carousel-item">
                            <img class="w-100 h-100" src="img/product-2.jpg" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="img/product-3.jpg" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="img/product-4.jpg" alt="Image">
                        </div> -->
                    </div>
                   
                    <!-- <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a> -->
                <!-- </div> -->
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold text-uppercase"><?php echo $res1['name'];?></h3>
                <div class="d-flex mb-3">
                    <?php
                $sql6="SELECT * FROM `review_tbl` WHERE pid=$did";
                            $res6=mysqli_query($db,$sql6);
                            $count=mysqli_num_rows($res6);?>
                    <!-- <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div> -->
                    <small class="pt-1">(<?php echo $count; ?> Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">$<?php 
                $price=($res1['price']*$res1['offer'])/100;
                $price1=$res1['price']- $price;
                echo $price1;?>
               </h3>
               <h5>
                <?php
                            if($res1['offer']>0)
                            {
                                echo $res1['offer']; ?> % off

                            <?php
                            }
                            ?>
               
                        </h5>
                <p class="mb-4"><?php echo $res1['description'];?></p>
               
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                    <form method="post">
                        <select class="form-control" name="brand">
                                        <?php  
                                        foreach($arr as $arr1)
                                        {?>
                                        <option value="<?php echo $arr1?>"><?php echo $arr1?></option>
                
                                        <?php
                                    }
                                    ?>
                         </select>
                        
                    
                </div>
                <!-- <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                    <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-1" name="color">
                            <label class="custom-control-label" for="color-1">Black</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-2" name="color">
                            <label class="custom-control-label" for="color-2">White</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-3" name="color">
                            <label class="custom-control-label" for="color-3">Red</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-4" name="color">
                            <label class="custom-control-label" for="color-4">Blue</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-5" name="color">
                            <label class="custom-control-label" for="color-5">Green</label>
                        </div>
                    </form>
                </div> -->
                <!-- <form method="post"> -->
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                    
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-primary btn-minus" >
                            <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control form-control-sm bg-secondary text-center" value="1" name="qty">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-primary btn-plus">
                            <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary" name="cart">Add To Cart</button>
                </div>
                </form>
                <!-- <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
               
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (<?php echo $count?>)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p></p>
                    </div>
                    <!-- <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Information</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                  </ul> 
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                  </ul> 
                            </div>
                        </div>
                    </div> -->
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                        <div class="col-md-6">
                        <?php $sql1="SELECT * FROM `product_master` where id=$did";
                            $res1=mysqli_query($db,$sql1);
                            $result1=mysqli_fetch_array($res1);
                            $name=$result1['name'];

                            $sql6="SELECT * FROM `review_tbl` WHERE pid=$did";
                            $res6=mysqli_query($db,$sql6);
                            $count=mysqli_num_rows($res6);?>
                            
                            
                                <h4 class="mb-4"><?php echo $count; ?> review for "<?php echo $name; ?>"</h4>
                                <?php
                                while($result4=mysqli_fetch_array($res6))
                            {
                            ?>
                                <div class="media mb-4">
                                    <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6><?php echo $result4['name']; ?><small> - <i><?php echo $result4['date']; ?></i></small></h6>
                                        <!-- <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div> -->
                                        <p><?php echo $result4['review']; ?>.</p>
                                    </div>
                                </div>
                           
                            <?php
                            }
                            ?>
                             </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <!-- <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div> -->
                                <form method="post">
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" name="review"class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php 
                     if (isset($_SESSION['username'])) {
                      echo $_SESSION['username'];
                  } ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" id="email"name="email" value="<?php 
                     if (isset($_SESSION['username'])) {
                      echo $_SESSION['email'];
                  } ?>" readonly>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" name="submit" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <!-- <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-2.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-3.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-4.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="img/product-5.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Products End -->

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
                   <?php
                   include 'footer.php';
                   ?>
               
                </body>
                </html>