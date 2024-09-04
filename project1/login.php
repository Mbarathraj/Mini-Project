<?php
$conn = mysqli_connect("localhost", "root", "", "register");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>

    <div class="container">
        <div class="pic col-12 d-flex justify-content-center">
            <h2 class="intro">
                <span class="text-success"> WELCOME ! . . .</span> TO KSR <span class="text-uppercase">College of Engineering</span>
            </h2>
            <img src="./assests/img/svg/login.svg" alt="">
            <button id="login" class="btn btn-outline-success rounded-pill col-4">Click Here To Login</button>
        </div>
        <div class="details col-8 ps-3">
            <h3 class="text-center">LOGIN</h3>
            <div class="mt-5">
                <form action="login.php" method="post" class="">
                    <label for=""> Admin / Student:</label>
                    <select name="user" id="" class="form-control form-select mt-3">
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                    </select>
                    <br>
                    <label for="email">Email ID:</label>
                    <input type="email" name="email" id="email" class="form-control mt-3" required>
                    <br>
                    <label for="pass">Password:</label>
                    <input type="password" name="password" id="pass" class="form-control mt-3" required>
                    <br>
                    <button type="submit" class="btn btn-success mt-3 form-control" name="login"> Login</button>
                    <br>
                    <br>
                    <a href="">Forgot Password?</a>
                    <?php
                    if (isset($_POST['login'])) {
                        $user=$_POST['user'];
                        $email = $_POST['email'];
                        $pass = $_POST['password'];
                        $_SESSION['email'] = $email;
                        $tbname=$user."login";
                        echo $tbname;
                        $sql = "SELECT * FROM $tbname WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if (strcmp($pass, $row['password']) == 0 && $tbname=="adminlogin") {
                                        $_SESSION['facultyid']=$row['facultyid'];
                                        header('Location: adminhome.php');
                                    }
                                    else if(strcmp($pass, $row['password']) == 0 && $tbname=="studentlogin"){
                                     
                                        $_SESSION['regno'] = $row['regno'];
                                        header('Location: home.php');
                                    } 
                                    else {
                                        echo "<script>
                                                let details=document.querySelector('.details')
                                                let pic=document.querySelector('.pic')
                                                pic.classList.add('slidep')
                                                details.classList.add('slidel')
                                                </script>";
                                        echo "<div class='alert alert-danger mt-2'>Wrong Password</div>";
                                    }
                                }
                            } else {
                                echo "<script>
                                let details=document.querySelector('.details')
                                let pic=document.querySelector('.pic')
                                pic.classList.add('slidep')
                                details.classList.add('slidel')
                                </script>";
                                echo "<div class='alert alert-danger mt-2'>No matching records found</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger mt-2'>Error executing the query: " . mysqli_error($conn) . "</div>";
                        }
                    }

                    ?>
                </form>
            </div>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/login.js"></script>
</body>

</html>