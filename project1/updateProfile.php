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
$con=mysqli_connect("localhost","root","","register");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c=0;
 foreach($_POST as $key =>$value){
   $tbname=$_SESSION['user']."login";
    if($value!=null){       
        $sql="UPDATE $tbname SET $key='$value' where $columnName=$id";
        $result=mysqli_query($con,$sql);
        if($result){
            $c++;
        }
    } 
 }  
 if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
    $target_dir = $_SESSION['user']."uploads/";
    echo $target_dir;
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if ($check === false) {
        echo "File is not a valid image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["img"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["img"]["name"])) . " has been uploaded.";
            // Save the file path to the database or perform other necessary operations
            $sql = "UPDATE $tbname SET pic='$target_file' WHERE $columnName='$id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $c++;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

 if($c>0){
    echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        Updated Successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
else{
    echo '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    Error
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
}
?>
