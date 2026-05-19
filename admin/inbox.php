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

$emailData="SELECT email FROM admin WHERE id=$userId";
$sqlemail=mysqli_query($connection,$emailData);
$emailResult=mysqli_fetch_assoc($sqlemail);
$email=$emailResult['email'];

$numri="SELECT COUNT(*) AS totalemail FROM admin WHERE email='$email'";
$numriquery=mysqli_query($connection,$numri);
$total=mysqli_fetch_assoc($numriquery);
$totalmail=$total['totalemail'];

$emailquery="SELECT * FROM mail WHERE marresi='$email'";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchinput = mysqli_real_escape_string($connection, $_GET['search']);

    $emailquery .= " AND (subject LIKE '%$searchinput%' 
                      OR body LIKE '%$searchinput%' 
                      OR derguesi LIKE '%$searchinput%')";
}

$emailquery .= " ORDER BY data DESC";

$emailresult = mysqli_query($connection, $emailquery);
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
                    <li>
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
                    <li class="activeElement">
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
                    <h1>Mailbox</h1>
                    <p>Komunikimi me mesuesit ose prinderit</p>
                </div>
            </div>
            <div class="pageContent con">
                <div class="inboxcontainer">
                <div class="inboxbtn">
                    <button type="button"><a href="email.php">Compose</a></button>
                </div>
                <div class="inbox">
                    <div class="searchemail">
                        <h1>Inbox</h1>
                        <form method="GET" id="formsubmit">
                        <input type="text" id="searchname" name="search"placeholder="Kerko email">
                        <button type="submit"><img src="../assets/images/admin/icons8-search-100.png"></button>
                        </form>
                    </div>
                    <div class="emailnumber">
                        <h1>Total: <?php 
                             echo $totalmail;
                            ?></h1>
                    </div>
                    <table>
                        <tbody>
                            <?php while($emaildata=mysqli_fetch_assoc($emailresult)){ ?>
                            <tr>
                                <td><?php echo $emaildata['derguesi'] ?></td>
                                <td><?php echo $emaildata['subject'] ?> <br> <?php echo $emaildata['body'] ?></td>
                                <td><?php echo $emaildata['data'] ?></td>
                            
                            </tr>
                            <?php } ?>
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