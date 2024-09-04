<?php
$currentDate = date("Y-m-d"); 
$conn=mysqli_connect("localhost","root","","student_details");
$sql="SELECT * FROM cse3a";
$con=mysqli_connect("localhost","root","","attendance");
$result=mysqli_query($conn,$sql);
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $count=0;
    foreach ($_POST as $key => $value) {
        $count++;
        if(is_numeric($key)){
           $sql="Insert INTO cse3a VALUES('$key','$currentDate')";
           $query=mysqli_query($con,$sql);
        }
    }
    if($count>=1){
        echo '<div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
        Updated Successfully
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
  }
  else{
    echo "hie";
  }
?>