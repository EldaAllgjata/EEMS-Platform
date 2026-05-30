<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION["id"]) ){
    header("Location: ../index.php");
    exit();
}



$mesuesID = $_SESSION["id"];

$teacherQuery = "
SELECT emerMbiemer, email
FROM mesues
WHERE mesuesID = '$mesuesID'
";

$teacherResult = mysqli_query($connection, $teacherQuery);
$teacherData = mysqli_fetch_assoc($teacherResult);

$teacherName  = $teacherData['emerMbiemer'];
$teacherEmail = $teacherData['email'];

if(isset($_POST['sendEmail'])){

    $marresi = mysqli_real_escape_string($connection, $_POST['marresi']);
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $body    = mysqli_real_escape_string($connection, $_POST['body']);

    if(!empty($marresi) && !empty($subject) && !empty($body)){

        $insertMail = "
        INSERT INTO mail
        (derguesi, marresi, subject, body, status)
        VALUES
        ('$teacherEmail', '$marresi', '$subject', '$body', 'sent')
        ";

        $runInsert = mysqli_query($connection, $insertMail);

        if($runInsert){
            echo "
            <script>
                alert('Email u dergua me sukses!');
                window.location.href='email.php';
            </script>
            ";
            exit();
        } else {
            echo "<script>alert('Gabim gjate dergimit!');</script>";
        }
    }
}

$mailQuery = "
SELECT *
FROM mail
WHERE marresi = '$teacherEmail'
";

if(isset($_GET['search']) && !empty($_GET['search'])){

    $search = mysqli_real_escape_string($connection, $_GET['search']);

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
WHERE marresi = '$teacherEmail'
";

$totalResult = mysqli_query($connection, $totalMailQuery);
$totalData = mysqli_fetch_assoc($totalResult);
$totalMail = $totalData['total'];

?>

<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mesazhet - Mësues</title>

<style>



body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f4f4f4;
}



.dashboard-container{
    display:flex;
}


.sidebar{
    width:250px;
    height:100vh;
    background:#32146b;
    color:white;
    position:fixed;
    top:0;
    left:0;
    display:flex;
    flex-direction:column;
    padding:40px 0 ;
}


.profile-section{
    text-align:center;
    
}
.profile-image{
    width:80px;
    margin-bottom:10px;
}



h3{
    margin-top:7px;
    font-size:24px;
    line-height:1.3;
}


.menu{
    display:flex;
    flex-direction:column;
    margin-top:40px;
}

.menu .item{
    display:flex;
    align-items:center;
    gap:15px;
    padding:18px 25px;
    text-decoration:none;
    color:white;
    transition:0.3s;
}

.menu .item:hover{
    background:#5a35a5;
}

.menu .item.active{
    background:#b9a5dd;
}

.menu .item img{
    width:28px;
    height:28px;
}

.menu .item span{
    font-size:16px;
    color:white;
}


.sidebar .logout-btn{
    display:flex;
    align-items:center;
    gap:15px;
    padding:18px 25px;
    text-decoration:none;
    color:white;
    transition:0.3s;
    margin-top:20px;
}



.sidebar .logout-btn img{
    width:24px;
}

.sidebar .logout-btn span{
    display:flex;
    align-items:center;
    gap:12px;
    olor:white;
    text-decoration:none;
    
}


        


.content{
    margin-left:250px;
    padding:20px;
    width:calc(100% - 250px);
}

.top-card{
    
    background:white;
    padding:20px;
    border-radius:15px;
    display:flex;
    align-items:center;
    gap:15px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    width:1300px;
    margin:0 auto;
    margin-bottom:25px;
}


.top-card h1{
    font-size:32px;
    color:#32146b;
}


.mail-wrapper{
    background:white;
    margin-top:20px;
    padding:25px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    width:1300px;
    margin:0 auto;
    
}

.messages-wrapper{
    display:flex;
    gap:30px;
    margin-top:20px;
    align-items:flex-start;
    
}

.left-buttons{
    width:150px;
    display:flex;
    flex-direction:column;
    gap:100px;
    margin-top:55px;
}

.left-buttons button{
    padding:10px;
    border:none;
    border-radius:10px;
    background:#4B2582;
    color:white;
    cursor:pointer;
}

.compose-btn{
    background:#32c400 !important;
    
}

.mail-content{
    flex:1;
}

.search-box{
    display:flex;
    justify-content:flex-end;
    margin-bottom:15px;
}

.search-box form{
    display:flex;
    gap:10px;
}

.search-box input{
    padding:10px;
    width:250px;
    border:1px solid #ccc;
    border-radius:8px;
}

.search-box button{
    padding:10px 18px;
    background:#4B2582;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    
}

.search-box button:hover{
    background:#32146b;
}

.total-mails{
    margin:10px 0;
    font-weight:bold;
}


.mail-table{
    width:100%;
    background:white;
    border-collapse:collapse;
}

.mail-table td{
    padding:15px;
    border-bottom:1px solid #ddd;
}

.sender{
    color:#3b82f6;
    font-weight:bold;
}

.subject{
    font-weight:bold;
}

.date{
    font-size:13px;
    color:gray;
}

.message-box{
    margin-top:30px;
    background:white;
    border-radius:10px;
}

.message-header{
    padding:15px;
    border-bottom:1px solid #ddd;
    font-size:20px;
}

.message-form{
    padding:20px;
}

.message-form input,
.message-form textarea{
    width:100%;
    padding:10px;
    margin-bottom:15px;
}

.form-buttons{
    display:flex;
    justify-content:space-between;
}

.send-btn{
    background:#32c400;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:10px;
}

.discard-btn{
    background:#ff4f4f;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:10px;
}

</style>
</head>

<body>

<div class="dashboard-container">


<aside class="sidebar">

<div>

    <div class="profile-section">
        <img src="../assets/images/teacher/icons8-male-user-90.png"class="profile-image">
        <h3>Mireseerdhe<br> mesues!</h3>
    </div>

    <nav class="menu">
        <a href="teacherDashboard.php" class="item">
                        <img src="../assets/images/teacher/icons8-dashboard-24.png">
                        <span>Dashboard</span>
                    </a>

                    <a href="notat.php" class="item">
                        <img src="../assets/images/teacher/icons8-grades-48.png">
                        <span>Notat</span>
                    </a>

                    <a href="mungesat.php" class="item">
                        <img src="../assets/images/teacher/icons8-attendance-64.png">
                        <span>Mungesat</span>
                    </a>

                    <a href="detyrat.php" class="item ">
                        <img src="../assets/images/teacher/icons8-home-30 (1).png">
                        <span>Detyrat</span>
                    </a>
                    <a href="orariT.php" class="item">
                        <img src="../assets/images/teacher/icons8-schedule-50 (3).png">
                        <span>Orari</span>
                    </a>

                    <a href="aktivitetet.php" class="item">
                        <img src="../assets/images/teacher/icons8-calendar-50 (1).png">
                        <span>Aktivitetet</span>
                    </a>

                    <a href="email.php" class="item active">
                        <img src="../assets/images/teacher/icons8-mail-50.png">
                        <span>Email</span>
                    </a>

                    <a href="profile.php" class="item">
                        <img src="../assets/images/teacher/icons8-test-account-64.png">
                        <span>Profili</span>
                    </a>
    </nav>

</div>

<a href="../index.php" class="logout-btn">
    <img src="../assets/images/teacher/icons8-log-out-50.png">
    <span>Dil</span>
</a>

</aside>


<main class="content">

<div class="top-card">
    <img src=" ../assets/images/teacher/icons8-email-48.png">
    <h1>Mesazhet e mësuesit</h1>
</div>
<div class="mail-wrapper">
 <div class="messages-wrapper">

  
 <div class="left-buttons">
    <button>Inbox</button>
    <button class="compose-btn" onclick="document.getElementById('composeBox').scrollIntoView();">Compose</button>
 </div>

 
 <div class="mail-content">

 
 <div class="search-box">
 <form method="GET">
    <input type="text" name="search" placeholder="Kërko email...">
    <button type="submit">Kërko</button>
 </form>
 </div>

 <div class="total-mails">
    Total mesazhe: <?php echo $totalMail; ?>
 </div>

 
 <table class="mail-table">

 <?php if(mysqli_num_rows($mailResult) > 0){ ?>

 <?php while($mail = mysqli_fetch_assoc($mailResult)){ ?>

 <tr>
    <td width="25%">
        <div class="sender"><?php echo $mail['derguesi']; ?></div>
    </td>

    <td width="55%">
        <div class="subject"><?php echo $mail['subject']; ?></div>
        <div><?php echo $mail['body']; ?></div>
    </td>

    <td width="20%">
        <div class="date">
            <?php echo date("d-m-Y", strtotime($mail['data'])); ?>
        </div>
    </td>
 </tr>

 <?php } ?>

 <?php } else { ?>

 <tr>
    <td colspan="3">Nuk ka mesazhe.</td>
 </tr>

 <?php } ?>

 </table>

 
 <div class="message-box" id="composeBox">
    <div class="message-header">Compose Email</div>
    <form method="POST" class="message-form">
        <label>Email</label>
        <input type="email" name="marresi" required>
        <label>Subject</label>
        <input type="text" name="subject" required>
        <label>Message</label>
        <textarea name="body" required></textarea>
        <div class="form-buttons">
            <button type="reset" class="discard-btn">Discard</button>
            <button type="submit" name="sendEmail" class="send-btn">Send</button>
        </div>
    </form>
</div>
</div>
</div>
</div>
</main>
</div>

</body>
</html>