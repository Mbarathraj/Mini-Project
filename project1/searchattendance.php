<?php
$currentDate = date("Y-m-d");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $branch = $_POST['attendanceBranch'];
    $year = $_POST['attendanceYear'];
    $attcon = mysqli_connect("localhost", "root", "", "student_details");
    $section = $_POST['attendanceSection'];
    $tableName = ($branch . $year . $section);
    $sql = "SELECT * FROM $tableName";
    $result = mysqli_query($attcon, $sql);
    $noOfStudents = mysqli_num_rows($result);

    echo '<div class="header border p-2 mt-4">
        <div class="row text-center">
            <h3>Student Attendance</h3>
        </div>
        <div class="row ms-2 me-2">
            <div class="col-12 col-md-8">
                <h6>Class &nbsp;: <span>BE- ';
    switch ($branch) {
        case 'cse':
            echo "Computer Science And Engineering";
            break;
        case 'ece':
            echo "Electronics and Communication Engineering";
            break;
        case 'it':
            echo "Information Technology";
            break;
        case 'eee':
            echo "Electrical and Electronics Engineering";
            break;
        case 'civil':
            echo "Civil";
            break;
        case 'mech':
            echo "Mechanical Engineering";
            break;
        case 'auto':
            echo "Auto Mobile";
            break;
        case 'iot':
            echo "Internet Of Things";
            break;
        case 'csd':
            echo "Computer Science And Design";
            break;
        case "sfe":
            echo "Safety And Fire Engineering";
            break;
    }
    echo '</span></h6>
                <h6>Year &nbsp;&nbsp;: 3 <sup>rd</sup></h6>
            </div>';
    echo '<div class="col-12 col-md-4 text-md-end">
               <h6>Total No. Students:';
    echo $noOfStudents;
    echo '</h6>
               </div>
             </div>
         </div>
    <div class="details mt-5 border p-2">';
    if ($result) {
        echo "
                <form id='attendanceForm'>
                <div class='table-responsive'>
                <table class=' table table-bordered table-hover'>
                <tr>
                  <th>Registet No.</th>
                  <th>Name</th>
                  <th>Present</th>
                  <th>Date</th>
                </tr>
                ";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "
                    <tr>
                      <td>{$row['reg_no']}</td>
                      <td class='text-danger'>{$row['name']}</td>
                      <td>
                        <div class='col text-center'>
                        <input type='checkbox' name='{$row['reg_no']}' class='input-group'  id='present' style='height:3vh''/>
                        </div>
                       
                      </td>
                      <td>$currentDate</td>
                    ";
        }
    }
    echo "</table></div>";
    echo "
            <div class='row justify-content-end me-2' >
            <button type='submit' class='btn btn-success col-4' name='asubmit'>Submit</button>
            </div>
            </form>
            ";
    echo '<script>

    function loadData(event,idname,urlpage,dis){
        event.preventDefault();
        idname="#"+idname;
        var formData=$(`${idname}`).serialize();
        $.ajax({
            type: "POST",
            url:urlpage,
            data:formData,
            success: function(response){
                $(`#${dis}`).html(response);
            }

        })
    }
    $(document).ready(function(){
        $("#attendanceForm").submit(function(event){
            console.log("Form submitted.");
            loadData(event,"attendanceForm","attendance.php","attendanceResult");
        })
    })
    </script>';
}
