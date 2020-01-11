<?php require_once('session.php') ?>

<?php
require_once("connection.php");

if (!$conn->connect_error) {


    if (isset($_REQUEST['submit'])) { // if submit button clicked

        $rawmaterialid  =  $_REQUEST['rawmaterial'];
        $date =  $_REQUEST['hf-date'];
        $weight =  $_REQUEST['hf-weight'];
        $weight = (float) $weight;
        $rate = $_REQUEST['hf-rate'];
        $rate = (float) $rate;
        $supplierid = $_REQUEST['suppliername'];
        $supplierid = (int) $supplierid;
        $modeofpayment = $_REQUEST['modeofpayment'];
        $totalpayment = $_REQUEST['hf-totalpayment'];
        $totalpayment = (float) $totalpayment;
        $paymentmade = $_REQUEST['hf-paymentmade'];
        $paymentmade = (float) $paymentmade;
        $discount = $_REQUEST['hf-discount'];
        $discount = (float) $discount;
        $remainingpayment = $_REQUEST['hf-remaining'];
        $remainingpayment = (float) $remainingpayment;
        $extrapayment = $_REQUEST['hf-extrapayment'];
        $extrapayment = (float) $extrapayment;
        // get weight and add weight and update weight
        $conn->autocommit(FALSE);

        $sql = "UPDATE rawmaterialStock rms SET  rms.weight  =rms.weight + $weight WHERE rms.rawmaterial_id = $rawmaterialid";
        $res = $conn->query($sql);

        if ($res) {
            $sql1 = "insert into rawMaterialStockAdditionHistory(rawmaterial_id,weight_added,rate, supplier_id, modeofpayment, totalpayment, paymentmade, discount, remainingpayment, extrapayment, date_added, deleted) values($rawmaterialid,$weight,$rate,$supplierid,'$modeofpayment',$totalpayment,$paymentmade,$discount,$remainingpayment,$extrapayment,'$date',false);";
            $res = $conn->query($sql1);

            if ($res) {
                //get kgs in stocks
                $sql3 = "SELECT rms.weight FROM rawmaterialStock rms where rms.rawmaterial_id = $rawmaterialid";
                $weightPresent = $conn->query($sql3)->fetch_object()->weight;
                //get current rate of raw material
                $sql4 = "SELECT rmn.percentageperkg FROM RawmaterialNutrients rmn WHERE rmn.raw_material_id = $rawmaterialid and rmn.Nutrition_id = 14 and rmn.deleted != 1";
                $currentRate = $conn->query($sql4)->fetch_object()->percentageperkg;
    
                $rspresent = ($weightPresent - $weight) * $currentRate;
                $rsadded = $weight * $rate;
    
                $rsnew = $rsadded + $rspresent;
                $newWeight = $weightPresent;
    
                $newRate = $rsnew / $newWeight;
    
                // echo "<script>alert('wp -$weightPresent  cr- $currentRate  w- $weight  nw- $newWeight nr- $newRate rp- $rspresent ra- $rsadded rn-$rsnew')</script>";
    
                $sql = "UPDATE RawmaterialNutrients rmn SET  rmn.percentageperkg  =$newRate WHERE rmn.raw_material_id = $rawmaterialid and rmn.Nutrition_id = 14 and rmn.deleted != 1";
                $res = $conn->query($sql);

                if($res){
                    $not = "done";
                    $conn->commit();
                }else{
                    $conn->close();
                    $not = "notdone";
                }
    
            }else{
                $conn->close();
            $not = "notdone";
            }

        } else {
            $conn->close();
            $not = "notdone";
        }
        //validation passed


        
    } else if (isset($_REQUEST['submita'])) {
        $rawmaterialid  =  $_REQUEST['rawmaterial'];
        $date =  $_REQUEST['hf-date'];
        $weight =  $_REQUEST['hf-weight'];
        $comment = $_REQUEST['hf-comment'];
        $weight = (float) $weight;

        $notification  = "";

        // get weight and add weight and update weight
        $conn->autocommit(FALSE);

        $sql3 = "SELECT rms.weight FROM rawmaterialStock rms where rms.rawmaterial_id = $rawmaterialid";
        $weightPresent = $conn->query($sql3)->fetch_object()->weight; // 79

        if ($weightPresent < $weight) {
            $notification = "gr";
            //can't do this
        } else {

            $sql = "UPDATE rawmaterialStock rms SET  rms.weight  =rms.weight - $weight WHERE rms.rawmaterial_id = $rawmaterialid";
            $res = $conn->query($sql);

            if($res){
                $sql1 = "insert into rawMaterialStockLossHistory(rawmaterial_id,weight_lost,date_added,comment,deleted) values($rawmaterialid,$weight,'$date','$comment',false);";
                $res = $conn->query($sql1);
                if($res){
                    $not = "done";
                    $conn->commit();
                }else{
                    $conn->close();
                    $not = "notdone";
                }
            }else{
                $conn->close();
                $not = "notdone";
            }
            //validation passed

            
        }
    } else {
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
    <title>Raw Material Stocks</title>

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
                        <div class="row" style="width:70%;margin:auto">
                            <div class="col-md-12">

                                <button type="button" style="margin:15px 5px" class="btn btn-info" id="arms">Add Stock</button>
                                <button type="button" style="margin:15px 5px" class="btn btn-success" id="vrms">View Stock</button>
                                <button type="button" style="margin:15px 5px" class="btn btn-danger" id="rrms">Remove Stock</button>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" id="content">


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

    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Raw Material Stock Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button type="button" style="margin:15px 5px" class="btn btn-success" id="addedrms">Added</button>
                    <button type="button" style="margin:15px 5px" class="btn btn-danger" id="removedrms">Removed</button>
                    <input type="hidden" id="idval" value="" />

                    <div id="parawithdata">



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal large -->

    <div id="snackbar"></div>

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

            var noti = "<?php echo $notification; ?>";
            if (noti == "adddo") {
                snackbar("Added Successfully", "green");
            } else if (noti == "gr") {
                snackbar("Weight added is greater than weight present in inventory.", "red");
            } else if (noti == "do") {
                snackbar("Removed Successfully", "green");
            }

            var notif = "<?php echo $not ?>";
            if (notif == "done") {
                snackbar("Added Successfully", "green");
            } else if (notif == "notdone") {
                snackbar("Adding Failure.", "red");
            }


            $('body').on('click', '#arms', function() { // Click to only happen on announce links
                $("#content").text("");
                $('#content').load("stock.php", {
                    fform: "arms"
                });

            });


            $('body').on('click', '#vrms', function() { // Click to only happen on announce links
                $("#content").text("");
                $('#content').load("stock.php", {
                    fform: "vrms"
                }, function() {
                    $('#example').DataTable();
                });



            });


            $('body').on('click', '#rrms', function() { // Click to only happen on announce links
                $("#content").text("");
                $('#content').load("stock.php", {
                    fform: "rrms"
                });

            });

            $('body').on('click', '.mid', function() { // Click to only happen on announce links
                //var a = document.getElement
                $("#idval").val($(this).data('id'));
                // debugger;
                var rawid = parseInt($("#idval").val());

                $('#parawithdata').load("stock.php", {
                    fmodid: rawid,
                    fform: "rawmaterialstockdetail"
                }, function() {
                    $('#modalexample').DataTable();
                });


                $('#largeModal').modal('show');

            });


            $('body').on('click', '#addedrms', function() { // Click to only happen on announce links
                //var a = document.getElement
                //$("#idval").val($(this).data('id'));
                // debugger;
                var rawid = parseInt($("#idval").val());
                $('#parawithdata').text('');
                $('#parawithdata').load("stock.php", {
                    fmodid: rawid,
                    fform: "rawmaterialstockdetail"
                }, function() {
                    $('#modalexample').DataTable();
                });


                //$('#largeModal').modal('show');

            });

            $('body').on('click', '#removedrms', function() { // Click to only happen on announce links
                //var a = document.getElement
                //$("#idval").val($(this).data('id'));
                // debugger;
                var rawid = parseInt($("#idval").val());
                $('#parawithdata').text('');
                $('#parawithdata').load("stock.php", {
                    fmodid: rawid,
                    fform: "removedrawmaterialstockdetail"
                }, function() {
                    $('#modalexample').DataTable();
                });


                //$('#largeModal').modal('show');

            });




        });
    </script>

    <script>
        function validateForm() {

            var rawmaterialid = document.getElementById('rawmaterial').value;
            var date = document.getElementById('hf-date').value;
            var weight = document.getElementById('hf-weight').value;
            var rate = document.getElementById('hf-rate').value;

            var suppliername = document.getElementById('suppliername').value;
            var modeofpayment = document.getElementById('modeofpayment').value;
            var totalpayment = document.getElementById('hf-totalpayment').value;
            var paymentmade = document.getElementById('hf-paymentmade').value;
            var discount = document.getElementById('hf-discount').value;
            var remainingpayment = document.getElementById('hf-remaining').value;
            var extrapayment = document.getElementById('hf-extrapayment').value;


            if (rawmaterialid == "select") {
                snackbar("Raw Material ID is required", "red");
                return false;
            }
            if (suppliername == "select") {
                snackbar("Supplier name is required", "red");
                return false;
            }
            if (date == "") {
                snackbar("Date Field is required", "red");
                return false;
            }
            if (weight == '0' || weight == '' || parseFloat(weight) < 0) {
                snackbar("Weight Field is empty or negetive", "red");
                return false;
            }
            if (parseFloat(paymentmade) < 0) {
                snackbar("Payment made can't be negetive", "red");
                return false;
            }
            if (parseFloat(discount) < 0) {
                snackbar("Discount can't be negetive", "red");
                return false;
            }


            var fl = validateQuantity(weight);
            if (!fl) {
                snackbar("Weight field is not valid. only numeral allowed.", "red");
                return false;
            }

            if (parseFloat(weight) < 0) {
                snackbar("Expense amount can't be negetive.", "red");
                return false;
            }

            if (rate == '0' || rate == '' || parseFloat(rate) < 0) {
                snackbar("Rate Field is empty or negetive", "red");
                return false;
            }

            var fl = validateQuantity(rate);
            if (!fl) {
                snackbar("Rate field is not valid. only numeral allowed.", "red");
                return false;
            }

            if (parseFloat(rate) < 0) {
                snackbar("Rate can't be negetive.", "red");
                return false;
            }

            return true;
        }


        function validateremForm() {

            var rawmaterialid = document.getElementById('rawmaterial').value;
            var date = document.getElementById('hf-date').value;
            var weight = document.getElementById('hf-weight').value;
            var comment = document.getElementById('hf-comment').value;

            if (rawmaterialid == "select") {
                snackbar("Raw Material ID is required", "red");
                return false;
            }
            if (date == "") {
                snackbar("Date Field is required", "red");
                return false;
            }
            if (comment == "") {
                snackbar("describe why you are removing in comment section", "red");
                return false;
            }
            if (weight == '0' || weight == '') {
                snackbar("Weight Field is required", "red");
                return false;
            }

            var fl = validateQuantity(weight);
            if (!fl) {
                snackbar("Weight field is not valid. only numeral allowed.", "red");
                return false;
            }

            if (parseFloat(weight) < 0) {
                snackbar("Expense amount can't be negetive.", "red");
                return false;
            }

            return true;
        }

        function validateQuantity(s) {
            var rgx = /^[0-9]*\.?[0-9]*$/;
            return s.match(rgx);
        }

        function snackbar(message, color) {
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");

            x.innerHTML = message;
            x.style.background = color;
            // Add the "show" class to DIV
            x.className = "show";
            // After 3 seconds, remove the show class from DIV
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }



        function weightchange() {
            var w = document.getElementById("hf-weight").value;
            var r = document.getElementById("hf-rate").value;
            if (w == 0 || r == 0 || w == "" || r == "") {
                document.getElementById("hf-totalpayment").value = 0;
            } else {
                document.getElementById("hf-totalpayment").value = w * r;
            }

        }

        function ratechange() {
            var w = document.getElementById("hf-weight").value;
            var r = document.getElementById("hf-rate").value;
            if (w == 0 || r == 0 || w == "" || r == "") {
                document.getElementById("hf-totalpayment").value = 0;
            } else {
                document.getElementById("hf-totalpayment").value = w * r;
            }
        }

        function paymentmadechange() {
            var pm = parseInt(document.getElementById("hf-paymentmade").value);
            var tp = parseInt(document.getElementById("hf-totalpayment").value);
            var d = parseInt(document.getElementById("hf-discount").value);
            debugger;
            if (pm + d > tp) {
                document.getElementById("hf-extrapayment").value = (pm + d) - tp;
                document.getElementById("hf-remaining").value = 0;
            } else if (pm + d == tp) {
                document.getElementById("hf-extrapayment").value = 0;
                document.getElementById("hf-remaining").value = 0;
            } else {
                document.getElementById("hf-extrapayment").value = 0;
                document.getElementById("hf-remaining").value = tp - (pm + d);
            }
        }

        function discountchange() {
            var pm = parseInt(document.getElementById("hf-paymentmade").value);
            var tp = parseInt(document.getElementById("hf-totalpayment").value);
            var d = parseInt(document.getElementById("hf-discount").value);
            debugger;
            if (pm + d > tp) {
                document.getElementById("hf-extrapayment").value = (pm + d) - tp;
                document.getElementById("hf-remaining").value = 0;
            } else if (pm + d == tp) {
                document.getElementById("hf-extrapayment").value = 0;
                document.getElementById("hf-remaining").value = 0;
            } else {
                document.getElementById("hf-extrapayment").value = 0;
                document.getElementById("hf-remaining").value = tp - (pm + d);
            }

        }
    </script>

</body>

</html>
<!-- end document-->