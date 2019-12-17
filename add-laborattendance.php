<?php require_once('session.php') ?>

<?php
require_once("connection.php"); 

if(!$conn->connect_error){// if database connected.

    $opt = "";
    $sql =  "select employee_id, user_name from employee where deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        // echo "<script>alert('a')</script>";
        $opt .='<option value='. $row['employee_id'] .'>'. $row['employee_id'] . ' - ' . $row['user_name'] .'</option>';

        

    }
    }


    $opt1 = "";
    $sql =  "select typeID,typeName from AttenadnceType where deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        // echo "<script>alert('a')</script>";
        $opt1 .='<option value='. $row['typeID'] .'>'. $row['typeName'] .'</option>';

        

    }
    }


}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Add Labor Attendance</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php include_once("header.php")?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php include_once("aside.php")?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                        <?php include_once('accountdetail.php')?>
                        </div>
                    </div>
                </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        Add <strong>Labor Attendance</strong>
                                    </div>


                                    <div class="card-body card-block">
                                            <div class="row form-group">
                                                <div class="col col-md-8">
                                                    <div class="row">
                                                        <div class="col-sm-8" id="tabletitle"><h2>Attendance Details</h2></div>
                                                    </div>

                                                                <div class="row form-group">
                                                                    <div class="col col-md-2">
                                                                        <label for="employeeid" class=" form-control-label">Employee ID</label>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <select class="form-control" name="employeeid" id="employeeid">
                                                                            <option value="select">select option</option><?php echo $opt;?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row form-group">
                                                                    <div class="col col-md-2">
                                                                        <label for="hf-date" class=" form-control-label">Date</label>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <input type="date" id="hf-date" name="hf-date" placeholder="Enter Date..." class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="row form-group">
                                                                    <div class="col col-md-2">
                                                                        <label for="hf-attendancestatus" class=" form-control-label">Attendance Status</label>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <select class="form-control" name="attendancestatus" id="attendancestatus">
                                                                            <option value="select">select option</option><?php echo $opt1;?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row form-group">
                                                                    <div class="col col-md-3">
                                                                    <button class="btn btn-primary btn-lg" onclick="submitform()">Add Attendance<button>
                                                                </div>
                                                                <div id="addatt">
                                                                </div>
                                            </div>

                                                    </div>

                                                    
                                            </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <!-- <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <div id="snackbar"></div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>




<script>

function submitform() {
  if(checkValidity()) {
        //send request to form
    var employeeid = document.getElementById('employeeid').value;
    var date = document.getElementById('hf-date').value;
    var attendancestatus = document.getElementById('attendancestatus').value;

    $('#addatt').load("attendance.php", {
        empid : employeeid,
        date: date,
        attsta : attendancestatus
         },function(){
            snackbar("Attendance Added.");    
            document.getElementById('employeeid').value = "select";
            document.getElementById('hf-date').value = "";
            document.getElementById('attendancestatus').value = ""  ; 
         });

  }
}

function checkValidity(){
    var employeeid = document.getElementById('employeeid').value;
    var date = document.getElementById('hf-date').value;
    var attendancestatus = document.getElementById('attendancestatus').value;
    // alert(employeeid);
    // alert(date);
    // alert(attendancestatus);
    if(employeeid == "select"){
        snackbar("Employee ID is required");
        return false;
    }
    if(date == ""){
        snackbar("Date is required");
        return false;
    }
    if(attendancestatus == "select"){
        snackbar("Attendance Status is required");
        return false;
    }
    return true;
}



function snackbar(message) {
  // Get the snackbar DIV
  var x = document.getElementById("snackbar");
  x.innerHTML =message;

  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>

</body>

</html>
<!-- end document-->
