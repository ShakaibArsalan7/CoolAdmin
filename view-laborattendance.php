<?php require_once('session.php');
require_once("connection.php");

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
    <title>View Labor Attendance</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="vendor/dataTables/dataTables.bootstrap4.min.css" rel="stylesheet">


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
    <?php
    $divs = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
    $opt2 = "";
    for ($i = 0; $i < 12; $i++) {
        $time = strtotime(sprintf('%d months', $i));
        $label = date('F', $time);
        $value = date('n', $time);
        $opt2 .= "<option value='$value'>$label</option>";
    }


    $opt3 = "";
    $already_selected_value = date('Y');
    $earliest_year = 2019;

    foreach (range(date('Y'), $earliest_year) as $x) {
        $opt3 .= '<option value="' . $x . '"' . ($x === $already_selected_value ? ' selected="selected"' : '') . '>' . $x . '</option>';
    }

    ?>
    <style>
        .sketchbox {
            width: calc((100vw -331) /62);
            height: calc((100vw -331) /46);
            background-color: white;
            border: 1px solid red;
            display: inline-block;
            vertical-align: top;
            margin: 0px;
        }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php include_once("header.php") ?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php include_once("aside.php") ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <?php include_once('accountdetail.php') ?>
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


                                <!-- //boxes -->
                                <div style="width:100%; text-align:center; padding-bottom: 30px">
                                    <h2>Attendance <?php echo date('M'), " ", date('Y') ?></h2>
                                    <div class="rs-select2--light rs-select2--md m-1">
                                        <select class="js-select2" name="monthexp" id="monthexp">
                                            <?php echo $opt2;
                                            ?>
                                        </select>

                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <div class="rs-select2--light rs-select2--sm m-1">
                                        <select class="js-select2" name="yearexp" id="yearexp">
                                            <?php echo $opt3;
                                            ?>
                                        </select>

                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="container-sketch" style="display: block;margin :0px auto">
                                </div>
                                <div style="width:100%; text-align:center; padding-bottom: 30px">
                                    <h2>Attendance Table</h2>
                                </div>
                                <?php
                                // <i class="fas fa-check"></i>
                                // <i class="fas fa-times"></i>

                                if (!$conn->connect_error) {

                                    $sql = 'select e.user_name,att.typeName,la.* from laborAttendance la inner join employee e on e.employee_id = la.employee_id inner join AttenadnceType att on la.attendance_description = att.typeID where la.deleted != 1';
                                    $res = $conn->query($sql);
                                    if ($res->num_rows > 0) {
                                        echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th>Date</th>';
                                        echo '<th>Employee Name</th>';
                                        echo '<th>Attendance Status</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        while ($row = $res->fetch_assoc()) {
                                            echo  '<tr>';
                                            echo  '<td>' . $row['date'] . '</td>';
                                            echo  '<td>' . $row['user_name'] . '</td>';
                                            echo  '<td>' . $row['typeName'] . '</td>';
                                            echo '</tr>';
                                        }




                                        echo '</tbody>';
                                        echo '</table>';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <?php include_once('copyright.php') ?>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>

    <script src="vendor/dataTables/jquery.dataTables.min.js"></script>
    <script src="vendor/dataTables/dataTables.bootstrap4.min.js"></script>
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
        $(document).ready(function() {
            $('#example').DataTable();

            $('#monthexp').on('change', function() {
                var month = this.value;
                var year = $('#yearexp').val();

                // $('.container-sketch').html('');
                $(".container-sketch").text("");
                $('.container-sketch').load("attendanceDesign.php", {
                    month: month,
                    year: year,
                    fform: "timechange"
                });

            });


            $('#yearexp').on('change', function() {
                var year = this.value;
                var month = $('#monthexp').val();

                $(".container-sketch").text("");
                $('.container-sketch').load("attendanceDesign.php", {
                    month: month,
                    year: year,
                    fform: "timechange"
                });

            });

        });


        var main = function() {
            resetBoxes(noOfEmployees, labattendances, noOfDays, daytoday, enames, true);
        };

        //Default width/height values: 10x10
        <?php echo "var noOfDays = ", cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')), ";";
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


        $sql = "SELECT * FROM laborAttendance la where la.deleted !=1 and MONTH(la.date) = MONTH(NOW()) and YEAR(la.date) = YEAR(NOW());";
        $attendances = $conn->query($sql);
        $labattendances = array();
        if ($attendances->num_rows > 0) {
            while ($row = $attendances->fetch_assoc()) {
                $labattendances[] = $row;
            }
        }
        $js_labattendances = json_encode($labattendances);

        echo "var enames = " . $js_enames . ";";
        echo "var labattendances = " . $js_labattendances . ";";
        echo "var noOfEmployees = ", $noOfEmployees, ";";
        echo "var month = '", date('m'), "';";
        echo "var daytoday = '", date('d'), "';";
        ?>
        //   var width = 10;
        //   var height = 10;


        var resetBoxes = function(noOfEmployees, labattendances, noOfDays, daytoday, enames, first) {
            $('.container-sketch').html('');

            $('.sketchbox').remove();
            for (var i = 0; i < noOfEmployees + 1; i++) {
                if (i != 0) {
                    var onelabatt = labattendances.filter(obj => obj.employee_id == enames[i - 1].employee_id);
                }
                for (var j = 0; j < noOfDays + 1; j++) {

                    if (first == true) {


                        day = j + 1;

                        if (day <= parseInt(daytoday) + 1) {

                            //i 0  == dates
                            // j 0 == names
                            if (i == 0 && j == 0) {
                                div = '<div class="sketchbox" style="border:1px solid black;background-color:green;width:200px"></div>';
                                $('.container-sketch').append(div);
                            } else if (i == 0) {
                                div = '<div class="sketchbox" style="font-size=4px;border:1px solid black; text-align:center">' + j + '</div>';
                                $('.container-sketch').append(div);

                            } else if (j == 0) {
                                div = '<input type="text" hidden value=' + enames[i - 1].employee_id + '><div class="sketchbox" style="font-size=4px;border:1px solid black; text-align:center;width:200px">' + enames[i - 1].user_name + '</div>';
                                $('.container-sketch').append(div);
                                //names
                            } else {
                                //if present then tick, else for absent leave ,cross
                                // debugger;
                                m = j;
                                id = enames[i - 1].employee_id + '_' + m;
                                var f = false;
                                for (var k = 0; k < onelabatt.length; k++) {
                                    var d = new Date(onelabatt[k].date).getDate();
                                    if (m == d) {
                                        // different type of attendances
                                        var at = onelabatt[k].attendance_description;
                                        if (at == 1) {
                                            div = '<div id =' + id + ' class="sketchbox" style="text-align:center;color:green"><i class="fas fa-check"></i></div>'
                                            $('.container-sketch').append(div);
                                        } else {
                                            div = '<div id =' + id + ' class="sketchbox" style="text-align:center;color:red"><i class="fas fa-times"></i></div>'
                                            $('.container-sketch').append(div);
                                        }
                                        f = true;
                                        break;
                                    }
                                }
                                if (!f) {
                                    div = '<div id =' + id + ' class="sketchbox" style="text-align:center;color:blue"><i class="fas fa-question"></i></div>'
                                    $('.container-sketch').append(div);
                                }



                            }

                        } else {

                            //i 0  == dates
                            // j 0 == names
                            if (i == 0 && j == 0) {
                                div = '<div class="sketchbox" style="border:1px solid black;background-color:green;width:200px"></div>';
                                $('.container-sketch').append(div);
                            } else if (i == 0) {
                                div = '<div class="sketchbox" style="font-size=4px;border:1px solid black; text-align:center">' + j + '</div>';
                                $('.container-sketch').append(div);

                            } else if (j == 0) {
                                div = '<input type="text" hidden value=' + enames[i - 1].employee_id + '><div class="sketchbox" style="font-size=4px;border:1px solid black; text-align:center;width:200px">' + enames[i - 1].user_name + '</div>';
                                $('.container-sketch').append(div);
                                //names
                            } else {
                                //if present then tick, else for absent leave ,cross

                                m = j;
                                id = i + '_' + m;
                                div = '<div id =' + id + ' class="sketchbox"></div>'
                                $('.container-sketch').append(div);
                            }

                        }

                    } else {

                        day = j + 1;
                        daytoday = noOfDays;
                        if (day <= parseInt(daytoday) + 1) {

                            //i 0  == dates
                            // j 0 == names
                            if (i == 0 && j == 0) {
                                div = '<div class="sketchbox" style="border:1px solid black;background-color:green;width:200px"></div>';
                                $('.container-sketch').append(div);
                            } else if (i == 0) {
                                div = '<div class="sketchbox" style="font-size=4px;border:1px solid black; text-align:center">' + j + '</div>';
                                $('.container-sketch').append(div);

                            } else if (j == 0) {
                                div = '<input type="text" hidden value=' + enames[i - 1].employee_id + '><div class="sketchbox" style="font-size=4px;border:1px solid black; text-align:center;width:200px">' + enames[i - 1].user_name + '</div>';
                                $('.container-sketch').append(div);
                                //names
                            } else {
                                //if present then tick, else for absent leave ,cross
                                // debugger;
                                m = j;
                                id = enames[i - 1].employee_id + '_' + m;
                                var f = false;
                                for (var k = 0; k < onelabatt.length; k++) {
                                    var d = new Date(onelabatt[k].date).getDate();
                                    if (m == d) {
                                        // different type of attendances
                                        var at = onelabatt[k].attendance_description;
                                        if (at == 1) {
                                            div = '<div id =' + id + ' class="sketchbox" style="text-align:center;color:green"><i class="fas fa-check"></i></div>'
                                            $('.container-sketch').append(div);
                                        } else {
                                            div = '<div id =' + id + ' class="sketchbox" style="text-align:center;color:red"><i class="fas fa-times"></i></div>'
                                            $('.container-sketch').append(div);
                                        }
                                        f = true;
                                        break;
                                    }
                                }
                                if (!f) {
                                    
                                    div = '<div id =' + id + ' class="sketchbox" style="text-align:center;color:blue"></div>'
                                    $('.container-sketch').append(div);
                                }



                            }

                        } else {


                        }

                    }


                }
                $('.container-sketch').append('<br style="width:0px;height:0px">');
            }
        };

        $(document).ready(main);
    </script>

</body>

</html>
<!-- end document-->