<?php 
include '../config/db.php';
error_reporting(0);
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}
$userId=$_SESSION['id'];

$nameData="SELECT emri FROM admin WHERE id=$userId";
$sqlname=mysqli_query($connection,$nameData);
$nameResult=mysqli_fetch_assoc($sqlname);
$name=$nameResult['emri'];

$girlsNumber="SELECT COUNT(*) FROM nxenes WHERE gjinia='Femër'";
$sqlgirls=mysqli_query($connection,$girlsNumber);
$girls=mysqli_fetch_assoc($sqlgirls);

$boysNumber="SELECT COUNT(*) FROM nxenes WHERE gjinia='Mashkull'";
$sqlBoys=mysqli_query($connection,$boysNumber);
$boys=mysqli_fetch_assoc($sqlBoys);

$total = $girls['COUNT(*)'] + $boys['COUNT(*)'];
if($total == 0){
    $girlsPercent = 0;
    $boysPercent = 0;
} else {
    $girlsPercent = ($girls['COUNT(*)'] / $total) * 100;
    $boysPercent = ($boys['COUNT(*)'] / $total) * 100;
}

$days=['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
$payment=[];

foreach($days as $day){
    $query="SELECT SUM(shuma) AS total FROM pagesat WHERE DAYNAME(dataPageses)='$day'";
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($result);
    if($row['total']!=NULL){
        $payment[]=$row['total'];
    }
    else{
        $payment[]=0;
    }
}
$teacherNumber="SELECT COUNT(*) AS total FROM mesues";
$sqlteacher=mysqli_query($connection,$teacherNumber);
$teacher=mysqli_fetch_assoc($sqlteacher);

$parentNumber="SELECT COUNT(*) AS total FROM prinder";
$sqlparent=mysqli_query($connection,$parentNumber);
$parent=mysqli_fetch_assoc($sqlparent);

$studentNumber="SELECT COUNT(*) AS total FROM nxenes";
$sqlstudent=mysqli_query($connection,$studentNumber);
$student=mysqli_fetch_assoc($sqlstudent);

$paymentCountNumber="SELECT COUNT(*) AS total FROM pagesat";
$sqlpayment=mysqli_query($connection,$paymentCountNumber);
$paymentCount=mysqli_fetch_assoc($sqlpayment);

$classNumber="SELECT COUNT(*) AS total FROM klasa";
$sqlclass=mysqli_query($connection,$classNumber);
$class=mysqli_fetch_assoc($sqlclass);

$subjectNumber="SELECT COUNT(*) AS total FROM lenda";
$sqlSubject=mysqli_query($connection,$subjectNumber);
$subject=mysqli_fetch_assoc($sqlSubject);
?>
<!DOCTYPE html>
<html lang="sq">
    <head>
        <link rel="stylesheet" href="adminDStyle.css">
        <title>Admin Dashboard</title>
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
                        <a href="inbox.php"><img src="../assets/images/admin/icons8-email-96.png"><span>Email</span></a>
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
                    <h1>Dashboard</h1>
                    <p>Paraqitje e permbledhur e aktivitetit</p>
                </div>
            </div>
            <div class="pageContent">
                <div class="data">
                    <div class="schoolYear">
                        <img src="../assets/images/admin/icons8-new-year-calendar-100.png">
                        <div class="dataType">
                            <h1>Lende</h1>
                            <p><?php echo $subject['total'];?></p>
                        </div>
                        <img class="blurphoto" src="../assets/images/admin/icons8-calendar-100.png">
                    </div>
                    <div class="teacher">
                        <img src="../assets/images/admin/icons8-teacher-60.png">
                        <div class="dataType">
                            <h1>Mesues</h1>
                            <p><?php echo $teacher['total']; ?></p>
                        </div>
                        <img class="blurphoto" src="../assets/images/admin/icons8-teacher-100.png">
                    </div>
                    <div class="parent">
                        <img src="../assets/images/admin/icons8-parent-96.png">
                        <div class="dataType">
                            <h1>Prinder</h1>
                            <p><?php echo $parent['total']; ?></p>
                        </div>
                        <img class="blurphoto" src="../assets/images/admin/icons8-parent-90.png">
                    </div>
                    <div class="student">
                        <img src="../assets/images/admin/icons8-student-64.png">
                        <div class="dataType">
                            <h1>Nxenes</h1>
                            <p><?php echo $student['total']; ?></p>
                        </div>
                        <img class="blurphoto" src="../assets/images/admin/icons8-student-100.png">
                    </div>
                    <div class="payment">
                        <img src="../assets/images/admin/icons8-money-100%20(1).png">
                        <div class="dataType">
                            <h1>Pagesa</h1>
                            <p><?php echo $paymentCount['total']; ?></p>
                        </div>
                        <img class="blurphoto" src="../assets/images/admin/icons8-money-100.png">
                    </div>
                    <div class="class">
                        <img src="../assets/images/admin/icons8-classroom-64.png">
                        <div class="dataType">
                            <h1>Klasa</h1>
                            <p><?php echo $class['total']; ?></p>
                        </div>
                        <img class="blurphoto" src="../assets/images/admin/icons8-class-100.png">
                    </div>
                </div>
                <div class="graphicalData">
                    <div class="gjinia">
                        <div class="gDText">
                            <img src="../assets/images/admin/icons8-gender-96.png">
                            <div class="gDTitle">
                                <h1>Gjinia e nxenesve</h1>
                                <p>Raporti i nxenesve sipas gjinise</p>
                            </div>
                        </div>
                        <div class="raport">
                            <div class="girls">
                                <img src="../assets/images/admin/icons8-female-100.png">
                                <h1>Femra</h1>
                                <div class="progress">
                                    <div class="progressGirls" style="width: <?php echo $girlsPercent; ?>%">            
                                    </div>
                                </div>
                            </div>
                            <div class="boys">
                                <img src="../assets/images/admin/icons8-male-100.png">
                                <h1>Meshkuj</h1>
                                <div class="progress">
                                    <div class="progressBoys" style="width: <?php echo $boysPercent; ?>%">            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="paymentGraph">
                        <h1>Grafiku i pagesave sipas diteve</h1>
                        <canvas id="paymentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const element = document.getElementById('paymentChart');

        new Chart(element, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($days); ?>,
                datasets: [{
                    label: 'Pagesat',
                    data: <?php echo json_encode($payment); ?>,
                    borderColor: '#FF4DA6',
                    backgroundColor: 'rgba(255,77,166,0.2)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>
</html>