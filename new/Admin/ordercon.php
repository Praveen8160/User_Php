<?php
 $conn=mysqli_connect('localhost','root','','sports');

$did=$_GET['id'];
$status="confirm";
$sql1="UPDATE `order_tbl` SET `status`='$status' WHERE id=$did";
$res1=mysqli_query($conn,$sql1);
header('location:vieworder.php');

?>