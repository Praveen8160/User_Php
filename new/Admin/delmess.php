<?php
$conn=mysqli_connect('localhost','root','','sports');

if($conn)
{
   echo'hello';
}
else
{
   echo 'no';
}
$did=$_GET['id'];
$sql="DELETE FROM `contact_tbl` WHERE id=$did";
$result=mysqli_query($conn,$sql);
header('location:message.php');
?>
