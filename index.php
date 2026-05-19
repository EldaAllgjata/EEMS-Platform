<?php
include 'config/db.php';
error_reporting(0);
session_start();

if(isset($_POST['butoni'])){

    $email = $_POST['userEmail'];
    $pass  = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $connectionResult = mysqli_query($connection, $sql);

    if(mysqli_num_rows($connectionResult) > 0){

        $users = mysqli_fetch_assoc($connectionResult);

        if(password_verify($pass, $users['fjalekalim'])){

            // SESSION
            $_SESSION['role'] = strtolower($users['role']);
            $_SESSION['id'] = $users['id'];

            $role = $_SESSION['role'];

            // REDIRECT
            if($role == 'admin'){
                header("Location: admin/adminDashboard.php");
            }
            else if($role == 'mesues'){
                header("Location: teacher/teacherDashboard.php");
            }
            else if($role == 'prind' || $role == 'parent'){
                header("Location: parent/parentSelectStudent.php");
            }
            else {
                die("Role i panjohur: " . $role);
            }

            exit();

        } else {
            echo "<script>alert('Fjalëkalim gabim!');</script>";
        }

    } else {
        echo "<script>alert('Email i vendosur është gabim!');</script>";
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
                        <img src="assets/images/admin/icons8-person-64 (1).png">
                    </div>
                    <input type="email" name="userEmail" placeholder="Email" required>
                </div>

                <div class="inputi">
                    <div class="inputPhoto">
                        <img src="assets/images/admin/icons8-password-100.png">
                    </div>
                    <input type="password" name="pass" placeholder="Fjalëkalimi" required>
                </div>

            </div>

            <div class="btn">
                <button type="submit" name="butoni" class="btn">
                    Kycu
                </button>
            </div>

        </form>

    </div>

</div>

</body>
</html>