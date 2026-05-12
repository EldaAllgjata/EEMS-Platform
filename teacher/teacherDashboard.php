<?php
session_start();
require "config.php";

if(!isset($_SESSION["mesuesID"])) {
    header("Location: login.php");
    exit();
}

$mesuesID = $_SESSION["mesuesID"];

if(isset($_POST["shtoKlase"])) {
    $emri = $_POST["klasaRe"] ?? '';

    if(!empty($emri)) {

        $checkKlasa = mysqli_query($conn, "
        SELECT * FROM klasa WHERE emer='$emri'
        ");

        if(mysqli_num_rows($checkKlasa) > 0) {
            $row = mysqli_fetch_assoc($checkKlasa);
            $klasID = $row["klasaID"];
        } else {
            mysqli_query($conn, "INSERT INTO klasa (emer) VALUES ('$emri')");
            $klasID = mysqli_insert_id($conn);
        }

        $check = mysqli_query($conn, "
        SELECT * FROM lidhjamesues 
        WHERE mesuesID=$mesuesID AND klasID=$klasID
        ");

        if(mysqli_num_rows($check) == 0) {
            mysqli_query($conn, "
            INSERT INTO lidhjamesues (mesuesID, klasID) 
            VALUES ($mesuesID, $klasID)
            ");
        }

        header("Location: dashboard1.php");
        exit();
    }
}

if(isset($_POST["shtoLende"])) {
    $emri = $_POST["lendaRe"] ?? '';

    if(!empty($emri)) {

        $checkLenda = mysqli_query($conn, "
        SELECT * FROM lenda WHERE emri='$emri'
        ");

        if(mysqli_num_rows($checkLenda) > 0) {
            $row = mysqli_fetch_assoc($checkLenda);
            $lendaID = $row["id"];
        } else {
            mysqli_query($conn, "INSERT INTO lenda (emri) VALUES ('$emri')");
            $lendaID = mysqli_insert_id($conn);
        }

        $check = mysqli_query($conn, "
        SELECT * FROM lidhjamesues 
        WHERE mesuesID=$mesuesID AND lendaID=$lendaID
        ");

        if(mysqli_num_rows($check) == 0) {
            mysqli_query($conn, "
            INSERT INTO lidhjamesues (mesuesID, lendaID) 
            VALUES ($mesuesID, $lendaID)
            ");
        }

        header("Location: dashboard1.php");
        exit();
    }
}

$q1 = mysqli_query($conn, "
SELECT COUNT(DISTINCT klasID) AS total
FROM lidhjamesues
WHERE mesuesID=$mesuesID
");
$row = mysqli_fetch_assoc($q1);
$klasa = $row["total"];

$q2 = mysqli_query($conn, "
SELECT COUNT(DISTINCT lendaID) AS total
FROM lidhjamesues
WHERE mesuesID=$mesuesID
");
$row = mysqli_fetch_assoc($q2);
$lendet = $row["total"];

$q3 = mysqli_query($conn, "
SELECT COUNT(DISTINCT nxenes.nxenesID) AS total
FROM nxenes
JOIN lidhjamesues 
ON nxenes.klasID = lidhjamesues.klasID
WHERE lidhjamesues.mesuesID=$mesuesID
");
$row = mysqli_fetch_assoc($q3);
$nxenesit = $row["total"];

$klasatQuery = mysqli_query($conn, "
SELECT DISTINCT klasa.emer
FROM klasa
JOIN lidhjamesues ON klasa.klasaID = lidhjamesues.klasID
WHERE lidhjamesues.mesuesID = $mesuesID
");

$lendetQuery = mysqli_query($conn, "
SELECT DISTINCT lenda.emri
FROM lenda
JOIN lidhjamesues ON lenda.id = lidhjamesues.lendaID
WHERE lidhjamesues.mesuesID = $mesuesID
");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./stilim.css">
</head>
<body>

 <div class="dashboard">

    <div class="container">

        
        <div class="sidebar">

            <div>
                <div class="top">
                    <div class="icon">
                        <img src="library/icons8-male-user-90.png" alt="">
                    </div>
                    <p>Mireseerdhe,<br>mesues!</p>
                </div>

                <div class="menu">

                    <div class="item active">
                        <img src="library/icons8-dashboard-24.png">
                        <span>Dashboard</span>
                    </div>

                    <div class="item">
                        <img src="library/icons8-grades-48.png">
                        <span>Notat</span>
                    </div>

                    <div class="item">
                        <img src="library/icons8-attendance-64.png">
                        <span>Mungesat</span>
                    </div>

                    <div class="item">
                        <img src="library/icons8-home-30 (1).png">
                        <span>Detyrat</span>
                    </div>

                    <div class="item">
                        <img src="library/icons8-schedule-50 (3).png">
                        <span>Orari</span>
                    </div>

                    <div class="item">
                        <img src="library/icons8-calendar-50 (1).png">
                        <span>Aktivitetet</span>
                    </div>

                    <div class="item">
                        <img src="library/icons8-mail-50.png">
                        <span>Email</span>
                    </div>

                    <div class="item">
                        <img src="library/icons8-test-account-64.png">
                        <span>Profili</span>
                    </div>
                </div>
            </div>

            <div class="item">
                <img src="library/icons8-log-out-50.png">
                <span>Dil</span>
            </div>

        </div>

        
        <div class="content-area">

            
            <div class="dashboard-container">

                <img src="library/icons8-teacher-50.png" alt="Dashboard" class="dashboard-image">
                 <p>Dashboard-i ofron një përmbledhje të aktivitetit dhe të performances së mësuesit!</p>

            </div>
         <div class="dashboard-box">
            
            <div class="statistika">

                <div class="klasa">
                    <img src="library/icons8-class-50.png">
                    <p>Klasa:<span><?php echo $klasa; ?> klasa</span></p>
                </div>

                <div class="nxenesit">
                    <img src="library/icons8-student-50.png">
                    <p>Nxënës:<span><?php echo $nxenesit; ?> nxënës</span></p>
                </div>

                <div class="lendet">
                    <img src="library/icons8-book-50.png">

                    <p>Lëndë:<span><?php echo $lendet; ?> lëndë </span></p>
                </div>

            </div>

            
            <div class="lista">

                <div class="klasa-lista">

                    <h3>Klasat:</h3>

                    <ul>
                        <?php while($row = mysqli_fetch_assoc($klasatQuery)) { ?>
                            <li>-Klasa <?php echo $row["emer"]; ?></li>
                        <?php } ?>
                    </ul>

                    <button type="button" class="popup-btn" onclick="hapPopupKlasa()"> Shto</button>

                </div>

                
                <div class="nxenesit-lista">

                    <h3>Lëndët:</h3>

                    <ul>
                        <?php while($row = mysqli_fetch_assoc($lendetQuery)) { ?>
                            <li>-<?php echo $row["emri"]; ?></li>
                        <?php } ?>
                    </ul>

                    <button type="button" class="popup-btn" onclick="hapPopupLenda()"> Shto </button>

                </div>

            </div>

            
            <div class="chart-section">

                
                <div class="chart-box">

                    <h3>Mesatarja e çdo klase:</h3>

                    <div class="chart-wrapper">

                        <div class="y-axis">
                            <span>10</span>
                            <span>5</span>
                            <span>0</span>
                        </div>

                        <div class="chart-content">

                            <div class="chart-area">

                                <div class="bars">
                                    <div class="bar blue" style="height:120px;"></div>
                                    <div class="bar red" style="height:110px;"></div>
                                    <div class="bar orange" style="height:95px;"></div>
                                </div>

                            </div>

                            <div class="x-axis">
                                <span>10A</span>
                                <span>10B</span>
                                <span>11C</span>
                            </div>

                        </div>

                    </div>

                </div>

                
                <div class="chart-box">

                    <h3>Mesatarja e çdo lënde:</h3>

                    <div class="chart-wrapper">

                        <div class="y-axis">
                            <span>10</span>
                            <span>5</span>
                            <span>0</span>
                        </div>

                        <div class="chart-content">

                            <div class="chart-area">

                                <div class="bars">
                                    <div class="bar green" style="height:105px;"></div>
                                    <div class="bar red" style="height:125px;"></div>
                                    <div class="bar blue" style="height:145px;"></div>
                                </div>

                            </div>

                            <div class="x-axis">
                                <span>Fizikë</span>
                                <span>Matematikë</span>
                                <span>TIK</span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
         </div>

        </div>

    </div>

</div>



<div class="popup" id="popupKlasa">

    <div class="popup-content">

        <span class="close" onclick="mbyllPopupKlasa()"> </span>

        <h2>Shto klasë</h2>

        <form method="POST">

            <input type="text" name="klasaRe" placeholder="Shkruaj klasën" required>
            <button type="submit" name="shtoKlase">Ruaj</button>

        </form>

    </div>

</div>



<div class="popup" id="popupLenda">

    <div class="popup-content">

        <span class="close" onclick="mbyllPopupLenda()"></span>

        <h2>Shto lëndë</h2>

        <form method="POST">

            <input type="text" name="lendaRe" placeholder="Shkruaj lëndën" required>

            <button type="submit" name="shtoLende">Ruaj</button>

        </form>

    </div>

</div>


<script>

function hapPopupKlasa() {
    document.getElementById("popupKlasa").style.display = "flex";
}

function mbyllPopupKlasa() {
    document.getElementById("popupKlasa").style.display = "none";
}

function hapPopupLenda() {
    document.getElementById("popupLenda").style.display = "flex";
}

function mbyllPopupLenda() {
    document.getElementById("popupLenda").style.display = "none";
}

</script>

</body>
</html>