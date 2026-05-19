<?php
include '../config/db.php';
error_reporting(0);

$id = $_POST['id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$birth = $_POST['birth'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$sql = "UPDATE mesues SET

emerMbiemer = '$name',
gjinia = '$gender',
datelindja = '$birth',
nrTel = '$phone',
email = '$email'
WHERE mesuesID = $id";

if(mysqli_query($connection, $sql)){

    echo "U perditesua me sukses!";

}else{

    echo "Gabim: " . mysqli_error($connection);
}
?>