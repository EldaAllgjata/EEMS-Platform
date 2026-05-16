<?php
include '../config/db.php';
error_reporting(0);

$id = $_POST['id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$birth = $_POST['birth'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$sql = "UPDATE prinder SET

emerMbiemer = '$name',
Gjinia = '$gender',
Datelindja = '$birth',
nrTel = '$phone',
email = '$email'
WHERE prind_id = $id";

if(mysqli_query($connection, $sql)){

    echo "U perditesua me sukses!";

}else{

    echo "Gabim: " . mysqli_error($connection);
}
?>