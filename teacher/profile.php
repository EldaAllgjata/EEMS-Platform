<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}

$mesuesID = $_SESSION["id"];

$mesuesQuery = "
SELECT *
FROM mesues
WHERE mesuesID = '$mesuesID'
";

$mesuesResult = mysqli_query($connection, $mesuesQuery);

if(!$mesuesResult){
    die("Gabim SQL: " . mysqli_error($connection));
}

$mesuesData = mysqli_fetch_assoc($mesuesResult);

$mesuesName = $mesuesData['emerMbiemer'];
$nrTel = $mesuesData['nrTel'];
$email = $mesuesData['email'];
$datelindja = $mesuesData['datelindja'];
$gjinia = $mesuesData['gjinia'];

$kualifikimeQuery = "
SELECT titulli, viti
FROM kualifikimemesuesi
WHERE mesuesID = '$mesuesID'
ORDER BY viti ASC
";

$kualifikimeResult = mysqli_query($connection, $kualifikimeQuery);

if(!$kualifikimeResult){
    die("Gabim SQL: " . mysqli_error($connection));
}

$kualifikimi = "";
$nr = 1;

if(mysqli_num_rows($kualifikimeResult) > 0){

    while($row = mysqli_fetch_assoc($kualifikimeResult)){
        $kualifikimi .= $nr . ". " . $row['titulli'] . " - Viti " . $row['viti'] . "<br>";
        $nr++;
    }

}else{
    $kualifikimi = "Nuk ka kualifikime të regjistruara.";
}

$fjalekalimiDB = $mesuesData['fjalekalimFillestare'];

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

        $message = "Fjalekalimi aktual eshte gabim!";

    }
    elseif($newPassword != $repeatPassword){

        $message = "Fjalekalimet nuk perputhen!";

    }
    else{

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updateQuery = "
        UPDATE mesues
        SET fjalekalimFillestare = '$hashedPassword'
        WHERE mesuesID = '$mesuesID'
        ";

        mysqli_query($connection, $updateQuery);

        
        $updateUsers = "
        UPDATE users
        SET fjalekalim = '$hashedPassword'
        WHERE email = '$email'
        ";

        mysqli_query($connection, $updateUsers);

        $message = "Fjalekalimi u ndryshua me sukses!";
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profili i mesuesit</title>
<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}



body.teacher-dashboard-page{
    background:#f3f3f3;
}



.dashboard-container{
    display:flex;
    min-height:100vh;
}



.sidebar{
    width:250px;
    background:#32146b;
    color:white;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:fixed;
    top:0;
    left:0;
    height:100vh;
    overflow-y:auto;
    padding:25px 0;
}

.profile-section{
    text-align:center;
    margin-bottom:30px;
}



h3{
    margin-top:7px;
    font-size:24px;
    line-height:1.3;
}

.menu{
    display:flex;
    flex-direction:column;
}

.menu-item{
    display:flex;
    align-items:center;
    gap:15px;
    padding:18px 25px;
    color:white;
    text-decoration:none;
    transition:0.3s;
    
}

.menu-item:hover{
    background:#5634a1;
}

.active-menu{
    background:#b6a1df;
}

.menu-icon{
    width:28px;
    height:28px;
}

.logout{
    margin-top:20px;
}



.content{
    margin-left:260px;
    width:calc(100% - 260px);
    padding:30px;
}



.top-card{
    background:white;
    border-radius:18px;
    padding:20px 25px;
    display:flex;
    align-items:center;
    gap:18px;
    box-shadow:0 3px 12px rgba(0,0,0,0.15);
    margin-bottom:25px;
    width:1300px;
    margin:0 auto;
    margin-bottom:25px;
}

.top-card img{
    width:55px;
}

.top-card h1{
    font-size:32px;
    color:#32146b;
}


.profile-wrapper{
    background:white;
    border-radius:18px;
    padding:35px;
    box-shadow:0 4px 15px rgba(0,0,0,0.15);
    width:1300px;
    margin:0 auto;
}


.profile-container{
    display:flex;
    gap:25px;
    align-items:flex-start;
}


.left-profile{
    width:260px;
}

.profile-card{
    background:#ececec;
    border-radius:12px;
    padding:25px;
    text-align:center;
    margin-bottom:20px;
}

.profile-card img{
    width:120px;
    height:120px;
    border-radius:50%;
    border:4px solid white;
}

.profile-card h3{
    margin-top:15px;
    color:#2c4fb5;
    font-size:22px;
}



.qualifications{
    background:#dddddd;
    border-radius:12px;
    overflow:hidden;
}

.qualifications h2{
    background:#cfcfcf;
    margin:0;
    padding:14px;
    text-align:center;
    color:#3d2a7a;
    font-size:22px;
}

.qualifications p{
    padding:15px;
    margin:0;
    border-bottom:1px solid #bdbdbd;
    font-size:18px;
    color:#3d2a7a;
    line-height:1.8;
}


.right-profile{
    flex:1;
}



.tabs{
    display:flex;
}

.tab-btn{
    flex:1;
    padding:16px;
    border:none;
    background:#ececec;
    cursor:pointer;
    font-size:20px;
    font-weight:bold;
    border:1px solid #d0d0d0;
    transition:0.3s;
}

.tab-btn:hover{
    background:#dfdfdf;
}

.tab-btn.active{
    background:white;
    border-top:4px solid #4c84ff;
}



.tab-content{
    border:1px solid #d0d0d0;
    background:#f5f5f5;
    padding:25px;
}



.info-table{
    width:100%;
    border-collapse:collapse;
}

.info-table td{
    border:1px solid #d0d0d0;
    padding:20px;
    font-size:20px;
}

.info-label{
    font-weight:bold;
    width:45%;
    background:#ececec;
}



.password-form label{
    display:block;
    margin-top:20px;
    margin-bottom:10px;
    font-size:20px;
    font-weight:bold;
}

.password-form input{
    width:100%;
    padding:15px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:18px;
}

.change-btn{
    width:100%;
    margin-top:30px;
    padding:16px;
    border:none;
    border-radius:8px;
    background:#2e2b68;
    color:white;
    font-size:22px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

.change-btn:hover{
    background:#211f4f;
}



.message{
    margin-top:20px;
    text-align:center;
    font-size:20px;
    font-weight:bold;
    color:green;
}

</style>

</head>

<body class="teacher-dashboard-page">
<div class="dashboard-container">
   <aside class="sidebar">
    <div>
      <div class="profile-section">

          <img src="../assets/images/teacher/icons8-male-user-90.png" class="profile-image">
          <h3>Mireseerdhe<br> mesues!</h3>
      </div>

    <nav class="menu">
        <a href="teacherDashboard.php" class="menu-item">
             <img src="../assets/images/teacher/icons8-dashboard-24.png" class="menu-icon">
             <span class="menu-text">Dashboard</span>
        </a>

        <a href="notat.php" class="menu-item">
             <img src="../assets/images/teacher/icons8-grades-48.png" class="menu-icon">
             <span class="menu-text">Notat</span>
        </a>

        <a href="mungesat.php" class="menu-item">
             <img src="../assets/images/teacher/icons8-attendance-64.png" class="menu-icon">
             <span class="menu-text">Mungesat</span>
        </a>
        <a href="detyrat.php" class="menu-item">
             <img src="../assets/images/teacher/icons8-home-30 (1).png" class="menu-icon">
             <span class="menu-text">Detyrat</span>
        </a>
        <a href="orariT.php" class="menu-item">
             <img src="../assets/images/teacher/icons8-schedule-50 (3).png" class="menu-icon">
             <span class="menu-text">Orari</span>
        </a>
        <a href="aktivitetet.php" class="menu-item">
             <img src="../assets/images/teacher/icons8-calendar-50 (1).png" class="menu-icon">
             <span class="menu-text">Aktivitetet</span>
        </a>
        <a href="email.php" class="menu-item">
             <img src="../assets/images/teacher/icons8-mail-50.png" class="menu-icon">
             <span class="menu-text">Email</span>
        </a>
        <a href="profile.php" class="menu-item active-menu">
             <img src="../assets/images/teacher/icons8-test-account-64.png" class="menu-icon">
             <span class="menu-text">Profili</span>
        </a>

        <a href="../index.php" class="menu-item logout">
             <img src="../assets/images/teacher/icons8-log-out-50.png" class="menu-icon">
             <span class="menu-text">Dil</span>
        </a>
    </nav>
   </div>
</aside>



<main class="content">

  <div class="top-card">
    <img src="../assets/images/teacher/icons8-test-account-64 (1).png">
    <h1>Profili i mesuesit</h1>
  </div>
  <div class="profile-wrapper">
   <div class="profile-container">
    <div class="left-profile">
     <div class="profile-card">
      <img src="../assets/images/teacher/icons8-administrator-male-94.png">
      <h3><?php echo $mesuesName; ?></h3>
     </div>
     <div class="qualifications">
        <h2>Kualifikimet</h2>
        <p><?php echo $kualifikimi; ?></p>
     </div>
    </div>
    <div class="right-profile">
     <div class="tabs">
        <button class="tab-btn <?php echo ($activeTab == 'info') ? 'active' : ''; ?>" onclick="showTab('info', event)">Informacioni</button>
        <button class="tab-btn <?php echo ($activeTab == 'password') ? 'active' : ''; ?>" onclick="showTab('password', event)">Ndrysho Fjalekalim</button>
     </div>
     <div id="info" class="tab-content" style="<?php echo ($activeTab == 'info') ? 'display:block;' : 'display:none;'; ?>">
        <table class="info-table">
            <tr>
                <td class="info-label">Emer Mbiemer:</td>
                <td><?php echo $mesuesName; ?></td>
            </tr>
            <tr>
                <td class="info-label">Numer telefoni:</td>
                <td><?php echo $nrTel; ?></td>
            </tr>
            <tr>
                <td class="info-label">Email:</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td class="info-label">ID e Mesuesit:</td>
                <td><?php echo $mesuesID; ?></td>
            </tr>
            <tr>
                <td class="info-label">Datelindja:</td>
                <td><?php echo $datelindja; ?></td>
            </tr>
            <tr>
                <td class="info-label">Mosha:</td>
                <td><?php echo $mosha; ?> vjec</td>
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
        <label>Fjalekalimi aktual:</label>
        <input type="password" name="currentPassword" required>
        <label>Fjalekalimi i ri:</label>
        <input type="password" name="newPassword" required>
        <label>Perserit fjalekalimin:</label>
        <input type="password"name="repeatPassword" required>
        <button type="submit" name="changePassword" class="change-btn">Ndrysho Fjalekalimin</button>
    </form>
    <?php
    if($message != ""){
        ?>
        <p class="message">
            <?php echo $message; ?>
        </p>
        <?php
        }
        ?>
        </div>
    </div>
</div>
</div>
</main>
</div>

<script>

function showTab(tabName, event){

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

</body>
</html>