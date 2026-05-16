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

$subjectData="SELECT id, emri FROM lenda";
$sqlSubject=mysqli_query($connection,$subjectData);

$teacherData="SELECT mesuesID, emerMbiemer FROM mesues";
$sqlTeacher=mysqli_query($connection,$teacherData);

if(isset($_POST['register'])){
    $klasa=$_POST['klasa'];
    $lendet=$_POST['lenda'];
    $mesues=$_POST['mesuesit'];
    
    if(empty($klasa) || empty($lendet) || empty($mesues) ){
        echo "<script>alert('Ju lutem plotesoni te gjithe fushat!');</script>";
    }
    else{
        $sqlcontrol="SELECT emer FROM klasa WHERE emer='$klasa'";
        $controlquery=mysqli_query($connection,$sqlcontrol);
        
        if(mysqli_num_rows($controlquery)==0){
            $sqlinsert="INSERT INTO klasa (emer) VALUES ('$klasa')";
            $insertquery=mysqli_query($connection,$sqlinsert);
            $klasaID = mysqli_insert_id($connection);
            
            $lendet=$_POST['lenda'];
            $mesues=$_POST['mesuesit'];
            
            if(isset($_POST['lende_extra']) && isset($_POST['mesues_extra'])){

            $extraLendet = $_POST['lende_extra'];
            $extraMesues = $_POST['mesues_extra'];

            for($i = 0; $i < count($extraLendet); $i++){

            $l = $extraLendet[$i];
            $m = $extraMesues[$i];

            $sqlExtra = "INSERT INTO lidhjamesues (mesuesID, klasID, lendaID)
                     VALUES ('$m','$klasaID','$l')";

            mysqli_query($connection,$sqlExtra);
            }
            }
            if($insertquery){
                echo "<script> alert('Klasa u regjistrua me sukses!'); </script>";
            }
            else{
                echo "<script> alert('Gabim ne regjistrim!');</script>";
            }
        }
        else{
            echo "<script>alert('Klasa eshte e regjistruar me pare!');</script>";
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
                <li>
                    <a href="parentRegistration.php"><img src="../assets/images/admin/icons8-parent-90.png"><span>Prinder</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                </li>
                <li  class="activeElement" onclick="modifymenu(this)">
                    <div class="menuItem">
                        <img src="../assets/images/admin/icons8-class-100.png"><span>Klasa</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon">
                    </div>
                    <ul class="submenu">
                        <li><a href="classRegistration.php">Shto klase</a></li>
                        <li><a href="viewClass.php">Modifiko klase</a></li>
                    </ul>
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
                <h1>Regjistrimi klasave</h1>
                <p>Plotesimi i te gjithe te dhenave per nje klase</p>
            </div>
        </div>
        <div class="pageContent con">
            <form method="post">
                <div class="pageTitle diff">
                    <img src="../assets/images/admin/icons8-information-100%20(1).png">
                    <div class="titleContent">
                        <h1>Te dhena</h1>
                        <p>Te dhenat e klases</p>
                    </div>
                </div>
                <div class="inputcontainer">
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-class-100%20(1).png">
                            <h1>Klasa</h1>
                        </div>
                        <input type="text" name="klasa">
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-plus-1-year-80.png">
                            <h1>Lendet qe ofrohen</h1>
                        </div>
                        <select name="lenda">
                            <?php while($subject=mysqli_fetch_assoc($sqlSubject)) { ?>
                            <option value="<?php echo $subject['id'] ?>"> <?php echo $subject['emri'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-plus-1-year-80.png">
                            <h1>Mesuesit</h1>
                        </div>
                        <select name="mesuesit">
                            <?php while($teacher=mysqli_fetch_assoc($sqlTeacher)) { ?>
                            <option value="<?php echo $teacher['mesuesID'] ?>"> <?php echo $teacher['emerMbiemer'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="template" style="display:none;">
                        <div class="inputcontainer extra-block">
                            <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-plus-1-year-80.png">
                            <h1>Lendet qe ofrohen</h1>
                        </div>
                        <select name="lende_extra[]">
                                    <?php
                                        $subjectData="SELECT id, emri FROM lenda";
                            $sqlSubject=mysqli_query($connection,$subjectData);
                                        while($subject=mysqli_fetch_assoc($sqlSubject)) { ?>
                                    <option value="<?php echo $subject['id'] ?>">
                                        <?php echo $subject['emri'] ?>
                                    </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-plus-1-year-80.png">
                            <h1>Mesuesit</h1>
                        </div>
                        <select name="mesues_extra[]">
                                    <?php
                                        $teacherData="SELECT mesuesID, emerMbiemer FROM mesues";
                                         $sqlTeacher=mysqli_query($connection,$teacherData);
                                         while($teacher=mysqli_fetch_assoc($sqlTeacher)) { ?>
                                    <option value="<?php echo $teacher['mesuesID'] ?>">
                                        <?php echo $teacher['emerMbiemer'] ?>
                                    </option>
                                    <?php } ?>
                        </select>
                    </div>
                    </div>
                    </div>
                    <button type="button" class="addbutton" onclick="shfaqPerseri()">Vendos me shume +</button>
                    <div id="dynamicContainer"></div>
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
    
    function shfaqPerseri() {
        let template = document.getElementById("template").innerHTML;
         document.getElementById("dynamicContainer").insertAdjacentHTML("beforeend", template);
    }
    </script>
</body>
</html>