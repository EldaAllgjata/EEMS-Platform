<?php
include '../config/db.php';
error_reporting(0);

$id = $_POST['id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$birth = $_POST['birth'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$parent = $_POST['parent'];
$classid = $_POST['classid'];
$year = $_POST['year'];
$nrid = $_POST['nrid'];

$sql = "UPDATE nxenes SET

emerMbiemer = '$name',
gjinia = '$gender',
datelindja = '$birth',
nrTel = '$phone',
email = '$email',
prindID = '$parent',
klasID = '$classid',
vitiStudimit = '$year',
nrID = '$nrid'

WHERE nxenesID = $id";

if(mysqli_query($connection, $sql)){

    echo "U perditesua me sukses!";

}else{

    echo "Gabim: " . mysqli_error($connection);
}
?>