<?php require_once('session.php') ?>

<?php
require_once("connection.php");
if (!$conn->connect_error) {

    $brandname  = "";
    $opt = "";
    $sql =  "select brand_id, brand_name from brand where deleted != 1";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            // echo "<script>alert('a')</script>";
            $opt .= '<option value=\"' . $row['brand_id'] . '\">' . $row['brand_id'] . ' - ' . $row['brand_name'] . '</option>';
        }
        // echo "<script>alert('$opt')</script>";
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
    <title>Edit Brand</title>

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
                                <div class="card">
                                    <div class="card-header">
                                        Edit <strong>Brand</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="row form-group" style="width:50%;margin:5px auto">
                                            <div class="col col-md-3">
                                                <label for="brandname" class=" form-control-label">Brand</label>
                                            </div>
                                            <div class="col col-md-8 brandname">
                                            </div>

                                        </div>
                                        <div class="row form-group" id="btns" style="width:100%;margin:15px auto">

                                            <!-- three buttons -->
                                        </div>
                                        <div class="row form-group" id="functions" style="width:100%;margin:15px">


                                        </div>




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

    <!-- static modal -->
    <!-- modal static -->
    <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <strong>Are you sure you want to delete this Brand ?</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmdelete">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal static -->
    <div id="snackbar"></div>
    <div id="confirmdel"></div>
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
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
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            var cols = "";
            cols += '<select class="form-control bred" id="brandedit" name="brande">' +
                '<option value="select">select option</option><?php echo $opt; ?>' +
                '</select>';
            $(".brandname").append(cols);

            $('#brandedit').on('change', function() {
                var rawid = this.value;
                if (rawid != "select") {
                    $("#functions").text("");
                    $('#btns').load("modifybrand.php", {
                        fmodid: rawid,
                        fform: "one"
                    });
                } else {
                    $("#btns").text("");
                }

            });
            $('body').on('click', '#cbn', function() { // Click to only happen on announce links
                var brandid = $('#brandid').val();
                $("#functions").text("");
                $('#functions').load("modifybrand.php", {
                    fmodid: brandid,
                    fform: "cbn"
                });
            });
            $('body').on('click', '#apo', function() { // Click to only happen on announce links
                var brandid = $('#brandid').val();
                $("#functions").text("");
                $('#functions').load("modifybrand.php", {
                    fmodid: brandid,
                    fform: "apo"
                });

            });
            $('body').on('click', '#rpo', function() { // Click to only happen on announce links
                var brandid = $('#brandid').val();
                $("#functions").text("");
                $('#functions').load("modifybrand.php", {
                    fmodid: brandid,
                    fform: "rpo"
                });

            });

            $('body').on('click', '#deletebrand', function() { // Click to only happen on announce links
                $("#functions").text("");
                $('#staticModal').modal('show');
            });

            $('body').on('click', '#confirmdelete', function() { // Click to only happen on announce links
                var brandid = $('#brandid').val();
                // alert(brandid);

                $('#confirmdel').load("modifybrand.php", {
                    brandid: brandid,
                    fform: "deleteconfirmed"
                }, function() {
                    $('.brandname').text('');    
                    $('.brandname').load("modifybrand.php", {
                        fform: "loadbrand"
                    },function(){
                        $('#brandedit').on('change', function() {
                var rawid = this.value;
                if (rawid != "select") {
                    $("#functions").text("");
                    $('#btns').load("modifybrand.php", {
                        fmodid: rawid,
                        fform: "one"
                    });
                } else {
                    $("#btns").text("");
                }

            });
                    });
                });
                $('#staticModal').modal('hide');
            });

            



            $('body').on('click', '#changebname', function() { // Click to only happen on announce links
                var brandname = $('#hf-brandname').val();
                if (brandname == "") {
                    snackbar("Brand Name is required.", "red");
                } else {
                    var brandid = parseInt($('#brandid1').val());
                    $("#functions").text("");
                    $('#functions').load("modifybrand.php", {
                        fmodid: brandid,
                        bname: brandname,
                        fform: "changebname"
                    });
                }

            });
            $('body').on('click', '#addPackingSize', function() { // Click to only happen on announce links
                var psize = $('#packingopt').val();

                if (psize == "select") {
                    snackbar("Packing Option is required.", "red");
                } else {
                    var brandid = parseInt($('#brandid2').val());
                    $("#functions").text("");
                    $('#functions').load("modifybrand.php", {
                        fmodid: brandid,
                        psize: parseInt(psize),
                        fform: "addPackingOption"
                    });
                }

            });
            $('body').on('click', '#remPackingSize', function() { // Click to only happen on announce links
                var psize = $('#packingopt').val();

                if (psize == "select") {
                    snackbar("Packing Option is required.", "red");
                } else {
                    var brandid = parseInt($('#brandid3').val());
                    $("#functions").text("");
                    $('#functions').load("modifybrand.php", {
                        fmodid: brandid,
                        psize: parseInt(psize),
                        fform: "remPackingOption"
                    });
                }

            });
        });


    </script>
    <script>
        function validateForm() {
            var brandname = document.getElementById("hf-brandname").value;
            //var emailaddress = document.getElementById("hf-emailaddress").value;
            if (brandname == "") {
                snackbar("Brand name is required.", "red");
                return false;
            }
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
    </script>
</body>

</html>
<!-- end document-->