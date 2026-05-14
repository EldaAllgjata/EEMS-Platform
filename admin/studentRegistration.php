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

$classData="SELECT klasaId, emer FROM klasa";
$sqlClass=mysqli_query($connection,$classData);

if(isset($_POST['register'])){
    $emri=$_POST['emriNxenes'];
    $gjinia=$_POST['gjinia'];
    $datelindja=$_POST['data'];
    $numri=$_POST['numritel'];
    $email=$_POST['email'];
    $prindi=$_POST['prindi'];
    $klasa=$_POST['klasa'];
    $viti=$_POST['viti'];
    $nrpersonal=$_POST['nrpersonal'];
    $prindid="SELECT prind_id FROM prinder WHERE emerMbiemer='$prindi'";
    $sqlprindID=mysqli_query($connection,$prindid);
    $resultprind=mysqli_fetch_assoc($sqlprindID);
    $IDprind=$resultprind['prind_id'];
    
    if(empty($emri) || empty($gjinia) || empty($datelindja) || empty($numri) || empty($email) || empty($prindi) || empty($klasa) || empty($viti) || empty($nrpersonal) || empty($IDprind)){
        echo "<script>alert('Ju lutem plotesoni te gjithe fushat!');";
    }
    else{
        $sqlcontrol="SELECT emerMbiemer FROM nxenes WHERE emerMbiemer='$emri'";
        $controlquery=mysqli_query($connection,$sqlcontrol);
        
        if(mysqli_num_rows($controlquery)==0){
            $sqlinsert="INSERT INTO nxenes (emerMbiemer, gjinia, datelindja, nrTel, email, prindID, klasID, vitiStudimit, nrID) VALUES ('$emri','$gjinia','$datelindja','$numri','$email', '$IDprind', '$klasa', '$viti','$nrpersonal')";
             $insertquery=mysqli_query($connection,$sqlinsert);
    
            if($insertquery){
                echo "<script> alert('Nxenesi u regjistrua me sukses!'); </script>";
            }
            else{
                echo "<script> alert('Gabim ne regjistrim!');</script>";
            }
        }
        else{
            echo "<script>alert('Nxenesi eshte i regjistruar me pare!');</script>";
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
                <li class="activeElement" onclick="modifymenu(this)">
                    <div class="menuItem">
                        <img src="../assets/images/admin/icons8-student-100.png"><span>Nxenes</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon">
                    </div>
                    <ul class="submenu">
                        <li><a href="studentRegistration.php">Shto nxenes</a></li>
                        <li><a href="viewStudents.php">Modifiko nxenes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="adminDashboard.php"><img src="../assets/images/admin/icons8-teacher-100.png"><span>Mesues</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                </li>
                <li>
                    <a href="adminDashboard.php"><img src="../assets/images/admin/icons8-parent-90.png"><span>Prinder</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                </li>
                <li>
                    <a href="adminDashboard.php"><img src="../assets/images/admin/icons8-class-100.png"><span>Klasa</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                </li>
                <li>
                    <a href="adminDashboard.php"><img src="../assets/images/admin/icons8-money-100.png"><span>Pagesa</span><img src="../assets/images/admin/icons8-expand-arrow-100.png" class="arrow-icon"></a>
                </li>
                <li>
                    <a href="adminDashboard.php"><img src="../assets/images/admin/icons8-calendar-100.png"><span>Aktivitet</span></a>
                </li>
                <li>
                    <a href="adminDashboard.php"><img src="../assets/images/admin/icons8-email-96.png"><span>Email</span></a>
                </li>
                <li>
                    <a href="adminDashboard.php"><img src="../assets/images/admin/icons8-profile-100.png"><span>Profili</span></a>
                </li>
                <li class="logout">
                    <a href="adminDashboard.php"><img src="../assets/images/admin/icons8-logout-rounded-100.png"><span>Dil</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="pageTitle">
            <img src="../assets/images/admin/icons8-dashboard-96%20(2).png">
            <div class="titleContent">
                <h1>Regjistrimi nxenesve</h1>
                <p>Plotesimi i te gjithe te dhenave per nje nxenes te ri </p>
            </div>
        </div>
        <div class="pageContent con">
            <form method="post">
                <div class="pageTitle diff">
                    <img src="../assets/images/admin/icons8-information-100%20(1).png">
                    <div class="titleContent">
                        <h1>Te dhena te pergjithshme</h1>
                        <p>Te dhenat personale te nje nxenesi</p>
                    </div>
                </div>
                <div class="inputcontainer">
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-name-96.png">
                            <h1>Emer Mbiemer</h1>
                        </div>
                        <input type="text" placeholder="Vendos emrin e plote" name="emriNxenes">
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
                            <img src="../assets/images/admin/icons8-parent-96%20(1).png">
                            <h1>Prindi</h1>
                        </div>
                        <input type="text" placeholder="Vendos emrin e plote te prindit" name="prindi">
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-id-verified-100%20(2).png">
                            <h1>Numri personal(ID)</h1>
                        </div>
                        <input type="text" placeholder="Vendos numrin personal" name="nrpersonal">
                    </div>
                </div>
                <div class="pageTitle diff" style="margin-top:20px;">
                    <img src="../assets/images/admin/icons8-academy-100.png">
                    <div class="titleContent">
                        <h1>Te dhena akademike</h1>
                        <p>Te dhenat akademike te nxenesit</p>
                    </div>
                </div>
                <div class="inputcontainer">
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-class-100%20(1).png">
                            <h1>Klasa</h1>
                        </div>
                        <select name="klasa">
                            <?php while($class=mysqli_fetch_assoc($sqlClass)) { ?>
                            <option value="<?php echo $class['klasaId'] ?>"> <?php echo $class['emer'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="inputs">
                        <div class="info">
                            <img src="../assets/images/admin/icons8-plus-1-year-80.png">
                            <h1>Viti i studimit</h1>
                        </div>
                        <input type="date" name="viti">
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