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
?>
<!DOCTYPE html>
<html lang="sq">
    <head>
        <link rel="stylesheet" href="adminDStyle.css">
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.css" rel="stylesheet">
        <title>Admin Dashboard</title>
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
                    <li  class="activeElement">
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
                    <h1>Aktivitetet</h1>
                    <p>Paraqitje e permbledhur e aktivitetit</p>
                </div>
            </div>
            <div class="pageContent con">
                <div class="pageTitle diff">
                    <img src="../assets/images/admin/icons8-information-100%20(1).png">
                    <div class="titleContent">
                        <h1>Perditesim i aktiviteteve te ardhshme</h1>
                        <p>Vendosja e eventeve perkatese ne dite te caktuara</p>
                    </div>
                </div>
                <div id="calendar"></div>
                <div class="modal" id="eventModal">

    <div class="modal-content">

        <h2>Shto Aktivitet</h2>

        <form id="eventForm">

            <input type="hidden" id="eventDate">

            <input type="hidden" id="eventId">

            <label>Titulli</label>
            <input type="text" id="title">

            <label>Pershkrimi</label>
            <textarea id="content"></textarea>

            <label>Kategoria</label>
            <input type="text" id="category">

            <label>Ambienti</label>
            <input type="text" id="ambient">

            <button type="submit">Ruaj</button>

            <button type="button" id="closeModal">
                Mbyll
            </button>

        </form>

    </div>

</div>
            </div>
            </div>
        </div>
    </body>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {

    const modal =
    document.getElementById('eventModal');

    const form =
    document.getElementById('eventForm');

    const closeModal =
    document.getElementById('closeModal');

    const calendarEl =
    document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        height: 650,

        editable: true,

        events: 'getEvents.php',

        dateClick: function(info){

            fetch(
                'getEventByDate.php?date='
                + info.dateStr
            )

            .then(response => response.json())

            .then(data => {

                document.getElementById('eventDate').value =
                info.dateStr;

                if(data){

                    document.getElementById('eventId').value =
                    data.id;

                    document.getElementById('title').value =
                    data.titull;

                    document.getElementById('content').value =
                    data.content;

                    document.getElementById('category').value =
                    data.kategoria;

                    document.getElementById('ambient').value =
                    data.ambient;

                }else{

                    document.getElementById('eventId').value = "";

                    document.getElementById('title').value = "";

                    document.getElementById('content').value = "";

                    document.getElementById('category').value = "";

                    document.getElementById('ambient').value = "";

                }

                modal.style.display = "flex";

            });

        },
        eventClick: function(info){

    fetch(
        'getSingleEvent.php?id='
        + info.event.id
    )

    .then(response => response.json())

    .then(data => {

        document.getElementById('eventId').value =
        data.id;

        document.getElementById('eventDate').value =
        data.data;

        document.getElementById('title').value =
        data.titull;

        document.getElementById('content').value =
        data.content;

        document.getElementById('category').value =
        data.kategoria;

        document.getElementById('ambient').value =
        data.ambient;

        modal.style.display = "flex";

    });

}

    });

    calendar.render();

    closeModal.addEventListener('click', function(){

        modal.style.display = "none";

    });

    form.addEventListener('submit', function(e){

        e.preventDefault();

        let formData = new FormData();

        formData.append(
            'id',
            document.getElementById('eventId').value
        );

        formData.append(
            'title',
            document.getElementById('title').value
        );

        formData.append(
            'content',
            document.getElementById('content').value
        );

        formData.append(
            'category',
            document.getElementById('category').value
        );

        formData.append(
            'ambient',
            document.getElementById('ambient').value
        );

        formData.append(
            'date',
            document.getElementById('eventDate').value
        );

        fetch('saveEvent.php', {

            method:'POST',

            body: formData

        })
        .then(response => response.text())
        .then(data => {

            modal.style.display = "none";

            calendar.refetchEvents();

        });

    });

});

</script>
</html>