<?php require_once('session.php') ?>

<?php
require_once("connection.php");

if (!$conn->connect_error) {


    if (isset($_REQUEST['submit'])) { // if submit button clicked

        $brandid  =  $_REQUEST['brandid'];
        $formulaid =  $_REQUEST['formulasid'];
        $packingid =  $_REQUEST['packingSizes'];
        $noofbags = $_REQUEST['hf-noofbags'];
        $noofbags = (int) $noofbags;
        $date =  $_REQUEST['hf-date'];

        $totalweight = (int) $packingid * $noofbags;
        $formulamultiplier = (float) $totalweight / 100.0;
        // $t = gettype($formulamultiplier);
        // echo "<script>alert('$formulamultiplier is a $t')</script>";

        $sql1 = "select rm.raw_material_name,rms.weight,bf.weightinkg * $formulamultiplier as weightRequired,bf.* from brandFormula bf inner join rawMaterial rm on bf.rawmaterial_id = rm.raw_material_id inner join rawmaterialStock rms on bf.rawmaterial_id = rms.rawmaterial_id where bf.brand_id = $brandid and bf.formula_id = $formulaid and bf.deleted != 1";
        $res = $conn->query($sql1);
        $brandformulasdata = array();
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $brandformulasdata[] = $row;
            }
        }


        $s = count($brandformulasdata);
        $i = 0;
        $permission = "goahead";
        $rawstocksinfo = array();
        while ($i < $s) {
            $row = $brandformulasdata[$i];
            if ($row['weightRequired'] > $row['weight']) {
                $less = $row['weightRequired'] - $row['weight'];
                $info = array($less, $row['rawmaterial_id'], $row['raw_material_name']);
                $rawstocksinfo[] = $info;
                $permission = "denied";
            }

            $i++;
        }


        //  echo "<script>alert('$permission')</script>";

        if ($permission == "goahead") {
            //enter into table
            $conn->autocommit(FALSE);

            $sql1 = "insert into productStock(brand_id,formula_id,packing_size,noofbags,date,deleted) values($brandid,$formulaid,$packingid,$noofbags,'$date',false);";
            $res = $conn->query($sql1);
            $done = false;
            if ($res) {
                //echo "inserted succesfully";
                //update the rawmaterial in the rawmaterial stock
                $done = true;

                foreach ($brandformulasdata as $row) {
                    $weight = $row['weightRequired'];
                    $rawmaterialid = $row['rawmaterial_id'];
                    $sql = "UPDATE rawmaterialStock rms SET  rms.weight  =rms.weight - $weight WHERE rms.rawmaterial_id = $rawmaterialid";
                    $res2 = $conn->query($sql);
                    if ($res2 && $done) {
                        $done = true;
                    } else {
                        $done = false;
                    }
                }
            }
            // add to number of bags
            // already there then update else add row
            if ($done == true) {
                $que = "SELECT p.id,p.noofbags FROM productStockPackingWise p where p.brand_id = $brandid and p.formula_id =$formulaid and p.packing_size =$packingid and p.deleted != 1";
                $res = $conn->query($que);
                if ($res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    $que = "update productStockPackingWise p set p.noofbags = p.noofbags + $noofbags where p.id = $row[id] and p.deleted != 1";
                    $res = $conn->query($que);
                    if ($res) {
                        $not = "done";
                        $conn->commit();
                    } else {
                        $conn->close();
                        $not = "notdone";
                    }
                } else {
                    $que2 = "INSERT INTO productStockPackingWise(brand_id, formula_id, packing_size, noofbags, deleted) VALUES ($brandid,$formulaid,$packingid,$noofbags,false )";
                    $res = $conn->query($que2);
                    if ($res) {
                        $not = "done";
                        $conn->commit();
                    } else {
                        $conn->close();
                        $not = "notdone";
                    }
                }
            } else {
                $conn->close();
                $not = "notdone";
            }
        }

        //    }

    } else if (isset($_REQUEST['submita'])) {


        $brandid  =  $_REQUEST['brandid'];
        $formulaid =  $_REQUEST['formulasid'];
        $packingid =  $_REQUEST['packingSizes'];
        $noofbags = $_REQUEST['hf-noofbags'];
        $date =  $_REQUEST['hf-date'];

        echo "<script>alert('$brandid - $formulaid - $packingid - $noofbags - $date')</script>";
        // $totalweight = (int)$packingid * (int)$noofbags;
        // $formulamultiplier = (float)$totalweight / 100.0; 
        // // $t = gettype($formulamultiplier);
        // // echo "<script>alert('$formulamultiplier is a $t')</script>";

        // $sql1 = "select rm.raw_material_name,rms.weight,bf.weightinkg * $formulamultiplier as weightRequired,bf.* from brandFormula bf inner join rawMaterial rm on bf.rawmaterial_id = rm.raw_material_id inner join rawmaterialStock rms on bf.rawmaterial_id = rms.rawmaterial_id where bf.brand_id = $brandid and bf.formula_id = $formulaid and bf.deleted != 1";
        // $res = $conn->query($sql1);
        // $brandformulasdata = array();
        // if($res->num_rows > 0 ){
        // while($row = $res->fetch_assoc()){
        //     $brandformulasdata[] = $row;
        //     }
        // }


        // $s = count($brandformulasdata);
        // $i = 0;
        // $permission = "goahead";
        // $rawstocksinfo = array();
        // while($i < $s){
        //     $row = $brandformulasdata[$i];
        //     if($row[weightRequired] > $row[weight]){
        //         $less = $row[weightRequired] - $row[weight];
        //         $info = array($less, $row[rawmaterial_id],$row[raw_material_name]);
        //         $rawstocksinfo[] = $info;
        //         $permission = "denied";
        //     }

        //     $i++;
        // }


        // //  echo "<script>alert('$permission')</script>";

        //  if($permission == "goahead"){
        //      //enter into table

        //      $sql1 = "insert into productStock(brand_id,formula_id,packing_size,noofbags,date,deleted) values($brandid,$formulaid,$packingid,$noofbags,'$date',false);";
        //      $res = $conn->query($sql1);
        //     if($res){
        //         //echo "inserted succesfully";
        //         //update the rawmaterial in the rawmaterial stock
        //         foreach($brandformulasdata as $row){
        //             $weight = $row[weightRequired];
        //             $rawmaterialid = $row[rawmaterial_id];
        //             $sql = "UPDATE rawmaterialStock rms SET  rms.weight  =rms.weight - $weight WHERE rms.rawmaterial_id = $rawmaterialid";
        //             $res1 = $conn->query($sql);
        //             if($res1){
        //                 $notification  = "adddo";        
        //             }
        //         }

        //         $notification  = "adddo";

        //     }

        //  }

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
    <title>Product Stocks</title>

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
                        <div class="row" style="width:50%;margin:auto">
                            <div class="col-md-12" id="lessinfo" style="color:blue;background-color:white">
                            </div>
                            <div class="col-md-12">

                                <button type="button" style="margin:15px 5px" class="btn btn-info" id="arms">Add Product Stock</button>
                                <button type="button" style="margin:15px 5px" class="btn btn-success" id="vrms">View Product Stock</button>
                                <!-- <button type="button" style="margin:15px 5px" class="btn btn-danger" id="rrms">Remove Product Stock</button> -->

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


    <div id="snackbar"></div>

    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>

    <script src="vendor/dataTables/jquery.dataTables.min.js"></script>
    <script src="vendor/dataTables/dataTables.bootstrap4.min.js"></script>
    <!-- Vendor JS   -->
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


            <?php echo "var lessarray =", json_encode($rawstocksinfo) ?>;
            if (lessarray != null) {
                var str = "";

                lessarray.forEach(function(entry) {
                    str += "<p style='margin:3px; text-align:center'> " + entry[1] + " - " + entry[2] + " is " + entry[0] + " kg less than required in the stock.</p>";
                });
                $("#lessinfo").html(str);
            }

            $('body').on('click', '#arms', function() { // Click to only happen on announce links
                $("#content").text("");
                $('#content').load("pstock.php", {
                    fform: "arms"
                });

            });

            $('body').on('click', '#vrms', function() { // Click to only happen on announce links
                $("#content").text("");
                $('#content').load("pstock.php", {
                    fform: "vrms"
                });

            });

            //    $('body').on('click','#rrms',function(){ // Click to only happen on announce links
            //         $("#content").text("");
            //         $('#content').load("pstock.php", {
            //         fform : "rrms"
            //          });

            //    });


            $('body').on('change', '#brandid', function() {
                var brandid = parseInt($("#brandid").val());

                // alert(brandid);

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

            //    *******************************************************


            $('body').on('change', '#brandid1', function() {
                var brandid = parseInt($("#brandid1").val());

                if (brandid == "select") {
                    $("#formulashere1").text("");
                } else {
                    $('#formulashere1').load("pstock.php", {
                        bmodid: brandid,
                        fform: "showformulas1"
                    });
                }


            });


            $('body').on('change', '#formulasid1', function() {
                var formulasid = parseInt($("#formulasid1").val());
                var brandid = parseInt($("#brandid1").val());
                // debugger;
                if (formulasid == "select") {
                    $("#stockhere1").text("");
                } else {
                    $('#stockhere1').load("pstock.php", {
                        bmodid: brandid,
                        formulasid: formulasid,
                        fform: "showstock"
                    }, function() {
                        $('#example2').DataTable();
                    });
                }


            });

            var noti = "<?php echo $not ?>";
            if (noti == "done") {
                snackbar("Added Successfully", "green");
            } else if (noti == "notdone") {
                snackbar("Adding Failure.", "red");
            }





        });
    </script>

    <script>
        function validateForm() {

            var brandid = document.getElementById('brandid').value;
            var noofbags = document.getElementById('hf-noofbags').value;
            var date = document.getElementById('hf-date').value;


            if (brandid == "select") {
                snackbar("Brand Name is required", "red");
                return false;

            } else {
                var formulaid = document.getElementById('formulasid').value;
                if (formulaid == "select") {
                    snackbar("Formula Name is required", "red");
                    return false;
                } else {

                    var packingsize = document.getElementById('packingSizes').value;
                    if (packingsize == "select") {
                        snackbar("Packing Size is required.", "red");
                        return false;
                    } else {
                        if (noofbags == "" || noofbags == '0') {
                            snackbar("No of bags field is required", "red");
                            return false;
                        } else {
                            var fl = validateQuantity(noofbags);
                            if (!fl) {
                                snackbar("No of Bags can only be integers. field is not valid", "red");
                                return false;
                            } else {
                                if (date == "") {
                                    snackbar("Date Field is required", "red");
                                    return false;
                                } else {
                                    return true;
                                }
                            }
                        }
                    }

                }

            }


            return true;
        }


        function validateremForm() {
            var brandid = document.getElementById('brandid').value;
            var noofbags = document.getElementById('hf-noofbags').value;
            var date = document.getElementById('hf-date').value;


            if (brandid == "select") {
                snackbar("Brand Name is required", "red");
                return false;

            } else {
                var formulaid = document.getElementById('formulasid').value;
                if (formulaid == "select") {
                    snackbar("Formula Name is required", "red");
                    return false;
                } else {

                    var packingsize = document.getElementById('packingSizes').value;
                    if (packingsize == "select") {
                        snackbar("Packing Size is required.", "red");
                        return false;
                    } else {
                        if (noofbags == "" || noofbags == '0') {
                            snackbar("No of bags field is required", "red");
                            return false;
                        } else {
                            var fl = validateQuantity(noofbags);
                            if (!fl) {
                                snackbar("No of Bags can only be integers. field is not valid", "red");
                                return false;
                            } else {
                                if (date == "") {
                                    snackbar("Date Field is required", "red");
                                    return false;
                                } else {
                                    return true;
                                }
                            }
                        }
                    }

                }

            }


            return true;
        }

        function validateQuantity(s) {
            var rgx = /^[0-9]*$/;
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
    </script>

</body>

</html>
<!-- end document-->