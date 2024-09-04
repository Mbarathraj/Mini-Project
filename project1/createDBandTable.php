<div class="accordion col-12" id="accordion">

<div class="accordion-item">

    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#content">
        <h6> Create New Database And Table</h6>
    </button>

    <div class="accordion-collapsed collapse show" id="content" data-bs-parent="#accordion">

        <div class="accordion-body w-100">

            <form action="adminhome.php" method="post" class="form d-flex flex-column gap-2 border p-3 pt-5 w-100">

                <div class="row d-flex align-items-center justify-content-center">

                    <div class="col-sm-8 col-12">
                        <h6 class="form-label">Database Name:</h6>
                        <input type="text" name="db" id="id" class="form-control rounded-pill" required value="<?php
                                                                                                                if (isset($_POST['submit'])) {
                                                                                                                    echo $_POST['db'];
                                                                                                                }
                                                                                                                ?>">
                    </div>

                </div>
                <div class="row d-flex align-items-center justify-content-center">

                    <div class="col-sm-8 col-12">

                        <h6 class="form-label">Table Name:</h6>
                        <input type="text" name="tb" id="tb" class="form-control rounded-pill" required value="<?php
                                                                                                                if (isset($_POST['submit'])) {
                                                                                                                    echo $_POST['tb'];
                                                                                                                }
                                                                                                                ?>">
                    </div>

                </div>
                <div class="row d-flex align-items-center justify-content-center">

                    <div class="col-sm-8 col-12">

                        <h6 class="form-label">Number of Columns:</h6>
                        <input type="number" name="column" id="column" class="form-control rounded-pill" min="1" required value="<?php
                                                                                                                                    if (isset($_POST['submit'])) {
                                                                                                                                        echo $_POST['column'];
                                                                                                                                    }
                                                                                                                                    ?>">
                    </div>

                </div>
                <div class="row d-flex justify-content-center">

                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-outline-success form-control w-50 rounded-pill mt-4" type="submit" name="submit">Create</button>
                    </div>
                </div>

            </form>

            <?php
            $con = mysqli_connect("localhost", "root", "");
            if (isset($_POST['submit'])) {
                $dbname = $_POST['db'];
                $tbname = $_POST['tb'];
                $noofcol = $_POST['column'];
                $_SESSION['noColumn'] = $noofcol;
                $_SESSION['tablename'] = $tbname;
                $_SESSION['dbname'] = $dbname;
                $result = $con->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
                if ($result->num_rows > 0) {
                    echo "<div class='alert alert-success'>Already exists</div>";
                } else {
                    $sql = "create database $dbname";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        echo "<div class='alert alert-success mt-2'>Created</div>";
                        echo "<div class='container mt-5'>
<form action='createdb.php' method='post' class='form'>
<div class='table-responsive form-control'>
<table class='table table-bordered table-hover mt-0 mb-0 ms-2 me-2 text-center'>
<tr>
    <th>Name</th>
    <th>Type</th>
    <th>Length/Values</th>
    <th>Default</th>
    <th>Attributes</th>
    <th>Null</th>
    <th>Index</th>
    <th>Auto Increment</th>
    <th>Media Type</th> 
</tr>";
                        $size = $noofcol;
                        while ($noofcol > 0) {
                            echo "
<tr>
    <td>
        <input type='text'  name='clname$noofcol'>
    </td>
    <td><select name='type$noofcol'>
        <option>INT</option>
        <option>VARCHAR</option>
        <option>DATE</option>
        <option>TEXT</option>
    </select>
</td>
    <td>
        <input type='text' name='len$noofcol'>
    </td>
    <td>
        <select name='default$noofcol'>
            <option>None</option>
            <option>As defined:</option>
            <option>NULL</option>
            <option>CURRENT_TIMESTAMP</option>
        </select>
    </td>
    <td>
        <select name='attributes$noofcol'>
        
            <option></option>
            <option>BINARY</option>
            <option>UNSIGNED </option>
            <option>UNSIGNED ZEROFILL</option>
            <option>CURRENT_TIMESTAMP</option>
        </select>
    </td>
    <td>
        <input type='checkbox' name='nullcheck$noofcol'>
    </td>
    <td>
        <select name='index$noofcol'>
            <option></option>
            <option >PRIMARY</option>
            <option >UNIQUE</option>
            <option >INDEX</option>
            <option >FULLTEXT</option>
        </select>
    </td>
    <td>
        <input type='checkbox' name='aicheck$noofcol'>
    </td>
    <td>
        <select name='media$noofcol'>
            <option>Image/jpeg</option>
            <option >text/plain</option>
            <option >application/octetstream</option>
            <option >image/png</option>
        </select>
    </td>        
</tr>";
                            $noofcol--;
                        } ?>
            <?php

                        echo "</table>
</div>
</div>
<div class='row d-flex justify-content-center'>
<button type='submit' name='tsubmit' class='btn btn-primary d-flex justify-content-center col-5 mt-3 mb-3 ms-5'>Save</button>
</div>
</form>";
                    } else {
                        echo "<div class='alert alert-danger'>Already Exists</div>.. $conn->error";
                    }
                }
            }
            ?>
            <?php

            if (isset($_POST['tsubmit'])) {
                $size = $_SESSION['noColumn'];
                $dbname = $_SESSION['dbname'];
                $tablename = $_SESSION['tablename'];
                $len = $size;
                $conn = mysqli_connect("localhost", "root", "", "$dbname");
                $column = $_POST["clname$size"];
                $length = $_POST["len$size"];
                $type = $_POST["type$size"] === "VARCHAR" ? "VARCHAR($length)" : $_POST["type$size"];
                $default = $_POST["default$size"] === "None" ? "" : $_POST["default$size"];
                $attributes = $_POST["attributes$size"];
                $nullChecked = isset($_POST["nullcheck$size"]) ? "Null" : "NOT NULL";
                $index = $_POST["index$size"];
                $aiChecked = isset($_POST["aicheck$size"]) ? "AUTO_INCREMENT" : "";
                $index = isset($_POST["aicheck$size"]) ? "PRIMARY KEY" : "";
                $media = $_POST["media$size"];
                $size--;
                $query = "create table $tablename ($column $type $attributes $default $nullChecked $aiChecked $index)";
                mysqli_query($conn, $query);
                $c = 1;
                while ($size > 0) {
                    $column = $_POST["clname$size"];
                    $length = $_POST["len$size"];
                    $type = $_POST["type$size"] === "VARCHAR" ? "VARCHAR($length)" : $_POST["type$size"];
                    $default = $_POST["default$size"] === "None" ? "" : $_POST["default$size"];
                    $attributes = $_POST["attributes$size"];
                    $nullChecked = isset($_POST["nullcheck$size"]) ? "Null" : "NOT NULL";
                    $index = $_POST["index$size"];
                    $aiChecked = isset($_POST["aicheck$size"]) ? "AUTO INCREMENT" : "";
                    $index = isset($_POST["aicheck$size"]) ? "PRIMARY KEY" : $_POST["index$size"];
                    $media = $_POST["media$size"];
                    $size--;
                    $sql = "alter table $tablename add $column $type $attributes $default $nullChecked $aiChecked $index";
                    $result = mysqli_query($conn, $sql);
                    $c++;
                }
                if ($c == $len) {
                    echo "<div class='alert alert-success'>Database And Table Creataed</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error</div>";
                }
            }
            ?>
        </div>
    </div>
</div>
</div>

<div class="accordion col-12" id="accordion">
<div class="accordion-item col-12 mt-3 ">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#content1">
        <h6>Create Table from Exist Database</h6>
    </button>
    <div class="accordion-collapsed collapse show" id="content1" data-bs-parent="#accordion">

        <div class="accordion-body w-100">

            <form action="adminhome.php" method="post" class="form d-flex flex-column gap-2 border p-3 pt-5 w-100">

                <div class="row d-flex align-items-center justify-content-center">

                    <div class="col-sm-8 col-12">
                        <h6 class="form-label">Exists Database Name:</h6>
                        <input type="text" name="edb" id="id" class="form-control rounded-pill" required value="<?php
                                                                                                                if (isset($_POST['esubmit'])) {
                                                                                                                    echo $_POST['edb'];
                                                                                                                }
                                                                                                                ?>">
                    </div>

                </div>
                <div class="row d-flex align-items-center justify-content-center">

                    <div class="col-sm-8 col-12">

                        <h6 class="form-label">New Table Name:</h6>
                        <input type="text" name="etb" id="tb" class="form-control rounded-pill" required value="<?php
                                                                                                                if (isset($_POST['esubmit'])) {
                                                                                                                    echo $_POST['etb'];
                                                                                                                }
                                                                                                                ?>">
                    </div>
                </div>
                <div class="row d-flex align-items-center justify-content-center">

                    <div class="col-sm-8 col-12">

                        <h6 class="form-label">Number of Columns:</h6>
                        <input type="number" name="ecolumn" id="column" class="form-control rounded-pill" min="1" required value="<?php
                                                                                                                                    if (isset($_POST['esubmit'])) {
                                                                                                                                        echo $_POST['ecolumn'];
                                                                                                                                    }
                                                                                                                                    ?>">
                    </div>

                </div>
                <div class="row d-flex justify-content-center">

                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-outline-success form-control w-50 rounded-pill mt-4" type="submit" name="esubmit">Create</button>
                    </div>

                </div>

            </form>
            <?php
            if (isset($_POST['esubmit'])) {
                $dbname = $_POST['edb'];
                $tbname = $_POST['etb'];
                $noofcol = $_POST['ecolumn'];
                $_SESSION['enoColumn'] = $noofcol;
                $_SESSION['etablename'] = $tbname;
                $_SESSION['edbname'] = $dbname;
                echo "<div class='container mt-5'>
<form action='adminhome.php' method='post' class='form'>
<div class='table-responsive form-control'>
<table class='table table-bordered table-hover mt-0 mb-0 ms-2 me-2 text-center'>
<tr>
<th>Name</th>
<th>Type</th>
<th>Length/Values</th>
<th>Default</th>
<th>Attributes</th>
<th>Null</th>
<th>Index</th>
<th>Auto Increment</th>
<th>Media Type</th> 
</tr>";
                $size = $noofcol;
                while ($noofcol > 0) {
                    echo "
<tr>
<td>
<input type='text'  name='eclname$noofcol'>
</td>
<td><select name='etype$noofcol'>
<option>INT</option>
<option>VARCHAR</option>
<option>DATE</option>
<option>TEXT</option>
</select>
</td>
<td>
<input type='text' name='elen$noofcol'>
</td>
<td>
<select name='edefault$noofcol'>
    <option>None</option>
    <option>As defined:</option>
    <option>NULL</option>
    <option>CURRENT_TIMESTAMP</option>
</select>
</td>
<td>
<select name='eattributes$noofcol'>

    <option></option>
    <option>BINARY</option>
    <option>UNSIGNED </option>
    <option>UNSIGNED ZEROFILL</option>
    <option>CURRENT_TIMESTAMP</option>
</select>
</td>
<td>
<input type='checkbox' name='enullcheck$noofcol'>
</td>
<td>
<select name='eindex$noofcol'>
    <option></option>
    <option >PRIMARY</option>
    <option >UNIQUE</option>
    <option >INDEX</option>
    <option >FULLTEXT</option>
</select>
</td>
<td>
<input type='checkbox' name='eaicheck$noofcol'>
</td>
<td>
<select name='emedia$noofcol'>
    <option>Image/jpeg</option>
    <option >text/plain</option>
    <option >application/octetstream</option>
    <option >image/png</option>
</select>
</td>        
</tr>";
                    $noofcol--;
                }
                ob_flush();

            ?>
            <?php
                echo "</table>
</div>
</div>
<button type='submit' name='etsubmit' class='btn btn-primary d-flex justify-content-center col-5 mt-3 mb-3 ms-5'>Save</button>
</form>";
            }
            ?>
            <?php
            if (isset($_POST['etsubmit'])) {
                ob_start();

                $size = $_SESSION['enoColumn'];
                $dbname = $_SESSION['edbname'];
                $tablename = $_SESSION['etablename'];
                $len = $size;
                $con = mysqli_connect("localhost", "root", "");
                $result = $con->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
                if ($result->num_rows > 0) {
                    $column = $_POST["eclname$size"];
                    $length = $_POST["elen$size"];
                    $type = $_POST["etype$size"] === "VARCHAR" ? "VARCHAR($length)" : $_POST["etype$size"];
                    $default = $_POST["edefault$size"] === "None" ? "" : $_POST["edefault$size"];
                    $attributes = $_POST["eattributes$size"];
                    $nullChecked = isset($_POST["enullcheck$size"]) ? "Null" : "NOT NULL";
                    $index = $_POST["eindex$size"];
                    $aiChecked = isset($_POST["eaicheck$size"]) ? "AUTO_INCREMENT" : "";
                    $index = isset($_POST["eaicheck$size"]) ? "PRIMARY KEY" : "";
                    $media = $_POST["emedia$size"];
                    $size--;
                    $query = "create table $tablename ($column $type $attributes $default $nullChecked $aiChecked $index)";
                    mysqli_query($conn, $query);
                    $c = 1;
                    while ($size > 0) {
                        $column = $_POST["eclname$size"];
                        $length = $_POST["elen$size"];
                        $type = $_POST["etype$size"] === "VARCHAR" ? "VARCHAR($length)" : $_POST["etype$size"];
                        $default = $_POST["edefault$size"] === "None" ? "" : $_POST["edefault$size"];
                        $attributes = $_POST["eattributes$size"];
                        $nullChecked = isset($_POST["enullcheck$size"]) ? "Null" : "NOT NULL";
                        $index = $_POST["eindex$size"];
                        $aiChecked = isset($_POST["eaicheck$size"]) ? "AUTO INCREMENT" : "";
                        $index = isset($_POST["eaicheck$size"]) ? "PRIMARY KEY" : $_POST["eindex$size"];
                        $media = $_POST["emedia$size"];
                        $size--;
                        $sql = "alter table $tablename add $column $type $attributes $default $nullChecked $aiChecked $index";
                        $result = mysqli_query($conn, $sql);
                        $c++;
                    }
                    if ($c == $len) {
                        echo "<div class='alert alert-success'>Table Created</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Database Not Exists</div>";
                }
            }
            ob_end_flush();
            ?>
        </div>
    </div>
</div>
</div>
</div>