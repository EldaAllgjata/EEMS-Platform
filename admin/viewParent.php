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

$classquery="SELECT klasaID,emer FROM klasa";
$queryresult=mysqli_query($connection,$classquery);

$sqlsearch="SELECT * FROM prinder 
WHERE 1=1";
if(isset($_GET['search']) && !empty($_GET['search'])){
    $searchinput=$_GET['search'];
    $sqlsearch.=" AND prinder.emerMbiemer LIKE '%$searchinput%'";
}
if(isset($_GET['class']) && !empty($_GET['class'])){
    $classinput=(int)$_GET['class'];
    $sqlsearch .= "
    AND prinder.prind_id IN (
        SELECT nxenes.prindID
        FROM nxenes
        WHERE nxenes.klasID = $classinput
    )";
}
$sqlsearch.=" GROUP BY prinder.prind_id";
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
                <h1>Prinderit</h1>
                <p>Shiko te dhenat e prinderve</p>
            </div>
        </div>
        <div class="pageContent con">
            <form method="GET" class="kerkimi" id="formsubmit">
                <input type="text" id="searchname" name="search" placeholder="Kerko prind">
                <select name="class" id="class">
                    <option value="">Zgjidh klasen</option>
                    <?php while($result=mysqli_fetch_assoc($queryresult)){ ?>
                    <option value="<?php echo $result['klasaID']?>"><?php echo $result['emer']?></option>
                    <?php } ?>
                </select>
                <button type="submit"><img src="../assets/images/admin/icons8-search-100.png"></button>
            </form>
            <table border="1">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Emer Mbiemer</th>
                        <th>Gjinia</th>
                        <th>Datelindja</th>
                        <th>Nr.telefonit</th>
                        <th>Email</th>
                        <th>Femijet</th>
                        <th>Klasa</th>
                        <th>Modifiko</th>
                        <th>Fshi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($parent=mysqli_fetch_assoc($sqlSearchResult)){ ?>
                    <tr>
                        <td><?php echo $parent['prind_id']?></td>
                        <td><?php echo $parent['emerMbiemer']?></td>
                        <td><?php echo $parent['Gjinia']?></td>
                        <td><?php echo $parent['Datelindja']?></td>
                        <td><?php echo $parent['nrTel']?></td>
                        <td><?php echo $parent['email']?></td>
                        <td>
                            <?php
                                $prindID = $parent['prind_id'];
                                $sqlFemije = "SELECT emerMbiemer FROM nxenes WHERE prindID = $prindID";
                                $resultFemije = mysqli_query($connection, $sqlFemije);

                                while($femije = mysqli_fetch_assoc($resultFemije)){
                                    echo $femije['emerMbiemer'] . "<br>";
                                }
                            ?>
                        </td>

                        <td>
                            <?php
                                $sqlKlasa = "SELECT DISTINCT klasa.emer 
                                FROM klasa 
                                JOIN nxenes ON nxenes.klasID = klasa.klasaID
                                WHERE nxenes.prindID = $prindID";

                                $resultKlasa = mysqli_query($connection, $sqlKlasa);

                                while($klasa = mysqli_fetch_assoc($resultKlasa)){
                                    echo $klasa['emer'] . "<br>";
                                }
                            ?>
                        </td>
                            <td><button type="button" onclick="openModal('<?php echo $parent['prind_id']; ?>','<?php echo $parent['emerMbiemer']; ?>','<?php echo $parent['Gjinia']; ?>','<?php echo $parent['Datelindja']; ?>','<?php echo $parent['nrTel']; ?>','<?php echo $parent['email']; ?>')">
                                    <img src="../assets/images/admin/icons8-edit-96.png"></button>
                            </td>
                            <td><a href="deleteparent.php?id=<?php echo $parent['prind_id']; ?>" onclick="return confirm('A je i sigurt qe do ta fshish kete prind?')"><img src="../assets/images/admin/icons8-delete-64.png"></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="overlay"></div>

    <div id="editModal">
        <h2>Modifiko Prindin</h2>

        <div class="modalForm">

            <input type="hidden" id="editId">

            <div class="inputGroup inputFull">
                <label>Emer Mbiemer</label>
                <input type="text" id="editName">
            </div>

            <div class="inputGroup">
                <label>Gjinia</label>
                <select id="editGender">
                    <option value="Femër">Femer</option>
                    <option value="Mashkull">Mashkull</option>
                </select>
            </div>

            <div class="inputGroup">
                <label>Datelindja</label>
                <input type="date" id="editBirth">
            </div>

            <div class="inputGroup">
                <label>Nr Tel</label>
                <input type="text" id="editPhone">
            </div>

            <div class="inputGroup">
                <label>Email</label>
                <input type="email" id="editEmail">
            </div>

        </div>

        <div class="modalButtons">
            <button class="saveBtn" onclick="saveEdit()">
                Ruaj
            </button>

            <button class="closeBtn" onclick="closeModal()">
                Mbyll
            </button>
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

        const inputsearch = document.getElementById("searchname");
        const classsearch = document.getElementById("class");
        const forma = document.getElementById("formsubmit");
        inputsearch.addEventListener("searchname", function() {
            if (this.value.trim() === "") {
                forma.submit();
            }
        });

        function openModal(
            id,
            name,
            gender,
            birth,
            phone,
            email
        ) {

            document.getElementById("overlay").style.display = "block";
            document.getElementById("editModal").style.display = "flex";

            document.getElementById("editId").value = id;
            document.getElementById("editName").value = name;
            document.getElementById("editGender").value = gender;
            document.getElementById("editBirth").value = birth;
            document.getElementById("editPhone").value = phone;
            document.getElementById("editEmail").value = email;
        }

        function closeModal() {

            document.getElementById("overlay").style.display = "none";
            document.getElementById("editModal").style.display = "none";
        }

        function saveEdit() {

            let id = document.getElementById("editId").value;
            let name = document.getElementById("editName").value;
            let gender = document.getElementById("editGender").value;
            let birth = document.getElementById("editBirth").value;
            let phone = document.getElementById("editPhone").value;
            let email = document.getElementById("editEmail").value;

            let xhr = new XMLHttpRequest();

            xhr.open("POST", "updateParent.php", true);

            xhr.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
            );

            xhr.onload = function() {

                alert(this.responseText);

                location.reload();
            };

            xhr.send(
                "id=" + encodeURIComponent(id) +
                "&name=" + encodeURIComponent(name) +
                "&gender=" + encodeURIComponent(gender) +
                "&birth=" + encodeURIComponent(birth) +
                "&phone=" + encodeURIComponent(phone) +
                "&email=" + encodeURIComponent(email)
            );
        }
    </script>
</body>

</html>