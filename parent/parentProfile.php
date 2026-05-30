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
SELECT *
FROM prinder
WHERE prind_ID = '$parentID'
";

$parentResult = mysqli_query($connection, $parentQuery);
$parentData = mysqli_fetch_assoc($parentResult);
$parentName = $parentData['emerMbiemer'];
$nrTel = $parentData['nrTel'];
$email = $parentData['email'];
$datelindja = $parentData['Datelindja'];
$gjinia = $parentData['Gjinia'];
$fjalekalimiDB = $parentData['fjalekalimFillestare'];

$birthDate = new DateTime($datelindja);
$today = new DateTime();
$mosha = $today->diff($birthDate)->y;

$message = "";
$activeTab = "info";

if(isset($_POST['changePassword'])){
    $activeTab = "password";
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $repeatPassword = $_POST['repeatPassword'];

    if(!password_verify($currentPassword, $fjalekalimiDB)){
        $message = "Fjalëkalimi aktual është gabim!";
    }
    elseif($newPassword != $repeatPassword){
        $message = "Fjalëkalimet nuk përputhen!";
    }
 else{

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $updateQuery = "
    UPDATE prinder
    SET fjalekalimFillestare = '$hashedPassword'
    WHERE prind_ID = '$parentID'
    ";

    mysqli_query($connection, $updateQuery);

    $updateUsers = "
    UPDATE users
    SET fjalekalim = '$hashedPassword'
    WHERE email = '$email'
    ";

    mysqli_query($connection, $updateUsers);
    $message = "Fjalëkalimi u ndryshua me sukses!";
}
}

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
?>

<!DOCTYPE html>
<html lang="sq">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profili</title>
<link rel="stylesheet" href="parent.css">

<style>

.profile-wrapper{
    background:white;
    border-radius:22px;
    padding:45px;
    margin-top:25px;
    box-shadow:0 6px 20px rgba(0,0,0,0.12);
    width:96%;
}

.profile-container{
    display:flex;
    gap:45px;
    align-items:flex-start;
}

.left-profile{
    width:300px;
    background:#f3f3f3;
    border-radius:18px;
    padding:40px 25px;
    text-align:center;
}

.left-profile img{
    width:150px;
    height:150px;
    border-radius:50%;
    margin-bottom:20px;
}

.left-profile h3{
    color:#2d4cc8;
    font-size:34px;
    margin-top:18px;
    font-weight:700;
}

.right-profile{
    flex:1;
}

.tabs{
    display:flex;
    width:100%;
}

.tab-btn{
    flex:1;
    padding:18px;
    border:none;
    background:#ececec;
    font-size:22px;
    font-weight:700;
    cursor:pointer;
    border:1px solid #dcdcdc;
    transition:0.3s;
}

.tab-btn.active{
    background:white;
    border-top:4px solid #4a8cff;
}

.tab-btn:hover{
    background:#e2e2e2;
}

.tab-content{
    border:1px solid #dcdcdc;
    padding:40px;
    background:#f8f8f8;
}

.info-table{
    width:100%;
    border-collapse:collapse;
}

.info-table td{
    border:1px solid #dcdcdc;
    padding:24px;
    font-size:24px;
}

.info-label{
    font-weight:700;
    width:40%;
}

.password-form{
    max-width:700px;
    margin:auto;
}

.password-form label{
    display:block;
    margin-top:25px;
    margin-bottom:12px;
    font-weight:700;
    font-size:22px;
}

.password-form input{
    width:100%;
    padding:18px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:22px;
}

.change-btn{
    margin-top:40px;
    width:100%;
    padding:18px;
    background:#2e2b68;
    color:white;
    border:none;
    border-radius:10px;
    font-size:26px;
    font-weight:700;
    cursor:pointer;
}

.change-btn:hover{
    background:#211f4f;
}

.message{
    margin-top:20px;
    text-align:center;
    font-weight:700;
    color:#2B7A78;
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
                <img src="../assets/images/parent/dashboard.png"
                     class="menu-icon">
                <span class="menu-text">
                    Dashboard
                </span>
            </a>

            <a href="parentGrades.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/certificate.png" class="menu-icon">
                <span class="menu-text">
                    Nota
                </span>
            </a>

            <a href="parentAbsences.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/student.png" class="menu-icon">
                <span class="menu-text">
                    Mungesa
                </span>
            </a>

            <a href="parentSchedule.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/calendar.png" class="menu-icon">
                <span class="menu-text">
                    Orari
                </span>
            </a>

            <a href="parentPayments.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/fee.png" class="menu-icon">
                <span class="menu-text">
                    Pagesat
                </span>
            </a>

            <a href="parentMessages.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/chatting.png" class="menu-icon">
                <span class="menu-text">
                    Mesazhet
                </span>
            </a>

            <a href="parentNotifications.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/notification.png" class="menu-icon">
                <span class="menu-text">
                    Njoftime
                </span>
            </a>

            <a href="parentStatistics.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item">
                <img src="../assets/images/parent/trend.png" class="menu-icon">
                <span class="menu-text">
                    Statistika
                </span>
            </a>

            <a href="parentProfile.php?nxenesID=<?php echo $nxenesID; ?>" class="menu-item active-menu" id="profileLink">
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
            <img src="../assets/images/parent/account,,1.png">
            <h1>
                Shiko profilin
            </h1>
        </div>

        <div class="profile-wrapper">

            <div class="profile-container">

                <div class="left-profile">
                    <img src="../assets/images/parent/icons8-administrator-male-94.png">
                    <h3>
                        <?php echo $parentName; ?>
                    </h3>
                </div>

                <div class="right-profile">
                    <div class="tabs">

                        <button class="tab-btn <?php echo ($activeTab == 'info') ? 'active' : ''; ?>" onclick="showTab('info')">
                            Informacioni
                        </button>

                        <button class="tab-btn <?php echo ($activeTab == 'password') ? 'active' : ''; ?>" onclick="showTab('password')">
                            Ndrysho fjalëkalimin
                        </button>

                    </div>

                    <div id="info"
                         class="tab-content"
                         style="<?php echo ($activeTab == 'info') ? 'display:block;' : 'display:none;'; ?>">

                        <table class="info-table">

                            <tr>
                                <td class="info-label">Emër Mbiemër:</td>
                                <td><?php echo $parentName; ?></td>
                            </tr>

                            <tr>
                                <td class="info-label">Numër telefoni:</td>
                                <td><?php echo $nrTel; ?></td>
                            </tr>

                            <tr>
                                <td class="info-label">Email:</td>
                                <td><?php echo $email; ?></td>
                            </tr>

                            <tr>
                                <td class="info-label">Datëlindja:</td>
                                <td><?php echo $datelindja; ?></td>
                            </tr>

                            <tr>
                                <td class="info-label">Mosha:</td>
                                <td><?php echo $mosha; ?></td>
                            </tr>

                            <tr>
                                <td class="info-label">Gjinia:</td>
                                <td><?php echo $gjinia; ?></td>
                            </tr>

                        </table>

                    </div>

                    <div id="password"
                         class="tab-content"
                         style="<?php echo ($activeTab == 'password') ? 'display:block;' : 'display:none;'; ?>">

                        <form method="POST" class="password-form">

                            <label>Fjalëkalimi aktual:</label>
                            <input type="password" name="currentPassword" required>
                            <label>Fjalëkalimi i ri:</label>
                            <input type="password" name="newPassword" required>
                            <label>Përsërit fjalëkalimin:</label>
                            <input type="password" name="repeatPassword" required>

                            <button type="submit" name="changePassword" class="change-btn">
                                Ndrysho
                            </button>

                        </form>

                        <?php if ($message != "") { ?>
                            <p class="message">
                                <?php echo $message; ?>
                            </p>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function showTab(tabName) {

    document.getElementById('info').style.display = 'none';
    document.getElementById('password').style.display = 'none';
    document.getElementById(tabName).style.display = 'block';

    const buttons = document.querySelectorAll('.tab-btn');

    buttons.forEach(btn => {
        btn.classList.remove('active');
    });

    event.target.classList.add('active');
}
</script>

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

<script>
window.scrollTo(0, 0);
</script>

</body>
</html>