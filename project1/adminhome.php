<?php
$currentDate = date("Y-m-d");
session_start();
if (!isset($_SESSION['facultyid'])) {
    header('Location: login.php');
    exit();
}
$_SESSION['user'] = "admin";
$facultyid = $_SESSION['facultyid'];
$conn = mysqli_connect("localhost", "root", "", "register");
$sql = "SELECT * FROM adminlogin where facultyid=$facultyid";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./css/adminhome.css ?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container overflow-hidden">
        <div class="row ">
            <div class="col-1 d-flex justify-content-center align-items-center border ">
                <img src="./assests/img/list_2099125.png" alt="" id="menubar">
            </div>
            <div class="list-group col-12 sidebar">
                <li class="list-group-item list-group-item-action" data-item="1">Home</li>
                <li class="list-group-item list-group-item-action" data-item="2">Profile</li>
                <li class="list-group-item list-group-item-action" data-item="3">Attendance</li>
                <li class="list-group-item list-group-item-action" data-item="4">Student Deatils</li>
                <li class="list-group-item list-group-item-action" data-item="5">Time Table</li>
                <li class="list-group-item list-group-item-action" data-item="6">Placement Student Details</li>
                <li class="list-group-item list-group-item-action" data-item="7">Reset Password</li>
                <li class="list-group-item list-group-item-action" data-item="8">Logout</li>
                <img src="./assests/img/icons8-cross-48.png" alt="" class="close" style="height: 35px; width: 35px;">
            </div>
            <div class="col-11 border  overflow-hidden">
                <div class="row border d-flex align-items-center">
                    <div class="col-md-10 text-center ">
                        <h5 id="clg" class="text-center">KSR COLLEGE OF ENGINEERING
                            <br>
                            (Autonomous) -637215.
                        </h5>
                    </div>
                    <div class="col-md-2 d-flex justify-content-end align-items-center flex-column profile ">
                        <img src="<?php echo $row['pic'] ?>" alt="" class="mt-2" style="height: 35px; width: 35px; border-radius: 50%; cursor:pointer;object-fit: cover; object-position: top;" id="propic">
                        <p style="font-family: 'Russo One', sans-serif;" class="mt-1">Profile</p>
                    </div>
                </div>
            </div>
        </div>

        <!--Update Password -->
        <section class="updatepassword border mt-3 p-3" data-filter="7">
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

        <!--Logout-->
        <section class="adiminlogout mt-3 p-3 border" data-filter="8">
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
                <div class="row d-flex gap-2 justify-content-center">
                    <form method="post" action="adminlogout.php">
                        <div class="row d-flex gap-2 justify-content-center">
                            <input type="submit" name="yes" value="Yes" class="btn btn-danger col-md-3">
                            <input type="submit" name="no" value="No" class="btn btn-success col-md-3">
                        </div>
                    </form>
                </div>
        </section>

        <!--Student Details-->
        <section class="studentDetails mt-3 p-3 border" data-filter="4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" id="regnoSearch" placeholder="Search Regno" class="form-control" />
                        <span class="input-group-text" id="basic-addon1"><img src="./assests/img/loupe.png" alt="" style="height: 20px; cursor:pointer"></span>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="studentlist">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <tr class="text-center">
                                <th>Reg No</th>
                                <th>Name</th>
                                <th>Dept</th>
                                <th>Year</th>
                                <th>Section</th>
                                <th>Placment Id</th>
                                <th>DOB</th>
                                <th>Mobile No</th>
                                <th>CGPA</th>

                            </tr>
                            <tr>
                                <td class="regno">73152113015</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113016</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113017</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113018</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113019</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113020</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113021</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113022</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113023</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113024</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <tr>
                                <td class="regno">73152113025</td>
                                <td>Barathraj M</td>
                                <td>CSE</td>
                                <td>3</td>
                                <td>A</td>
                                <td>2113015</td>
                                <td>22/10/2003</td>
                                <td>6382958518</td>
                                <td>8.66</td>
                            </tr>
                            <td class="regno">73152113026</td>
                            <td>Barathraj M</td>
                            <td>CSE</td>
                            <td>3</td>
                            <td>A</td>
                            <td>2113015</td>
                            <td>22/10/2003</td>
                            <td>6382958518</td>
                            <td>8.66</td>
                            </tr>
                            <td class="regno">73152113027</td>
                            <td>Barathraj M</td>
                            <td>CSE</td>
                            <td>3</td>
                            <td>A</td>
                            <td>2113015</td>
                            <td>22/10/2003</td>
                            <td>6382958518</td>
                            <td>8.66</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!--Attendance-->

        <section class="admin-attendance mt-3 border p-3" data-filter="3">
            <form id="searchAttendanceForm">
                <div class="row p-2">
                    <div class="col-md-6">
                        <label for="branch">Branch</label>
                        <br>
                        <select name="attendanceBranch" id="branch" class="form-control form-select">
                            <option value="cse">Computer Science And Engineering</option>
                            <option value="it">Information Technology</option>
                            <option value="ece">Electronics and Communication Engineering</option>
                            <option value="eee">Electrical and Electronics Engineering</option>
                            <option value="civil">Civil</option>
                            <option value="mech">Mechanical Engineering</option>
                            <option value="csd">Computer Science And Design</option>
                            <option value="iot">Internet Of Things</option>
                            <option value="auto">Auto Mobile</option>
                            <option value="sfe">Safety And Fire Engineering</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="year">Year</label>
                        <br>
                        <select name="attendanceYear" id="year" class="form-control form-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
                <div class="row p-2 d-flex justify-content-center mt-1">
                    <div class="col-md-6">
                        <label for="section">Section</label>
                        <br>
                        <select name="attendanceSection" id="section" class="form-control form-select">
                            <option value="a">A</option>
                            <option value="b">B</option>
                        </select>
                    </div>
                </div>
                <div class="row p-2 mt-1 d-flex justify-content-center">
                    <button class="btn btn-success col-md-4" type="submit" name="searchAttendance">
                        Submit
                    </button>
                </div>
            </form>
            <div id="serachAttendanceResult"></div>
            <div id="attendanceResult"></div>
        </section>

        <!--Schedule Time Table-->

        <section class="scheduletimetable mt-3 p-3 border" data-filter="5">
            <div class="row border p-2 d-flex align-items-center">
                <div class="col-md-8 opacity-50 d-flex justify-content-center" style="font-family: 'Russo One', sans-serif;">
                    <h5>Time Table</h5>
                </div>
                <div class="col-md-4 img  d-flex border flex-column align-items-center">
                    <img src="./assests/img/svg/timetable.svg" alt="" style="height: 150px;">
                    <h6 style="font-family: 'Russo One', sans-serif;" class="opacity-50"> Schedule</h6>
                </div>
            </div>
            <form id="TimeTable">
                <div class="row mt-3 p-2">
                    <div class="col-4">
                        <label for="ttsem">Semester</label>
                        <select id="ttsem" class="form-control" name="ttSemester">
                            <option value="sem1" selected>Semester 1</option>
                            <option value="sem2">Semester 2</option>
                            <option value="sem3">Semester 3</option>
                            <option value="sem4">Semester 4</option>
                            <option value="sem5">Semester 5</option>
                            <option value="sem6">Semester 6</option>
                            <option value="sem7">Semester 7</option>
                            <option value="sem8">Semester 8</option>
                        </select>

                    </div>
                    <div class="col-4">
                        <label for="ttbranch">Branch</label>
                        <select id="ttbranch" class="form-control" name="ttBranch">
                            <option value="cse" selected>CSE</option>
                            <option value="it">IT</option>
                            <option value="ece">ECE</option>
                            <option value="eee">EEE</option>
                            <option value="mech">MECH</option>
                            <option value="civil">CIVIL</option>
                            <option value="sfe">SEF</option>
                            <option value="auto">AUTO MOBILE</option>
                            <option value="csd">CSD</option>
                            <option value="iot">IOT</option>
                        </select>

                    </div>
                    <div class="col-4">
                        <label for="ttsec">Section</label>
                        <select id="ttsec" class="form-control" name="ttSection">
                            <option value="a" selected>A</option>
                            <option value="b">B</option>
                        </select>

                    </div>
                </div>
                <div class="row mt-2 d-flex justify-content-center">
                    <button class="btn col-md-4 btn-success" type="submit" name="TimeTableSearch">Search</button>
                </div>
            </form>
            <div id="resultTimeTable"></div>
        </section>

        <!--Placement Student Details-->
        <section class="adminPlacementStudent mt-3 p-3 border" data-filter="6">
            <form id="placement">
                <div class="row mt-3 p-2">
                    <div class="col-6">
                        <label for="psbranch">Branch</label>
                        <select id="psbranch" class="form-control form-select" name="psBranch">
                            <option value="cse">CSE</option>
                            <option value="it">IT</option>
                            <option value="ece">ECE</option>
                            <option value="eee">EEE</option>
                            <option value="mech">MECH</option>
                            <option value="civil">CIVIL</option>
                            <option value="sfe">SEF</option>
                            <option value="auto">AUTO MOBILE</option>
                            <option value="csd">CSD</option>
                            <option value="iot">IOT</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="yer">Year Of Batch: </label>
                        <select name="year" id="yer" class="form-select">
                            <?php
                            $pastYear = Date("Y");
                            $futureYear = Date("Y") + 4;
                            while ($pastYear <= $futureYear) {
                                echo '<option value="';
                                echo $pastYear;
                                echo '">';
                                echo "$pastYear</option>";
                                $pastYear++;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-2 d-flex justify-content-center">
                    <button class="btn col-md-4 btn-success" type="submit" name="pssubmit">Search</button>
                </div>
            </form>
            <div id="placementResult" class="table-responsive"></div>
        </section>

        <!--Admin Home-->

        <section class="admin-home mt-3 border p-3" data-filter="1">
            <h1>.</h1>
        </section>

        <!--Admin Profile-->

        <section class="admin-profile mt-3 border p-5" data-filter="2">

            <div class="row border mt-4">
                <div class="col-md-3  d-flex flex-column align-items-center p-1 border">
                    <img src="<?php echo $row['pic']; ?>" alt="" class="" style="height: 50px; width: 50px; border-radius: 50%; object-fit: cover; object-position: top;">
                    <div class="name" style="font-family: 'Russo One', sans-serif;color: rgba(0,0,0,0.6);">
                        <?php echo $row['name']; ?>
                    </div>
                </div>
                <div class="col-md-7 border text-center d-flex flex-column justify-content-center" style="color: rgba(0,0,0,0.6);">
                    <div class="dept" style="font-family: 'Russo One', sans-serif;">
                        <?php echo $row['dept'] ?></div>
                    <div class="regno" style="font-family: 'Russo One', sans-serif;">
                        Faculty Id: <?php echo $facultyid; ?></div>
                </div>
                <div class="col-md-2 d-flex justify-content-center align-items-center border p-1">
                    <button class="btn btn-success form-control" id="admineditp">Edit Profile</button>
                </div>
            </div>

            <div class="row mt-3 admin-detail border p-2">
                <form id="updateAdminprofile" enctype="multipart/form-data">
                    <div class="row mt-2">
                        <div class="col-md-6 mt-1">
                            <label for="name">Name:</label>
                            <input type="text" placeholder="<?php echo $row['name'] ?>" class="form-control  " id="name" autocomplete="on" name="name">
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="email">Email:</label>
                            <input type="text" placeholder="<?php echo $row['email'] ?>" class="form-control" readonly id="email" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mt-1">
                            <label for="regno">Faulty Id:</label>
                            <input type="text" placeholder="<?php echo $facultyid; ?>" class="form-control" readonly id="regno" disabled>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="mobile">Mobile No:</label>
                            <input type="text" placeholder="<?php echo $row['mobileno'] ?>" class="form-control" id="mobile" name="mobileno">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mt-1">
                            <label for="mname"> Designation:</label>
                            <input type="text" placeholder="<?php echo $row['designation'] ?>" class="form-control" id="designation" disabled>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="gender"> Gender:</label>
                            <select name="" id="gender" class="form-control" disabled>
                                <option value="" disabled selected><?php echo $row['gender'] ?></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mt-1">
                            <label for="fname">Father Name:</label>
                            <input type="text" placeholder="<?php echo $row['fname'] ?>" class="form-control" id="fname" name="fname">
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="mname"> Mother Name:</label>
                            <input type="text" placeholder="<?php echo $row['mname'] ?>" class="form-control" id="mname" name="mname">
                        </div>

                    </div>
                    <div class="row mt-2">
                        <label for="adminimg">Picture</label>
                        <input type="file" name="img" id="adminimg" class="form-control" accept="image/*">
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" cols="30" rows="6" style="resize: none;" autocomplete="on" placeholder="<?php echo $row['address'] ?>"></textarea>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-success form-control w-50" id="updatep">Update</button>
                    </div>
                </form>
                <div id="updateAdminResult"></div>
                <div class="admin-model"></div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/adminhome.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function loadData(event, idname, urlpage, dis) {
            event.preventDefault();
            idname = '#' + idname;
            var formData = $(`${idname}`).serialize();
            $.ajax({
                type: "POST",
                url: urlpage,
                data: formData,
                success: function(response) {
                    $(`#${dis}`).html(response);
                }

            })
        }

        function picloadData(event, idname, urlpage, dis) {
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
            $('#placement').submit(function(event) {
                loadData(event, "placement", "placement.php", "placementResult");
            })
        })

        $(document).ready(function() {
            $('#searchAttendanceForm').submit(function(event) {
                loadData(event, "searchAttendanceForm", "searchattendance.php", "serachAttendanceResult")
            })
        })
        $(document).ready(function() {
            $('#updatePass').submit(function(event) {
                loadData(event, "updatePass", "updatePass.php", "updatePassword");
            })
        });
        $(document).ready(function() {
            $('#updateAdminprofile').submit(function(event) {
                picloadData(event, "updateAdminprofile", "updateProfile.php", "updateAdminResult")
            })
        })
        $(document).ready(function() {
            $('#TimeTable').submit(function(event) {
                loadData(event, "TimeTable", "searchTimeTable.php", "resultTimeTable");
            })
        })
        const searchInput = document.getElementById('regnoSearch')
        const searchregno = document.querySelectorAll('.regno')
        console.log(searchregno)
        searchInput.addEventListener('keyup', () => {
            const userInput = searchInput.value.toLowerCase();

            searchregno.forEach((element) => {
                const regno = element.textContent.toLowerCase();
                if (regno.includes(userInput)) {
                    element.parentNode.style.display = "table-row";
                } else {
                    element.parentNode.style.display = "none";
                }
            });
        })
    </script>
</body>

</html>