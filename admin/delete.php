<?php
include '../config/db.php';

$id=(int)$_GET['id'];
$sqlquery="DELETE FROM nxenes WHERE nxenesID=$id";
mysqli_query($connection,$sqlquery);


header("Location: viewStudents.php");
exit();
?>
