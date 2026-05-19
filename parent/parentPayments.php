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
$parentName   = $parentData['emerMbiemer'];

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
        nxenes.klasID,
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

$row            = mysqli_fetch_assoc($result);
$studentRealID  = $row['nxenesID'];

$paymentsQuery = "
    SELECT *
    FROM pagesat
    WHERE studentID = '$studentRealID'
    AND prindID = '$parentID'
    ORDER BY dataPageses DESC
";

$paymentsResult = mysqli_query($connection, $paymentsQuery);
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pagesat</title>

    <link rel="stylesheet" href="parent.css">

    <style>
        .payments-wrapper {
            margin-top: 30px;
        }

        .payment-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.12);
            border-left: 8px solid #4B2582;
            transition: 0.3s;
        }

        .payment-card:hover {
            transform: translateY(-4px);
        }

        .payment-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .payment-top h2 {
            font-size: 28px;
            color: #222;
        }

        .payment-status {
            padding: 10px 18px;
            border-radius: 30px;
            color: white;
            font-weight: 600;
            font-size: 15px;
        }

        .status-paid {
            background: #16a34a;
        }

        .status-processing {
            background: #f59e0b;
        }

        .status-unpaid {
            background: #ef4444;
        }

        .payment-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-top: 20px;
        }

        .payment-box {
            background: #f7f7f7;
            border-radius: 14px;
            padding: 18px;
        }

        .payment-box span {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }

        .payment-box h3 {
            font-size: 20px;
            color: #222;
        }

        .paypal-section {
            margin-top: 25px;
            display: flex;
            justify-content: flex-end;
        }

        .paypal-btn {
            background: #0070ba;
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .paypal-btn:hover {
            background: #005ea6;
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
            box-shadow: 0px 2px 10px rgba(0,0,0,0.15);
        }

        .top-card img {
            width: 60px;
        }

        .top-card h1 {
            font-size: 34px;
            color: #222;
        }

        .no-payments {
            background: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            font-size: 20px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.12);
        }
    </style>

    <script src="https://www.paypal.com/sdk/js?client-id=AZpVUP1GnyVSkt45jSLH3WopysfgIfMJIwhfhEu7lhhPmndGiWr30exHDRnKvBIe-Npzy4Ryjpd69VKe&currency=USD&intent=capture&commit=true"></script>
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
                <span class="menu-text">Dashboard</span>
            </a>

            <a href="parentGrades.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/certificate.png" class="menu-icon">
                <span class="menu-text">Nota</span>
            </a>

            <a href="parentAbsences.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/student.png" class="menu-icon">
                <span class="menu-text">Mungesa</span>
            </a>

            <a href="parentSchedule.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/calendar.png" class="menu-icon">
                <span class="menu-text">Orari</span>
            </a>

            <a href="parentPayments.php" class="menu-item active-menu">
                <img src="/EEMS-Platform/assets/images/parent/fee.png" class="menu-icon">
                <span class="menu-text">Pagesat</span>
            </a>

            <a href="parentMessages.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/chatting.png" class="menu-icon">
                <span class="menu-text">Mesazhet</span>
            </a>

            <a href="parentNotifications.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/notification.png" class="menu-icon">
                <span class="menu-text">Njoftime</span>
            </a>

            <a href="parentStatistics.php" class="menu-item">
                <img src="/EEMS-Platform/assets/images/parent/trend.png" class="menu-icon">
                <span class="menu-text">Statistika</span>
            </a>

            <a href="parentProfile.php" class="menu-item">
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
            <img src="/EEMS-Platform/assets/images/parent/credit-card.png">
            <h1>Pagesat për vazhdimin e shkollës në Elite</h1>
        </div>

        <div class="payments-wrapper">

            <?php if (mysqli_num_rows($paymentsResult) > 0): ?>
                <?php while ($payment = mysqli_fetch_assoc($paymentsResult)): ?>
                    <?php
                        $status = $payment['statusi'];
                        if ($status == "Paguar") {
                            $statusClass = "status-paid";
                        } elseif ($status == "Ne proces") {
                            $statusClass = "status-processing";
                        } else {
                            $statusClass = "status-unpaid";
                        }
                    ?>

                    <div class="payment-card">

                        <div class="payment-top">
                            <h2>Muaji: <?php echo $payment['muaji']; ?></h2>
                            <div class="payment-status <?php echo $statusClass; ?>">
                                <?php echo $status; ?>
                            </div>
                        </div>

                        <div class="payment-info">

                            <div class="payment-box">
                                <span>Shuma</span>
                                <h3>$<?php echo number_format($payment['shuma'], 2); ?> USD</h3>
                            </div>

                            <div class="payment-box">
                                <span>Metoda e pagesës</span>
                                <h3><?php echo $payment['metodaPageses']; ?></h3>
                            </div>

                            <div class="payment-box">
                                <span>Data e pagesës</span>
                                <h3><?php echo $payment['dataPageses']; ?></h3>
                            </div>

                            <div class="payment-box">
                                <span>Afati</span>
                                <h3><?php echo $payment['afati']; ?></h3>
                            </div>

                            <div class="payment-box">
                                <span>Transaction ID</span>
                                <h3>#<?php echo $payment['transactionID']; ?></h3>
                            </div>

                            <div class="payment-box">
                                <span>Nxënësi</span>
                                <h3><?php echo $row['emerMbiemer']; ?></h3>
                            </div>

                        </div>

                        <?php if ($payment['statusi'] != 'Paguar'): ?>

                            <div class="paypal-section">
                                <div id="paypal-button-<?php echo $payment['transactionID']; ?>"></div>
                            </div>

                            <script>
                                paypal.Buttons({
                                    createOrder: function (data, actions) {
                                        return actions.order.create({
                                            purchase_units: [{
                                                amount: {
                                                    currency_code: "USD",
                                                    value: "<?php echo number_format($payment['shuma'], 2, '.', ''); ?>"
                                                }
                                            }]
                                        });
                                    },

                                    onApprove: function (data, actions) {
                                        window.location.href =
                                            "confirmPayment.php?id=<?php echo $payment['id']; ?>&paypalOrderID=" + data.orderID;
                                    },

                                    onError: function (err) {
                                        console.log(err);
                                        alert(JSON.stringify(err, null, 2));
                                    }

                                }).render('#paypal-button-<?php echo $payment['transactionID']; ?>');
                            </script>

                        <?php endif; ?>

                    </div>

                <?php endwhile; ?>
                
            <?php else: ?>

                <div class="no-payments">
                    Nuk ka pagesa të regjistruara.
                </div>

            <?php endif; ?>

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