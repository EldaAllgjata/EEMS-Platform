<?php

include '../config/db.php';

$id = $_POST['id'];

$title = $_POST['title'];

$content = $_POST['content'];

$category = $_POST['category'];

$ambient = $_POST['ambient'];

$date = $_POST['date'];


$checkQuery = "SELECT * FROM aktivitet
WHERE data='$date'";

$checkResult = mysqli_query($connection,$checkQuery);

if(mysqli_num_rows($checkResult)>0){
    $existing =
    mysqli_fetch_assoc($checkResult);

    $existingId = $existing['id'];

    $sql = "UPDATE aktivitet

    SET

    titull='$title',
    content='$content',
    kategoria='$category',
    ambient='$ambient'

    WHERE id=$existingId";

}else{

    $sql = "INSERT INTO aktivitet

    (titull,content,kategoria,ambient,data)

    VALUES

    ('$title','$content',
    '$category','$ambient','$date')";
}

mysqli_query($connection,$sql);

?>