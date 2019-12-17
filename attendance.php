<?php


require_once("connection.php");
if(!$conn->connect_error){

$eid = $_POST['empid'];
$date = $_POST['date'];
$atsta = $_POST['attsta'];

$sql = "select * from laborAttendance where date = '$date' and employee_id = $eid and deleted != 1";

$res = $conn->query($sql);

if($res->num_rows > 0 ){
    $sql = "update laborAttendance set attendance_description = '$atsta' where date = '$date' and employee_id = $eid and deleted != 1";
    $res = $conn->query($sql);
    if($res){
        //echo "Added Successfully";
    }
}else{
    $sql = "insert into laborAttendance(date,employee_id,attendance_description,deleted) values('$date',$eid,'$atsta',false);";
    $res = $conn->query($sql);
    if($res){
        //echo "Added Successfully";
    }
}





}

?>
