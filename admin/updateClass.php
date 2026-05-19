<?php
include '../config/db.php';
error_reporting(0);

$id = $_POST['id'];
$name = $_POST['name'];

$sql = "UPDATE klasa SET
emer = '$name'
WHERE klasaID = $id";

if(mysqli_query($connection, $sql)){

    echo "U perditesua me sukses!";

}else{

    echo "Gabim: " . mysqli_error($connection);
}
?>