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
SELECT emerMbiemer, email
FROM prinder
WHERE prind_ID = '$parentID'
";

$parentResult = mysqli_query($connection, $parentQuery);
$parentData   = mysqli_fetch_assoc($parentResult);
$parentName  = $parentData['emerMbiemer'];
$parentEmail = $parentData['email'];

if (isset($_GET['nxenesID'])) {
    $nxenesID = $_GET['nxenesID'];
    $_SESSION['selectedStudent'] = $nxenesID;
} elseif (isset($_SESSION['selectedStudent'])) {
    $nxenesID = $_SESSION['selectedStudent'];
} else {
    die("Nuk u zgjodh nxënësi");
}

if (isset($_POST['sendEmail'])) {

    $marresi = mysqli_real_escape_string(
        $connection,
        $_POST['marresi']
    );

    $subject = mysqli_real_escape_string(
        $connection,
        $_POST['subject']
    );

    $body = mysqli_real_escape_string(
        $connection,
        $_POST['body']
    );

    if (!empty($marresi) && !empty($subject) && !empty($body)) {

        $insertMail = "
        INSERT INTO mail
        (
            derguesi,
            marresi,
            subject,
            body,
            status
        )
        VALUES
        (
            '$parentEmail',
            '$marresi',
            '$subject',
            '$body',
            'sent'
        )
        ";

        $runInsert = mysqli_query($connection, $insertMail);

        if ($runInsert) {
            echo "
            <script>
                alert('Email u dergua me sukses!');
                window.location.href='parentMessages.php';
            </script>
            ";
            exit();
        } else {
            echo "
            <script>
                alert('Gabim gjate dergimit!');
            </script>
            ";
        }
    }
}

$mailQuery = "
SELECT *
FROM mail
WHERE marresi = '$parentEmail'
";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string(
        $connection,
        $_GET['search']
    );

    $mailQuery .= "
    AND (
        subject LIKE '%$search%'
        OR body LIKE '%$search%'
        OR derguesi LIKE '%$search%'
    )
    ";
}

$mailQuery .= " ORDER BY data DESC";
$mailResult = mysqli_query($connection, $mailQuery);

$totalMailQuery = "
SELECT COUNT(*) AS total
FROM mail
WHERE marresi = '$parentEmail'
";

$totalResult = mysqli_query($connection, $totalMailQuery);
$totalData   = mysqli_fetch_assoc($totalResult);
$totalMail   = $totalData['total'];
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesazhet</title>
    <link rel="stylesheet" href="parent.css">

    <style>

        .messages-wrapper {
            display: flex;
            gap: 40px;
            margin-top: 30px;
            align-items: flex-start;
        }

        .left-buttons {
            width: 160px;
            display: flex;
            flex-direction: column;
            padding-top: 15px;
        }

        .compose-btn {
            margin-top: 520px;
        }

        .left-buttons button {
            width: 130px;
            height: 42px;
            border: none;
            border-radius: 14px;
            background: #4B2582;
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        .left-buttons button:hover {
            transform: scale(1.03);
        }

        .mail-content {
            flex: 1;
        }

        .mail-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border: 1px solid #cfcfcf;
            border-radius: 14px;
            overflow: hidden;
        }

        .mail-table tr {
            border-bottom: 1px solid #d8d8d8;
        }

        .mail-table td {
            padding: 18px;
            vertical-align: top;
        }

        .sender {
            color: #3b82f6;
            font-size: 14px;
            font-weight: 600;
        }

        .subject {
            font-weight: bold;
            font-size: 15px;
            color: #222;
        }

        .body {
            font-size: 14px;
            color: #555;
            margin-top: 5px;
        }

        .date {
            font-size: 13px;
            color: #777;
            text-align: right;
            white-space: nowrap;
        }

        .message-box {
            border: 1px solid #cfcfcf;
            background: white;
            border-radius: 14px;
            overflow: hidden;
            margin-top: 15px;
        }

        .message-form {
            padding: 25px;
        }

        .message-form label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: #333;
        }

        .message-form input {
            width: 100%;
            height: 45px;
            border: 1px solid #d5d5d5;
            border-radius: 8px;
            padding-left: 14px;
            margin-bottom: 18px;
            outline: none;
            font-size: 15px;
        }

        .message-form textarea {
            width: 100%;
            height: 170px;
            border: 1px solid #d5d5d5;
            border-radius: 8px;
            padding: 14px;
            resize: none;
            outline: none;
            font-size: 15px;
        }

        .form-buttons {
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
        }

        .discard-btn {
            background: #ff4f4f;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }

        .send-btn {
            background: #32c400;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }

        .send-btn:hover, .discard-btn:hover {
            opacity: 0.9;
        }

        .top-card {
            width: 100%;
            height: 95px;
            background: #f5f5f5;
            border-radius: 18px;
            display: flex;
            align-items: center;
            gap: 20px;
            padding-left: 30px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
        }

        .top-card img {
            width: 60px;
        }

        .top-card h1 {
            font-size: 34px;
            color: #222;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box form {
            display: flex;
            gap: 10px;
        }

        .search-box input {
            width: 300px;
            height: 42px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding-left: 14px;
            outline: none;
        }

        .search-box button {
            width: 100px;
            border: none;
            background: #4B2582;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }

        .total-mails {
            margin-bottom: 15px;
            font-size: 17px;
            font-weight: 600;
            color: #444;
        }

        .compose-top {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .compose-top h2 {
            font-size: 26px;
            color: #555;
        }

        .compose-btn {
            width: 130px;
            height: 42px;
            border: none;
            border-radius: 14px;
            background: #32c400 !important;
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        .compose-btn:hover {
            transform: scale(1.03);
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
                
                <a href="parentGrades.php" class="menu-item">
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
                
                <a href="parentMessages.php" class="menu-item active-menu">
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
        <img src="../assets/images/parent/chatting,,1.png">
        <h1>
            Mundësia për të komunikuar me mësuesit
        </h1>
    </div>

    <div class="messages-wrapper">

        <div class="left-buttons">

            <button>
                Inbox
            </button>

            <button class="compose-btn"
                    onclick="document.getElementById('composeBox').scrollIntoView();">
                Compose
            </button>

        </div>

        <div class="mail-content">

            <div class="search-box">
                <form method="GET">
                    <input type="text" name="search" placeholder="Kerko email...">
                    <button type="submit">
                        Kerko
                    </button>
                </form>
            </div>

            <div class="total-mails">
                Mesazhe gjithsej: <?php echo $totalMail; ?>
            </div>

            <table class="mail-table">
                <?php
                if (mysqli_num_rows($mailResult) > 0) {
                    while ($mail = mysqli_fetch_assoc($mailResult)) {
                ?>
                        <tr>
                            <td width="25%">
                                <div class="sender">
                                    <?php echo $mail['derguesi']; ?>
                                </div>
                            </td>
                            <td width="55%">
                                <div class="subject">
                                    <?php echo $mail['subject']; ?>
                                </div>
                                <div class="body">
                                    <?php echo $mail['body']; ?>
                                </div>
                            </td>
                            <td width="20%">
                                <div class="date">
                                    <?php echo date("d-m-Y", strtotime($mail['data'])); ?>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="3">
                            Nuk ka mesazhe.
                        </td>
                    </tr>
                <?php } ?>

            </table>

            <div class="message-box" id="composeBox">
                <form method="POST" class="message-form">
                    <label>Email</label>
                    <input type="email" name="marresi" placeholder="example@gmail.com" required>
                    <label>Subject</label>
                    <input type="text" name="subject" placeholder="Subject" required>
                    <label>Message</label>
                    <textarea name="body" placeholder="Place some text here..." required></textarea>

                    <div class="form-buttons">

                        <button type="reset" class="discard-btn">
                            Discard
                        </button>

                        <button type="submit" name="sendEmail" class="send-btn">
                            Send
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</main>

</div>

<script>
const sidebar = document.querySelector('.sidebar');

if (sidebar) {

    const savedSidebarScroll = sessionStorage.getItem("sidebarScroll");

    if (savedSidebarScroll !== null) {
        sidebar.scrollTop = savedSidebarScroll;
    }

    sidebar.addEventListener("scroll", function () {
        sessionStorage.setItem("sidebarScroll", sidebar.scrollTop);
    });

}
</script>

</body>
</html>