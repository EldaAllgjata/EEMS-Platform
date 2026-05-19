<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['role'])){
    header("Location: ../index.php");
    exit();
}

if($_SESSION['role'] != 'parent'){
    header("Location: ../index.php");
    exit();
}

$parentID = $_SESSION['id'];

$parentQuery = "
SELECT emerMbiemer
FROM prinder
WHERE prind_ID = '$parentID'
";

$parentResult = mysqli_query($connection, $parentQuery);
$parentData = mysqli_fetch_assoc($parentResult);
$parentName = $parentData['emerMbiemer'];

if(isset($_GET['nxenesID'])){
    $nxenesID = $_GET['nxenesID'];
    $_SESSION['selectedStudent'] = $nxenesID;
}
elseif(isset($_SESSION['selectedStudent'])){
    $nxenesID = $_SESSION['selectedStudent'];
}
else{
    die("Nuk u zgjodh nxënësi");
}

$query = "
SELECT 
    nxenes.nxenesID,
    nxenes.emerMbiemer,
    nxenes.nrID,
    klasa.emer AS emriKlases
FROM nxenes
INNER JOIN klasa
ON nxenes.klasID = klasa.klasaID
WHERE nxenes.nrID = '$nxenesID'
AND nxenes.prindID = '$parentID'
";

$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result) == 0){
    die("Nxënësi nuk ekziston");
}

$row = mysqli_fetch_assoc($result);
$realNxenesID = $row['nxenesID'];

$notesFrequency = [
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0,
    9 => 0,
    10 => 0
];

$gradesQuery = "
SELECT v1,v2,v3,projekt,test
FROM vleresim
WHERE nxenesID = '$realNxenesID'
";

$gradesResult = mysqli_query($connection, $gradesQuery);

while($grade = mysqli_fetch_assoc($gradesResult)){

    $allGrades = [
        $grade['v1'],
        $grade['v2'],
        $grade['v3'],
        $grade['projekt'],
        $grade['test']
    ];

    foreach($allGrades as $note){
        if($note >= 4 && $note <= 10){
            $notesFrequency[$note]++;
        }
    }

}

$paArsyeQuery = "
SELECT COUNT(*) AS total
FROM mungesat
WHERE nxenesID = '$realNxenesID'
AND statusi = 'Mungese'
";

$paArsyeResult = mysqli_query($connection, $paArsyeQuery);
$paArsyeData = mysqli_fetch_assoc($paArsyeResult);
$mungesaPaArsye = $paArsyeData['total'];

$meArsyeQuery = "
SELECT COUNT(*) AS total
FROM mungesat
WHERE nxenesID = '$realNxenesID'
AND statusi = 'Me arsye'
";

$meArsyeResult = mysqli_query($connection, $meArsyeQuery);
$meArsyeData = mysqli_fetch_assoc($meArsyeResult);
$mungesaMeArsye = $meArsyeData['total'];

$mesataret = [];

for($t = 1; $t <= 3; $t++){

    $mesatareQuery = "
    SELECT *
    FROM vleresim
    WHERE nxenesID = '$realNxenesID'
    AND tremujori = '$t'
    ";

    $mesatareResult = mysqli_query($connection, $mesatareQuery);
    $shuma = 0;
    $count = 0;

    while($m = mysqli_fetch_assoc($mesatareResult)){

        $notat = [
            $m['v1'],
            $m['v2'],
            $m['v3'],
            $m['projekt'],
            $m['test']
        ];

        foreach($notat as $n){
            if($n != NULL && $n != 0){
                $shuma += $n;
                $count++;
            }
        }

    }

    if($count > 0){
        $mesataret[] = round($shuma / $count, 2);
    }
    else{
        $mesataret[] = 0;
    }

}

?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistika</title>
    <link rel="stylesheet" href="parent.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

.statistics-wrapper {
    margin-top: 30px;
}

.charts-row {
    display: flex;
    gap: 25px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.chart-card {
    flex: 1;
    min-width: 320px;
    background: #f7f7f7;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.chart-card.large {
    width: 100%;
    max-width: 900px;
    margin: auto;
}

.chart-title {
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #333;
}

.report-button-container {
    text-align: center;
    margin-top: 30px;
}

.report-button-container {
    text-align: center;
    margin-top: 90px;
    margin-bottom: 40px;
}

.report-btn {
    background: #2B7A78;
    color: white;
    border: none;
    padding: 28px 70px;
    border-radius: 22px;
    font-size: 34px;
    font-weight: 800;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.25);
}

.report-btn:hover {
    background: #205e5c;
    transform: scale(1.08);
}

canvas {
    width: 100% !important;
    height: 300px !important;
}

</style>

</head>

<body class="parent-dashboard-page">

<div class="dashboard-container">

    <aside class="sidebar">

        <div class="profile-section">

            <img src="/EEMS-Platform/assets/images/parent/user.png" class="profile-image">

            <p class="profile-name">
                Mirëserdhe,<br>
                <?php echo $parentName; ?>
            </p>

        </div>

        <nav class="menu">

            <a href="parentDashboard.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/dashboard.png" class="menu-icon">
                <span class="menu-text">
                    Dashboard
                </span>
            </a>

            <a href="parentGrades.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/certificate.png" class="menu-icon">
                <span class="menu-text">
                    Nota
                </span>
            </a>

            <a href="parentAbsences.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/student.png" class="menu-icon">
                <span class="menu-text">
                    Mungesa
                </span>
            </a>

            <a href="parentSchedule.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/calendar.png" class="menu-icon">
                <span class="menu-text">
                    Orari
                </span>
            </a>

            <a href="parentPayments.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/fee.png"
                     class="menu-icon">
                <span class="menu-text">
                    Pagesat
                </span>
            </a>

            <a href="parentMessages.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/chatting.png" class="menu-icon">
                <span class="menu-text">
                    Mesazhet
                </span>
            </a>

            <a href="parentNotifications.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/notification.png" class="menu-icon">
                <span class="menu-text">
                    Njoftime
                </span>
            </a>

            <a href="parentStatistics.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item active-menu">
                <img src="/EEMS-Platform/assets/images/parent/trend.png" class="menu-icon">
                <span class="menu-text">
                    Statistika
                </span>

            </a>

            <a href="parentProfile.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/person.png" class="menu-icon">
                <span class="menu-text">
                    Profili
                </span>
            </a>

            <a href="../index.php" class="menu-item logout" onclick="sessionStorage.clear();">
                <img src="/EEMS-Platform/assets/images/parent/logout.png" class="menu-icon">
                <span class="menu-text">
                    Dil
                </span>
            </a>

        </nav>

    </aside>

    <main class="content">

        <div class="top-card">
            <img src="/EEMS-Platform/assets/images/parent/trend,,1.png">
            <h1>
                Statistika për ecurinë në shkollë të nxënësit
            </h1>
        </div>

        <div class="statistics-wrapper">

            <div class="charts-row">

                <div class="chart-card">
                    <h2 class="chart-title">
                        Frekuenca e çdo note
                    </h2>
                    <canvas id="gradesChart"></canvas>
                </div>

                <div class="chart-card">
                    <h2 class="chart-title">
                        Paraqitja e mungesave
                    </h2>
                    <canvas id="absencesChart"></canvas>
                </div>

            </div>

            <div class="chart-card large">
                <h2 class="chart-title">
                    Mesatarja e nxënësit përgjatë tremujorëve
                </h2>
                <canvas id="averageChart"></canvas>
            </div>

            <div class="report-button-container">
                <button onclick="generateReport()" class="report-btn">
                    Gjenero raport
                </button>
            </div>

        </div>

    </main>

</div>

<script>

/* =========================
   GRAFIKU 1
========================= */

const gradesChart = new Chart(
document.getElementById('gradesChart'),
{
    type: 'bar',

    data: {
        labels: ['4','5','6','7','8','9','10'],
        datasets: [{
            label: 'Frekuenca',
            data: [
                <?php echo $notesFrequency[4]; ?>,
                <?php echo $notesFrequency[5]; ?>,
                <?php echo $notesFrequency[6]; ?>,
                <?php echo $notesFrequency[7]; ?>,
                <?php echo $notesFrequency[8]; ?>,
                <?php echo $notesFrequency[9]; ?>,
                <?php echo $notesFrequency[10]; ?>
            ],
            backgroundColor:'#7FE0DD'
        }]
    },

    options:{
        responsive:true
    }
});

/* =========================
   GRAFIKU 2
========================= */

const absencesChart = new Chart(
document.getElementById('absencesChart'),
{
    type:'pie',
    data:{
        labels:['Me arsye','Pa arsye'],
        datasets:[{
            data:[
                <?php echo $mungesaMeArsye; ?>,
                <?php echo $mungesaPaArsye; ?>
            ],
            backgroundColor:[
                '#39e12d',
                '#e11414'
            ]
        }]
    },

    options:{
        responsive:true
    }
});

/* =========================
   GRAFIKU 3
========================= */

const averageChart = new Chart(
document.getElementById('averageChart'),
{
    type:'line',
    data:{
        labels:[
            'Tremujori 1',
            'Tremujori 2',
            'Tremujori 3'
        ],

        datasets:[{
            label:'Mesatarja',
            data:[
                <?php echo $mesataret[0]; ?>,
                <?php echo $mesataret[1]; ?>,
                <?php echo $mesataret[2]; ?>
            ],
            borderColor:'#2B7A78',
            backgroundColor:'#2B7A78',
            tension:0.4,
            fill:false
        }]
    },

    options:{
        responsive:true,
        scales:{
            y:{
                beginAtZero:true,
                max:10
            }
        }
    }
});
/* =========================
   GJENERO RAPORT
========================= */

function generateReport(){
    let raport = `
RAPORT STATISTIKOR I NXËNËSIT

-----------------------------------

Frekuenca e notave:

Nota 4: <?php echo $notesFrequency[4]; ?>

Nota 5: <?php echo $notesFrequency[5]; ?>

Nota 6: <?php echo $notesFrequency[6]; ?>

Nota 7: <?php echo $notesFrequency[7]; ?>

Nota 8: <?php echo $notesFrequency[8]; ?>

Nota 9: <?php echo $notesFrequency[9]; ?>

Nota 10: <?php echo $notesFrequency[10]; ?>

-----------------------------------

Mungesa:

Me arsye:
<?php echo $mungesaMeArsye; ?>

Pa arsye:
<?php echo $mungesaPaArsye; ?>

-----------------------------------

Mesatarja sipas tremujorëve:

Tremujori 1:
<?php echo $mesataret[0]; ?>

Tremujori 2:
<?php echo $mesataret[1]; ?>

Tremujori 3:
<?php echo $mesataret[2]; ?>

-----------------------------------

Përfundim:

Nxënësi ka treguar këtë ecuri akademike përgjatë vitit shkollor.Raporti është gjeneruar automatikisht nga sistemi EEMS.
`;

    const blob = new Blob([raport], { type: "text/plain" });
    const link = document.createElement("a");

    link.href = URL.createObjectURL(blob);
    link.download = "raporti_nxenesit.txt";
    link.click();
}
</script>

<script>
const sidebar = document.querySelector('.sidebar');
if(sidebar){
    const savedSidebarScroll = sessionStorage.getItem("sidebarScroll");
    if(savedSidebarScroll !== null){
        sidebar.scrollTop = savedSidebarScroll;
    }
    sidebar.addEventListener("scroll", function(){
        sessionStorage.setItem("sidebarScroll", sidebar.scrollTop);
    });
}
</script>
</body>
</html>