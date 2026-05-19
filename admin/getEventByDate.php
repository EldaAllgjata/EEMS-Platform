<?php

include '../config/db.php';

$date = $_GET['date'];

$sql = "SELECT * FROM aktivitet
WHERE data='$date'";

$result = mysqli_query($connection,$sql);

if(mysqli_num_rows($result)>0){

    $row = mysqli_fetch_assoc($result);

    echo json_encode($row);

}else{

    echo json_encode(null);

}

?>