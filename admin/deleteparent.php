<?php
include '../config/db.php';

$id=(int)$_GET['id'];
$sqlDeleteLinks = "DELETE FROM nxenes WHERE prindID=$id";
if($sqlDeleteLinks){
mysqli_query($connection,$sqlDeleteLinks);
}

$sqlquery="DELETE FROM prinder WHERE prind_id=$id";
mysqli_query($connection,$sqlquery);


header("Location: viewParent.php");
exit();
?>
