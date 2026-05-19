<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}

$mesuesID = $_SESSION["id"];

if(isset($_POST["ruaj"])){

    $nxenesID = $_POST["nxenesID"];
    $lendaID  = $_POST["lendaID"];
    $klasaID  = $_POST["klasaID"];
    $data     = $_POST["data"];
    $ora      = $_POST["ora"];
    $statusi  = $_POST["statusi"];

    mysqli_query($connection,
    "INSERT INTO mungesat
    (nxenesID, lendaID, klasaID, mesuesID, data, ora, statusi)
    VALUES
    ('$nxenesID','$lendaID','$klasaID','$mesuesID','$data','$ora','$statusi')");
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

$klasid = $_POST['klasid'] ?? null;

$sql = "
SELECT nxenes.nxenesID, nxenes.emerMbiemer
FROM nxenes
JOIN lidhjamesues
ON nxenes.klasID = lidhjamesues.klasID
WHERE lidhjamesues.mesuesID='$mesuesID'
";

if(!empty($klasid)){
    $sql .= " AND nxenes.klasID='$klasid'";
}

$result = mysqli_query($connection, $sql);


$sqlRaporti = "
SELECT 
    n.emerMbiemer,

    SUM(CASE 
        WHEN MONTH(m.data) BETWEEN 9 AND 12 
        AND m.statusi='Mungese' 
        THEN 1 ELSE 0 END) AS tremujori1,

    SUM(CASE 
        WHEN MONTH(m.data) BETWEEN 1 AND 3 
        AND m.statusi='Mungese' 
        THEN 1 ELSE 0 END) AS tremujori2,

    SUM(CASE 
        WHEN MONTH(m.data) BETWEEN 4 AND 6 
        AND m.statusi='Mungese' 
        THEN 1 ELSE 0 END) AS tremujori3,

    SUM(CASE 
        WHEN m.statusi='Mungese' 
        THEN 1 ELSE 0 END) AS gjithsej

FROM mungesat m
JOIN nxenes n ON m.nxenesID = n.nxenesID
WHERE m.mesuesID = '$mesuesID'
GROUP BY n.nxenesID
";

$rezultati = mysqli_query($connection, $sqlRaporti);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mungesat</title>
    <link rel="stylesheet" href="./stilim.css">
</head>
<body>

<div class="dashboard">

    <div class="container">

        
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

                    <a href="mungesat.php" class="item active">
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
                    <img src="../assets/images/teacher/icons8-attendance-64 (1).png">
                    <h2>Raportim ditor mbi pjesëmarrjen e nxënësve</h2>
                    <style>
                        .dashboard-container .header-left h2{
                            font-size:30px;
                            color:#32146b;
                        }
                    </style>
                </div>
            </div>

            <div class="dashboard-box">

                <div class="mungesa-container">

                    

                    
                    <div class="table-box">

                        <table>
                            <thead>
                                <tr>
                                    <th>Nxënësi</th>
                                    <th>Tremujori 1</th>
                                    <th>Tremujori 2</th>
                                    <th>Tremujori 3</th>
                                    <th>Gjithsej</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php while($row = mysqli_fetch_assoc($rezultati)){ ?>
                                <tr>
                                    <td><?= $row["emerMbiemer"] ?></td>
                                    <td><?= $row["tremujori1"] ?></td>
                                    <td><?= $row["tremujori2"] ?></td>
                                    <td><?= $row["tremujori3"] ?></td>
                                    <td><?= $row["gjithsej"] ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>

                    </div>
                <div class="mungesa-wrapper">
                    
                     <form method="POST">

                        <div class="mungesa-form">

                            <div class="form-group">
                                <label>Nxënësi:</label>
                                <select name="nxenesID" required>
                                    <option value="">Zgjidh nxënësin</option>
                                    <?php while($n = mysqli_fetch_assoc($result)){ ?>
                                        <option value="<?= $n['nxenesID'] ?>">
                                            <?= $n['emerMbiemer'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Lënda:</label>
                                <select name="lendaID" required>
                                    <option value="">Zgjidh lëndën</option>
                                    <?php while($l = mysqli_fetch_assoc($lendetQuery)){ ?>
                                        <option value="<?= $l['id'] ?>">
                                            <?= $l['emri'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Klasa:</label>
                                <select name="klasaID" required>
                                    <option value="">Zgjidh klasën</option>
                                    <?php while($k = mysqli_fetch_assoc($klasatQuery)){ ?>
                                        <option value="<?= $k['klasaID'] ?>">
                                            <?= $k['emer'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Data:</label>
                                <input type="date" name="data" required>
                            </div>

                            <div class="form-group">
                                <label>Ora:</label>
                                <input type="time" name="ora" required>
                            </div>

                            <div class="form-group">
                                <label>Statusi:</label>
                                <select name="statusi" required>
                                    <option value="Prezent">Prezent</option>
                                    <option value="Mungese">Mungese</option>
                                    <option value="Me arsye">Me arsye</option>
                                </select>
                            </div>

                        </div>

                        <div class="save1-btn">
                            <button type="submit" name="ruaj">Ruaj</button>
                        </div>

                     </form>
                    </div>
                </div>

                </div>

            </div>

        </div>

    </div>

</div>
<style>



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



.mungesa-container .table-box{
    width: 100%;
    overflow-x: auto;
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
}

.mungesa-container table{
    width: 100%;
    border-collapse: collapse;
}

.mungesa-container table th{
    background: #4a1d84;
    color: white;
    padding: 12px;
    text-align: left;
    
}

.mungesa-container table td{
    padding: 10px;
    border-bottom: 1px solid #eee;
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

.mungesa-form .form-group input,
.mungesa-form .form-group select{
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
    outline: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.45);
}



.save1-btn{
    grid-column: 1 / -1;
    display: flex;
    justify-content: center;
    margin-top: 15px;
}

.save1-btn button{
    box-shadow: 0 2px 10px rgba(0,0,0,0.55);
    background: #5f15c0;
    color: white;
    border: none;
    padding: 12px 40px;
    border-radius: 10px;
    
}
</body>
</html>