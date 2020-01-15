<?php require_once('session.php');

require_once("connection.php");
if (!$conn->connect_error) {
    $opt1 = "";
    $sql1 = "SELECT c.client_id, c.user_name FROM client c WHERE c.deleted != 1";
    $res = $conn->query($sql1);
    $data1 = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $opt1 .= '<option value=' . $row['client_id'] . '>' . $row['client_id'] . ' - ' . $row['user_name'] . '</option>';
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
    <title>Client Account</title>

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

                        <div class="row">
                            <div class="col-md-12">


                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="hf-client" class=" form-control-label">Client</label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <select class="form-control" id="clientid" name="clientid">
                                            <option value='select'>select option</option><?php echo $opt1; ?>
                                        </select>
                                    </div>
                                </div>
                                <div id="clientdetails">
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
            $('body').on('change', '#clientid', function() {
                var clientid = this.value

                if (clientid == "select") {
                    $("#clientdetails").text("");
                } else {
                    $('#clientdetails').load("accounthandle.php", {
                        clientid: parseInt(clientid),
                        fform: "clientdetails"
                    }, function() {
                        $('#example4').DataTable({
                            scrollX: true
                        });
                    });
                }
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
                if (remc <= 0) {
                    snackbar('Remaining amount cannot be zero', 'red');
                    return false;
                }
                $('#addpay').load("accounthandle.php", {
                    id: id,
                    remc: remc,
                    fform: "clientRemainingamount"
                }, function() {
                    var clientid = parseInt(document.getElementById('clientid').value);
                    $('#clientdetails').text('');
                    $('#clientdetails').load("accounthandle.php", {
                        clientid: clientid,
                        fform: "clientdetails"
                    }, function() {
                        $('#example4').DataTable({
                            scrollX: true
                        });
                    });
                });
                $('#largeModal').modal('hide');
            });



        });
    </script>
    <script>
        function additionalPaymentclchange() {
            var remc = parseFloat(document.getElementById("remc").value);
            var addc = parseFloat(document.getElementById("hf-additionalc").value);
            // debugger;
            if (addc > remc) {
                snackbar('you are adding more than remaining payment.', 'red');
                document.getElementById("hf-additionalc").value = remc;
            }
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

    </script>
</body>

</html>
<!-- end document-->