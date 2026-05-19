<?php
include '../config/db.php';
error_reporting(0);

$id=(int)$_GET['id'];

$sqlMungesa = "DELETE FROM mungesa WHERE nxenesID = $id";
mysqli_query($connection, $sqlMungesa);

$sqlPagesa = "DELETE FROM pagesat WHERE studentID = $id";
mysqli_query($connection, $sqlPagesa);
 
$sqlquery="DELETE FROM nxenes WHERE nxenesID=$id";
mysqli_query($connection,$sqlquery);


header("Location: viewStudents.php");
exit();
?>
