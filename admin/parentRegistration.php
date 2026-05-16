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

if(isset($_POST['register'])){
    $emri=$_POST['emriPrind'];
    $gjinia=$_POST['gjinia'];
    $datelindja=$_POST['data'];
    $numri=$_POST['numritel'];
    $email=$_POST['email'];
    $fjalekalimi=$_POST['fjalekalimi'];
    
    if(empty($emri) || empty($gjinia) || empty($datelindja) || empty($numri) || empty($email) || empty($fjalekalimi)){
        echo "<script>alert('Ju lutem plotesoni te gjithe fushat!');</script>";
    }
    else{
        $fjalekalimi=password_hash($_POST['fjalekalimi'],PASSWORD_DEFAULT);
        $sqlcontrol="SELECT emerMbiemer FROM prinder WHERE emerMbiemer='$emri'";
        $controlquery=mysqli_query($connection,$sqlcontrol);
        
        if(mysqli_num_rows($controlquery)==0){
            $sqlinsert="INSERT INTO prinder (emerMbiemer, gjinia, datelindja, nrTel, email, fjalekalimFillestare) VALUES ('$emri','$gjinia','$datelindja','$numri','$email', '$fjalekalimi')";
             $insertquery=mysqli_query($connection,$sqlinsert);
            
            if($insertquery){
                echo "<script> alert('Prindi u regjistrua me sukses!'); </script>";
            }
            else{
                echo "<script> alert('Gabim ne regjistrim!');</script>";
            }
        }
        else{
            echo "<script>alert('Prindi eshte i regjistruar me pare!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="sq">

<head>
    <link rel="stylesheet" href="adminDStyle.css">
    <title>Regjistrimi nxenesve</title>
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
                    <a href="studentRegistration.php"><img src="../assets/images/admin/icons8-student-100.png"><span>Nxenes</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                </li>
                <li>
                    <a href="teacherRegistration.php"><img src="../assets/images/admin/icons8-teacher-100.png"><span>Mesues</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                </li>
                <li class="activeElement" onclick="modifymenu(this)">
                      <div class="menuItem">
                        <img src="../assets/images/admin/icons8-parent-90.png"><span>Prinder</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon">
                    </div>
                    <ul class="submenu">
                        <li><a href="parentRegistration.php">Shto prind</a></li>
                        <li><a href="viewParent.php">Modifiko prind</a></li>
                    </ul>
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
                <h1>Regjistrimi prinderve</h1>
                <p>Plotesimi i te gjithe te dhenave per nje prind te ri </p>
            </div>
        </div>
        <div class="pageContent con">
            <form method="post">
                <div class="pageTitle diff">
                    <img src="../assets/images/admin/icons8-information-100%20(1).png">
                    <div class="titleContent">
                        <h1>Te dhena te pergjithshme</h1>
                        <p>Te dhenat personale te nje prindi</p>
                    </div>
                </div>
                <div class="inputcontainer">
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-name-96.png">
                            <h1>Emer Mbiemer</h1>
                        </div>
                        <input type="text" placeholder="Vendos emrin e plote" name="emriPrind">
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-gender-64.png">
                            <h1>Gjinia</h1>
                        </div>
                        <select name="gjinia">
                            <option value="Femër">Femer</option>
                            <option value="Mashkull">Mashkull</option>
                        </select>
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-age-100.png">
                            <h1>Datelindja</h1>
                        </div>
                        <input type="date" name="data">
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-phone-100%20(1).png">
                            <h1>Numri i telefonit</h1>
                        </div>
                        <input type="number" placeholder="06********" name="numritel">
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-email-100.png">
                            <h1>Email</h1>
                        </div>
                        <input type="email" placeholder="Vendos adresen e email-it" name="email">
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-password-100.png">
                            <h1>Fjalekalimi fillestare</h1>
                        </div>
                        <input type="text" placeholder="Vendos fjalekalimin fillestare" name="fjalekalimi">
                    </div>
                </div>
                <div class="buttoncontainer">
                    <button type="submit" name="register">Regjistro</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function modifymenu(li) {
            const submenu = li.parentElement.querySelector(".submenu");
            if (submenu.style.display === "flex") {
                submenu.style.display = "none";
            } else {
                submenu.style.display = "flex";
            }
        }
    </script>
</body>

</html>