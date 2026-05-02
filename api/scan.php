<?php
$conn = new mysqli("localhost", "root", "", "eemsdb");

if ($conn->connect_error) {
    die("DB error");
}

$nxenesID = $_GET['data'];

// gjej nxenesin
$sql = "SELECT * FROM nxenes WHERE nxenesID='$nxenesID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $emri = $row['emerMbiemer'];

    // kontrollo nëse është regjistruar sot
    $check = "SELECT * FROM mungesa 
              WHERE nxenesID='$nxenesID' 
              AND data = CURDATE()";

    $checkResult = $conn->query($check);

    if ($checkResult->num_rows == 0) {

        // lendaID mund ta vendosësh default (p.sh 1 = "Prezence")
        $lendaID = 1;

        $ora = date("H:i:s");
        $statusi = "Prezent";

        $insert = "INSERT INTO mungesa 
        (nxenesID, lendaID, data, ora, statusi)
        VALUES 
        ('$nxenesID', '$lendaID', CURDATE(), '$ora', '$statusi')";

        if ($conn->query($insert)) {
            echo "OK: $emri regjistruar si prezent";
        } else {
            echo "Insert error";
        }

    } else {
        echo "Already registered today";
    }

} else {
    echo "Nxenesi nuk u gjet";
}

$conn->close();
?>