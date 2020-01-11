<?php require_once('session.php') ?>

<?php
require_once("connection.php");

if (!$conn->connect_error) {



    $rawmaterialname  = "";
    $opt = "";
    $sql =  "select raw_material_id, raw_material_name from rawMaterial where deleted != 1";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            // echo "<script>alert('a')</script>";
            $opt .= '<option value=\"' . $row['raw_material_id'] . '\">' . $row['raw_material_id'] . ' - ' . $row['raw_material_name'] . '</option>';
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
    <title>View Raw Material Nutrient</title>

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
                                        View <strong>Raw Material Nutrients</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="rawmaterialname" class=" form-control-label">Raw Material</label>
                                                </div>
                                                <div class="col-12 col-md-5 rawmaterialname">
                                                </div>
                                            </div>




                                        </form>
                                    </div>
                                </div>

                                <div id='nutridata'>

                                </div>

                                <div id='updatenutri'>

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

    <div id="snackbar"></div>

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

            cols += '<select class="form-control" id="rawmat" name="rawmaterial">' +
                '<option value="select">select option</option><?php echo $opt; ?>' +
                '</select>';
            $(".rawmaterialname").append(cols);



            $('#rawmat').on('change', function() {
                var rawid = this.value;
                if (rawid != "select") {
                    $('#nutridata').load("rawmatnutridata.php", {
                        fmodid: rawid
                    }, function() {
                        $('#example').DataTable({
                            "scrollX": true
                        });
                    });
                    $("#updatenutri").text("");
                } else {
                    $("#nutridata").text("");
                }

            });

            $('body').on('click', '#editnutri', function() {
                // Click to only happen on announce links
                var rawmatid = parseInt($('#sid').val());



                $('#updatenutri').load("update-rawmatnutridata.php", {
                    fmodid: rawmatid,
                    fform: "updatenutri"
                });
            });



            $('body').on('change', '#nutrientID', function() {
                // Click to only happen on announce links
                var valnum = $('#nutrientID').val();
                var quan = document.getElementById(valnum).textContent;

                $('#nutrientquantity').val(quan);

            });


            $('body').on('click', '#updatenutriinfo', function() {
                // Click to only happen on announce links
                var quantity = $('#nutrientquantity').val();

                if (quantity == "") {
                    snackbar("Quantity Field is empty.","red");
                } else {
                    var fl = validateQuantity(quantity);
                    if (!fl) {
                        snackbar("Quantity field is not valid. only numeral allowed.","red");
                        return false;
                    } else {


                        var rawmatid = parseInt($('#rawmaterialid').val());
                        var nutrientID = parseInt($('#nutrientID').val());

                        // alert(rawmatid);
                        // alert(nutrientID);
                        $("#updatenutri").text("");
                        $('#updatenutri').load("update-rawmatnutridata.php", {
                            fmodid: rawmatid,
                            nutrientID: nutrientID,
                            quantity: quantity,
                            fform: "updatevalue"
                        }, function() {
                            if (rawmatid != "select") {
                            $('#nutridata').load("rawmatnutridata.php", {
                                fmodid: rawmatid
                            },function(){
                                $('#example').DataTable({
                                "scrollX": true
                            });
                            });
                            }

                            
                        });


                        // if (rawmatid != "select") {
                        //     $('#nutridata').load("rawmatnutridata.php", {
                        //         fmodid: rawmatid
                        //     });
                        // }

                    }
                }




                // $('#updatenutri').load("update-rawmatnutridata.php", {
                // fmodid : rawmatid,
                // fform : "updatenutri"
                //  });
            });




        });

        function validateQuantity(s) {
            var rgx = /^[0-9]*\.?[0-9]*$/;
            return s.match(rgx);
        }

        function snackbar(message,color) {
  // Get the snackbar DIV
  var x = document.getElementById("snackbar");

  x.innerHTML =message;
  x.style.background = color;
  // Add the "show" class to DIV
  x.className = "show";
  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
    </script>

</body>

</html>
<!-- end document-->