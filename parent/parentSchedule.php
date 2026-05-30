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
    nxenes.emerMbiemer,
    nxenes.nrID,
    nxenes.klasID,
    klasa.emer AS emriKlases
FROM nxenes
INNER JOIN klasa
ON nxenes.klasID = klasa.klasaID
WHERE nxenes.nrID = '$nxenesID'
AND nxenes.prindID = '$parentID'
";

$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result) == 0){
    die('Nxënësi nuk ekziston');
}

$row = mysqli_fetch_assoc($result);
$klasID = $row['klasID'];
$tremujori = 1;

if(isset($_GET['tremujori'])){
    $tremujori = $_GET['tremujori'];
}

$orariQuery = "
SELECT 
    orari.dita,
    orari.ora_fillimit,
    lenda.emri AS lenda
FROM orari
INNER JOIN lenda
ON orari.lendaID = lenda.id
WHERE orari.klasID = '$klasID'
AND orari.tremujori = '$tremujori'

ORDER BY FIELD(orari.dita,
'E Hënë',
'E Martë',
'E Mërkurë',
'E Enjte',
'E Premte'),

orari.ora_fillimit
";

$orariResult = mysqli_query($connection, $orariQuery);
$orari = [];

while($data = mysqli_fetch_assoc($orariResult)){
    $dita = $data['dita'];
    $ora = substr($data['ora_fillimit'],0,5);
    $orari[$ora][$dita] = $data['lenda'];
}

$ditet = [
    'E Hënë',
    'E Martë',
    'E Mërkurë',
    'E Enjte',
    'E Premte'
];

$oret = [
    '08:00',
    '09:00',
    '10:00',
    '11:00',
    '12:00'
];
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orari</title>
    <link rel="stylesheet" href="parent.css">

    <style>
        .schedule-wrapper {
            margin-top: 40px;
            background: white;
            border-radius: 25px;
            padding: 45px;
        }

        .schedule-header, .schedule-row {
            display: grid;
            grid-template-columns: 160px repeat(5, 1fr);
            gap: 18px;
            margin-bottom: 18px;
        }

        .time-box {
            background: #d9d9d9;
            padding: 18px;
            text-align: center;
            font-weight: bold;
            border-radius: 10px;
            font-size: 18px;
        }

        .day-box {
            background: #d9d9d9;
            padding: 18px;
            text-align: center;
            font-weight: bold;
            border-radius: 10px;
            font-size: 18px;
        }

        .subject-box {
            background: #c8bddf;
            padding: 22px;
            text-align: center;
            border-radius: 12px;
            font-weight: 600;
            font-size: 18px;
            min-height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tremujor-buttons {
            margin-top: 45px;
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .tremujor-btn {
            background: #3d1b78;
            color: white;
            padding: 18px 45px;
            border-radius: 18px;
            text-decoration: none;
            font-weight: bold;
            font-size: 17px;
            transition: 0.3s;
        }

        .tremujor-btn:hover {
            background: #5527a3;
            transform: scale(1.05);
        }

        .active-tremujor {
            background: #6d3ed1;
        }
    </style>
</head>

<body class="parent-dashboard-page">

<div class="dashboard-container">

    <aside class="sidebar">

        <div class="profile-section">
            <img src="../assets/images/parent/user.png" class="profile-image">
            <p class="profile-name">
                Mirëserdhe,<br>
                <?php echo htmlspecialchars($parentName); ?>
            </p>
        </div>

        <nav class="menu">

            <a href="parentDashboard.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/dashboard.png" class="menu-icon">
                <span class="menu-text">Dashboard</span>
            </a>

            <a href="parentGrades.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/certificate.png" class="menu-icon">
                <span class="menu-text">Nota</span>
            </a>

            <a href="parentAbsences.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/student.png" class="menu-icon">
                <span class="menu-text">Mungesa</span>
            </a>

            <a href="parentSchedule.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item active-menu">
                <img src="../assets/images/parent/calendar.png" class="menu-icon">
                <span class="menu-text">Orari</span>
            </a>

            <a href="parentPayments.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/fee.png" class="menu-icon">
                <span class="menu-text">Pagesat</span>
            </a>

            <a href="parentMessages.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/chatting.png" class="menu-icon">
                <span class="menu-text">Mesazhet</span>
            </a>

            <a href="parentNotifications.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/notification.png" class="menu-icon">
                <span class="menu-text">Njoftime</span>
            </a>

            <a href="parentStatistics.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/trend.png" class="menu-icon">
                <span class="menu-text">Statistika</span>
            </a>

            <a href="parentProfile.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/person.png" class="menu-icon">
                <span class="menu-text">Profili</span>
            </a>

            <a href="../index.php" class="menu-item logout" onclick="sessionStorage.clear();">
                <img src="../assets/images/parent/logout.png" class="menu-icon">
                <span class="menu-text">Dil</span>
            </a>

        </nav>

    </aside>

    <main class="content">

        <div class="top-card">
            <img src="../assets/images/parent/timetable.png">
            <h1>
                Orari sipas ditëve të javës
            </h1>
        </div>

        <div class="schedule-wrapper">

            <div class="schedule-header">

                <div></div>

                <?php
                foreach($ditet as $dita){
                    echo "<div class='day-box'>$dita</div>";
                }
                ?>

            </div>

            <?php
            foreach($oret as $ora){
            ?>

                <div class="schedule-row">

                    <div class="time-box">
                        <?php echo $ora; ?>
                    </div>

                    <?php
                    foreach($ditet as $dita){
                        $lenda = "";

                        if(isset($orari[$ora][$dita])){
                            $lenda = $orari[$ora][$dita];
                        }

                        echo "
                        <div class='subject-box'>
                            $lenda
                        </div>
                        ";
                    }
                    ?>

                </div>

            <?php
            }
            ?>

            <div class="tremujor-buttons">

                <a href="parentSchedule.php?tremujori=1" class="tremujor-btn <?php if($tremujori == 1) echo 'active-tremujor'; ?>">
                    Tremujori i parë
                </a>

                <a href="parentSchedule.php?tremujori=2" class="tremujor-btn <?php if($tremujori == 2) echo 'active-tremujor'; ?>">
                    Tremujori i dytë
                </a>

                <a href="parentSchedule.php?tremujori=3" class="tremujor-btn <?php if($tremujori == 3) echo 'active-tremujor'; ?>">
                    Tremujori i tretë
                </a>

            </div>

        </div>

    </main>

</div>
<script>
const sidebar = document.querySelector('.sidebar');

if(sidebar){
    sidebar.addEventListener("scroll", function(){
        sessionStorage.setItem("sidebarScroll", sidebar.scrollTop);
    });

    const savedSidebarScroll = sessionStorage.getItem("sidebarScroll");
    if(savedSidebarScroll !== null){
        sidebar.scrollTop = savedSidebarScroll;
    }
}
</script>

<script>
let isTremujorChange = false;
document.querySelectorAll(".tremujor-btn").forEach(btn => {
    btn.addEventListener("click", function () {
        isTremujorChange = true;
        sessionStorage.setItem("scrollPos", window.scrollY);
    });
});

window.addEventListener("load", function () {
    const savedScroll = sessionStorage.getItem("scrollPos");
    if(savedScroll !== null){
        window.scrollTo(0, parseInt(savedScroll));
    }
    sessionStorage.removeItem("scrollPos");
});
</script>
</body>
</html>