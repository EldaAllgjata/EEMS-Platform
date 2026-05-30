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
SELECT emerMbiemer, email
FROM prinder
WHERE prind_ID = '$parentID'
";

$parentResult = mysqli_query($connection, $parentQuery);
$parentData = mysqli_fetch_assoc($parentResult);

$parentName = $parentData['emerMbiemer'];
$parentEmail = $parentData['email'];

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

$realStudentQuery = "
SELECT nxenesID
FROM nxenes
WHERE nrID = '$nxenesID'
LIMIT 1
";

$realStudentResult = mysqli_query($connection, $realStudentQuery);
$realStudentData = mysqli_fetch_assoc($realStudentResult);

$realNxenesID = $realStudentData['nxenesID'];

$totalMungesaQuery = "
SELECT COUNT(*) AS total
FROM mungesat
WHERE nxenesID = '$realNxenesID'
AND statusi != 'Prezent'
";

$totalMungesaResult = mysqli_query($connection, $totalMungesaQuery);
$totalMungesaData = mysqli_fetch_assoc($totalMungesaResult);

$totalMungesa = $totalMungesaData['total'] ?? 0;

$meArsyeQuery = "
SELECT COUNT(*) AS total
FROM mungesat
WHERE nxenesID = '$realNxenesID'
AND statusi = 'Me arsye'
";

$meArsyeResult = mysqli_query($connection, $meArsyeQuery);
$meArsyeData = mysqli_fetch_assoc($meArsyeResult);

$mungesaMeArsye = $meArsyeData['total'] ?? 0;

$paArsyeQuery = "
SELECT COUNT(*) AS total
FROM mungesat
WHERE nxenesID = '$realNxenesID'
AND statusi = 'Mungese'
";

$paArsyeResult = mysqli_query($connection, $paArsyeQuery);
$paArsyeData = mysqli_fetch_assoc($paArsyeResult);

$mungesaPaArsye = $paArsyeData['total'] ?? 0;

$detyraQuery = "
SELECT titulli, dataMbarimit
FROM detyrat
WHERE klasID = '".$row['klasID']."'
ORDER BY dataMbarimit DESC
LIMIT 1
";

$detyraResult = mysqli_query($connection, $detyraQuery);
$detyra = mysqli_fetch_assoc($detyraResult);

$aktivitetQuery = "
SELECT titull, data
FROM aktivitet
ORDER BY data DESC
LIMIT 1
";

$aktivitetResult = mysqli_query($connection, $aktivitetQuery);
$aktivitet = mysqli_fetch_assoc($aktivitetResult);

$totalMessagesQuery = "
SELECT COUNT(*) AS totalMessages
FROM mail
WHERE marresi = '$parentEmail'
";

$totalMessagesResult = mysqli_query($connection, $totalMessagesQuery);
$totalMessagesData = mysqli_fetch_assoc($totalMessagesResult);

$totalMessages = $totalMessagesData['totalMessages'] ?? 0;

$latestMessageQuery = "
SELECT derguesi, subject, body
FROM mail
WHERE marresi = '$parentEmail'
ORDER BY data DESC
LIMIT 1
";

$latestMessageResult = mysqli_query($connection, $latestMessageQuery);
$latestMessage = mysqli_fetch_assoc($latestMessageResult);
?>

<!DOCTYPE html>
<html lang="sq">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Prindi</title>

    <link rel="stylesheet" href="parent.css">

    <style>

        .student-section{
            display:flex;
            gap:40px;
            align-items:center;
            margin-bottom:50px;
            flex-wrap:wrap;
        }

        .student-avatar{
            width:220px;
            height:220px;
            border-radius:50%;
            background:#361D6E;
            padding:20px;
            object-fit:contain;
        }

        .student-info{
            flex:1;
            min-width:300px;
            background:white;
            border-radius:25px;
            padding:35px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }

        .student-info h2{
            font-size:36px;
            margin-bottom:25px;
            color:#361D6E;
            word-break:break-word;
        }

        .student-info p{
            font-size:24px;
            margin-bottom:18px;
            line-height:1.5;
        }

        .dashboard-cards{
            display:flex;
            gap:20px;
            width:100%;
            align-items:stretch;
            flex-wrap:wrap;
        }

        .info-card{
            flex:1;
            min-width:250px;
            background:#FBEDED;
            border-radius:25px;
            padding:30px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
            transition:0.3s;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
            cursor:pointer;
        }

        .info-card:hover{
            transform:translateY(-5px);
        }

        .info-card h3{
            color:#361D6E;
            font-size:30px;
            margin-bottom:25px;
        }

        .info-card p{
            font-size:22px;
            line-height:1.7;
        }

        .notification-text{
            margin-bottom:12px;
        }

        @media(max-width:1100px){

            .student-info h2{
                font-size:30px;
            }

            .student-info p{
                font-size:20px;
            }

        }

        @media(max-width:900px){

            .student-section{
                flex-direction:column;
                align-items:center;
            }

            .student-avatar{
                width:180px;
                height:180px;
            }

            .student-info{
                width:100%;
            }

            .student-info h2{
                font-size:28px;
            }

            .student-info p{
                font-size:19px;
            }

            .info-card h3{
                font-size:26px;
            }

            .info-card p{
                font-size:19px;
            }

        }

        @media(max-width:500px){

            .student-info{
                padding:25px;
            }

            .student-info h2{
                font-size:24px;
            }

            .student-info p{
                font-size:17px;
            }

            .info-card{
                padding:25px;
            }

            .info-card h3{
                font-size:22px;
            }

            .info-card p{
                font-size:17px;
            }

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
                    <?php echo $parentName; ?>
                </p>

            </div>

            <nav class="menu">

                <a href="parentDashboard.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item active-menu">

                    <img src="../assets/images/parent/dashboard.png" class="menu-icon">

                    <span class="menu-text">
                        Dashboard
                    </span>

                </a>

                <a href="parentGrades.php" class="menu-item">

                    <img src="../assets/images/parent/certificate.png" class="menu-icon">

                    <span class="menu-text">
                        Nota
                    </span>

                </a>

                <a href="parentAbsences.php" class="menu-item">

                    <img src="../assets/images/parent/student.png" class="menu-icon">

                    <span class="menu-text">
                        Mungesa
                    </span>

                </a>

                <a href="parentSchedule.php" class="menu-item">

                    <img src="../assets/images/parent/calendar.png" class="menu-icon">

                    <span class="menu-text">
                        Orari
                    </span>

                </a>

                <a href="parentPayments.php" class="menu-item">

                    <img src="../assets/images/parent/fee.png" class="menu-icon">

                    <span class="menu-text">
                        Pagesat
                    </span>

                </a>

                <a href="parentMessages.php" class="menu-item">

                    <img src="../assets/images/parent/chatting.png" class="menu-icon">

                    <span class="menu-text">
                        Mesazhet
                    </span>

                </a>

                <a href="parentNotifications.php" class="menu-item">

                    <img src="../assets/images/parent/notification.png" class="menu-icon">

                    <span class="menu-text">
                        Njoftime
                    </span>

                </a>

                <a href="parentStatistics.php" class="menu-item">

                    <img src="../assets/images/parent/trend.png" class="menu-icon">

                    <span class="menu-text">
                        Statistika
                    </span>

                </a>

                <a href="parentProfile.php" class="menu-item">

                    <img src="../assets/images/parent/person.png" class="menu-icon">

                    <span class="menu-text">
                        Profili
                    </span>

                </a>

                <a href="../index.php" class="menu-item logout" onclick="sessionStorage.clear();">

                    <img src="../assets/images/parent/logout.png" class="menu-icon">

                    <span class="menu-text">
                        Dil
                    </span>

                </a>

            </nav>

        </aside>

        <main class="content">

            <div class="top-card">

                <img src="../assets/images/parent/dashboardLejla.png">

                <h1>
                    Informacion i përgjithshëm për nxënësin
                </h1>

            </div>

            <section class="student-section">

                <img src="../assets/images/parent/bachelor.png" class="student-avatar">

                <div class="student-info">

                    <h2>
                        <?php echo $row['emerMbiemer']; ?>
                    </h2>

                    <p>
                        <strong>Klasa:</strong>
                        <?php echo $row['emriKlases']; ?>
                    </p>

                    <p>
                        <strong>Nr ID:</strong>
                        <?php echo $row['nrID']; ?>
                    </p>

                    <p>
                        <strong>Viti shkollor:</strong>
                        2025-2026
                    </p>

                </div>

            </section>

            <section class="dashboard-cards">

                <div class="info-card" onclick="location.href='parentAbsences.php?nxenesID=<?php echo $nxenesID; ?>'">

                    <h3>Mungesat</h3>

                    <p>

                        Mungesa me arsye:
                        <?php echo $mungesaMeArsye; ?>

                        <br><br>

                        Mungesa pa arsye:
                        <?php echo $mungesaPaArsye; ?>

                        <br><br>

                        Mungesa totale:
                        <?php echo $totalMungesa; ?>

                    </p>

                </div>

                <div class="info-card" onclick="location.href='parentNotifications.php?nxenesID=<?php echo $nxenesID; ?>'">

                    <h3>Njoftimet</h3>

                    <p style="margin-bottom:12px;">

                        Detyrë:
                        <?php echo $detyra['titulli'] ?? 'Nuk ka detyra'; ?>

                        <br>

                        <?php echo $detyra['dataMbarimit'] ?? '-'; ?>

                    </p>

                    <p>

                        Aktivitet:
                        <?php echo $aktivitet['titull'] ?? 'Nuk ka aktivitet'; ?>

                        <br>

                        <?php
                        if(isset($aktivitet['data'])){
                            echo date("Y-m-d", strtotime($aktivitet['data']));
                        }
                        ?>

                    </p>

                </div>

                <div class="info-card" onclick="location.href='parentMessages.php?nxenesID=<?php echo $nxenesID; ?>'">

                    <h3>Mesazhet</h3>

                    <p>

                        Ju keni
                        <strong>
                            <?php echo $totalMessages; ?>
                        </strong>
                        mesazhe në inbox.

                        <br><br>

                        <?php
                        if($latestMessage){
                        ?>

                            <strong>
                                <?php echo $latestMessage['derguesi']; ?>
                            </strong>

                            <br>

                            <?php echo $latestMessage['subject']; ?>

                        <?php
                        }
                        else{
                            echo "Nuk ka mesazhe.";
                        }
                        ?>

                    </p>

                </div>

            </section>

        </main>

    </div>

    <script>

        const sidebar = document.querySelector('.sidebar');

        if(sidebar){

            const savedSidebarScroll =
            sessionStorage.getItem("sidebarScroll");

            if(savedSidebarScroll !== null){
                sidebar.scrollTop = savedSidebarScroll;
            }

            sidebar.addEventListener("scroll", function(){

                sessionStorage.setItem(
                    "sidebarScroll",
                    sidebar.scrollTop
                );

            });

        }

    </script>

</body>

</html>