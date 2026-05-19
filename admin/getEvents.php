<?php

include '../config/db.php';

$sql = "SELECT

            id,

            titull AS title,

            data AS start

        FROM aktivitet";

$result = mysqli_query($connection,$sql);

$events = [];

while($row = mysqli_fetch_assoc($result)){

    $events[] = $row;

}

header('Content-Type: application/json');

echo json_encode($events);

?>