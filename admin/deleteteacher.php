<?php
include '../config/db.php';
error_reporting(0);

$id=(int)$_GET['id'];
$sqlDeleteLinks = "DELETE FROM lidhjamesues WHERE mesuesID=$id";
mysqli_query($connection,$sqlDeleteLinks);

$sqlquery="DELETE FROM mesues WHERE mesuesID=$id";
mysqli_query($connection,$sqlquery);


header("Location: viewTeachers.php");
exit();
?>
