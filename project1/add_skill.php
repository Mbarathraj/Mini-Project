<?php

session_start();
$sessionRegno = $_SESSION['regno'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addNew = $_POST['addskills'];

    $sessioRegno = $_SESSION['regno'];
    $sessiondeptabb = $_SESSION['deptabb'];
    $placementDbName =  $sessiondeptabb . "placement";
    $placementConnection = mysqli_connect("localhost", "root", "", "$placementDbName");
    $sql = "SELECT * from placement_2024 WHERE  regno='$sessioRegno'";
    $result = mysqli_query($placementConnection, $sql);
    if ($result) {
        $skills = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $skills = $skills . $row['skills'];
        }
        $skills = $skills . " " . $addNew;
        $upsql = "UPDATE `placement_2024` SET `skills`='$skills' WHERE regno=$sessioRegno";
        $upresult = mysqli_query($placementConnection, $upsql);
       
        
    }
}
