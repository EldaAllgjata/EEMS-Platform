<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}

$mesuesID = $_SESSION["id"];

if(isset($_GET["delete"])){
    $id = $_GET["delete"];

    mysqli_query($connection, "DELETE FROM detyrat WHERE id='$id' AND mesuesID='$mesuesID'");
    header("Location: detyrat.php");
    exit();
}
$editData = null;

if(isset($_GET["edit"])){
    $id = $_GET["edit"];

    $res = mysqli_query($connection, "SELECT * FROM detyrat WHERE id='$id' AND mesuesID='$mesuesID'");
    $editData = mysqli_fetch_assoc($res);
}


if(isset($_POST["ruajDetyre"])){

    $titulli = $_POST["titulli"];
    $lendaID = $_POST["lendaID"];
    $klasID = $_POST["klasID"];
    $dataFillimit = $_POST["dataFillimit"];
    $dataMbarimit = $_POST["dataMbarimit"];
    $pershkrimi = $_POST["pershkrimi"];

    
    if(isset($_POST["id"]) && $_POST["id"] != ""){
        $id = $_POST["id"];

        mysqli_query($connection,
        "UPDATE detyrat SET 
            titulli='$titulli',
            lendaID='$lendaID',
            klasID='$klasID',
            dataFillimit='$dataFillimit',
            dataMbarimit='$dataMbarimit',
            pershkrimi='$pershkrimi'
        WHERE id='$id' AND mesuesID='$mesuesID'");
    }
    else{
        
        mysqli_query($connection,
        "INSERT INTO detyrat 
        (titulli, lendaID, klasID, dataFillimit, dataMbarimit, pershkrimi, mesuesID)
        VALUES 
        ('$titulli','$lendaID','$klasID','$dataFillimit','$dataMbarimit','$pershkrimi','$mesuesID')");
    }

    header("Location: detyrat.php");
    exit();
}


$detyrat = mysqli_query($connection,
"SELECT d.*, 
        l.emri AS lenda,
        k.emer AS klasa
FROM detyrat d
JOIN lenda l ON d.lendaID = l.id
JOIN klasa k ON d.klasID = k.klasaID
WHERE d.mesuesID = '$mesuesID'
ORDER BY d.id DESC");


$lendetQuery = mysqli_query($connection,
"SELECT DISTINCT lenda.id, lenda.emri
FROM lenda
JOIN lidhjamesues
ON lenda.id = lidhjamesues.lendaID
WHERE lidhjamesues.mesuesID = '$mesuesID'");


$klasatQuery = mysqli_query($connection,
"SELECT DISTINCT klasa.klasaID, klasa.emer
FROM klasa
JOIN lidhjamesues
ON klasa.klasaID = lidhjamesues.klasID
WHERE lidhjamesues.mesuesID = '$mesuesID'");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Detyrat</title>
<link rel="stylesheet" href="./stilim.css">

<style>


.header-left h2{
    font-size:30px;
    color:#32146b;
}
.mungesa-wrapper{
    width: 100%;
    display: flex;
    justify-content: center;
}

.mungesa-container{
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.mungesa-form{
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 40px;
    width: 100%;
    max-width: 1000px;
}

.mungesa-form .form-group{
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.mungesa-form .form-group label{
    font-weight: bold;
    font-size: 20px;
}

.mungesa-form input,
.mungesa-form select,
.mungesa-form textarea{
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.save1-btn{
    grid-column: 1 / -1;
    display: flex;
    justify-content: center;
    margin-top: 15px;
}

.save1-btn button{
    background: #5f15c0;
    color: white;
    border: none;
    padding: 12px 40px;
    border-radius: 10px;
    cursor: pointer;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#4a1d84;
    color:white;
    padding:12px;
    text-align:left;
}

table td{
    padding:10px;
    border-bottom:1px solid #eee;
}
</style>

</head>

<body>

<div class="dashboard">

    <div class="container">

        <!-- SIDEBAR -->
        <div class="sidebar">

            <div>

                <div class="top">
                    <div class="icon">
                        <img src="../assets/images/teacher/icons8-male-user-90.png">
                    </div>
                    <p>Mireseerdhe,<br>mesues!</p>
                </div>

                <div class="menu">

                    <a href="teacherDashboard.php" class="item">
                        <img src="../assets/images/teacher/icons8-dashboard-24.png">
                        <span>Dashboard</span>
                    </a>

                    <a href="notat.php" class="item">
                        <img src="../assets/images/teacher/icons8-grades-48.png">
                        <span>Notat</span>
                    </a>

                    <a href="mungesat.php" class="item">
                        <img src="../assets/images/teacher/icons8-attendance-64.png">
                        <span>Mungesat</span>
                    </a>

                    <a href="detyrat.php" class="item active">
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
                    <img src="../assets/images/teacher/icons8-home-30.png"  style="width:45px; height:45px;">
                    <h2>Shtimi dhe menaxhimi i detyrave të nxënësve</h2>
                </div>
            </div>

            <div class="dashboard-box">

                <div class="mungesa-container">

                    
                    <form method="POST">

                        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

                        <div class="mungesa-form">

                            <div class="form-group">
                                <label>Titulli</label>
                                <input type="text" name="titulli" required value="<?= $editData['titulli'] ?? '' ?>">
                            </div>

                            <div class="form-group">
                                <label>Lënda</label>
                                <select name="lendaID" required>
                                    <option value="">Zgjidh</option>
                                    <?php while($l = mysqli_fetch_assoc($lendetQuery)){ ?>
                                        <option value="<?= $l['id'] ?>"
                                        <?= (isset($editData['lendaID']) && $editData['lendaID']==$l['id']) ? 'selected' : '' ?>>
                                        <?= $l['emri'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Klasa</label>
                                <select name="klasID" required>
                                    <option value="">Zgjidh</option>
                                    <?php while($k = mysqli_fetch_assoc($klasatQuery)){ ?>
                                        <option value="<?= $k['klasaID'] ?>"
                                        <?= (isset($editData['klasID']) && $editData['klasID']==$k['klasaID']) ? 'selected' : '' ?>>
                                        <?= $k['emer'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Data Fillimit</label>
                                <input type="date" name="dataFillimit" value="<?= $editData['dataFillimit'] ?? '' ?>">
                            </div>

                            <div class="form-group">
                                <label>Data Mbarimit</label>
                                <input type="date" name="dataMbarimit" value="<?= $editData['dataMbarimit'] ?? '' ?>">
                            </div>

                            <div class="form-group">
                                <label>Përshkrimi</label>
                                <textarea name="pershkrimi"><?= $editData['pershkrimi'] ?? '' ?></textarea>
                            </div>

                        </div>

                        <div class="save1-btn">
                            <button type="submit" name="ruajDetyre">
                                <?= $editData ? "Update" : "Ruaj" ?>
                            </button>
                        </div>

                    </form>

                    
                    <div class="table-box">

                        <table>
                            <thead>
                                <tr>
                                    <th>Titulli</th>
                                    <th>Lënda</th>
                                    <th>Klasa</th>
                                    <th>Fillimi</th>
                                    <th>Mbarimi</th>
                                    <th>Veprime</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php while($d = mysqli_fetch_assoc($detyrat)){ ?>
                                <tr>
                                    <td><?= $d['titulli'] ?></td>
                                    <td><?= $d['lenda'] ?></td>
                                    <td><?= $d['klasa'] ?></td>
                                    <td><?= $d['dataFillimit'] ?></td>
                                    <td><?= $d['dataMbarimit'] ?></td>
                                    <td>
                                        <a href="?edit=<?= $d['id'] ?>">Edit</a> |
                                        <a href="?delete=<?= $d['id'] ?>" onclick="return confirm('Je i sigurt?')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>