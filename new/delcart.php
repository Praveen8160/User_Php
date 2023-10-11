<?php
$db=mysqli_connect('localhost','root','','sports');

$did=$_GET['id'];
$sql1="SELECT * FROM `cart__tbl` WHERE id=$did";
$res=mysqli_query($db,$sql1);
$result1=mysqli_fetch_array($res);
$name=$result1['pname'];
$qty=$result1['quantity'];

$sql2="SELECT * FROM `product_master` WHERE name='$name'";
$res2=mysqli_query($db,$sql2);
$result2=mysqli_fetch_array($res2);
$qt=$result2['quantity'];

$qu=$qty + $qt;

$sql4="UPDATE `product_master` SET `quantity`='$qu' where name='$name'";
$res4=mysqli_query($db,$sql4);

$sql="DELETE FROM `cart__tbl` WHERE id=$did";
$result=mysqli_query($db,$sql);
header('location:cart.php');
?>