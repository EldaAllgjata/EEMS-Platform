<?php
$connection = new mysqli("localhost", "root", "", "eemsdb");

if ($connection->connect_error) {
    die("DB connection failed");
}
?>