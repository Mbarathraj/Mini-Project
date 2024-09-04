<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "cseplacement");
$sessionRgno = $_SESSION['regno'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c = 0;
    if (isset($_FILES['resume']['name']) && !empty($_FILES['resume']['name'])) {
        $target_dir = $_SESSION['user'] . "resumeuploads/";
        $target_file = $target_dir . basename($_FILES["resume"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["resume"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedFileTypes = array("jpg", "jpeg", "png", "gif", "pdf", "doc", "docx");

        // Get the file extension
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file type is allowed
        if (!in_array($imageFileType, $allowedFileTypes)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, and DOCX files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
                // Save the file path to the database or perform other necessary operations
                $sql = "UPDATE placement_2024 SET resume='$target_file' WHERE regno='$sessionRgno'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $c++;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    if ($c > 0) {
        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            Updated Successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        Error
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}
