<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}

$mesuesID = $_SESSION["id"];

$tremujori = 1;

if(isset($_GET['tremujori'])){
    $tremujori = $_GET['tremujori'];
}

$orariQuery = "
SELECT 
    orari.dita,
    orari.ora_fillimit,
    lenda.emri AS lenda,
    klasa.emer AS klasa
FROM orari
INNER JOIN lenda ON orari.lendaID = lenda.id
INNER JOIN klasa ON orari.klasID = klasa.klasaID
WHERE orari.mesuesID = '$mesuesID'
AND orari.tremujori = '$tremujori'
ORDER BY FIELD(orari.dita,
'E Hënë','E Martë','E Mërkurë','E Enjte','E Premte'),
orari.ora_fillimit
";

$orariResult = mysqli_query($connection, $orariQuery);

$orari = [];

while($data = mysqli_fetch_assoc($orariResult)){
    $dita = $data['dita'];
    $ora = substr($data['ora_fillimit'],0,5);
    $orari[$ora][$dita] = $data['lenda'] ;
}

$ditet = ['E Hënë','E Martë','E Mërkurë','E Enjte','E Premte'];
$oret  = ['08:00','09:00','10:00','11:00','12:00'];
?>

<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Orari</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}

body{
    background:#f2f2f2;
}



.dashboard .container{
    display:grid;
    grid-template-columns: 250px 1fr;
    min-height:100vh;
    gap:20px;
}

.dashboard .sidebar{
    background:#32146b;
    color:white;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    padding:40px 0;
}

.dashboard .top{
    text-align:center;
}

.dashboard .icon img{
    width:80px;
    margin-bottom:10px;
}

.dashboard .top p{
    font-size:24px;
    line-height:1.3;
    
}

.dashboard .menu{
    display:flex;
    flex-direction:column;
    margin-top:40px;
}

.dashboard .item{
    display:flex;
    align-items:center;
    gap:15px;
    padding:18px 25px;
    cursor:pointer;
    transition:0.3s;
    text-decoration:none;
    color:white;
}

.dashboard .item:hover{
    background:#5a35a5;
}

.dashboard .item.active{
    background:#b9a5dd;
}

.dashboard .item img{
    width:28px;
    height:28px;
}

.dashboard .content-area{
    padding:20px;
}



.header{
    background:white;
    padding:20px;
    border-radius:15px;
    margin-bottom:20px;
    display:flex;
    align-items:center;
    gap:15px;
    box-shadow:0 2px 10px rgba(0,0,0,0.15);
    width:1400px;
    margin:0 auto;
    margin-bottom:25px;
}
.header h2{
    font-size:30px;
    color:#32146b;
}

.box{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    width: 1400px;
    margin:0 auto;
}

.grid-header,
.grid-row{
    display:grid;
    grid-template-columns:120px repeat(5,1fr);
    gap:15px;
    margin-bottom:15px;
}

.day,.time{
    background:#ddd;
    padding:12px;
    text-align:center;
    font-weight:bold;
    border-radius:8px;
}

.cell{
    background:#c8bddf;
    padding:12px;
    text-align:center;
    border-radius:8px;
    font-weight:600;
}

.buttons{
    margin-top:25px;
    display:flex;
    justify-content:center;
    gap:20px;
}

.btn{
    background:#32146b;
    color:white;
    padding:12px 25px;
    border-radius:12px;
    text-decoration:none;
    font-weight:bold;
}

.btn.active{
    background:#6d3ed1;
}
</style>

</head>

<body>

<div class="dashboard">
<div class="container">

<div class="sidebar">

    <div>
        <div class="top">
            <div class="icon">
                <img src="../assets/images/teacher/icons8-male-user-90.png">
            </div>
            <p>Mireserdhe,<br>mesues!</p>
        </div>

        <div class="menu">

            
                    <a href="teacherDashboard.php" class="item">
                        <img src="../assets/images/teacher/icons8-dashboard-24.png">
                        <span>Dashboard</span>
                    </a>

                    <a href="notat.php" class="item">
                        <img src="../assets/images/teacher/icons8-grades-48.png">
                        <span>Notat</span>
                    </a>

                    <a href="mungesat.php" class="item ">
                        <img src="../assets/images/teacher/icons8-attendance-64.png">
                        <span>Mungesat</span>
                    </a>
                    <a href="detyrat.php" class="item ">
                        <img src="../assets/images/teacher/icons8-home-30 (1).png">
                        <span>Detyrat</span>
                    </a>

                    <a href="orariT.php" class="item active">
                        <img src="../assets/images/teacher/icons8-schedule-50 (3).png">
                        <span>Orari</span>
                    </a>

                    <a href="aktivitetet.php" class="item">
                        <img src="../assets/images/teacher/icons8-calendar-50 (1).png">
                        <span>Aktivitetet</span>
                    </a>

                    <a href="email.php" class="item">
                        <img src="../assets/images/teacher/icons8-mail-50.png">
                        <span>Email</span>
                    </a>

                    <a href="profile.php" class="item">
                        <img src="../assets/images/teacher/icons8-test-account-64.png">
                        <span>Profili</span>
                    </a>

        </div>
    </div>
    <a href="../index.php" class="item">
              <img src="../assets/images/teacher/icons8-log-out-50.png">
                <span>Dil</span>
    </a>

</div>


<div class="content-area">

<div class="header">
    <img src="../assets/images/teacher/icons8-schedule-50 (1).png" width="40">
    <h2>Orari i mësuesit</h2>
</div>

<div class="box">


<div class="grid-header">
    <div></div>
    <?php foreach($ditet as $d){ ?>
        <div class="day"><?= $d ?></div>
    <?php } ?>
</div>

<?php foreach($oret as $o){ ?>
<div class="grid-row">

    <div class="time"><?= $o ?></div>

    <?php foreach($ditet as $d){ 
        $val = $orari[$o][$d] ?? "";
    ?>
        <div class="cell"><?= $val ?></div>
    <?php } ?>

</div>
<?php } ?>


<div class="buttons">

    <a class="btn <?= $tremujori==1?'active':'' ?>" href="?tremujori=1">Tremujori1</a>
    <a class="btn <?= $tremujori==2?'active':'' ?>" href="?tremujori=2">Tremujori2</a>
    <a class="btn <?= $tremujori==3?'active':'' ?>" href="?tremujori=3">Tremujori3</a>
</div>

</div>

</div>
</div>
</div>

</body>
</html>