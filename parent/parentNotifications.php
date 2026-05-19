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
    die("Nxënësi nuk ekziston");
}

$row = mysqli_fetch_assoc($result);
$klasaID = $row['klasID'];

$detyratQuery = "
SELECT 
    detyrat.*,
    lenda.emri AS emriLendes
FROM detyrat
INNER JOIN lenda
ON detyrat.lendaID = lenda.id
WHERE detyrat.klasID = '$klasaID'
ORDER BY detyrat.dataMbarimit ASC
";

$detyratResult = mysqli_query($connection, $detyratQuery);

$aktivitetetQuery = "
SELECT *
FROM aktivitet
ORDER BY data ASC
";

$aktivitetetResult = mysqli_query($connection, $aktivitetetQuery);
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Njoftime</title>
    <link rel="stylesheet" href="parent.css">

    <style>

        .notification-wrapper{
            width:100%;
            padding:20px 10px 40px;
        }

        .section-title{
            width:320px;
            margin:25px auto;
            background:#43207d;
            color:white;
            text-align:center;
            padding:12px;
            border-radius:15px;
            font-size:24px;
            font-weight:bold;
            box-shadow:0px 3px 8px rgba(0,0,0,0.3);
        }

        .cards-container{
            width:100%;
            display:flex;
            flex-wrap:wrap;
            gap:40px;
            justify-content:center;
            margin-top:30px;
        }

        .notification-card{
            width:290px;
            min-height:220px;
            background:#f6eaea;
            padding:20px;
            border-radius:4px;
            box-shadow:0px 3px 8px rgba(0,0,0,0.25);
            transition:0.3s;
        }

        .notification-card:hover{
            transform:translateY(-4px);
        }

        .notification-card h3{
            margin-bottom:12px;
            font-size:20px;
            color:#222;
        }

        .notification-card p{
            font-size:19px;
            margin-bottom:10px;
            font-weight:bold;
            color:#222;
        }

        .status-message{
            margin-top:25px;
            font-size:20px;
            font-weight:bold;
        }

        .afron{
            color:#c0392b;
        }

        .afat{
            color:#1e8449;
        }

        .kaluar{
            color:#555;
        }

        .activities-title{
            margin-top:90px;
        }

    </style>

</head>

<body class="parent-dashboard-page">

<div class="dashboard-container">

    <aside class="sidebar">

        <div class="profile-section">

            <img src="/EEMS-Platform/assets/images/parent/user.png"
                 class="profile-image">

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

            <a href="parentGrades.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/certificate.png" class="menu-icon">
                <span class="menu-text">
                    Nota
                </span>
            </a>

            <a href="parentAbsences.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/student.png" class="menu-icon">
                <span class="menu-text">
                    Mungesa
                </span>
            </a>

            <a href="parentSchedule.php"class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/calendar.png"
                     class="menu-icon">
                <span class="menu-text">
                    Orari
                </span>
            </a>

            <a href="parentPayments.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/fee.png"
                     class="menu-icon">
                <span class="menu-text">
                    Pagesat
                </span>
            </a>

            <a href="parentMessages.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/chatting.png" class="menu-icon">
                <span class="menu-text">
                    Mesazhet
                </span>
            </a>

            <a href="parentNotifications.php" class="menu-item active-menu">
                <img src="/EEMS-Platform/assets/images/parent/notification.png" class="menu-icon">
                <span class="menu-text">
                    Njoftime
                </span>
            </a>

            <a href="parentStatistics.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/trend.png" class="menu-icon">
                <span class="menu-text">
                    Statistika
                </span>
            </a>

            <a href="parentProfile.php" class="menu-item">
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
            <img src="/EEMS-Platform/assets/images/parent/notification,,1.png">
            <h1>
                Njoftime për veprimtaritë shkollore (detyrat dhe aktivitetet)
            </h1>
        </div>

        <div class="notification-wrapper">
            <div class="section-title">
                Lista e detyrave
            </div>

            <div class="cards-container">
                <?php
                if(mysqli_num_rows($detyratResult) > 0){
                    while($detyra = mysqli_fetch_assoc($detyratResult)){
                        $today = date("Y-m-d");
                        $todayTime = strtotime($today);
                        $mbarimiTime = strtotime($detyra['dataMbarimit']);
                        $difference = ($mbarimiTime - $todayTime) / (60 * 60 * 24);

                        if($difference < 0){
                            $status = "Afati ka kaluar";
                            $class = "kaluar";
                        }
                        elseif($difference <= 5){
                            $status = "Afati po afron";
                            $class = "afron";
                        }
                        else{
                            $status = "Ka akoma afat";
                            $class = "afat";
                        }

                        ?>

                        <div class="notification-card">
                            <p>
                                Titulli:
                                <?php echo $detyra['titulli']; ?>
                            </p>
                            <p>
                                Lënda:
                                <?php echo $detyra['emriLendes']; ?>
                            </p>
                            <p>
                                Afati:
                                <?php echo $detyra['dataMbarimit']; ?>
                            </p>
                            <p class="status-message <?php echo $class; ?>">
                                [ <?php echo $status; ?> ]
                            </p>
                        </div>

                        <?php
                    }
                }
                else{
                    echo "<p>Nuk ka detyra për momentin.</p>";
                }

                ?>

            </div>

            <div class="section-title activities-title">
                Lista e aktiviteteve
            </div>

            <div class="cards-container">

                <?php if(mysqli_num_rows($aktivitetetResult) > 0){ while($aktivitet = mysqli_fetch_assoc($aktivitetetResult)){?>

                        <div class="notification-card">

                            <p>
                                Titulli:
                                <?php echo $aktivitet['titull']; ?>
                            </p>

                            <p>
                                Kategoria:
                                <?php echo $aktivitet['kategoria']; ?>
                            </p>

                            <p>
                                Data:
                                <?php echo date("Y-m-d", strtotime($aktivitet['data'])); ?>
                            </p>

                            <p>
                                Ambienti:
                                <?php echo $aktivitet['ambient']; ?>
                            </p>

                        </div>

                        <?php
                    }
                }
                else{
                    echo "<p>Nuk ka aktivitete për momentin.</p>";
                }
                ?>

            </div>

        </div>

    </main>

</div>

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