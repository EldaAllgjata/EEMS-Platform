<?php
include "../config/db.php";
session_start();

if(
    !isset($_GET['id']) ||
    !isset($_GET['paypalOrderID'])
){
    die("Invalid request");
}

$id = $_GET['id'];
$paypalOrderID = $_GET['paypalOrderID'];

$query = "
UPDATE pagesat
SET 
statusi = 'Paguar',
transactionID = '$paypalOrderID'
WHERE id = '$id'
";

mysqli_query($connection, $query);
header("Location: parentPayments.php");

exit();
?>