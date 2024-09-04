<?php
session_start();
$sessionRegno=$_SESSION['regno'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $regno=$_POST['resultregno'];
   
 }  


?>