<?php
$conn = mysqli_connect("localhost", "root", "", "register");
session_start();
if (!isset($_SESSION['regno'])) {
    header("Location: login.php");
    exit();
}
$sessioRegno = $_SESSION['regno'];
$_SESSION['user'] = "student";
$sql = "SELECT * FROM studentlogin WHERE regno='$sessioRegno'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['deptabb'] = $row['deptabb'];
    $placementDbName = $row['deptabb'] . "placement";
    $placementConnection = mysqli_connect("localhost", "root", "", "$placementDbName");
    $placementSql = "SELECT * FROM placement_2024 WHERE regno='$sessioRegno'";
    $placementResult = mysqli_query($placementConnection, $placementSql);
    if ($placementResult) {
        $placementRow = mysqli_fetch_assoc($placementResult);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="./css/home.css ?v=<?php echo time(); ?>">

</head>

<body>

    <div class="container overflow-hidden">
        <div class="row">
            <div class="col-md-1 col-2 d-flex justify-content-center align-items-center border ">
                <img src="./assests/img/list_2099125.png" alt="" style="height: 35px; width: 37px;" id="menubar">
            </div>
            <div class="list-group col-12 sidebar">
                <li class="list-group-item list-group-item-action" data-item="1">Home</li>
                <li class="list-group-item list-group-item-action" data-item="2">Profile</li>
                <li class="list-group-item list-group-item-action" data-item="3">Result</li>
                <li class="list-group-item list-group-item-action" data-item="4">Placement</li>
                <li class="list-group-item list-group-item-action" data-item="5">Time Table</li>
                <li class="list-group-item list-group-item-action" data-item="6">Chat</li>
                <li class="list-group-item list-group-item-action" data-item="7">Update Password</li>
                <li class="list-group-item list-group-item-action" data-item="8">Logout</li>
                <img src="./assests/img/icons8-cross-48.png" alt="" class="close" style="height: 35px; width: 35px;">
            </div>
            <div class="col-md-11 border  overflow-hidden col-10">
                <div class="row border d-flex align-items-center">
                    <div class="col-10 text-center">
                        <h4 id="clg">KSR COLLEGE OF ENGINEERING
                            <br>
                            (Autonomous) -637215.
                        </h4>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center flex-column profile">
                        <img src="<?php echo $row['pic']; ?>" alt="" class="mt-2" style="height: 35px; width: 35px; border-radius: 50%; object-fit: cover; object-position: top;" id="propic">
                        <p style="font-family: 'Russo One', sans-serif;">Profile</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Home-->

        <section class="home mt-3 border p-3" data-filter="1">
            .
        </section>
        <!--User Proile -->

        <section class="view-profile border mt-2 p-5" data-filter="2">
            <div class="row border p-2">
                <div class="col-md-3  d-flex flex-column align-items-center p-1 border">

                    <img src="<?php echo $row['pic']; ?>" alt="" class="" style="height: 50px; width: 50px; border-radius: 50%; object-fit: cover; object-position: top;" id="propic">

                    <div class="name" style="font-family: 'Russo One', sans-serif;color: rgba(0,0,0,0.6);">
                        <?php echo $row['name']; ?>
                    </div>
                </div>
                <div class="col-md-7 border text-center" style="color: rgba(0,0,0,0.6);">
                    <div class="dept" style="font-family: 'Russo One', sans-serif;">
                        <?php echo $row['dept']; ?>
                    </div>
                    <div class="regno" style="font-family: 'Russo One', sans-serif;">
                        <?php echo $row['dept']; ?>
                    </div>
                    <div class="sec" style="font-family: 'Russo One', sans-serif;">
                        <?php
                        echo $row['year'];
                        ?> - Year</div>
                </div>
                <div class="col-md-2 d-flex justify-content-center align-items-center border p-1">
                    <button class="btn btn-success form-control" id="editp">Edit Profile</button>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4 border p-1 d-flex align-items-center bg-secondary justify-content-center">
                    <img src="./assests/img/attendance.png" alt="" style="height: 70px;">
                    <p class="text-center mt-1" style="font-family: 'Russo One', sans-serif;">Attendance Percentage
                        : 90%
                        <br>
                        <?php
                        $today = date("Y-m-d");;
                        $tbname = $row['deptabb'] . $row['year'] . $row['sec'];
                        $addcon = mysqli_connect("localhost", "root", "", "attendance");
                        $addsql = "SELECT * FROM $tbname WHERE reg_no='{$row['regno']}' AND date='$today'";
                        $addresult = mysqli_query($addcon, $addsql);
                        if (mysqli_num_rows($addresult) > 0) {
                            echo "Today: Present";
                        } else {
                            echo "Today: Absent";
                        }

                        ?>
                    </p>
                </div>
                <div class="col-md-4 border
                p-1 d-flex align-items-center bg-secondary-subtle justify-content-center gap-2">
                    <img src="./assests/img/language-learning.png" alt="" style="height: 70px;">
                    <p class="text-center mt-1" style="font-family: 'Russo One', sans-serif;">CGPA
                        : <?php echo $row['cgpa'] ?>
                    </p>
                </div>
                <div class="col-md-4 border p-1 d-flex align-items-center bg-secondary justify-content-center gap-2">
                    <img src="./assests/img/cinema_9663884.png" alt="" style="height: 70px;">
                    <p class="text-center mt-1" style="font-family: 'Russo One', sans-serif;">
                        Achivements
                    </p>
                </div>
            </div>


            <div class="row mt-3 user-detail">
                <form id="updateForm">
                    <div class="row mt-2">
                        <div class="col-md-6 mt-1">
                            <label for="name">User Name:</label>
                            <input type="text" placeholder="<?php echo $row['name']; ?>" class="form-control  " id="name" autocomplete="on" name="username" readonly>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="email">Email Id:</label>
                            <input type="text" placeholder="<?php echo $row['email']; ?>" class="form-control" readonly id="email" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mt-1">
                            <label for="regno">Register No:</label>
                            <input type="text" placeholder="<?php echo $row['regno']; ?>" class="form-control" readonly id="regno">
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="dob">DOB:</label>
                            <input type="text" placeholder="<?php echo $row['dob']; ?>" class="form-control" id="dob" name="dateofbirth">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mt-1">
                            <label for="mobile">Mobile No:</label>
                            <input type="text" placeholder="<?php echo $row['mobileno']; ?>" class="form-control" id="mobile" name="mobileno">
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="gender"> Gender:</label>
                            <select name="gender" id="gender" class="form-control" disabled>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mt-1">
                            <label for="fname">Father Name:</label>
                            <input type="text" placeholder="<?php echo $row['fname']; ?>" class="form-control" id="fname" name="fname">
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="mname"> Mother Name:</label>
                            <input type="text" placeholder="<?php echo $row['mname']; ?>" class="form-control" id="mname" name="mname">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="pic">Picture</label>
                        <input type="file" name="img" id="pic" class="form-control" accept="image/*">
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="Address">Address</label>
                            <textarea name="address" class="form-control" id="Address" cols="30" rows="6" style="resize: none;" autocomplete="on" placeholder="<?php echo $row['address']; ?>"></textarea>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-success form-control w-50" id="updatep">Update</button>
                    </div>
                </form>
                <div id="profileResult"></div>
                <div class="model border"></div>
            </div>
        </section>
        <!--Update Password-->
        <section class="updatePass mt-3 p-3 border" data-filter="7" id="updatePassword">
            <div class="row d-flex">
                <div class="col-md-6 p-1 d-flex justify-content-center">
                    <img src="./assests/img/svg/resetpass.svg" alt="" style="height: 40vh;">
                </div>
                <form id="updatePass" class="col-md-6 d-flex justify-content-center flex-column align-items-center ">

                    <div class="col-8 mt-2">
                        <label for="newPass" style="font-family: 'Russo One', sans-serif;">New Password</label>
                        <input type="password" class="form-control" id="newPass" name="newpass">
                    </div>
                    <div class="col-8 mt-2">
                        <label for="conPass" style="font-family: 'Russo One', sans-serif;">Confirm Password</label>
                        <input type="password" class="form-control" id="conPass" name="conpass">
                    </div>
                    <button name="updatepass" type="submit" class="col-4 btn btn-success mt-2" style="font-family: 'Russo One', sans-serif;" id="updatePassBtn">Update</button>

                </form>
                <div id="updatePassword"></div>
            </div>
        </section>
        <!--Result-->

        <section class="result border mt-3 p-5" data-filter="3">
            <div class="row d-flex  justify-content-center  align-items-center">
                <h1 class="col text-center" style="color: #0984e3;">K.S.R COLLEGE OF ENGINEERING</h1>
                <p style="color: #0984e3;" class="text-center">(Autonomous)</p>
                <h4 style="color:#0984e3;" class="text-center opacity-75">K.S.R Kalvi Nagar,Tiruchengode - 637
                    215,Namakkal Dt.Tamilnadu</h4>
                <img src="./assests/img/ce-logo-final.png" alt="" style="width: 450px;" height="350px">

            </div>
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-5 ms-5">
                    <form id="searchResult">
                        <label for="rregno" class="text-primary">
                            <h5><i class="fa-regular fa-user"></i> Register No:</h5>
                        </label>
                        <input type="text" class="form-control" id="rregno" name="resultregno">
                        <button class="btn btn-primary form-control mt-4 rounded-pill" type="submit" id="resultSubmit">Submit</button>
                    </form>
                </div>
            </div>
            <div id="resultResult"></div>

        </section>
        <!--Placement Details -->

        <section class="placement border mt-3 p-5" data-filter="4" id="Placement">
            <div class="row d-flex flex-column justify-content-center align-items-center border p-3">
                <img src="./assests/img/user_2102647.png" alt="" style="height: 100px;width: 150px;">
                <div class="text-center opacity-50">
                    <h6 style="font-family: 'Russo One', sans-serif;">
                        <?php echo $placementRow['name']; ?></h6>
                </div>
                <div class="text-center opacity-50">
                    <h6 style="font-family: 'Russo One', sans-serif;">Placement Id:
                        <?php echo $placementRow['placementid']; ?></h6>
                </div>
            </div>
            <h3 class="mt-4" style="font-family: 'Russo One', sans-serif;">Placement Activities:-</h3>
            <div class="row text-center">
                <div class="col-md-4 border p-3 d-flex flex-column" style="font-family: 'Russo One', sans-serif;">
                    <img src="./assests/img/svg/company.svg" alt="" style="height: 200px;">
                    Number of Companies Arrived <br>
                    <?php echo $placementRow['companyarrived']; ?>
                </div>
                <div class="col-md-4 border p-3 d-flex flex-column" style="font-family: 'Russo One', sans-serif;">
                    <img src="./assests/img/svg/interview.svg" alt="" height="200px">
                    Number of Companies You Attended
                    <br> <?php echo $placementRow['companyattend']; ?>
                </div>
                <div class="col-md-4 border p-3 d-flex flex-column" style="font-family: 'Russo One', sans-serif;">
                    <img src="./assests/img/svg/intern.svg" alt="" height="190px">
                    Number of Internships <br> <?php echo $placementRow['noofintern']; ?>
                </div>
            </div>

            <form id="uploadResume" class="row border mt-4 p-2 d-flex align-items-center" enctype="multipart/form-data">
                <div class="col-md-8">
                    <label for="resume" style="font-family: 'Russo One', sans-serif;">Upload Your Resume: </label>
                    <input type="file" name="resume" id="resume" class="form-control mt-2">
                </div>
                <div class="col-md-4 mt-4">
                    <button class="btn btn-success form-control mt-md-2">Submit</button>
                </div>
            </form>

            <div id="resumeResult"></div>



            <h5 class="mt-3" style="font-family: 'Russo One', sans-serif;">Skills</h5>
            <div class="row p-2 border">
                <div class="col-12 d-flex gap-1 justify-content-center align-items-center flex-wrap show-skills" style="min-height: 50px;">
                    <?php
                    $skills = "";
                    $skills = $placementRow['skills'];
                    $skillsarray = explode(" ", $skills);
                    $lengthofarray = count($skillsarray);
                    for ($i = 0; $i < $lengthofarray; $i++) {
                        if (!empty($skillsarray[$i])) {
                            echo '<h6 class="border p-1 d-flex justify-content-center  align-items-center">';
                            echo $skillsarray[$i];
                            echo ' &nbsp; <i class="fa-solid fa-circle-xmark skill" style="color: black; cursor: pointer;" data-item="';
                            echo $i;
                            echo '"></i>';
                            echo '</h6>';
                        }
                    }
                    ?>


                </div>
                <div class="col-12 ">
                    <form id="addSkills">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-11">

                                <input type="text" class=" border form-control " style="outline: none;" placeholder="Ex: Java" id="skills" name="addskills" />
                            </div>
                            <button class="col-md-1 col-4 btn btn-success mt-2 mt-md-0" type="submit" id="addSkillbtn"> <img src="./assests/img/icons8-send-30 (1).png" alt="" style="height: 20px;"></button>

                        </div>
                    </form>
                </div>
            </div>
            <div id="dismissed"></div>
            <div id="skillresult"></div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="accordion mt-5" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h4 style="font-family: 'Russo One', sans-serif;" class="opacity-50">Upcoming
                                        Companies</h4>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="list-group">
                                        <li class="list-group-item list-group-item-action" style="font-family: 'Russo One', sans-serif;">
                                            Coding Mart (11-2-2024)
                                        </li>
                                        <li class="list-group-item list-group-item-action" style="font-family: 'Russo One', sans-serif;">
                                            Zoho (11-2-2024)
                                        </li>
                                        <li class="list-group-item list-group-item-action" style="font-family: 'Russo One', sans-serif;">
                                            TCS (11-2-2024)
                                        </li>
                                        <li class="list-group-item list-group-item-action" style="font-family: 'Russo One', sans-serif;">
                                            Virtusa (11-2-2024)
                                        </li>
                                        <li class="list-group-item list-group-item-action" style="font-family: 'Russo One', sans-serif;">
                                            Infosis (11-2-2024)
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--ITime Table-->
        <section class="time-table border mt-3 p-5" data-filter="5">
            <div class="row border p-2 d-flex align-items-center">
                <div class="col-md-8 opacity-50" style="font-family: 'Russo One', sans-serif;">
                    <h5> DEPT: <?php echo $row['dept'] ?>
                        <br>
                        Section: 'A'<br>
                        Semester: 5</h6>
                </div>
                <div class="col-md-4 img  d-flex border flex-column align-items-center">
                    <img src="./assests/img/svg/timetable.svg" alt="">
                    <h6 style="font-family: 'Russo One', sans-serif;" class="opacity-50"> Schedule</h6>
                </div>
            </div>
            <div class="row mt-5">
                <div class="text-center table-responsive">
                    <table class="table table-bordered">
                        <th>Day</th>
                        <th>I <br>
                            09:00 to 09:45
                        </th>
                        <th>II <br>
                            09:45 to 10:45</th>
                        <th rowspan="7">
                            <p style="margin-top: 115px;"> B <br> R <br> E <br> A <br> K</p>
                        </th>
                        <th>III <br>
                            11:00 to 11:45</th>
                        <th>IV <br> 11:45 to 12:30</th>
                        <th rowspan="7">
                            <p style="margin-top: 115px;"> L <br> U <br> N <br> C <br> H</p>
                        </th>
                        <th>V <br>
                            01:30 to 02:30</th>
                        <th>VI <br>
                            02:30 to 03:15</th>
                        <th>VII <br>
                            03:15 to 04:00</th>
                        </tr>
                        <tr>
                            <td>MON</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td>TUE</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td>WED</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td>THU</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td>FRI</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td>SAT</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    </table>
                </div>
            </div>

        </section>
        <!--Logout-->
        <section class="userlogout mt-3 p-3 border" data-filter="8">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            <div class="row d-flex justify-content-center">
                <div class="alert alert-danger d-flex align-items-center col-md-6" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        Are You Sure to Logout
                    </div>

                </div>
                <form method="post" action="logout.php">
                    <div class="row d-flex gap-2 justify-content-center">
                        <input type="submit" name="yes" value="Yes" class="btn btn-danger col-md-3">
                        <input type="submit" name="no" value="No" class="btn btn-success col-md-3">
                    </div>
                </form>

        </section>
        <!--Chat-->
        <section class="chat border p-2 m-2" data-filter="6">
            <div class="messagebox border p-3" id="messagebox">
                <?php
                $mesconn = mysqli_connect("localhost", "root", "", "chatdb");
                $currentTimestamp = time();
                $formattedDate = date("Y-m-d H:i:s", $currentTimestamp);
                $sql = "SELECT * FROM chats";
                $result = mysqli_query($mesconn, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="alert alert-info  d-flex justify-contnet-between col-md-10">';
                        echo '<div class="col-5 ">';
                        echo $row['message'];
                        echo '</div>';
                        echo '<div class="col-5 text-end "><sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo  $row['time'];
                        echo '</sub></div>';
                        echo '</div>';
                    }
                }


                ?>
            </div>
            <form id="sendMessage">
                <div class="messBox  p-2 row m-1 bg-success">

                    <textarea name="message" id="myTextarea" oninput="adjustTextareaSize()" class="col-11 border " placeholder="Type Here.."></textarea>
                    <button class="mesicon col-1 border d-flex justify-content-center align-items-center">
                        <img src="./assests/img/send.png" alt="" style="height: 25px;" type="submit">
                    </button>

                </div>
            </form>

    </div>
    </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/home.js"></script>
</body>
<script>
    if (window.location.hash === "#Placement") {
        console.log('hi')
        console.log('<?php echo $skills; ?>')
        let sections = document.querySelectorAll('section')
        sections.forEach(i => {
            i.style.display = "none"
        })

        let p = document.querySelector('#Placement');
        if (p) {
            p.style.display = "block";

        }
    }

    function refreshAndRedirectToPlacement() {

        window.location.hash = "Placement";
        location.reload();
    }

    function sendmessage(event, idName, urlpage, dis) {
        event.preventDefault();
        idname = "#" + idName;
        var formData = $(`${idname}`).serialize();
        $.ajax({
            type: "POST",
            url: urlpage, // Change this to the PHP file handling the form data
            data: formData,
            success: function(response) {
                let currentData = $(`#${dis}`).html();
                let newData = currentData + response;
                $(`#${dis}`).html(newData);
            }
        });
    }

    function loadData(event, idName, urlpage, dis) {
        event.preventDefault();
        idname = "#" + idName;
        var formData = $(`${idname}`).serialize();
        $.ajax({
            type: "POST",
            url: urlpage, // Change this to the PHP file handling the form data
            data: formData,
            success: function(response) {
                $(`#${dis}`).html(response);
            }
        });

    }

    function uploadloadData(event, idname, urlpage, dis) {
        event.preventDefault();
        idname = '#' + idname;
        var formData = new FormData($(idname)[0]); // Use FormData to include files
        $.ajax({
            type: "POST",
            url: urlpage,
            data: formData,
            contentType: false,
            processData: false, // Important to prevent jQuery from transforming the data
            success: function(response) {
                $('#' + dis).html(response);
            }
        });
    }
    $(document).ready(function() {
        $("#updateForm").submit(function(event) {
            uploadloadData(event, "updateForm", "updateProfile.php", "profileResult");
        });
    });
    $(document).ready(function() {
        $('#uploadResume').submit(function(event) {
            uploadloadData(event, "uploadResume", "uploadResume.php", "resumeResult")
        })
    })
    $(document).ready(function() {
        $("#addSkills").submit(function(event) {
            loadData(event, "addSkills", "add_skill.php", "skillresult");
        });
    });
    $(document).ready(function() {
        $("#searchResult").submit(function(event) {
            loadData(event, "searchResult", "result.php", "resultResult");
        });
    });
    $(document).ready(function() {
        $('#updatePass').submit(function(event) {
            loadData(event, "updatePass", "updatePass.php", "updatePassword");
        })
    });
    $(document).ready(function() {
        $('#sendMessage').submit(function(event) {
            sendmessage(event, "sendMessage", "sendMessage.php", "messagebox")
        })
    });

    function dismissSkill(index) {
        $.ajax({
            type: "POST",
            url: "dismiss_skill.php",
            data: {
                index: index
            },
            success: function(response) {
                // Handle the response from the server
                $('#dismissed').html(response);
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", status, error);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        let addSkillbtn = document.getElementById('addSkillbtn');
        let showskills = document.querySelector('.show-skills');

        let i = '<?php echo $lengthofarray; ?>';

        let skills = document.querySelectorAll('.skill');

        skills.forEach(skill => {
            skill.addEventListener('click', () => {
                var parentElement = skill.parentNode;
                parentElement.classList.add('d-none');
                dismissSkill(skill.attributes['data-item'].value);
            });
        });

        addSkillbtn.addEventListener('click', () => {
            let inputskill = document.getElementById('skills');
            i++;
            showskills.innerHTML += `
            <h6 class="border p-1 d-flex justify-content-center align-items-center">
                ${inputskill.value}
                &nbsp;
                <i class="fa-solid fa-circle-xmark skill" style="color: black; cursor: pointer;" data-item="${i}"></i>
            </h6>
        `;
            setTimeout(refreshAndRedirectToPlacement, 1000);
        });

    });
</script>

</html>