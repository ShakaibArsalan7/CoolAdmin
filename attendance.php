<?php


require_once("connection.php");
if (!$conn->connect_error) {

    $form = $_POST['fform'];

    if ($form == "addattendance") {


        $attData = json_decode($_POST['attendanceData']);

        foreach ($attData as $info) {
            $sql = "select * from laborAttendance where date = '$info[2]' and employee_id = $info[0] and deleted != 1";

            $res = $conn->query($sql);

            if ($res->num_rows > 0) {
                $sql = "update laborAttendance set attendance_description = '$info[1]' where date = '$info[2]' and employee_id = $info[0] and deleted != 1";
                $res = $conn->query($sql);
                if ($res) {
                    echo "<script>snackbar('Successfully Added','green')</script>";
                    //echo "Added Successfully";
                } else {
                    echo "<script>snackbar('Adding Failure','red')</script>";
                }
            } else {
                $sql = "insert into laborAttendance(date,employee_id,attendance_description,deleted) values('$info[2]',$info[0],'$info[1]',false);";
                $res = $conn->query($sql);
                if ($res) {
                    echo "<script>snackbar('Successfully Added','green')</script>";
                    //echo "Added Successfully";
                } else {
                    echo "<script>snackbar('Adding Failure','red')</script>";
                }
            }
        }

        
    } else if ($form == "updateattendance") {
        $emp = (int)$_POST['emp'];
        $date = $_POST['date'];
        $attsta = $_POST['attsta'];

        $sql = "select * from laborAttendance la where la.date = '$date' and la.employee_id = $emp  and la.deleted != 1";
        $res = $conn->query($sql);
        if($res->num_rows > 0){
            // update
            $sql = "update laborAttendance set attendance_description = '$attsta' where date = '$date' and employee_id = $emp and deleted != 1";
            $res = $conn->query($sql);
            if($res){
                echo "<script>snackbar('Successfully Updated','green')</script>";

            }else{
                echo "<script>snackbar('Updation Failure','red')</script>";

            }
        }else{
            // insert
            $sql = "insert into laborAttendance(date,employee_id,attendance_description,deleted) values('$date',$emp,'$attsta',false);";
            $res = $conn->query($sql);
            if($res){
                echo "<script>snackbar('Successfully Inserted','green')</script>";

            }else{
                echo "<script>snackbar('Insertion Failure','red')</script>";

            }
        }


    }
}
