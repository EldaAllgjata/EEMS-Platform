<?php 
include '../config/db.php';
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}
$userId=$_SESSION['id'];

$nameData="SELECT * FROM admin WHERE id=$userId";
$sqlname=mysqli_query($connection,$nameData);
$nameResult=mysqli_fetch_assoc($sqlname);
$idadmin=$nameResult['id'];
$name=$nameResult['emri'];
$nrtel=$nameResult['nrTel'];
$email=$nameResult['email'];
$datelindja=$nameResult['datelindja'];
$gjinia=$nameResult['gjinia'];

if(isset($_POST['ruaj'])){
    $firstpass=$_POST['fjalekalimi'];
    $newpass=$_POST['fjalekalimiRi'];
    $reppass=$_POST['perseritfjalekalim'];
    if(password_verify($firstpass,$nameResult['fjalekalim']) && $newpass==$reppass){
        $newpasshash=password_hash($_POST['fjalekalimiRi'], PASSWORD_DEFAULT);    
        $sqluser="UPDATE users SET fjalekalim='$newpasshash' WHERE reference_id=$userId";
        $userupdate=mysqli_query($connection,$sqluser);
        if($userupdate){
            echo "<script>alert('Fjalekalimi u ndryshuar me sukses!');</script>" ;
        }
        else{
            echo "<script>alert('Gabim');</script>" ;
        }
    }
    else{
        echo "<script>alert('Te dhenat jane gabim!');</script>" ;
    }
}
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
                    <li>
                        <a href="inbox.php"><img src="../assets/images/admin/icons8-email-96.png"><span>Email</span></a>
                    </li>
                    <li class="activeElement">
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
                        <div class="profilebutton">
                            <button type="button" onclick="opentable()" class="clicked">Informacioni </button>
                            <button type="button" onclick="openpass()">Ndrysho fjalekalim</button>
                        </div>
                    <div class="tablecontainer" id="tablecontent">
                    <table>
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
                    <div class="passcontainer" id="passcontent">
                        <form method="post">
                            <div class="passinput">
                                <label>Fjalekalimi aktual</label>
                                <input type="password" name="fjalekalimi" placeholder="********">
                            </div>
                            <div class="passinput">
                                <label>Fjalekalimi i ri</label>
                                <input type="password" name="fjalekalimiRi" placeholder="********">
                            </div>
                            <div class="passinput">
                                <label>Perserit fjalekalimin</label>
                                <input type="password" name="perseritfjalekalim" placeholder="********">
                            </div>
                            <div class="butonipass">
                                <button type="submit" name="ruaj">Ndrysho</button>
                            </div>
                        </form>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        const buttons=document.querySelectorAll('.profilebutton button');
        function opentable(){
            document.getElementById('tablecontent').style.display='block';
            document.getElementById('passcontent').style.display='none';
            
            buttons[0].classList.add('clicked');
            buttons[1].classList.remove('clicked');
        }
        function openpass(){
            document.getElementById('tablecontent').style.display='none';
            document.getElementById('passcontent').style.display='block';
            
            buttons[0].classList.remove('clicked');
            buttons[1].classList.add('clicked');
        }
</script>
</html>