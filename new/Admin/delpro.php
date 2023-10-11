<?php
$conn=mysqli_connect('localhost','root','','sports');

$did=$_GET['id'];
$sql="DELETE FROM `product_master` WHERE id=$did";
$result=mysqli_query($conn,$sql);
header('location:admin-viewproduct.php');
?>