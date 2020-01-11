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
$supplier = $row2['c2'];

$res3 = $conn->query($sql3);
$row3 = $res3->fetch_assoc();
$clients = $row3['c3'];

$res4 = $conn->query($sql4);
$row4 = $res4->fetch_assoc();
$expenses = $row4['c4'];

$opt = "";
$sql =  "select id, expense_type from expenseType where deleted != 1";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        // echo "<script>alert('a')</script>";
        $opt .= '<option value=' . $row['id'] . '>' . $row['expense_type'] . '</option>';
    }
    // echo "<script>alert('$opt')</script>";
}


$opt1 = "";
$sql =  "select employee_id, user_name from employee where deleted != 1";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        // echo "<script>alert('a')</script>";
        $opt1 .= '<option value=' . $row['employee_id'] . '>' . $row['employee_id'] . ' - ' . $row['user_name'] . '</option>';
    }
}
$opt2 = "";
for ($i = 0; $i < 12; $i++) {
    $time = strtotime(sprintf('%d months', $i));
    $label = date('F', $time);
    $value = date('n', $time);
    $opt2 .= "<option value='$value'>$label</option>";
}


$opt3 = "";
$already_selected_value = date('Y');
$earliest_year = 2020;

foreach (range(date('Y'), $earliest_year) as $x) {
    $opt3 .= '<option value="' . $x . '"' . ($x === $already_selected_value ? ' selected="selected"' : '') . '>' . $x . '</option>';
}


$opt4 = "";
$sql =  "select raw_material_id, raw_material_name from rawMaterial where deleted != 1";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        // echo "<script>alert('a')</script>";
        $opt4 .= '<option value=' . $row['raw_material_id'] . '>' . $row['raw_material_id'] . ' - ' . $row['raw_material_name'] . '</option>';
    }
}

$opt5 = "";
$sql =  "select c.client_id, c.user_name from client c where c.deleted != 1";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        // echo "<script>alert('a')</script>";
        $opt5 .= '<option value=' . $row['client_id'] . '>' . $row['client_id'] . ' - ' . $row['user_name'] . '</option>';
    }
}

$opt6 = "";
$sql =  "select s.supplier_id, s.user_name from supplier s where s.deleted != 1";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        // echo "<script>alert('a')</script>";
        $opt6 .= '<option value=' . $row['supplier_id'] . '>' . $row['supplier_id'] . ' - ' . $row['user_name'] . '</option>';
    }
}

// $opt1 = "";
// $sql =  "select employee_id, user_name from employee where deleted != 1";
// $res = $conn->query($sql);
// if ($res->num_rows > 0) {
//     while ($row = $res->fetch_assoc()) {
//         // echo "<script>alert('a')</script>";
//         $opt1 .= '<option value=' . $row['employee_id'] . '>' . $row['employee_id'] . ' - ' . $row['user_name'] . '</option>';
//     }
// }

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
    <link href="css/clock.css" rel="stylesheet" media="all">
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>

    <!-- JavaScript Includes -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>

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
                                                <a href="view-employee.php">
                                                    <h2><?php echo "$activeEmployees"; ?></h2>
                                                    <span>Employees</span>
                                                </a>
                                            </div>
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
                                                <a href="view-suppliers.php">
                                                    <h2><?php echo "$supplier"; ?></h2>
                                                    <span>Suppliers</span>
                                                </a>
                                            </div>
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
                                                <a href="view-clients.php">
                                                    <h2><?php echo "$clients"; ?></h2>
                                                    <span>clients</span>
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix" style="font-size:0.1rem;">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2 style="font-size:1.6rem;"><?php echo ($expenses == NULL) ? 0 : "$expenses"; ?></h2>
                                                <span>Exp. (<?php echo date('M Y'); ?>)</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Current Time</h3>
                                        <div id="digic">

                                            <div class="clock">
                                                <div class="hours">
                                                    <div class="first">
                                                        <div class="number">0</div>
                                                    </div>
                                                    <div class="second">
                                                        <div class="number">0</div>
                                                    </div>
                                                </div>
                                                <div class="tick">:</div>
                                                <div class="minutes">
                                                    <div class="first">
                                                        <div class="number">0</div>
                                                    </div>
                                                    <div class="second">
                                                        <div class="number">0</div>
                                                    </div>
                                                </div>
                                                <div class="tick">:</div>
                                                <div class="seconds">
                                                    <div class="first">
                                                        <div class="number">0</div>
                                                    </div>
                                                    <div class="second infinite">
                                                        <div class="number">0</div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Raw Material Last 5 Details</h3>
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="rawmat" id="rawmat">
                                                <?php echo $opt4;
                                                ?>
                                            </select>

                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div><canvas id="raw-mat-chart"></canvas></div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Expense Details</h3>
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
                                        <div><canvas id="exp-det-chart"></canvas></div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6">

                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">

                                        <h3 class="title-2 m-b-40">Employee Attendance Details</h3>
                                        <div class="rs-select2--light rs-select2--md m-1">
                                            <select class="js-select2" name="employeeid" id="employeeid">
                                                <?php echo $opt1; ?>
                                            </select>

                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md  m-1">
                                            <select class="js-select2" name="monthemp" id="monthemp">
                                                <?php echo $opt2;
                                                ?>
                                            </select>

                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--sm  m-1">
                                            <select class="js-select2" name="yearemp" id="yearemp">
                                                <?php echo $opt3;
                                                ?>
                                            </select>

                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div><canvas id="emp-att-chart"></canvas></div>

                                    </div>
                                </div>

                            </div>

                            <!-- <div class="col-md-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">More Reports will be added after further requirements implementations.</h3>
                                        <div><canvas id="raw-mat-chart1"></canvas></div>
                                    </div>
                                </div>
                            </div> -->


                        </div>

                    </div>


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
                                if ($res->num_rows > 0) {
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
                                    $total = 0;

                                    while ($row = $res->fetch_assoc()) {
                                        $total += $row['amount'];
                                        echo '<tr>';
                                        echo '<td>' . $row['date'] . '</td>';
                                        echo '<td>';
                                        echo '<span class="block-email">' . $row['expense_type'] . '</span>';
                                        echo '</td>';
                                        echo '<td class="desc">' . $row['comment'] . '</td>';
                                        echo '<td>' . $row['amount'] . '</td>';
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
                                            <?php echo $opt4; ?>
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
                                if ($res->num_rows > 0) {
                                    echo '<table class="table table-data2" id="example1" style="width:100%">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Raw Material Name</th>';
                                    echo '<th>Quantity</th>';
                                    echo '<th>Added on</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody >';
                                    while ($row = $res->fetch_assoc()) {
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
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35 m-t-50">Sales</h3>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="rs-select2--light rs-select2--md">
                                        <select class="js-select2" name="clientsid" id="clientsid">
                                            <option value="all" selected="selected">All Clients</option>
                                            <?php echo $opt5; ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <div class="rs-select2--light rs-select2--md">
                                        <select class="js-select2" name="time3" id="time3">
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


                            <div class="table-responsive table-responsive-data2" id="salesdetails">


                                <?php


                                $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id where MONTH(s.date_added) = MONTH(CURRENT_DATE()) AND YEAR(s.date_added) = YEAR(CURRENT_DATE()) and s.deleted != 1";
                                $res = $conn->query($sql);
                                if ($res->num_rows > 0) {
                                    echo '<table class="table table-data2" id="example4" style="width:100%">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Client</th>';
                                    echo '<th>Brand</th>';
                                    echo '<th>Formula</th>';
                                    echo '<th>Packing Size</th>';
                                    echo '<th>Bags</th>';
                                    echo '<th>Total Payment</th>';
                                    echo '<th>Added on</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody >';
                                    while ($row = $res->fetch_assoc()) {
                                        echo  '<tr>';
                                        echo  '<td>' . $row['user_name'] . '</td>';
                                        echo  '<td>' . $row['brand_name'] . '</td>';
                                        echo  '<td>' . $row['formula_name'] . '</td>';
                                        echo  '<td>' . $row['packing_size'] . ' kg</td>';
                                        echo  '<td>' . $row['noofbags'] . '</td>';
                                        echo  '<td>' . $row['totalpayment'] . '</td>';
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
                            <!-- DATA TABLE -->
                            <h3 class="title-5 m-b-35 m-t-50">Purchases</h3>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="rs-select2--light rs-select2--md">
                                        <select class="js-select2" name="suppliersid" id="suppliersid">
                                            <option value="all" selected="selected">All Suppliers</option>
                                            <?php echo $opt6; ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <div class="rs-select2--light rs-select2--md">
                                        <select class="js-select2" name="time4" id="time4">
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


                            <div class="table-responsive table-responsive-data2" id="purchasesdetail">


                                <?php


                                $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id WHERE MONTH(date_added) = MONTH(CURRENT_DATE()) AND YEAR(date_added) = YEAR(CURRENT_DATE()) and rmsh.deleted != 1";
                                $res = $conn->query($sql);
                                if ($res->num_rows > 0) {
                                    echo '<table class="table table-data2" id="example2" style="width:100%">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Supplier</th>';
                                    echo '<th>Item</th>';
                                    echo '<th>weight</th>';
                                    echo '<th>rate</th>';
                                    echo '<th>Total payment</th>';
                                    echo '<th>Added on</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody >';
                                    while ($row = $res->fetch_assoc()) {
                                        echo  '<tr>';
                                        echo  '<td>' . $row['user_name'] . '</td>';
                                        echo  '<td>' . $row['raw_material_name'] . '</td>';
                                        echo  '<td>' . $row['weight_added'] . ' kg</td>';
                                        echo  '<td>' . $row['rate'] . '</td>';
                                        echo  '<td>' . $row['totalpayment'] . '</td>';
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

                    <?php include_once('copyright.php') ?>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

    </div>

    <div id="expreport"></div>
    <div id="empreport"></div>
    <div id="rawreport"></div>

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
        var expchart = "";
        var empchart = "";
        var rawchart = "";

        $(document).ready(function() {
            $('#example').DataTable({
                "scrollX": true,
                pageLength: 5
            });

            $('#example1').DataTable({
                "scrollX": true,
                pageLength: 5
            });

            $('#example2').DataTable({
                "scrollX": true,
                pageLength: 5
            });

            $('#example4').DataTable({
                "scrollX": true,
                pageLength: 5
            });

            $('#category').on('change', function() {
                var category = this.value;
                var time = $('#time').val();
                // alert(category);
                // alert(time);
                $("#expenses").text("");
                $('#expenses').load("dashboardReports.php", {
                    category: category,
                    time: time,
                    fform: "expenseReport"
                }, function() {
                    $('#example').DataTable({
                        "scrollX": true,
                        pageLength: 5
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
                    category: category,
                    time: time,
                    fform: "expenseReport"
                }, function() {
                    $('#example').DataTable({
                        "scrollX": true,
                        pageLength: 5
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
                    rawmaterial: rawmaterial,
                    time: time,
                    fform: "rawmaterialstockreport"
                }, function() {
                    $('#example1').DataTable({
                        "scrollX": true,
                        pageLength: 5
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
                    rawmaterial: rawmaterial,
                    time: time,
                    fform: "rawmaterialstockreport"
                }, function() {
                    $('#example1').DataTable({
                        "scrollX": true,
                        pageLength: 5
                    });
                });
            });

            $('#time3').on('change', function() {
                var time = this.value;
                var client = $('#clientsid').val();
                $("#salesdetails").text("");
                $('#salesdetails').load("dashboardReports.php", {
                    client: client,
                    time: time,
                    fform: "salesdetailsreport"
                }, function() {
                    $('#example4').DataTable({
                        "scrollX": true,
                        pageLength: 5
                    });
                });
            });


            $('#clientsid').on('change', function() {
                var client = this.value;
                var time = $('#time3').val();
                // alert(category);
                // alert(time);
                $("#salesdetails").text("");
                $('#salesdetails').load("dashboardReports.php", {
                    client: client,
                    time: time,
                    fform: "salesdetailsreport"
                }, function() {
                    $('#example4').DataTable({
                        "scrollX": true,
                        pageLength: 5
                    });
                });
            });


            $('#time4').on('change', function() {
                var time = this.value;
                var supplier = $('#suppliersid').val();
                $("#purchasesdetail").text("");
                $('#purchasesdetail').load("dashboardReports.php", {
                    supplier: supplier,
                    time: time,
                    fform: "purchasesdetailreport"
                }, function() {
                    $('#example2').DataTable({
                        "scrollX": true,
                        pageLength: 5
                    });
                });
            });

            $('#suppliersid').on('change', function() {
                var supplier = this.value;
                var time = $('#time4').val();
                // alert(category);
                // alert(time);
                $("#purchasesdetail").text("");
                $('#purchasesdetail').load("dashboardReports.php", {
                    supplier: supplier,
                    time: time,
                    fform: "purchasesdetailreport"
                }, function() {
                    $('#example2').DataTable({
                        "scrollX": true,
                        pageLength: 5
                    });
                });
            });








            $('#monthexp').on('change', function() {
                var month = this.value;
                var year = $('#yearexp').val();

                $("#expreport").text("");
                $('#expreport').load("dashboardReports.php", {
                    month: month,
                    year: year,
                    fform: "expensereport"
                });

            });


            $('#yearexp').on('change', function() {
                var year = this.value;
                var month = $('#monthexp').val();

                $("#expreport").text("");
                $('#expreport').load("dashboardReports.php", {
                    month: month,
                    year: year,
                    fform: "expensereport"
                });
            });

            $('#employeeid').on('change', function() {
                var id = this.value;
                var month = $('#monthemp').val();
                var year = $('#yearemp').val();

                $("#empreport").text("");
                $('#empreport').load("dashboardReports.php", {
                    id: id,
                    month: month,
                    year: year,
                    fform: "empattreport"
                });
            });

            $('#monthemp').on('change', function() {
                var month = this.value;
                var id = $('#employeeid').val();
                var year = $('#yearemp').val();

                $("#empreport").text("");
                $('#empreport').load("dashboardReports.php", {
                    id: id,
                    month: month,
                    year: year,
                    fform: "empattreport"
                });
            });

            $('#yearemp').on('change', function() {
                var year = this.value;
                var month = $('#monthemp').val();
                var id = $('#employeeid').val();

                $("#empreport").text("");
                $('#empreport').load("dashboardReports.php", {
                    id: id,
                    month: month,
                    year: year,
                    fform: "empattreport"
                });
            });

            $('#rawmat').on('change', function() {
                var id = this.value;

                $("#rawreport").text("");
                $('#rawreport').load("dashboardReports.php", {
                    id: id,
                    fform: "rawreport"
                });
            });


            //clock


            var hoursContainer = document.querySelector('.hours')
            var minutesContainer = document.querySelector('.minutes')
            var secondsContainer = document.querySelector('.seconds')
            var tickElements = Array.from(document.querySelectorAll('.tick'))

            var last = new Date(0)
            last.setUTCHours(-1)

            var tickState = true

            function updateTime() {
                var now = new Date

                var lastHours = last.getHours().toString()
                var nowHours = now.getHours().toString()
                if (lastHours !== nowHours) {
                    updateContainer(hoursContainer, nowHours)
                }

                var lastMinutes = last.getMinutes().toString()
                var nowMinutes = now.getMinutes().toString()
                if (lastMinutes !== nowMinutes) {
                    updateContainer(minutesContainer, nowMinutes)
                }

                var lastSeconds = last.getSeconds().toString()
                var nowSeconds = now.getSeconds().toString()
                if (lastSeconds !== nowSeconds) {
                    //tick()
                    updateContainer(secondsContainer, nowSeconds)
                }

                last = now
            }

            function tick() {
                tickElements.forEach(t => t.classList.toggle('tick-hidden'))
            }

            function updateContainer(container, newTime) {
                var time = newTime.split('')

                if (time.length === 1) {
                    time.unshift('0')
                }


                var first = container.firstElementChild
                if (first.lastElementChild.textContent !== time[0]) {
                    updateNumber(first, time[0])
                }

                var last = container.lastElementChild
                if (last.lastElementChild.textContent !== time[1]) {
                    updateNumber(last, time[1])
                }
            }

            function updateNumber(element, number) {
                //element.lastElementChild.textContent = number
                var second = element.lastElementChild.cloneNode(true)
                second.textContent = number

                element.appendChild(second)
                element.classList.add('move')

                setTimeout(function() {
                    element.classList.remove('move')
                }, 990)
                setTimeout(function() {
                    element.removeChild(element.firstElementChild)
                }, 990)
            }

            setInterval(updateTime, 100)


            //clock





        });

        function am(x) {
            if (x == "") {
                var x = '<?php echo $total; ?>';
                $('#amountTotal').text('Expense Report ------------- Total : ' + x);

            } else {
                $('#amountTotal').text('Expense Report ------------- Total : ' + x);

            }

        }

        function expensedetail(et = "", am = "") {
            <?php

            $sql = "SELECT * FROM expenseType et WHERE et.deleted != 1";
            $res = $conn->query($sql);
            $et = array();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $et[] = $row['expense_type'];
                }
            }



            $sql = "SELECT e.type_id,sum(e.amount) as total FROM expenses e WHERE e.deleted != 1 and MONTH(e.date) = MONTH(CURRENT_DATE()) AND YEAR(e.date) = YEAR(CURRENT_DATE()) group by e.type_id";
            $res = $conn->query($sql);
            $am = array();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $am[] = $row['total'];
                }
            }

            ?>
            // console.log(expchart);
            if (et == "" && am == "") {
                <?php echo "var etjs =  ", json_encode($et), "; var amjs =  ", json_encode($am), ";" ?>
            } else {
                var etjs = et;
                var amjs = am;
            }

            // alert(expchart);
            if (expchart != null && expchart != undefined && expchart != "") {
                expchart.destroy();
            }

            // Bar chart
            expchart = new Chart(document.getElementById("exp-det-chart"), {
                type: 'bar',
                data: {
                    labels: etjs,
                    datasets: [{
                        label: "Expense Details",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: amjs
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Expense details'
                    }
                }
            });
        }

        expensedetail("", "");

        function empattendancedetail(da = "") {

            <?php

            $sql = "SELECT count(*) as total FROM AttenadnceType att WHERE att.deleted != 1";
            $total = $conn->query($sql)->fetch_object()->total;
            $sql = "SELECT * FROM employee e where e.deleted != 1 limit 1";
            $id = $conn->query($sql)->fetch_object()->employee_id;
            $sql = "select la.attendance_description,count(la.attendance_description) as totalc from laborAttendance la where la.deleted != 1 and MONTH(la.date) = MONTH(CURRENT_DATE()) AND YEAR(la.date) = YEAR(CURRENT_DATE()) and la.employee_id = $id group by la.attendance_description";
            $res = $conn->query($sql);
            $daatt = array();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $daatt[] = $row;
                }
            }
            $da = array();
            $s = count($daatt);
            if ($s > 0) {
                for ($i = 1; $i <= $total; $i++) {
                    $f = false;
                    foreach ($daatt as $d) {
                        if ($d['attendance_description'] == $i) {
                            $da[] = $d['totalc'];
                            $f = true;
                        }
                    }
                    if (!$f) {
                        $da[] = 0;
                    }
                }
            } else {
                for ($i = 1; $i <= $total; $i++) {
                    $da[] = 0;
                }
            }


            ?>
            // console.log(expchart);
            if (da == "") {
                <?php echo "var dajs =  ", json_encode($da), ";" ?>
            } else {
                var dajs = da;
            }

            // alert(expchart);
            if (empchart != null && empchart != undefined && empchart != "") {
                empchart.destroy();
            }

            empchart = new Chart(document.getElementById("emp-att-chart"), {
                type: 'pie',
                data: {
                    labels: ["Present", "Absent", "Full day leave", "Half day Leave", "Sick Leave"],
                    datasets: [{
                        label: "Attendance details",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: dajs
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Attendance details'
                    }
                }
            });


        }
        empattendancedetail("");

        function rawmaterialRep(dates = "", weights = "") {

            <?php


            $sql = "SELECT * FROM employee e where e.deleted != 1 limit 1";
            $id = $conn->query($sql)->fetch_object()->employee_id;


            $sql = "SELECT * FROM rawMaterialStockAdditionHistory rms WHERE rms.deleted != 1 and rms.rawmaterial_id = $id order by rms.date_added desc limit 5";
            $res = $conn->query($sql);
            $dates = array();
            $weights = array();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $dates[] = $row['date_added'];
                    $weights[] = $row['weight_added'];
                }
            }

            ?>
            // console.log(expchart);
            if (dates == "" && weights == "" && typeof(dates) == "string") {
                <?php echo "var datesjs =  ", json_encode($dates), "; var weightsjs =  ", json_encode($weights), ";" ?>
            } else if (dates.length == 0 && weights.length == 0 && typeof(dates) == "object") {
                var datesjs = [];
                var weightsjs = [];
            } else {
                var datesjs = dates;
                var weightsjs = weights;
            }

            // alert(expchart);
            if (rawchart != null && rawchart != undefined && rawchart != "") {
                rawchart.destroy();
            }



            rawchart = new Chart(document.getElementById("raw-mat-chart"), {
                type: 'line',
                data: {
                    labels: datesjs, //dates
                    datasets: [{
                        data: weightsjs, //weights
                        label: "Raw Material",
                        borderColor: "#3e95cd",
                        fill: false
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Raw Material Last 5 Details'
                    }
                }
            });
        }

        rawmaterialRep("", "");
    </script>

</body>

</html>