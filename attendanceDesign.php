<?php
require_once("connection.php");






if(!$conn->connect_error){


// //$id = $_POST['fmodid'];
$form = $_POST['fform'];
$month = $_POST['month'];
$year = $_POST['year'];

if($form === "timechange"){
    echo "var noOfDays = ", cal_days_in_month(CAL_GREGORIAN, date($month), date($year)), ";";
    $sql = "select count(*) as noOfEmployees from employee e where e.deleted != 1";
    $noOfEmployees = $conn->query($sql)->fetch_object()->noOfEmployees;
    $sql = "select * from employee e where e.deleted != 1";
    $employees = $conn->query($sql);
    $enames = array();
    if ($employees->num_rows > 0) {
        while ($row = $employees->fetch_assoc()) {
            $enames[] = $row;
        }
    }
    $js_enames = json_encode($enames);


    $sql = "SELECT * FROM laborAttendance la where la.deleted !=1 and MONTH(la.date) = $month and YEAR(la.date) = $year;";
    $attendances = $conn->query($sql);
    $labattendances = array();
    if ($attendances->num_rows > 0) {
        while ($row = $attendances->fetch_assoc()) {
            $labattendances[] = $row;
        }
    }
    $js_labattendances = json_encode($labattendances);
    echo "<script>";
    echo "var enames = " . $js_enames . ";";
    echo "var labattendances = " . $js_labattendances . ";";
    echo "var noOfEmployees = ", $noOfEmployees, ";";
    echo "var month = '", date('m'), "';";
    echo "var daytoday = '", date('d'), "';";
    echo "resetBoxes(noOfEmployees, labattendances, noOfDays,daytoday,enames,false);";
    echo "</script>";
}

}




?>