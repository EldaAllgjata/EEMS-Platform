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
$parentData = mysqli_fetch_assoc($parentResult);
$parentName = $parentData['emerMbiemer'];

if (isset($_GET['nxenesID'])) {

    $nxenesID = $_GET['nxenesID'];
    $_SESSION['selectedStudent'] = $nxenesID;

} elseif (isset($_SESSION['selectedStudent'])) {

    $nxenesID = $_SESSION['selectedStudent'];

} else {

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

if (mysqli_num_rows($result) == 0) {
    die("Nxënësi nuk ekziston");
}

$row = mysqli_fetch_assoc($result);

$realNxenesID = $row['nxenesID'];

$tremujori = "";

if (isset($_GET['tremujori'])) {
    $tremujori = $_GET['tremujori'];
}

$gradesQuery = "
SELECT
    lenda.emri AS emriLendes,
    vleresim.v1,
    vleresim.v2,
    vleresim.v3,
    vleresim.projekt,
    vleresim.test
FROM vleresim
INNER JOIN lenda
    ON vleresim.lendaID = lenda.id
WHERE vleresim.nxenesID = '$realNxenesID'
";

if ($tremujori != "") {
    $gradesQuery .= " AND vleresim.tremujori = '$tremujori'";
}

$gradesResult = mysqli_query($connection, $gradesQuery);
?>

<!DOCTYPE html>
<html lang="sq">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notat e nxënësit</title>
    <link rel="stylesheet" href="parent.css">

    <style>

        .grades-filter{
            width:100%;
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:40px;
            margin-bottom:40px;
        }

        .grades-filter form{
            width:100%;
            display:flex;
            justify-content:center;
        }

        .tremujor-dropdown{
            width:450px;
            height:80px;
            background:#ffffff;
            border:3px solid #361D6E;
            border-radius:25px;
            padding:0 30px;
            font-size:30px;
            font-weight:bold;
            color:#361D6E;
            cursor:pointer;
            outline:none;
            box-shadow:0 8px 20px rgba(0,0,0,0.12);
            appearance:none;
            -webkit-appearance:none;
            -moz-appearance:none;
            transition:0.3s;
            text-align:center;
            text-align-last:center;
        }

        .tremujor-dropdown option{
            text-align:center;
        }

        .tremujor-dropdown:hover{
            transform:translateY(-4px);
            box-shadow:0 12px 25px rgba(0,0,0,0.18);
        }

        .grades-table-container{
            width:100%;
            background:#FFFAFA;
            border:3px solid black;
            border-radius:30px;
            padding:30px;
            overflow-x:auto;
            margin-top:20px;
        }

        .grades-table{
            width:100%;
            border-collapse:collapse;
            background:#FFFAFA;
        }

        .grades-table thead{
            background:#361D6E;
            color:white;
        }

        .grades-table th{
            border:2px solid black;
            padding:25px;
            font-size:28px;
            font-weight:bold;
            text-align:center;
        }

        .grades-table td{
            border:2px solid black;
            padding:22px;
            font-size:24px;
            text-align:center;
        }

        .grades-table tbody tr:hover{
            background:#f3ebff;
        }

        @media(max-width:900px){

            .tremujor-dropdown{
                width:100%;
                max-width:380px;
                font-size:22px;
            }

            .grades-table th{
                font-size:20px;
                padding:18px;
            }

            .grades-table td{
                font-size:18px;
                padding:18px;
            }

        }

        @media(max-width:500px){

            .tremujor-dropdown{
                font-size:18px;
                height:65px;
            }

            .grades-table-container{
                padding:15px;
            }

            .grades-table th{
                font-size:17px;
            }

            .grades-table td{
                font-size:16px;
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

            <a href="parentDashboard.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">

                <img src="../assets/images/parent/dashboard.png" class="menu-icon">
                <span class="menu-text">Dashboard</span>

            </a>

            <a href="parentGrades.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item active-menu">

                <img src="../assets/images/parent/certificate.png" class="menu-icon">
                <span class="menu-text">Nota</span>

            </a>

            <a href="parentAbsences.php" class="menu-item">

                <img src="../assets/images/parent/student.png" class="menu-icon">
                <span class="menu-text">Mungesa</span>

            </a>

            <a href="parentSchedule.php" class="menu-item">

                <img src="../assets/images/parent/calendar.png" class="menu-icon">
                <span class="menu-text">Orari</span>

            </a>

            <a href="parentPayments.php" class="menu-item">

                <img src="../assets/images/parent/fee.png" class="menu-icon">
                <span class="menu-text">Pagesat</span>

            </a>

            <a href="parentMessages.php" class="menu-item">

                <img src="../assets/images/parent/chatting.png" class="menu-icon">
                <span class="menu-text">Mesazhet</span>

            </a>

            <a href="parentNotifications.php" class="menu-item">

                <img src="../assets/images/parent/notification.png" class="menu-icon">
                <span class="menu-text">Njoftime</span>

            </a>

            <a href="parentStatistics.php" class="menu-item">

                <img src="../assets/images/parent/trend.png" class="menu-icon">
                <span class="menu-text">Statistika</span>

            </a>

            <a href="parentProfile.php" class="menu-item">

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

            <img src="../assets/images/parent/certificateLejla.png">

            <h1>
                Notat e nxënësit në lëndë dhe tremujor të ndryshëm
            </h1>

        </div>

        <div class="grades-filter">

            <form method="GET">

                <input type="hidden" name="nxenesID" value="<?php echo $nxenesID; ?>">

                <select name="tremujori"
                        class="tremujor-dropdown"
                        onchange="this.form.submit()">

                    <option value=""
                        <?php if (!isset($_GET['tremujori'])) { echo "selected"; } ?>>
                        Zgjidh tremujorin
                    </option>

                    <option value="1"
                        <?php if ($tremujori == 1) { echo "selected"; } ?>>
                        Tremujori 1
                    </option>

                    <option value="2"
                        <?php if ($tremujori == 2) { echo "selected"; } ?>>
                        Tremujori 2
                    </option>

                    <option value="3"
                        <?php if ($tremujori == 3) { echo "selected"; } ?>>
                        Tremujori 3
                    </option>

                </select>

            </form>

        </div>

        <div class="grades-table-container">

            <table class="grades-table">

                <thead>

                    <tr>

                        <th>Lënda</th>
                        <th>Vlerësim 1</th>
                        <th>Vlerësim 2</th>
                        <th>Vlerësim 3</th>
                        <th>Projekti</th>
                        <th>Testi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($grade = mysqli_fetch_assoc($gradesResult)) { ?>

                        <tr>

                            <td><?php echo $grade['emriLendes']; ?></td>
                            <td><?php echo $grade['v1']; ?></td>
                            <td><?php echo $grade['v2']; ?></td>
                            <td><?php echo $grade['v3']; ?></td>
                            <td><?php echo $grade['projekt']; ?></td>
                            <td><?php echo $grade['test']; ?></td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </main>

</div>

<script>

const sidebar = document.querySelector('.sidebar');

if (sidebar) {

    const savedSidebarScroll =
        sessionStorage.getItem("sidebarScroll");

    if (savedSidebarScroll !== null) {
        sidebar.scrollTop = savedSidebarScroll;
    }

    sidebar.addEventListener("scroll", function () {

        sessionStorage.setItem(
            "sidebarScroll",
            sidebar.scrollTop
        );

    });

}

</script>

</body>
</html>