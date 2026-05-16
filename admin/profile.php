<?php 
include '../config/db.php';
error_reporting(0);
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}
$userId=$_SESSION['id'];

$nameData="SELECT * FROM admin WHERE id=$userId";
$sqlname=mysqli_query($connection,$nameData);
$nameResult=mysqli_fetch_assoc($sqlname);
$name=$nameResult['emri'];
//$nrtel=$nameResult['nrTel'];
//$email=$nameResult['email'];
//$datelindja=$nameResult['datelindja'];
//$gjinia=$nameResult['gjinia'];
?>
<!DOCTYPE html>
<html lang="sq">
    <head>
        <link rel="stylesheet" href="adminDStyle.css">
        <title>Profile</title>
    </head>
    <body>
        <div class="menu">
            <div class="greetings">
                <img src="../assets/images/admin/icons8-admin-96%20(1).png">
                <h1>Miresevjen,<span><?php echo $name;?>!</span></h1>
            </div>
            <div class="menuitems">
                <ul class="elements">
                    <li class="activeElement">
                        <a href="adminDashboard.php"><img src="../assets/images/admin/icons8-dashboard-96%20(1).png"><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="studentRegistration.php"><img src="../assets/images/admin/icons8-student-100.png"><span>Nxenes</span>
                        <img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                    </li>
                    <li>
                        <a href="teacherRegistration.php"><img src="../assets/images/admin/icons8-teacher-100.png"><span>Mesues</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                    </li>
                    <li>
                        <a href="parentRegistration.php"><img src="../assets/images/admin/icons8-parent-90.png"><span>Prinder</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                    </li>
                    <li>
                        <a href="classRegistration.php"><img src="../assets/images/admin/icons8-class-100.png"><span>Klasa</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                    </li>
                    <li>
                        <a href="payment.php"><img src="../assets/images/admin/icons8-money-100.png"><span>Pagesa</span></a>
                    </li>
                    <li>
                        <a href="activities.php"><img src="../assets/images/admin/icons8-calendar-100.png"><span>Aktivitet</span></a>
                    </li>
                    <li>
                        <a href="email.php"><img src="../assets/images/admin/icons8-email-96.png"><span>Email</span></a>
                    </li>
                    <li>
                        <a href="profile.php"><img src="../assets/images/admin/icons8-profile-100.png"><span>Profili</span></a>
                    </li>
                    <li class="logout">
                        <a href="logout.php"><img src="../assets/images/admin/icons8-logout-rounded-100.png"><span>Dil</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="pageTitle">
                <img src="../assets/images/admin/icons8-dashboard-96%20(2).png">
                <div class="titleContent">
                    <h1>Profili im</h1>
                    <p>Paraqitje e te dhenave personale</p>
                </div>
            </div>
            <div class="pageContent con">
                <div class="profiledis">
                <div class="impInf">
                    <div class="imagecontainer">
                        <img src="../assets/images/admin/icons8-administrator-male-94.png">
                    </div>
                    <h1><?php echo $name?></h1>
                </div>
                <div class="otherdata">
                    <table border="1">
                        <thead>
                        <tr>
                            <th class="clickedButton"><button>Informacioni</button></th>
                            <th><button>Ndrysho fjalekalim</button></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Emer Mbiemer:</td>
                            <td><?php echo $name ?></td>
                        </tr>
                        <tr>
                            <td>Numer telefoni:</td>
                            <td><?php echo $nrtel ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                            <td>Datelindja:</td>
                            <td><?php echo $datelindja ?></td>
                        </tr>
                        <tr>
                            <td>Gjinia:</td>
                            <td><?php echo $gjinia ?></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
</script>
</html>