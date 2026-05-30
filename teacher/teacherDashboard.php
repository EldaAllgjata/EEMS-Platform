<?php
session_start();
include "../config/db.php";
if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}

$mesuesID = $_SESSION["id"];


$q1 = mysqli_query($connection,
"SELECT COUNT(DISTINCT klasID) AS total
FROM lidhjamesues
WHERE mesuesID='$mesuesID'");

$row1 = mysqli_fetch_assoc($q1);
$klasa = $row1["total"];

$q2 = mysqli_query($connection,
"SELECT COUNT(DISTINCT lendaID) AS total
FROM lidhjamesues
WHERE mesuesID='$mesuesID'");

$row2 = mysqli_fetch_assoc($q2);
$lendet = $row2["total"];

$q3 = mysqli_query($connection,
"SELECT COUNT(DISTINCT nxenes.nxenesID) AS total
FROM nxenes
JOIN lidhjamesues
ON nxenes.klasID = lidhjamesues.klasID
WHERE lidhjamesues.mesuesID='$mesuesID'");

$row3 = mysqli_fetch_assoc($q3);
$nxenesit = $row3["total"];

$klasatQuery = mysqli_query($connection,
"SELECT DISTINCT klasa.emer
FROM klasa
JOIN lidhjamesues
ON klasa.klasaID = lidhjamesues.klasID
WHERE lidhjamesues.mesuesID='$mesuesID'");

$lendetQuery = mysqli_query($connection,
"SELECT DISTINCT lenda.emri
FROM lenda
JOIN lidhjamesues
ON lenda.id = lidhjamesues.lendaID
WHERE lidhjamesues.mesuesID='$mesuesID'");
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
                        <img src="../assets/images/teacher/icons8-male-user-90.png" alt="">
                    </div>
                    <p>Mireseerdhe,<br>mesues!</p>
                </div>

                <div class="menu">

                    <a href="teacherDashboard.php" class="item active">
                      <img src="../assets/images/teacher/icons8-dashboard-24.png">
                      <span>Dashboard</span>
                     </a>

                    <a href ="notat.php"  class="item">
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

                <img src="../assets/images/teacher/icons8-teacher-50.png" alt="Dashboard" class="dashboard-image">
                 <h2>Dashboard-i ofron një përmbledhje të aktivitetit dhe të performances së mësuesit!</h2>
                 <style>
                    
                    .dashboard-container h2{
                        font-size:30px;
                        color:#32146b;
                    }
                    </style>

            </div>
         <div class="dashboard-box">
            
            <div class="statistika">

                <div class="klasa">
                    <img src="../assets/images/teacher/icons8-class-50.png">
                    <p>Klasa:<span><?php echo $klasa; ?> klasa</span></p>
                </div>

                <div class="nxenesit">
                    <img src="../assets/images/teacher/icons8-student-50.png">
                    <p>Nxënës:<span><?php echo $nxenesit; ?> nxënës</span></p>
                </div>

                <div class="lendet">
                    <img src="../assets/images/teacher/icons8-book-50.png">

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

                    

                </div>

                
                <div class="nxenesit-lista">

                    <h3>Lëndët:</h3>

                    <ul>
                        <?php while($row = mysqli_fetch_assoc($lendetQuery)) { ?>
                            <li>-<?php echo $row["emri"]; ?></li>
                        <?php } ?>
                    </ul>

                    

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
                                <span>12H</span>
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
                                <span>Muzikë</span>
                                <span>Kimi</span>
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
</body>
</html>