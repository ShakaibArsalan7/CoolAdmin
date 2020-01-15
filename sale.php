<?php require_once('session.php');
require_once("connection.php");
if (!$conn->connect_error) {
    $brandname  = "";
    $opt = "";
    $sql =  "select brand_id, brand_name from brand where deleted != 1";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $opt .= '<option value=' . $row['brand_id'] . '>' . $row['brand_id'] . ' - ' . $row['brand_name'] . '</option>';
        }
    }
    $today = date("Y-m-d");
    //brand id , formula id , packing sizes, no of bags , submit button

    $opt1 = "";
    $sql1 = "SELECT c.client_id, c.user_name FROM client c WHERE c.deleted != 1";
    $res = $conn->query($sql1);
    $data1 = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $opt1 .= '<option value=' . $row['client_id'] . '>' . $row['client_id'] . ' - ' . $row['user_name'] . '</option>';
        }
    }

    $opt6 = "";
    $sql1 = "SELECT s.salesman_id, s.user_name FROM salesman s WHERE s.deleted != 1";
    $res = $conn->query($sql1);
    $data1 = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $opt6 .= '<option value=' . $row['salesman_id'] . '>' . $row['salesman_id'] . ' - ' . $row['user_name'] . '</option>';
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
    <title>Sale</title>

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
                            <div class="col-md-10">
                                <h3 style="margin-bottom:25px;"><strong>Sale</strong></h3>




                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-brandid" class=" form-control-label">Brand :</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <select class="form-control" id="brandid" name="brandid">
                                            <option value='select'>select option</option><?php echo $opt; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group" id="formulashere">
                                </div>
                                <div class="row form-group" id="packingshere">
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-noofbags" class=" form-control-label">No of Bags</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" id="hf-noofbags" name="hf-noofbags" placeholder="Enter No. of Bags..." class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-client" class=" form-control-label">Client</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <select class="form-control" id="clientname" name="clientname">
                                            <option value='select'>select option</option><?php echo $opt1; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-salesman" class=" form-control-label">Salesman</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <select class="form-control" id="salesmanname" name="salesmanname">
                                            <option value='select'>select option</option><?php echo $opt6; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-modeofpayment" class=" form-control-label">Mode of Payment</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <select class="form-control" id="modeofpayment" name="modeofpayment">
                                            <option value='cash'>Cash</option>
                                            <option value='cheque'>Cheque</option>
                                            <option value='card'>Card</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-totalpayment" class=" form-control-label">Total Payment</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="number" id="hf-totalpayment" name="hf-totalpayment" class="form-control" oninput="totalpaymentchange()">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-paymentmade" class=" form-control-label">Payment Made</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="number" id="hf-paymentmade" name="hf-paymentmade" placeholder="Enter Payment Made..." class="form-control" oninput="paymentmadechange()" value="0">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-discount" class=" form-control-label">Discount(in Rs)</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="number" id="hf-discount" name="hf-discount" placeholder="Enter Discount..." class="form-control" oninput="discountchange()" value="0">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-remaining" class=" form-control-label">Remaining(to be made)</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="number" id="hf-remaining" name="hf-remaining" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-extrapayment" class=" form-control-label">Extra Payment</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="number" id="hf-extrapayment" name="hf-extrapayment" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-date" class=" form-control-label">Date</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type='date' id='hf-date' name='hf-date' placeholder='Enter Date...' class='form-control' value="<?php echo $today; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <button class="btn btn-primary btn-lg" id="saledone" onclick="return validateForm()">Sale</button>
                                    </div>
                                </div>







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

    <div id="saleajax"></div>
    <div id="addpay"></div>
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
        $(document).ready(function() {
            $('body').on('change', '#brandid', function() {
                var brandid = parseInt($("#brandid").val());
                if (brandid == "select") {
                    $("#formulashere").text("");
                    $("#packingshere").text("");
                } else {
                    $('#formulashere').load("pstock.php", {
                        bmodid: brandid,
                        fform: "showformulas"
                    });
                }
            });


            $('body').on('change', '#formulasid', function() {
                var formulasid = parseInt($("#formulasid").val());
                var brandid = parseInt($("#brandid").val());

                if (formulasid == "select") {
                    $("#packingshere").text("");
                } else {
                    $('#packingshere').load("pstock.php", {
                        bmodid: brandid,
                        fform: "showpackings"
                    });
                }


            });
        });
    </script>

    <script>
        function validateForm() {

            var brandid = document.getElementById('brandid').value;

            var noofbags = document.getElementById('hf-noofbags').value;

            var clientname = document.getElementById('clientname').value;
            var salesmanname = document.getElementById('salesmanname').value;
            var modeofpayment = document.getElementById('modeofpayment').value;
            var totalpayment = document.getElementById('hf-totalpayment').value;
            var paymentmade = document.getElementById('hf-paymentmade').value;
            var discount = document.getElementById('hf-discount').value;
            var remainingpayment = document.getElementById('hf-remaining').value;
            var extrapayment = document.getElementById('hf-extrapayment').value;
            var date = document.getElementById('hf-date').value;


            if (brandid == "select") {
                snackbar("Brand is required", "red");
                return false;
            } else {
                var formulaid = document.getElementById('formulasid').value;
                if (formulaid == "select") {
                    snackbar("Formula is required", "red");
                    return false;
                } else {
                    var packingsize = document.getElementById('packingSizes').value;
                    if (packingsize == "select") {
                        snackbar("Packing Size is required", "red");
                        return false;
                    }
                }
            }


            if (noofbags == "" || parseInt(noofbags) <= 0) {
                snackbar("No of Bags can't be zero or less than zero", "red");
                return false;
            }
            if (clientname == "select") {
                snackbar("Client name is required", "red");
                return false;
            }
            if (salesmanname == "select") {
                snackbar("Salesman name is required", "red");
                return false;
            }
            if (date == "") {
                snackbar("Date Field is required", "red");
                return false;
            }

            if (totalpayment == '' || parseFloat(totalpayment) <= 0) {
                snackbar("Total Payment can't be negetive or zero or empty", "red");
                return false;
            }
            if (paymentmade == '' || parseFloat(paymentmade) < 0) {
                snackbar("Payment made can't be negetive or empty", "red");
                return false;
            }
            if (discount == '' || parseFloat(discount) < 0) {
                snackbar("Discount can't be negetive or empty", "red");
                return false;
            }

            $('#saleajax').text('');
            //send the ajax with data
            $('#saleajax').load("accounthandle.php", {

                brandid: parseInt(brandid),
                formulaid: parseInt(formulaid),
                packingsize: parseInt(packingsize),
                noofbags: parseInt(noofbags),
                clientname: parseInt(clientname),
                salesmanname: parseInt(salesmanname),
                modeofpayment: modeofpayment,
                totalpayment: parseFloat(totalpayment),
                paymentmade: parseFloat(paymentmade),
                discount: parseFloat(discount),
                remainingpayment: parseFloat(remainingpayment),
                extrapayment: parseFloat(extrapayment),
                date: date,
                fform: "saleajax"
            }, function() {
                document.getElementById('brandid').value = "select";
            });

            return true;
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



        function totalpaymentchange() {
            var pm = parseInt(document.getElementById("hf-paymentmade").value);
            var tp = parseInt(document.getElementById("hf-totalpayment").value);
            var d = parseInt(document.getElementById("hf-discount").value);
            // debugger;
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

        function paymentmadechange() {
            var pm = parseInt(document.getElementById("hf-paymentmade").value);
            var tp = parseInt(document.getElementById("hf-totalpayment").value);
            var d = parseInt(document.getElementById("hf-discount").value);
            // debugger;
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

        function additionalPaymentsuchange() {
            var rems = parseFloat(document.getElementById("rems").value);
            var adds = parseFloat(document.getElementById("hf-additionals").value);
            // debugger;
            if (adds > rems) {
                snackbar('you are adding more than remaining payment.', 'red');
                document.getElementById("hf-additionals").value = rems;
            }
        }

        function additionalPaymentclchange() {
            var remc = parseFloat(document.getElementById("remc").value);
            var addc = parseFloat(document.getElementById("hf-additionalc").value);
            // debugger;
            if (addc > remc) {
                snackbar('you are adding more than remaining payment.', 'red');
                document.getElementById("hf-additionalc").value = remc;
            }
        }
    </script>

</body>

</html>
<!-- end document-->