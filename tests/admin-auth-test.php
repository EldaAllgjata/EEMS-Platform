<?php

$ch = curl_init("http://localhost/eems/eems/admin/adminDashboard.php");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);   
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false); 

$response = curl_exec($ch);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

/* Kontrollo redirect */
if (strpos($response, "Location: ../index.php") !== false) {
    echo "PASS - Redirect detected to login (protected)";
} elseif ($httpCode == 302) {
    echo "PASS - Redirect detected (HTTP 302)";
} else {
    echo "FAIL - No redirect, dashboard exposed";
}

?>