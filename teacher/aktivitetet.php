<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION["id"])) {
    header("Location: ../index.php");
    exit();
}


$sql = "SELECT * FROM aktivitet ORDER BY data ASC";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitetet</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#efefef;
        }

        .dashboard{
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:250px;
            background:#381a73;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
            padding:40px 0;
        }

        .profile-section{
            text-align:center;
            color:white;
            
        }

        .profile-image{
            width:80px;
            margin-bottom:10px;
        }

        .profile-section p{
            font-size:24px;
            line-height:1.3;
        }

        .menu{
            display:flex;
            flex-direction:column;
            margin-top:40px;
        }

        .item{
            display:flex;
            align-items:center;
            gap:15px;
            padding:18px 25px;
            text-decoration:none;
            color:white;
            transition:0.3s;
        }

        .item:hover{
            background:#5a35a5;
        }

        .item img{
            width:28px;
            height:28px;
        }

        .item.active{
            background:#b9a5dd;
        }

        .logout-btn{
            display:flex;
            align-items:center;
            gap:12px;
            color:white;
            text-decoration:none;
            padding:20px 25px;
        }

        .logout-btn img{
            width:24px;
        }


        .content{
            flex:1;
            padding:25px;
            
        }

        

        .top-box{
            background:white;
            border-radius:18px;
            padding:20px 30px;
            box-shadow:0 2px 10px rgba(0,0,0,0.15);
            display:flex;
            align-items:center;
            gap:15px;
            margin-bottom:25px;
            width:1300px;
            margin:0 auto;
            margin-bottom:20px;
        }

        .top-box img{
            width:35px;
        }

        .top-box h2{
            font-size:24px;
            font-weight:600;
            font-size:32px;
           color:#32146b;
        }
        

        

        .table-box{
            background:white;
            border-radius:18px;
            box-shadow:0 2px 10px rgba(0,0,0,0.15);
            padding:25px;
            min-height:700px;
            width:1300px;
            margin:0 auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
           border:1px solid #dddddd;
            padding:10px;
            text-align:left;
            font-size:16px;
            font-weight:600;
            background:#4a1d84;
            color:white;
        }

        td{
          border:1px solid #eee;
          padding:10px;
          font-size:16px;
          vertical-align:top;
          line-height:1.4;
        }

        tr:hover{
            background:#f7f7f7;
        }

        

        .table-responsive{
            overflow-x:auto;
        }

    </style>
</head>
<body>

<div class="dashboard">

    
    <aside class="sidebar">

        <div>

            <div class="profile-section">
                <img src="../assets/images/teacher/icons8-male-user-90.png"
                     class="profile-image">

                <p> Mireseerdhe<br> mesues!</p>
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

                <a href="detyrat.php" class="item">
                    <img src="../assets/images/teacher/icons8-home-30 (1).png">
                    <span>Detyrat</span>
                </a>

                <a href="orariT.php" class="item">
                    <img src="../assets/images/teacher/icons8-schedule-50 (3).png">
                    <span>Orari</span>
                </a>

                <a href="aktivitetet.php" class="item active">
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

            </nav>

        </div>

        <a href="../index.php" class="logout-btn">
            <img src="../assets/images/teacher/icons8-log-out-50.png">
            <span>Dil</span>
        </a>

    </aside>

    
    <div class="content">

        
        <div class="top-box">
            <img src="../assets/images/teacher/icons8-calendar-50.png">
            <h2>Lista e aktiviteteve te planifikuara!</h2>
        </div>

        
        <div class="table-box">

            <div class="table-responsive">

                <table>

                    <thead>
                        <tr>
                            <th>Titulli</th>
                            <th>Kategoria</th>
                            <th>Data</th>
                            <th>Përshkrimi</th>
                            <th>Ambienti</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_assoc($result)){
                    ?>

                        <tr>
                            <td><?php echo $row["titull"]; ?></td>
                            <td><?php echo $row["kategoria"]; ?></td>
                            <td><?php echo $row["data"]; ?></td>
                            <td><?php echo $row["content"]; ?></td>
                            <td><?php echo $row["ambient"]; ?></td>
                        </tr>

                    <?php
                        }
                    } else {
                    ?>

                        <tr>
                            <td colspan="5">Nuk ka aktivitete të regjistruara.</td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>