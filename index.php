<?php
    include 'config/db.php';
    session_start();

    if(isset($_POST['butoni'])){
        $email=$_POST['userEmail'];
        $pass=$_POST['pass'];
        $sql="SELECT * FROM users WHERE email='$email'";
        $connectionResult=mysqli_query($connection,$sql);
        if(mysqli_num_rows($connectionResult)>0){
            $users=mysqli_fetch_assoc($connectionResult);
            if(password_verify($pass,$users['fjalekalim'])){
                $_SESSION['role']=$users['role'];
                $_SESSION['id']=$users['reference_id'];
                
                if($users['role']=='admin'){
                    header("Location: admin/adminDashboard.php");
                }
                else if($users['role']=="mesues"){
                    header("Location: teacher/teacherDashboard.php");
                }
                else{
                    header("Location: parent/parentDashboard.php");
                }
                exit();
            }
            else{
                echo "<script>alert('Fjalekalim gabim!');</script>";
            }
        }
        else{
            echo "<script>alert('Email i vendosur eshte gabim!');</script>";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="sq">
    <head>
        <title>Platforma EEMS</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="logincontainer">
            <div class="loginImage">
                <img src="assets/images/admin/icons8-person-96.png">
            </div>
            <div class="loginContent">
                <form method="POST" class="formaRegjistrimit">
                    <div class="inputGroup">
                        <div class="inputi">
                            <div class="inputPhoto">
                                <img src="assets/images/admin/icons8-person-64%20(1).png">
                            </div>
                            <input type="email" name="userEmail" placeholder="Email" required>
                        </div>
                        <div class="inputi">
                            <div class="inputPhoto">
                                <img src="assets/images/admin/icons8-password-100.png">
                            </div>
                            <input type="password" name="pass" placeholder="Fjalekalimi" required>
                        </div>
                    </div>
                    <div class="btn">
                        <button name="butoni" class="btn">Kycu</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
