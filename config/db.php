<?php
$conn = new mysqli("localhost", "root", "", "eemsdb");

if ($conn->connect_error) {
    die("DB connection failed");
}
?>