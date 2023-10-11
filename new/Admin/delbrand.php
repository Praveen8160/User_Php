<?php
$conn=mysqli_connect('localhost','root','','sports');

$did=$_GET['id'];
$sql="DELETE FROM `brand_tbl` WHERE id=$did";
$result=mysqli_query($conn,$sql);
header('location:viewbrand.php');
?>