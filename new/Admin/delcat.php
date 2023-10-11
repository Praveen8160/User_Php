<?php
$conn=mysqli_connect('localhost','root','','sports');

$did=$_GET['id'];
$sql="DELETE FROM `categories_tbl` WHERE id=$did";
$result=mysqli_query($conn,$sql);
header('location:viewcat.php');
?>
