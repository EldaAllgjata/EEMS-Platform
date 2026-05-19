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

$sqlsearch="SELECT * FROM klasa 
WHERE 1=1";
if(isset($_GET['class']) && !empty($_GET['class'])){
    $classinput=(int)$_GET['class'];
    $sqlsearch .= " AND klasa.klasaID = $classinput";
}
$sqlsearch.=" GROUP BY klasa.klasaID";
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
                <h1>Klasat</h1>
                <p>Shiko te dhenat e klasave</p>
            </div>
        </div>
        <div class="pageContent con">
            <form method="GET" class="kerkimi" id="formsubmit">
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
                        <th>Emer</th>
                        <th>Lendet</th>
                        <th>Nr.nxenes</th>
                        <th>Mesuesit</th>
                        <th>Modifiko</th>
                        <th>Fshi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($class=mysqli_fetch_assoc($sqlSearchResult)){ ?>
                    <tr>
                        <td><?php echo $class['klasaID']?></td>
                        <td><?php echo $class['emer']?></td>
                        <td>
                            <?php
                                $classid = $class['klasaID'];
                                $sqlSubjectid="SELECT lendaID FROM lidhjamesues where klasID=$classid";
                                $subjectquery=mysqli_query($connection,$sqlSubjectid);
                                while($subjectidResult=mysqli_fetch_assoc($subjectquery)){
                                $subjectid=$subjectidResult['lendaID'];
                                $sqlSubject = "SELECT emri FROM lenda WHERE id = $subjectid";
                                $resultSubject = mysqli_query($connection, $sqlSubject);

                                while($subject = mysqli_fetch_assoc($resultSubject)){
                                    echo $subject['emri'] . "<br>";
                                }
                                }
                            ?>
                        </td>

                        <td>
                            <?php
                                $classid=$class['klasaID'];
                                $sqlStudents="SELECT COUNT(*) AS total FROM nxenes WHERE klasID=$classid";
                                $resultStudents=mysqli_query($connection,$sqlStudents);
                                $studentresult = mysqli_fetch_assoc($resultStudents);
                                echo $studentresult['total'];
                            ?>
                        </td>
                        <td>
                            <?php
                                $classid = $class['klasaID'];
                                $sqlTeacherid="SELECT mesuesID FROM lidhjamesues where klasID=$classid";
                                $teacherquery=mysqli_query($connection,$sqlTeacherid);
                                while($teacheridResult=mysqli_fetch_assoc($teacherquery)){
                                $teacherid=$teacheridResult['mesuesID'];
                                $sqlTeacher = "SELECT emerMbiemer FROM mesues WHERE mesuesID = $teacherid";
                                $resultTeacher = mysqli_query($connection, $sqlTeacher);

                                while($teacher = mysqli_fetch_assoc($resultTeacher)){
                                    echo $teacher['emerMbiemer'] . "<br>";
                                }
                                }
                            ?>
                            
                        </td>
                        <td>
                            <button type="button" onclick="openModal('<?php echo $class['klasaID']; ?>','<?php echo $class['emer']; ?>')">
                            <img src="../assets/images/admin/icons8-edit-96.png"></button>
                        </td>
                        <td>
                            <a href="deleteClass.php?id=<?php echo $class['klasaID']; ?>" onclick="return confirm('A je i sigurt qe do ta fshish kete klase?')"><img src="../assets/images/admin/icons8-delete-64.png"></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="overlay"></div>

    <div id="editModal">
        <h2>Modifiko Klasen</h2>

        <div class="modalForm">

            <input type="hidden" id="editId">

            <div class="inputGroup inputFull">
                <label>Emri</label>
                <input type="text" id="editName">
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

        const classsearch = document.getElementById("class");
        const forma = document.getElementById("formsubmit");
        inputsearch.addEventListener("searchname", function() {
            if (this.value.trim() === "") {
                forma.submit();
            }
        });

        function openModal(
            id , name
        ) {

            document.getElementById("overlay").style.display = "block";
            document.getElementById("editModal").style.display = "flex";
            document.getElementById("editId").value = id;             
            document.getElementById("editName").value = name;
        }

        function closeModal() {

            document.getElementById("overlay").style.display = "none";
            document.getElementById("editModal").style.display = "none";
        }

        function saveEdit() {
            let id = document.getElementById("editId").value;
            let name = document.getElementById("editName").value;

            let xhr = new XMLHttpRequest();

            xhr.open("POST", "updateClass.php", true);

            xhr.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
            );

            xhr.onload = function() {

                alert(this.responseText);

                location.reload();
            };

            xhr.send("id=" + encodeURIComponent(id) +
    "&name=" + encodeURIComponent(name));
        }
    </script>
</body>

</html>