<?php
include '../config/db.php';
error_reporting(0);

$id=(int)$_GET['id'];

$sqlDeleteLinks = "DELETE FROM lidhjamesues WHERE klasID=$id";
if($sqlDeleteLinks){
mysqli_query($connection,$sqlDeleteLinks);
}
$sqlquery="DELETE FROM klasa WHERE klasaID=$id";
mysqli_query($connection,$sqlquery);


header("Location: viewClass.php");
exit();
?>
