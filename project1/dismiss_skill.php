<?php 
session_start();
$index = $_POST['index'];
$sessioRegno = $_SESSION['regno'];
$sessiondeptabb= $_SESSION['deptabb'];
$placementDbName =  $sessiondeptabb. "placement";
$placementConnection = mysqli_connect("localhost", "root", "", "$placementDbName");
$sql="SELECT * from placement_2024 WHERE  regno='$sessioRegno'";
$result=mysqli_query($placementConnection,$sql);
if($result){
    $skills="";
    while ($row = mysqli_fetch_assoc($result)) {
        $skills=$skills.$row['skills'];
    }
    $array=explode(" ",$skills);
    $newskills="";
    for($i=0;$i<count($array);$i++){

        if($i!=$index && !empty($array[$i])){
            $newskills=$newskills." ".$array[$i];
        }
    }
    echo "$newskills";
    $upsql="UPDATE `placement_2024` SET `skills`='$newskills' WHERE regno=$sessioRegno";
    $upresult=mysqli_query($placementConnection,$upsql);
    if($upresult){
        echo "updated";
    }
   
}
else{
    
}
?>