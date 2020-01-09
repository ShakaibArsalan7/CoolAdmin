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
    <title>Accounts</title>

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

                                <button type="button" style="margin:15px 5px" class="btn btn-info" id="sale">Sale</button>
                                <button type="button" style="margin:15px 5px" class="btn btn-success" id="supplieraccount">Suppliers Account</button>
                                <button type="button" style="margin:15px 5px" class="btn btn-danger" id="clientaccount">Clients Account</button>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" id="content">


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

    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Clear Remaining Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idval" value="" />

                    <div id="parawithdata">



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal large -->


    
    <div id="saleajax"></div>
    <div id="addpay"></div>
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
            <?php #echo $notification; ?>
            // var noti = ";
            // if (noti == "adddo") {
            //     snackbar("Added Successfully", "green");
            // } else if (noti == "gr") {
            //     snackbar("Weight added is greater than weight present in inventory.", "red");
            // } else if (noti == "do") {
            //     snackbar("Removed Successfully", "green");
            // }

            $('body').on('click', '#sale', function() { // Click to only happen on announce links
                $("#content").text("");
                $('#content').load("accounthandle.php", {
                    fform: "sale"
                });

            });


            $('body').on('click', '#supplieraccount', function() { // Click to only happen on announce links
                $("#content").text("");
                $('#content').load("accounthandle.php", {
                    fform: "supplieraccount"
                });
            });

            $('body').on('change', '#suppliername', function() {
                var supplierid = parseInt($("#suppliername").val());

                if (supplierid == "select") {
                    $("#supplierdetails").text("");
                } else {
                    $('#supplierdetails').load("accounthandle.php", {
                        supplierid: supplierid,
                        fform: "supplierdetails"
                    }, function() {
                        $('#example3').DataTable();
                    });
                }
            });

            // ******************************************************************

            $('body').on('click', '#clientaccount', function() { // Click to only happen on announce links
                $("#content").text("");
                $('#content').load("accounthandle.php", {
                    fform: "clientaccount"
                });
            });

            $('body').on('change', '#clientid', function() {
                var clientid = parseInt($("#clientid").val());

                if (clientid == "select") {
                    $("#clientdetails").text("");
                } else {
                    $('#clientdetails').load("accounthandle.php", {
                        clientid: clientid,
                        fform: "clientdetails"
                    }, function() {
                        $('#example4').DataTable({
                            scrollX :true
                        });
                    });
                }
            });

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


            // $('body').on('click', '#clientaccount', function() { // Click to only happen on announce links
            //     $("#content").text("");
            //     $('#content').load("accounthandle.php", {
            //         fform: "clientaccount"
            //     });

            // });

            $('body').on('click', '.mid', function() { // Click to only happen on announce links
                //var a = document.getElement
                $("#idval").val($(this).data('id'));
                // debugger;
                var id = parseInt($("#idval").val());

                $('#parawithdata').load("accounthandle.php", {
                    id: id,
                    fform: "clearSupplierDue"
                });


                $('#largeModal').modal('show');

            });

            $('body').on('click', '#additionalpayment', function() {
                // update the amount in the database after adding the remaining 
                var rems = parseFloat(document.getElementById('hf-additionals').value);
                var id = parseInt($("#idval").val());
                if(rems <= 0 ){
                    snackbar('Remaining amount cannot be zero','red');
                    return false;
                } 
                $('#addpay').load("accounthandle.php", {
                    id: id,
                    rems :rems,
                    fform: "supplierRemainingamount"
                },function(){
                    var supplierid = parseInt(document.getElementById('suppliername').value);
                    $('#supplierdetails').text('');
                    $('#supplierdetails').load("accounthandle.php", {
                        supplierid: supplierid,
                        fform: "supplierdetails"
                    }, function() {
                        $('#example3').DataTable();
                    });
                });
                $('#largeModal').modal('hide');
            });


            $('body').on('click', '.clid', function() { // Click to only happen on announce links
                //var a = document.getElement
                $("#idval").val($(this).data('id'));
                // debugger;
                var id = parseInt($("#idval").val());

                $('#parawithdata').load("accounthandle.php", {
                    id: id,
                    fform: "clearClientDue"
                });


                $('#largeModal').modal('show');

            });

            $('body').on('click', '#additionalpaymentcl', function() { // Click to only happen on announce links
                var remc = parseFloat(document.getElementById('hf-additionalc').value);
                var id = parseInt($("#idval").val());
                if(remc <= 0 ){
                    snackbar('Remaining amount cannot be zero','red');
                    return false;
                } 
                $('#addpay').load("accounthandle.php", {
                    id: id,
                    remc :remc,
                    fform: "clientRemainingamount"
                },function(){
                    var clientid = parseInt(document.getElementById('clientid').value);
                    $('#clientdetails').text('');
                    $('#clientdetails').load("accounthandle.php", {
                        clientid: clientid,
                        fform: "clientdetails"
                    }, function() {
                        $('#example4').DataTable({
                            scrollX :true
                        });
                    });
                });
                $('#largeModal').modal('hide');
            });








        });
    </script>

    <script>
        function validateForm() {

            var brandid = document.getElementById('brandid').value;

            var noofbags = document.getElementById('hf-noofbags').value;

            var clientname = document.getElementById('clientname').value;
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
                formulaid : parseInt(formulaid), 
                packingsize : parseInt(packingsize),
                noofbags: parseInt(noofbags),
                clientname: parseInt(clientname),
                modeofpayment: modeofpayment,
                totalpayment: parseFloat(totalpayment),
                paymentmade: parseFloat(paymentmade),
                discount: parseFloat(discount),
                remainingpayment: parseFloat(remainingpayment),
                extrapayment: parseFloat(extrapayment),
                date: date,
                fform: "saleajax"
            },function(){
                document.getElementById('brandid').value = "select";
            });

            return true;
        }


        // function validateQuantity(s) {
        //     var rgx = /^[0-9]*\.?[0-9]*$/;
        //     return s.match(rgx);
        // }

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

        function additionalPaymentsuchange(){
            var rems = parseFloat(document.getElementById("rems").value);
            var adds = parseFloat(document.getElementById("hf-additionals").value);
            // debugger;
            if(adds > rems){
                snackbar('you are adding more than remaining payment.','red');
                document.getElementById("hf-additionals").value = rems;
            }
        }
        function additionalPaymentclchange(){
            var remc = parseFloat(document.getElementById("remc").value);
            var addc = parseFloat(document.getElementById("hf-additionalc").value);
            // debugger;
            if(addc > remc){
                snackbar('you are adding more than remaining payment.','red');
                document.getElementById("hf-additionalc").value = remc;
            }
        }
    </script>

</body>

</html>
<!-- end document-->