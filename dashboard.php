<?php require_once('session.php') ?>
<?php 
require_once("connection.php");
$activeEmployees = $supplier = $clients = "";

$sql1 = "select count(*) as c1 from employee where deleted = 0";
$sql2 = "select count(*) as c2 from supplier where deleted = 0";
$sql3 = "select count(*) as c3 from client where deleted = 0";
$month = date('M');
$year = date('Y');
$sql4 = "select sum(amount) as c4 from expenses e where e.deleted = 0 and MONTH(e.date) = MONTH(NOW()) and YEAR(e.date) = YEAR(NOW())";

$res1 = $conn->query($sql1);
$row1 = $res1->fetch_assoc();
$activeEmployees = $row1['c1'];

$res2 = $conn->query($sql2);
$row2 = $res2->fetch_assoc();
$supplier =$row2['c2'];

$res3 = $conn->query($sql3);
$row3 = $res3->fetch_assoc();
$clients = $row3['c3'];

$res4 = $conn->query($sql4);
$row4 = $res4->fetch_assoc();
$expenses = $row4['c4'];

$opt = "";
$sql =  "select id, expense_type from expenseType where deleted != 1";
$res = $conn->query($sql);
if($res->num_rows > 0 ){
while($row = $res->fetch_assoc()){
    // echo "<script>alert('a')</script>";
    $opt .='<option value='. $row['id'] .'>'. $row['expense_type'] .'</option>';

    }
// echo "<script>alert('$opt')</script>";
}


$opt1 = "";
$sql =  "select raw_material_id, raw_material_name from rawMaterial where deleted != 1";
$res = $conn->query($sql);
if($res->num_rows > 0 ){
while($row = $res->fetch_assoc()){
    // echo "<script>alert('a')</script>";
    $opt1 .='<option value='. $row['raw_material_id'] .'>'. $row['raw_material_id'] . ' - ' . $row['raw_material_name'] .'</option>';

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
    <title>Dashboard</title>

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
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>

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
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    <!-- <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add item</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo "$activeEmployees";?></h2>
                                                <span>Active Employees</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart2"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo "$supplier";?></h2>
                                                <span>Suppliers</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart2"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo "$clients";?></h2>
                                                <span>clients</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart3"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2 style="font-size:2rem;"><?php echo "$expenses";?></h2>
                                                <span>Exp. (<?php echo date('M Y');?>)</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart4"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="row">
                        <div class="col-md-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                    <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="rawmaterialgraph" id="rawmaterialgraph">
                                                <option value="select" selected="selected">Select Option</option>
                                                <?php #echo $opt1; ?>
                                            </select>
                                            
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Raw Material Last 5 Purchases</h3>
                                        <div id="myChart"><canvas id="sales-chart"></canvas></div>
                                    </div>
                                </div>
                        </div>
                        
                            <div class="col-md-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Team Commits</h3>
                                        <canvas id="team-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                           
                        </div> -->


                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35" id="amountTotal">Expenses Report</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="category" id="category">
                                                <option value="all" selected="selected">All Categories</option>
                                                <?php echo $opt; ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="time" id="time">
                                                <option value="today">Today</option>
                                                <option value="1w">1 Week</option>
                                                <option value="tm" selected="selected">this Month</option>
                                                <option value="1m">1 Months</option>
                                                <option value="1y">1 Year</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        
                                    </div>
                                </div>


                                <div class="table-responsive table-responsive-data2" id="expenses">
                                    
                                        <?php
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());";

                                        $res = $conn->query($sql);
                                        if($res->num_rows > 0 ){
                                            echo '<table class="table table-data2" id="example" style="width:100%">';
                                            echo '<thead>';
                                            echo '<tr>';
                                            echo '<th>Date</th>';
                                            echo '<th>Expense Type</th>';
                                            echo '<th>Comment</th>';
                                            echo '<th>Amount</th>';
                                            echo '</tr>';
                                            echo '</thead>';
                                            echo '<tbody >';
                                                $total =0;
                                        
                                                while($row = $res->fetch_assoc()){
                                                    $total +=$row['amount']; 
                                                    echo '<tr>';
                                                    echo '<td>' . $row['date'] . '</td>';
                                                    echo '<td>';
                                                    echo '<span class="block-email">' .$row['expense_type'] .'</span>';
                                                    echo '</td>';
                                                    echo '<td class="desc">' .$row['comment'] .'</td>';
                                                    echo '<td>'. $row['amount'] .'</td>';
                                                    echo '</tr>';
                                                }

                                                
                                                echo '</tbody>';
                                                echo '</table>';
                                        
                                        }
                                        
                                        
                                        ?>
                                            
                                        
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35 m-t-50">Raw Material Stock Report</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="rawmaterial" id="rawmaterial">
                                                <option value="all" selected="selected">All Raw Materials</option>
                                                <?php echo $opt1; ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="time2" id="time2">
                                                <option value="today">Today</option>
                                                <option value="1w">1 Week</option>
                                                <option value="tm" selected="selected">this Month</option>
                                                <option value="1m">1 Months</option>
                                                <option value="1y">1 Year</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        
                                    </div>
                                </div>


                                <div class="table-responsive table-responsive-data2" id="rawmaterialstocks">
                                   


                                        <?php
                                         

                                        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id WHERE MONTH(date_added) = MONTH(CURRENT_DATE()) AND YEAR(date_added) = YEAR(CURRENT_DATE()) and rmsh.deleted != 1";
                                        $res = $conn->query($sql);
                                        if($res->num_rows > 0 ){
                                            echo '<table class="table table-data2" id="example1" style="width:100%">';
                                         echo '<thead>';
                                         echo '<tr>';
                                         echo '<th>Raw Material Name</th>';
                                         echo '<th>Quantity</th>';
                                         echo '<th>Added on</th>';
                                         echo '</tr>';
                                         echo '</thead>';
                                         echo '<tbody >';
                                                while($row = $res->fetch_assoc()){
                                                    echo  '<tr>';
                                                    echo  '<td>' . $row['raw_material_name'] . '</td>';
                                                    echo  '<td>' . $row['weight_added'] . ' kg</td>';
                                                    echo  '<td>' . $row['date_added'] . '</td>';
                                                    echo '</tr>';
                                                }
                                                echo '</tbody>';
                                        echo '</table>';
                                        
                                        }
                                        
                                        
                                        ?>
                                            
                                        
                                </div>
                                <!-- END DATA TABLE -->
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

    <div id="rmlfp"></div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->

    <script src="vendor/dataTables/jquery.dataTables.min.js"></script>
    <script src="vendor/dataTables/dataTables.bootstrap4.min.js"></script>
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
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script>

    $(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        pageLength : 5
    });

    $('#example1').DataTable({
        "scrollX": true,
        pageLength : 5
    });


    $('#category').on('change', function() {
        var category = this.value;
        var time = $('#time').val();
        // alert(category);
        // alert(time);
         $("#expenses").text("");
            $('#expenses').load("dashboardReports.php", {
                category : category,
                time : time,
                fform : "expenseReport"
            },function(){
                $('#example').DataTable({
        "scrollX": true,
        pageLength : 5
    });
            });

        
    });


    $('#time').on('change', function() {
        var time = this.value;
        var category = $('#category').val();
            // alert(category);
            // alert(time);
            $("#expenses").text("");
            $('#expenses').load("dashboardReports.php", {
                category : category,
                time : time,
                fform : "expenseReport"
            },function(){
                $('#example').DataTable({
        "scrollX": true,
        pageLength : 5
    });
            });
    });


    am("");


    $('#rawmaterial').on('change', function() {
        var rawmaterial = this.value;
        var time = $('#time2').val();
        // alert(category);
        // alert(time);
         $("#rawmaterialstocks").text("");
            $('#rawmaterialstocks').load("dashboardReports.php", {
                rawmaterial : rawmaterial,
                time : time,
                fform : "rawmaterialstockreport"
            },function(){
                $('#example1').DataTable({
        "scrollX": true,
        pageLength : 5
    });
            });

        
    });


    $('#time2').on('change', function() {
        var time = this.value;
        var rawmaterial = $('#rawmaterial').val();
            // alert(category);
            // alert(time);
            $("#rawmaterialstocks").text("");
            $('#rawmaterialstocks').load("dashboardReports.php", {
                rawmaterial : rawmaterial,
                time : time,
                fform : "rawmaterialstockreport"
            },function(){
                $('#example1').DataTable({
        "scrollX": true,
        pageLength : 5
    });
            });
    });


});
function am(x){
        if(x == ""){
            var x = '<?php echo $total;?>';
        $('#amountTotal').text('Expense Report ------------- Total : '+x);

        }else{
            $('#amountTotal').text('Expense Report ------------- Total : '+x);

        }

}




</script>

</body>

</html>
