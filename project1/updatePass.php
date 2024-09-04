<?php
session_start();
if($_SESSION['user']=="admin"){
    $id = $_SESSION['facultyid'];
    $columnName="facultyid";
}
else{
    $id = $_SESSION['regno'];
    $columnName="regno";
}
$conn=mysqli_connect('localhost',"root","","register");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newpass = $_POST['newpass'];
    $conpass = $_POST['conpass'];
    $tbname=$_SESSION['user']."login";
    if (strcmp($newpass, $conpass) == 0 && !empty($newpass) && !empty($conpass)) {
        $sql = "UPDATE $tbname SET password=$newpass where $columnName=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<script type="text/javascript">window.location.href = "login.php";</script>';
            exit();
        }
    } else {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Password Doesn't Match
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>";
    }
}
