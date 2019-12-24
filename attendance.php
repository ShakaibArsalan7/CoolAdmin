<?php


require_once("connection.php");
if(!$conn->connect_error){

// $eid = $_POST['empid'];
// $date = $_POST['date'];
// $atsta = $_POST['attsta'];
// echo "<script>alert('here')<script>";

$attData=json_decode($_POST['attendanceData']);
// $c = count($attData);
// echo "<script>alert('$c')<script>";

foreach($attData as $info){
    $sql = "select * from laborAttendance where date = '$info[2]' and employee_id = $info[0] and deleted != 1";

    $res = $conn->query($sql);
    
    if($res->num_rows > 0 ){
        $sql = "update laborAttendance set attendance_description = '$info[1]' where date = '$info[2]' and employee_id = $info[0] and deleted != 1";
        $res = $conn->query($sql);
        if($res){
            //echo "Added Successfully";
        }
    }else{
        $sql = "insert into laborAttendance(date,employee_id,attendance_description,deleted) values('$info[2]',$info[0],'$info[1]',false);";
        $res = $conn->query($sql);
        if($res){
            //echo "Added Successfully";
        }
    }
}







}

?>
