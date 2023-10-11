<?php
session_start();
?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'sports');
?>
<?php


if (!isset($_SESSION['email'])) {
    header('location:register.php');
}
?>
<?php
if(isset($_POST['place']))
{
    if(!empty($_POST['cname'])&&!empty($_POST['email'])&&!empty($_POST['mobile'])&&!empty($_POST['add'])&&!empty($_POST['con'])&&!empty($_POST['city'])&&!empty($_POST['state'])&&!empty($_POST['pincode'])&&!empty($_POST['payment']))

{
                            $total=0;
                            $email=$_SESSION['email'];
                            $sql="SELECT `id` FROM `users` WHERE email='$email'";
                            $res=mysqli_query($db,$sql);
                            $result=mysqli_fetch_array($res);
                            $id=$result['id'];
                            $sql1="SELECT * FROM `cart__tbl` WHERE cid=$id";
                            $res1=mysqli_query($db,$sql1);
                            $pro1="";
                            $total1=0;
                            while($result1=mysqli_fetch_array($res1))
                            {
                                $pro1=$result1['pname'];
                                $qty1=$result1['quantity'];
                                $total1=$result1['price']*$result1['quantity'];
                                $email=$_POST['email'];
                                $mobile=$_POST['mobile'];
                                $add=$_POST['add'];
                                $city=$_POST['city'];
                                $status="pending";
                                $pin=$_POST['pincode'];
                                $payment=$_POST['payment'];
                                $sql="INSERT INTO `order_tbl`(`cid`, `pname`, `quantity`, `address`, `city`, `total`, `payment`, `mobile`, `status`) VALUES ('$id','$pro1','$qty1','$add','$city','$total1','$payment','$mobile','$status')";
                                $res=mysqli_query($db,$sql);
                            }

                            // $email=$_SESSION['email'];
                            // $sql="SELECT `id` FROM `users` WHERE email='$email'";
                            // $res=mysqli_query($db,$sql);
                            // $result=mysqli_fetch_array($res);
                            // $id=$result['id'];
                            // $name=$pro1;
                            // $email=$_POST['email'];
                            // $mobile=$_POST['mobile'];
                            // $add=$_POST['add'];
                            // $city=$_POST['city'];
                            // $pin=$_POST['pincode'];
                            // $payment=$_POST['payment'];                      
    // $subtotal=$total1;
    // $sql="INSERT INTO `order_tbl`(`cid`, `pname`, `quantity`, `address`, `city`, `total`, `payment`, `mobile`) VALUES ('$id','$name','$qty1','$add','$city','$subtotal','$payment','$mobile')";
    // $res=mysqli_query($db,$sql);
    $sql1="DELETE FROM `cart__tbl` WHERE cid=$id";
    $result1=mysqli_query($db,$sql1);
    ?>
    <script>
        alert('order are confirm')
        </script>  
    <?php
     header('location:profile.php');
}else
{?>
    <script>
        alert('enter the all detail')
        </script>
<?php

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body style="overflow-x: hidden">
    <!-- Topbar Start -->
    <?php
     include 'head.php';
     ?>




    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <form method="post">
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>User Name</label>
                            <input class="form-control" type="text" name="cname" placeholder="John" value="<?php 
                     if (isset($_SESSION['username'])) {
                      echo $_SESSION['username'];
                  } ?>">
                        </div>
                        <!-- <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe">
                        </div> -->
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" name="email" placeholder="example@email.com" value="<?php 
                     if (isset($_SESSION['username'])) {
                      echo $_SESSION['email'];
                  } ?>">
                        </div>
                        <?php
                        ?>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" name="mobile" value="<?php
                             $email=$_SESSION['email'];
                             $sql="SELECT * FROM `customertbl` WHERE email='$email'";
                             $res=mysqli_query($db,$sql);
                             while($result=mysqli_fetch_array($res))
                             {     
                     if (isset($result['phone'])) {
                      echo $result['phone'];
                  }
                  else
                  {
                    echo "";
                  } 
                }
                  ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line </label>
                            <input class="form-control" type="text" name="add" value="<?php
                             $email=$_SESSION['email'];
                             $sql="SELECT * FROM `customertbl` WHERE email='$email'";
                             $res=mysqli_query($db,$sql);
                             while($result=mysqli_fetch_array($res))
                             {     
                     if (isset($result['address'])) {
                      echo $result['address'];
                  }
                  else
                  {
                    echo "";
                  } 
                }
                  ?>">
                        </div>
                        <!-- <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div> -->
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input class="form-control" type="text" name="con" value="<?php
                             $email=$_SESSION['email'];
                             $sql="SELECT * FROM `customertbl` WHERE email='$email'";
                             $res=mysqli_query($db,$sql);
                             while($result=mysqli_fetch_array($res))
                             {     
                     if (isset($result['country'])) {
                      echo $result['country'];
                  }
                  else
                  {
                    echo "";
                  } 
                }
                  ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" name="city" value="<?php
                             $email=$_SESSION['email'];
                             $sql="SELECT * FROM `customertbl` WHERE email='$email'";
                             $res=mysqli_query($db,$sql);
                             while($result=mysqli_fetch_array($res))
                             {     
                     if (isset($result['city'])) {
                      echo $result['city'];
                  }
                  else
                  {
                    echo "";
                  } 
                }
                  ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" name="state" value="<?php
                             $email=$_SESSION['email'];
                             $sql="SELECT * FROM `customertbl` WHERE email='$email'";
                             $res=mysqli_query($db,$sql);
                             while($result=mysqli_fetch_array($res))
                             {     
                     if (isset($result['state'])) {
                      echo $result['state'];
                  }
                  else
                  {
                    echo "";
                  } 
                }
                  ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" name="pincode" value="<?php
                             $email=$_SESSION['email'];
                             $sql="SELECT * FROM `customertbl` WHERE email='$email'";
                             $res=mysqli_query($db,$sql);
                             while($result=mysqli_fetch_array($res))
                             {     
                     if (isset($result['pincode'])) {
                      echo $result['pincode'];
                  }
                  else
                  {
                    echo "";
                  } 
                }
                  ?>">
                        </div>
                        <!-- <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount">
                                <label class="custom-control-label" for="newaccount">Create an account</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                   
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <?php
                            $total=0;
                            $email=$_SESSION['email'];
                            $sql="SELECT `id` FROM `users` WHERE email='$email'";
                            $res=mysqli_query($db,$sql);
                            $result=mysqli_fetch_array($res);
                            $id=$result['id'];
                            $sql1="SELECT * FROM `cart__tbl` WHERE cid=$id";
                            $res1=mysqli_query($db,$sql1);
                            while($result1=mysqli_fetch_array($res1))
                            {
                                ?>
                        <div class="d-flex justify-content-between">
                            <p><?php echo $result1['pname'];?></p>
                            <p><?php echo $result1['price']*$result1['quantity'];?></p>
                        </div><?php
                            $total=$result1['price']*$result1['quantity']+$total;
                            $qty=$result1['quantity'];
                            }
                        ?>
                        <!-- <div class="d-flex justify-content-between">
                            <p>Colorful Stylish Shirt 2</p>
                            <p>$150</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Colorful Stylish Shirt 3</p>
                            <p>$150</p>
                        </div> -->
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium"><?php echo $total ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">Free</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold"><?php echo $total ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="Paypal" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value="Direct Check" id="directcheck">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value="Bank Transfer" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" id="btn" name="place">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
                        </form>
    <!-- Checkout End -->

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

<script>
  

</script>
    <?php
    include 'footer.php';
    ?>

 </body>
 </html>