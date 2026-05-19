<?php

include '../config/db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM aktivitet
WHERE id=$id";

$result = mysqli_query($connection,$sql);

$row = mysqli_fetch_assoc($result);

header('Content-Type: application/json');

echo json_encode($row);

?>