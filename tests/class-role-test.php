<?php
session_start();
$_SESSION["id"] = 1;
$_SESSION["role"] = "teacher";

$cookie = session_name() . '=' . session_id();

$url = "http://localhost/eems/eems/admin/classRegistration.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($httpCode == 302 || strpos($response, "index.php") !== false) {
    echo "PASS - Access control works";
} else {
    echo "FAIL - ROLE BYPASS detected!";
}
?>