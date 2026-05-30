<?php
include "../config/db.php";

session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['role'])){
    header("Location: ../index.php");
    exit();
}

if($_SESSION['role'] != 'parent'){
    header("Location: ../index.php");
    exit();
}

$userID = $_SESSION['id'];

$query = "
SELECT 
    nxenes.emerMbiemer,
    nxenes.nrID,
    klasa.emer AS emriKlases
FROM nxenes
INNER JOIN klasa 
    ON nxenes.klasID = klasa.klasaID
WHERE nxenes.prindID = '$userID'
";

$result = mysqli_query($connection, $query);

if(!$result){
    die("Query error: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>

<html lang="sq">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Zgjidh Nxënësin</title>

    <link rel="stylesheet" href="parent.css">

    <style>

        .parent-select-page{
            background:linear-gradient(110deg, #d8a4bf 0%, #6c97dd 100%);
            padding-top:50px;
        }

        .main-container{
            width:100%;
            max-width:1400px;
            margin:auto;
            padding-top:50px;
        }

        .header-button{
            background:#361c6d;
            color:white;
            border:none;
            border-radius:30px;
            padding:12px 30px;
            font-size:28px;
            margin-bottom:130px;
            display:block;
            margin-left:auto;
            margin-right:auto;
            text-align:center;
            position:relative;
            top:60px;
        }

        .cards-container{
            display:flex;
            flex-wrap:wrap;
            gap:50px;
            justify-content:center;
        }

        .student-card-wrapper{
            width:420px;
            position:relative;
        }

        .avatar-container{
            width:120px;
            height:120px;
            border-radius:50%;
            background:#361c6d;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
            position:relative;
            z-index:2;
            top:55px;
        }

        .avatar-image{
            width:70px;
            height:70px;
        }

        .student-card{
            background:rgba(255,255,255,0.3);
            border:2px solid white;
            border-radius:50px;
            padding:90px 35px 40px;
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        .input-wrapper{
            position:relative;
        }

        .input-icon{
            position:absolute;
            width:35px;
            height:35px;
            left:12px;
            top:50%;
            transform:translateY(-50%);
            background:#361c6d;
            padding:8px;
            border-radius:50%;
        }

        .student-input{
            width:100%;
            padding:16px 16px 16px 60px;
            border:none;
            border-radius:10px;
            background:#7a67a4;
            color:white;
            font-size:20px;
        }

        .view-button{
            display:inline-flex;
            justify-content:center;
            align-items:center;
            background:#361c6d;
            color:white;
            border:none;
            border-radius:30px;
            padding:12px 25px;
            font-size:24px;
            margin-top:20px;
            cursor:pointer;
            text-decoration:none;
            transition:all 0.3s ease;
        }

        .view-button:hover{
            background:#5a2db8;
            transform:scale(1.05);
            box-shadow:0 8px 20px rgba(0,0,0,0.3);
        }

    </style>

</head>

<body class="parent-select-page">

<div class="main-container">

    <button class="header-button" style="position:relative; top:60px;">
        Zgjidh nxënësin që do të shikosh
    </button>

    <section class="cards-container">

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <article class="student-card-wrapper">

                <div class="avatar-container">
                    <img src="../assets/images/parent/icons8-person-96.png" class="avatar-image">
                </div>

                <div class="student-card">

                    <div class="input-wrapper">
                        <img src="../assets/images/parent/icons8-person-64 (1).png" class="input-icon">
                        <input type="text" class="student-input"
                            value="<?php echo $row['emerMbiemer']; ?>" readonly>
                    </div>

                    <div class="input-wrapper">
                        <img src="../assets/images/parent/icons8-person-64 (1).png" class="input-icon">
                        <input type="text" class="student-input"
                            value="<?php echo $row['emriKlases']; ?>" readonly>
                    </div>

                    <div class="input-wrapper">
                        <img src="../assets/images/parent/icons8-person-64 (1).png" class="input-icon">
                        <input type="text" class="student-input"
                            value="<?php echo $row['nrID']; ?>" readonly>
                    </div>

                    <a href="parentDashboard.php?nxenesID=<?php echo $row['nrID']; ?>" class="view-button">
                        Shiko
                    </a>

                </div>

            </article>

        <?php } ?>

    </section>

</div>

</body>
</html>