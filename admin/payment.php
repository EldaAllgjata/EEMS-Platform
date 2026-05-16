<?php 
include '../config/db.php';
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

$paymentquery="SELECT COUNT(*) AS total, SUM(shuma) AS shumatotal FROM pagesat";
$paymentresult=mysqli_query($connection,$paymentquery);
$payment=mysqli_fetch_assoc($paymentresult);

$confirmedquery=("SELECT COUNT(*) AS konfirmuar FROM pagesat WHERE statusi='Paguar'");
$confirmedresult=mysqli_query($connection,$confirmedquery);
$confirmed=mysqli_fetch_assoc($confirmedresult);

$classquery="SELECT klasaID, emer FROM klasa";
$queryresult=mysqli_query($connection,$classquery);

$yearquery="SELECT DISTINCT YEAR(dataPageses) AS viti FROM pagesat";
$yearresult=mysqli_query($connection,$yearquery);
$sqlsearch="SELECT * FROM pagesat WHERE 1=1";

if(isset($_GET['search']) && !empty($_GET['search'])){
    $searchinput=$_GET['search'];
    $emriquery="SELECT nxenesID, emerMbiemer FROM nxenes WHERE emerMbiemer='$searchinput'";
    $emriquery="SELECT nxenesID, emerMbiemer 
                FROM nxenes 
                WHERE emerMbiemer LIKE '%$searchinput%'";

    $emriresult=mysqli_query($connection,$emriquery);

    if(mysqli_num_rows($emriresult) > 0){

        $emri=mysqli_fetch_assoc($emriresult);

        $emridata=$emri['nxenesID'];

        $sqlsearch.=" AND studentID=$emridata";
    }
}
if(isset($_GET['class']) && !empty($_GET['class'])){
    $classinput=(int)$_GET['class'];
    $sqlsearch.=" AND klasID=$classinput";
}
if(isset($_GET['schoolyear']) && !empty($_GET['schoolyear'])){
    $schoolinput=$_GET['schoolyear'];
    $sqlsearch.=" AND year(dataPageses)=$schoolinput";
}

$sqlSearchResult=mysqli_query($connection,$sqlsearch);
?>
<!DOCTYPE html>
<html lang="sq">

<head>
    <link rel="stylesheet" href="adminDStyle.css">
    <title>Tabela e nxenesve</title>
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
                    <a href="studentRegistration.php"><img src="../assets/images/admin/icons8-student-100.png"><span>Nxenes</span></a>
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
                <li class="activeElement" onclick="modifymenu(this)">
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
                <h1>Pagesat</h1>
                <p>Shiko te dhenat e pagesave</p>
            </div>
        </div>
        <div class="data">
                    <div class="schoolYear">
                        <img src="../assets/images/admin/icons8-money-100%20(2).png">
                        <div class="dataType">
                            <h1>Pagesa totale</h1>
                            <p><?php echo $payment['total'];?></p>
                        </div>
                        <img class="blurphoto" src="../assets/images/admin/icons8-money-100%20(3).png">
                    </div>
                    <div class="teacher">
                        <img src="../assets/images/admin/icons8-money-100%20(1).png">
                        <div class="dataType">
                            <h1>Vlera totale</h1>
                            <p><?php echo $payment['shumatotal']; ?></p>
                        </div>
                        <img class="blurphoto" src="../assets/images/admin/icons8-money-100.png">
                    </div>
                    <div class="parent">
                        <img src="../assets/images/admin/icons8-done-100.png">
                        <div class="dataType">
                            <h1>Te konfirmuara</h1>
                            <p><?php echo $confirmed['konfirmuar']; ?></p>
                        </div>
                        <img class="blurphoto" src="../assets/images/admin/icons8-confirmed-100.png">
                    </div>
                </div>
        <div class="pageContent con">
            
            <form method="GET" class="kerkimi" id="formsubmit">
                <input type="text" id="searchname" name="search" placeholder="Kerko nxenes">
                <select name="class" id="class">
                    <option value="">Zgjidh klasen</option>
                    <?php while($result=mysqli_fetch_assoc($queryresult)){ ?>
                    <option value="<?php echo $result['klasaID']?>"><?php echo $result['emer']?></option>
                    <?php } ?>
                </select>
                <select name="schoolyear" id="year">
                    <option value="">Zgjidh vitin </option>
                    <?php while($result=mysqli_fetch_assoc($yearresult)){ ?>
                    <option value="<?php echo $result['viti']?>"><?php echo $result['viti']?></option>
                    <?php } ?>
                </select>
                <button type="submit"><img src="../assets/images/admin/icons8-search-100.png"></button>
            </form>
            <table border="1">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nxenesi</th>
                        <th>Shuma</th>
                        <th>Paguesi</th>
                        <th>Statusi</th>
                        <th>Transaction ID</th>
                        <th>Metoda</th>
                        <th>Klasa</th>
                        <th>Viti</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($payment=mysqli_fetch_assoc($sqlSearchResult)){ ?>
                    <tr>
                        <td><?php echo $payment['id']?></td>
                        <td><?php 
                                $student=$payment['studentID'];
                                $studentquery="SELECT emerMbiemer FROM nxenes WHERE nxenesID=$student";
                                $studentresult=mysqli_query($connection,$studentquery);
                                $studentname=mysqli_fetch_assoc($studentresult);
                                echo $studentname['emerMbiemer'];
                            ?>
                        </td>
                        <td><?php echo $payment['shuma']?></td>
                        <td><?php 
                                $parent=$payment['prindID'];
                                $parentquery="SELECT emerMbiemer FROM prinder WHERE prind_id=$parent";
                                $parentresult=mysqli_query($connection,$parentquery);
                                $parentname=mysqli_fetch_assoc($parentresult);
                                echo $parentname['emerMbiemer'];
                            ?>
                        </td>
                        <td><?php echo $payment['statusi']?></td>
                        <td><?php echo $payment['transactionID']?></td>
                        <td><?php echo $payment['metodaPageses']?></td>
                        <td><?php 
                                $class=$payment['klasID'];
                                $classquery="SELECT emer FROM klasa WHERE klasaID=$class";
                                $classresult=mysqli_query($connection,$classquery);
                                $classname=mysqli_fetch_assoc($classresult);
                                echo $classname['emer'];
                            ?>
                        </td>
                        <td><?php echo $payment['dataPageses']?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const inputsearch = document.getElementById("searchname");
        const classsearch = document.getElementById("class");
        const yearsearch = document.getElementById("year");
        const forma = document.getElementById("formsubmit");
        inputsearch.addEventListener("searchname", function() {
            if (this.value.trim() === "") {
                forma.submit();
            }
        });
    </script>
</body>

</html>