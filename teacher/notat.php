<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}

$mesuesID = $_SESSION["id"];


$klasid = $_POST['klasid'] ?? null;
$lendaID = $_POST['lendaID'] ?? null;
$tremujori = $_POST['tremujori'] ?? null;

if(isset($_POST['ruaj'])){

    $klasid = $_POST['klasid'];
    $lendaID = $_POST['lendaID'];
    $tremujori = $_POST['tremujori'];

    foreach($_POST['vleresim1'] as $nxenesID => $v1){

        $v1 = !empty($v1) ? $v1 : 0;
        $v2 = !empty($_POST['vleresim2'][$nxenesID]) ? $_POST['vleresim2'][$nxenesID] : 0;
        $v3 = !empty($_POST['vleresim3'][$nxenesID]) ? $_POST['vleresim3'][$nxenesID] : 0;
        $projekt = !empty($_POST['projekt'][$nxenesID]) ? $_POST['projekt'][$nxenesID] : 0;
        $test = !empty($_POST['test'][$nxenesID]) ? $_POST['test'][$nxenesID] : 0;

        $check = mysqli_query($connection,
        "SELECT * FROM vleresim
         WHERE nxenesID='$nxenesID'
         AND klasid='$klasid'
         AND lendaID='$lendaID'
         AND tremujori='$tremujori'");

        if(!$check){
            die(mysqli_error($connection));
        }

        if(mysqli_num_rows($check) > 0){
            mysqli_query($connection,
            "UPDATE vleresim SET
                v1='$v1',
                v2='$v2',
                v3='$v3',
                projekt='$projekt',
                test='$test'
            WHERE nxenesID='$nxenesID'
            AND klasid='$klasid'
            AND lendaID='$lendaID'
            AND tremujori='$tremujori'");

        } else {

            mysqli_query($connection,
            "INSERT INTO vleresim
            (nxenesID, tremujori, v1, v2, v3, projekt, test, lendaID, klasid)
            VALUES
            ('$nxenesID','$tremujori','$v1','$v2','$v3','$projekt','$test','$lendaID','$klasid')");
        }
    }

    echo "<script>alert('Notat u ruajtën me sukses!');</script>";
}


$klasatQuery = mysqli_query($connection,
"SELECT DISTINCT klasa.klasaID, klasa.emer
FROM klasa
JOIN lidhjamesues
ON klasa.klasaID = lidhjamesues.klasID
WHERE lidhjamesues.mesuesID='$mesuesID'");

$lendetQuery = mysqli_query($connection,
"SELECT DISTINCT lenda.id, lenda.emri
FROM lenda
JOIN lidhjamesues
ON lenda.id = lidhjamesues.lendaID
WHERE lidhjamesues.mesuesID='$mesuesID'");

$sql = "
SELECT nxenes.nxenesID, nxenes.emerMbiemer
FROM nxenes
JOIN lidhjamesues
ON nxenes.klasID = lidhjamesues.klasID
WHERE lidhjamesues.mesuesID='$mesuesID'
";

if(!empty($_POST['klasid'])){
    $klasid = $_POST['klasid'];
    $sql .= " AND nxenes.klasID='$klasid'";
}

$result = mysqli_query($connection, $sql);


if(!$result){
    die("SQL Error: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notat</title>
    <link rel="stylesheet" href="./stilim.css">
</head>

<body>

<div class="dashboard">

    <div class="container">

        
        <div class="sidebar">

            <div>

                <div class="top">
                    <div class="icon">
                        <img src="../assets/images/teacher/icons8-male-user-90.png" alt="">
                    </div>

                    <p>Mireseerdhe,<br>mesues!</p>
                </div>

                <div class="menu">

                    <a href="teacherDashboard.php" class="item">
                        <img src="../assets/images/teacher/icons8-dashboard-24.png">
                        <span>Dashboard</span>
                    </a>

                    <a href="notat.php" class="item active">
                        <img src="../assets/images/teacher/icons8-grades-48.png">
                        <span>Notat</span>
                    </a>

                    <a href="mungesat.php" class="item">
                        <img src="../assets/images/teacher/icons8-attendance-64.png">
                        <span>Mungesat</span>
                    </a>

                    <a href="detyrat.php" class="item">
                        <img src="../assets/images/teacher/icons8-home-30 (1).png">
                        <span>Detyrat</span>
                    </a>

                    <a href="orariT.php" class="item">
                        <img src="../assets/images/teacher/icons8-schedule-50 (3).png">
                        <span>Orari</span>
                    </a>

                    <a href="aktivitetet.php" class="item">
                        <img src="../assets/images/teacher/icons8-calendar-50 (1).png">
                        <span>Aktivitetet</span>
                    </a>

                    <a href="email.php" class="item">
                        <img src="../assets/images/teacher/icons8-mail-50.png">
                        <span>Email</span>
                    </a>

                    <a href="profile.php" class="item">
                        <img src="../assets/images/teacher/icons8-test-account-64.png">
                        <span>Profili</span>
                    </a>

                </div>


            </div>

            <a href="../index.php" class="item">
              <img src="../assets/images/teacher/icons8-log-out-50.png">
                <span>Dil</span>
            </a>

        </div>

        
        <div class="content-area">

            
            <div class="dashboard-container">

                <div class="header-left">
                    <img src="../assets/images/teacher/icons8-grades-48 (1).png" class="dashboard-image">

                    <h2>Vendosja e notave!</h2>
                    <style>
                        .dashboard-container .header-left h2{
                            font-size:30px;
                            color:#32146b;
                        }
                        </style>
                </div>

            </div>

            
            <div class="dashboard-box">

                <form method="POST">

                
                <div class="filters-container">

                    
                    <div class="filter-item">
                        <label>Klasa:</label>

                        <select name="klasid"  onchange="this.form.submit()"  required>
                            <?php while($k = mysqli_fetch_assoc($klasatQuery)) { ?>
                                <option value="<?= $k['klasaID'] ?>"
                                   <?= (isset($klasid) && $klasid == $k['klasaID']) ? 'selected' : '' ?>>
                                   <?= $k['emer'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    
                    <div class="filter-item">
                        <label>Lënda:</label>

                        <select name="lendaID" onchange="this.form.submit()" required>
                            <?php while($l = mysqli_fetch_assoc($lendetQuery)) { ?>

                              <option value="<?= $l['id'] ?>"
                                   <?= ($lendaID == $l['id']) ? 'selected' : '' ?>>

                                <?= $l['emri'] ?>

                              </option>

                            <?php } ?>
                        </select>
                    </div>

                    
                    <div class="filter-item">
                        <label>Tre-mujori:</label>

                        <select name="tremujori" onchange="this.form.submit()" required>
                            <option value="1" <?= ($tremujori == 1) ? 'selected' : '' ?>>1</option>

                            <option value="2" <?= ($tremujori == 2) ? 'selected' : '' ?>>2</option>

                            <option value="3" <?= ($tremujori == 3) ? 'selected' : '' ?>>3</option>
                        </select>
                    </div>

                    
                    <div class="search-box">
                        <img src="../assets/images/teacher/icons8-search-50.png">
                        <input type="text" id="searchInput" placeholder="Kërko nxënës...">
                    </div>

                </div>

                
                <div class="table-container">

                    <table>

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Emri</th>
                                <th>Mbiemri</th>
                                <th>Vlerësim 1</th>
                                <th>Vlerësim 2</th>
                                <th>Vlerësim 3</th>
                                <th>Projekt</th>
                                <th>Testi</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php while($row = mysqli_fetch_assoc($result)) {

                            $parts = explode(" ", $row['emerMbiemer'], 2);
                            $emri = $parts[0];
                            $mbiemri = isset($parts[1]) ? $parts[1] : "";
                            
                            
                            $nxenesID = $row['nxenesID'];

                            $notaQuery = mysqli_query($connection,
                             "SELECT * FROM vleresim
                             WHERE nxenesID='$nxenesID'
                             AND klasid='$klasid'
                             AND lendaID='$lendaID'
                             AND tremujori='$tremujori'"
                            );

                             $nota = mysqli_fetch_assoc($notaQuery); 
                        ?>
                        

                        <tr>

                            <td><?= $row['nxenesID'] ?></td>
                            <td><?= $emri ?></td>
                            <td><?= $mbiemri ?></td>

                            <td><input type="number" name="vleresim1[<?= $row['nxenesID'] ?>]" value="<?= $nota['v1'] ?? '' ?>" min="4" max="10"></td>
                            <td><input type="number" name="vleresim2[<?= $row['nxenesID'] ?>]" value="<?= $nota['v2'] ?? '' ?>" min="4" max="10"></td>
                            <td><input type="number" name="vleresim3[<?= $row['nxenesID'] ?>]" value="<?= $nota['v3'] ?? '' ?>" min="4" max="10"></td>
                            <td><input type="number" name="projekt[<?= $row['nxenesID'] ?>]" value="<?= $nota['projekt'] ?? '' ?>" min="4" max="10"></td>
                            <td><input type="number" name="test[<?= $row['nxenesID'] ?>]" value="<?= $nota['test'] ?? '' ?>" min="4" max="10"></td>

                        </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

                
                <div class="actions-container">

                    <button type="submit" name="ruaj" value="1" class="save-btn">Ruaj ndryshimet</button>

                </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function () {

    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("table tbody tr");

    rows.forEach(row => {

        let emri = row.children[1].textContent.toLowerCase();
        let mbiemri = row.children[2].textContent.toLowerCase();

        if (emri.includes(filter) || mbiemri.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});
</script>

</body>
</html>