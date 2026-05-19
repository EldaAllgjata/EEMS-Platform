<?php
include "../config/db.php";
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SESSION['role'] != 'parent') {
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
$parentData   = mysqli_fetch_assoc($parentResult);
$parentName   = $parentData['emerMbiemer'] ?? '';

if (isset($_GET['nxenesID'])) {
    $nxenesID = $_GET['nxenesID'];
    $_SESSION['selectedStudent'] = $nxenesID;
} elseif (isset($_SESSION['selectedStudent'])) {
    $nxenesID = $_SESSION['selectedStudent'];
} else {
    die("Nuk u zgjodh nxënësi");
}

$studentQuery = "
    SELECT nxenes.nxenesID
    FROM nxenes
    WHERE nxenes.nrID = '$nxenesID'
    AND nxenes.prindID = '$parentID'
    LIMIT 1
";

$studentResult = mysqli_query($connection, $studentQuery);

if (!$studentResult || mysqli_num_rows($studentResult) == 0) {
    die("Nxënësi nuk u gjet ose nuk i përket këtij prindi");
}

$studentRow   = mysqli_fetch_assoc($studentResult);
$realNxenesID = $studentRow['nxenesID'];

$totalQuery = "
    SELECT COUNT(*) AS total
    FROM mungesat
    WHERE nxenesID = '$realNxenesID'
    AND statusi != 'Prezent'
";

$totalResult  = mysqli_query($connection, $totalQuery);
$totalData    = mysqli_fetch_assoc($totalResult);
$totalMungesa = $totalData['total'] ?? 0;

$paArsyeQuery = "
    SELECT COUNT(*) AS total
    FROM mungesat
    WHERE nxenesID = '$realNxenesID'
    AND statusi = 'Mungese'
";

$paArsyeResult = mysqli_query($connection, $paArsyeQuery);
$paArsyeData   = mysqli_fetch_assoc($paArsyeResult);
$mungesaPaArsye = $paArsyeData['total'] ?? 0;

$meArsyeQuery = "
    SELECT COUNT(*) AS total
    FROM mungesat
    WHERE nxenesID = '$realNxenesID'
    AND statusi = 'Me arsye'
";

$meArsyeResult = mysqli_query($connection, $meArsyeQuery);
$meArsyeData   = mysqli_fetch_assoc($meArsyeResult);
$mungesaMeArsye = $meArsyeData['total'] ?? 0;

$totalLejura = 46 - $totalMungesa;

$listaQuery = "
    SELECT 
        mungesat.data,
        mungesat.ora,
        mungesat.statusi,
        lenda.emri AS emriLendes
    FROM mungesat
    LEFT JOIN lenda 
        ON mungesat.lendaID = lenda.id
    WHERE mungesat.nxenesID = '$realNxenesID'
    ORDER BY mungesat.data DESC, mungesat.ora DESC
";

$listaResult = mysqli_query($connection, $listaQuery);
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mungesat e nxënësit</title>
    <link rel="stylesheet" href="parent.css">

    <style>
        .stats-cards {
            display: flex;
            gap: 20px;
            margin: 24px 0 28px 0;
            flex-wrap: wrap;
        }

        .stat-card {
            flex: 1;
            min-width: 180px;
            border-radius: 16px;
            padding: 22px 26px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            color: #fff;
        }

        .stat-card.total {
            background: #DEA8A8;
        }

        .stat-card.pa-arsye {
            background: #F73B3B;
        }

        .stat-card.lejuara {
            background: #5FC15A;
        }

        .stat-card-icon {
            width: 52px;
            height: 52px;
            object-fit: contain;
            opacity: 0.9;
        }

        .stat-card-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card-label {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 6px;
            color: #fff;
        }

        .stat-card-value {
            font-size: 34px;
            font-weight: 900;
            line-height: 1;
            color: #fff;
        }

        .absences-table-wrapper {
            background: #FFFAFA;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            overflow: hidden;
            padding: 18px;
        }

        .absences-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 20px;
        }

        .absences-table thead th {
            padding: 22px 30px;
            text-align: left;
            font-size: 22px;
            font-weight: 900;
            background: #f3f3f3;
        }

        .absences-table tbody td {
            padding: 20px 30px;
            font-size: 19px;
            color: #333;
        }

        .absences-table tbody tr:hover {
            background: #f7eeee;
            transform: scale(1.01);
            transition: 0.2s ease;
        }

        .badge.prezent {
            background: #d4f8dd;
            color: #1e8e3e;
        }

        .badge.me-arsye {
            background: #fde8e8;
            color: #c0392b;
        }

        .badge.pa-arsye {
            background: #FA8072;
            color: #d35454;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 14px;
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
                <?php echo htmlspecialchars($parentName); ?>
            </p>
        </div>

        <nav class="menu">

            <a href="parentDashboard.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/dashboard.png" class="menu-icon">
                <span class="menu-text">Dashboard</span>
            </a>

            <a href="parentGrades.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/certificate.png" class="menu-icon">
                <span class="menu-text">Nota</span>
            </a>

            <a href="parentAbsences.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item active-menu">
                <img src="/EEMS-Platform/assets/images/parent/student.png" class="menu-icon">
                <span class="menu-text">Mungesa</span>
            </a>

            <a href="parentSchedule.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/calendar.png" class="menu-icon">
                <span class="menu-text">Orari</span>
            </a>

            <a href="parentPayments.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/fee.png" class="menu-icon">
                <span class="menu-text">Pagesat</span>
            </a>

            <a href="parentMessages.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/chatting.png" class="menu-icon">
                <span class="menu-text">Mesazhet</span>
            </a>

            <a href="parentNotifications.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/notification.png" class="menu-icon">
                <span class="menu-text">Njoftime</span>
            </a>

            <a href="parentStatistics.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/trend.png" class="menu-icon">
                <span class="menu-text">Statistika</span>
            </a>

            <a href="parentProfile.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/person.png" class="menu-icon">
                <span class="menu-text">Profili</span>
            </a>

            <a href="../index.php" class="menu-item logout" onclick="sessionStorage.clear();">
                <img src="/EEMS-Platform/assets/images/parent/logout.png" class="menu-icon">
                <span class="menu-text">Dil</span>
            </a>

        </nav>

    </aside>

    <main class="content">

        <div class="top-card">
            <img src="/EEMS-Platform/assets/images/parent/studentLejla.png">
            <h1>Mungesat e nxënësit përgjatë ditëve të vitit shkollor</h1>
        </div>

        <div class="stats-cards">

            <div class="stat-card total">

                <img src="/EEMS-Platform/assets/images/parent/absence (1).png" class="stat-card-icon">

                <div class="stat-card-info">
                    <span class="stat-card-label">Totali i mungesave</span>
                    <span class="stat-card-value"><?php echo $totalMungesa; ?></span>
                </div>

            </div>

            <div class="stat-card pa-arsye">

                <img src="/EEMS-Platform/assets/images/parent/school.png" class="stat-card-icon">

                <div class="stat-card-info">
                    <span class="stat-card-label">Mungesa pa arsye</span>
                    <span class="stat-card-value"><?php echo $mungesaPaArsye; ?></span>
                </div>

            </div>

            <div class="stat-card lejuara">

                <img src="/EEMS-Platform/assets/images/parent/absent (1).png" class="stat-card-icon">

                <div class="stat-card-info">
                    <span class="stat-card-label">Mungesa te lejuara</span>
                    <span class="stat-card-value"><?php echo $totalLejura; ?></span>
                </div>

            </div>

        </div>

        <div class="absences-table-wrapper">

            <table class="absences-table">

                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Lënda</th>
                        <th>Statusi</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(mysqli_num_rows($listaResult) > 0): ?>

                    <?php while($mungesaRow = mysqli_fetch_assoc($listaResult)): ?>

                        <tr>

                            <td><?php echo date('d/m/Y', strtotime($mungesaRow['data'])); ?></td>
                            <td><?php echo htmlspecialchars($mungesaRow['emriLendes'] ?? 'Pa lëndë'); ?></td>
                            <td>
                                <?php
                                $statusi = $mungesaRow['statusi'];

                                if($statusi == 'Mungese'){
                                    $badgeClass = 'pa-arsye';
                                }
                                elseif($statusi == 'Me arsye'){
                                    $badgeClass = 'me-arsye';
                                }
                                elseif($statusi == 'Prezent'){
                                    $badgeClass = 'prezent';
                                }
                                else{
                                    $badgeClass = '';
                                }
                                ?>

                                <span class="badge <?php echo $badgeClass; ?>">
                                    <?php echo htmlspecialchars($statusi); ?>
                                </span>

                            </td>
                        </tr>

                    <?php endwhile; ?>
                <?php else: ?>

                    <tr>
                        <td colspan="3" class="no-data">
                            Nuk ka mungesa te regjistruara.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

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