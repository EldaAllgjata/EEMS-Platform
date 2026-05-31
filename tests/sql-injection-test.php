<?php
include "../config/db.php";

$email = "' OR '1'='1";
$password = "123";

$sql = "SELECT * FROM admin
        WHERE email='$email'
        AND fjalekalim='$password'";

$result = mysqli_query($connection, $sql);

if(!$result){
    die(mysqli_error($connection));
}

if(mysqli_num_rows($result) > 0){
    echo "FAIL - SQL Injection Vulnerable";
}else{
    echo "PASS - Protected from SQL Injection";
}
?>