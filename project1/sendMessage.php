<?php
session_start();
$sessionRegno=$_SESSION['regno'];
$sessionName= $_SESSION['name'];
$conn=mysqli_connect("localhost","root","","chatdb");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $message=$_POST['message'];
    $currentTimestamp = time();
    $formattedDate = date("Y-m-d H:i:s", $currentTimestamp);
    $sql="INSERT INTO chats VALUES('$sessionName','$message','$formattedDate','')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo '<div class="alert alert-info  d-flex justify-contnet-between col-md-10">';
        echo '<div class="col-5 ">';
        echo  $message;
        echo '</div>';
        echo '<div class="col-5 text-end"><sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo  $formattedDate;
        echo '</sub></div>';
        echo '</div>';
    }
}

?>