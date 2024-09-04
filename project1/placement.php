<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $branch = $_POST['psBranch'];
    $year = $_POST['year'];
    $dbName = $branch . "placement";
    $conn = mysqli_connect("localhost", "root", "", "$dbName");
    $tbName = "placement_" . $year;
    echo "<script>
    setInterval(function() {
       
    }, 3000);
    </script>";
    $sql = "SELECT * FROM $tbName";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<div class="table-responsive">
        <table class="table table-bordered mt-3">';
        echo "  <tr class='text-center'>
        <th>Reg No:</th>
        <th colspan='2'>Details</th>
    </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
           echo "
        <tr>
            <th rowspan='13' class='text-center mt-5'>";
            echo $row['regno'];
        echo "</th>
        </tr>
        <tr>
            <th>Name</th>
            <td>{$row['name']}</td>
        </tr>
        <tr>
            <th>Department</th>
            <td>{$row['dept']}</td>
        </tr>
        <tr>
            <th>Year</th>
            <td>{$row['year']}</td>
        </tr>
        <tr>
            <th>Section</th>
            <td>{$row['sec']}</td>
        </tr>

        <tr>
            <th>Placement Id</th>
            <td>{$row['placementid']}</td>
        </tr>

        <tr>
            <th>Number of Company Attend</th>
            <td>{$row['companyattend']}</td>
        </tr>

        <tr>
            <th>Number of Intership</th>
            <td>{$row['noofintern']}</td>
        </tr>
        <tr>
            <th>CGPA</th>
            <td>{$row['cgpa']}</td>
        </tr>
        <tr>
            <th>10<sup>th</sup> %</th>
            <td>{$row['10thper']}</td>
        </tr>

        <tr>
            <th>12<sup>th</sup> %</th>
            <td>{$row['12thper']}</td>
        </tr>
        <tr>
            <th>Skills</th>
            <td>{$row['skills']}</td>
        </tr>
        <tr>
            <th>Resume</th>
            <td class='text-center'>";
?>
        <?php 
        if(!empty($row['resume'])){
           echo " <a href='{$row['resume']}' download>
                <img src='./assests/img/profile.png' alt='' style='height: 35px; cursor: pointer;''>
            </a>
            </td>
        </tr>";
        }
    }
        echo "</table>
        </div>";
    }
}







?>










