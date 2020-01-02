<?php require_once('session.php') ?>

<?php
require_once("connection.php");

$rawmaterialname  = "";
$err = "";




if (!$conn->connect_error) { // if database connected.

    if (isset($_REQUEST['submit'])) { // if submit button clicked

        $brandid  =  $_REQUEST['brande'];
        $formulaname  =  $_REQUEST['formulaname'];
        $timestamp = time();

        //validation passed

        $sql = "insert into formulas(brand_id,formula_name,adding_timestamp,deleted) values($brandid,'$formulaname','$timestamp',false);";
        //echo "<script>alert(\"$sql\")</script>";
        $res = $conn->query($sql);
        if ($res) {
            //echo "inserted succesfully";
            $sql2 = "select formula_id from formulas where adding_timestamp = '$timestamp' && deleted != 1";
            $formulaid = $conn->query($sql2)->fetch_object()->formula_id;


            //echo "<script>alert('$res1');</script>";
            foreach ($_POST as $name => $value) {
                if (strpos($name, 'rawmaterial') !== false) {
                    $qname =  "rmweight" .  substr($name, 11);
                    $qquan = $_POST[$qname];
                    $rawmatid = $_POST[$name];

                    $que = "insert into brandFormula(brand_id,formula_id,rawmaterial_id,weightinkg,deleted) values($brandid,$formulaid,$rawmatid,$qquan,false)";
                    $res2 = $conn->query($que);
                }
                //echo "<script>alert('$name - $value')</script>";

            }
        }
    } else { // if not submit, first visit to page or refresh

        $brandname  = "";
        $opt = "";
        $sql =  "select brand_id, brand_name from brand where deleted != 1";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                // echo "<script>alert('a')</script>";
                $opt .= '<option value=' . $row['brand_id'] . '>' . $row['brand_id'] . ' - ' . $row['brand_name'] . '</option>';
            }
            // echo "<script>alert('$opt')</script>";
        }

        $rawmaterialname  = "";
        $opt1 = "";
        $sql =  "select raw_material_id, raw_material_name from rawMaterial where deleted != 1";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                // echo "<script>alert('a')</script>";
                $opt1 .= '<option value=' . $row['raw_material_id'] . '>' . $row['raw_material_id'] . ' - ' . $row['raw_material_name'] . '</option>';
            }
            // echo "<script>alert('$opt')</script>";
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
    <title>Add Formula</title>

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
                                        Add <strong>Formula</strong>
                                    </div>


                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="brandname" class=" form-control-label">Brand</label>
                                                </div>
                                                <div class="col-12 col-md-5 brandname">
                                                    <select class="form-control" id="brandedit" name="brande">
                                                        <option value="select">select option</option><?php echo $opt; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="formulaname" class=" form-control-label">Formula Name</label>
                                                </div>
                                                <div class="col-12 col-md-5 formulaname">
                                                    <input type="text" id="formulaname" name="formulaname" placeholder="Enter Formula name..." class="form-control">

                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-8">
                                                    <div class="row">
                                                        <div class="col-sm-8" id="tabletitle">
                                                            <h2>Raw Material Details</h2>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <button type="button" class="btn btn-success add-new" id="addrow"><i class="fa fa-plus"></i> Add New</button>
                                                        </div>
                                                    </div>

                                                    <table id="myTable" class=" table table-bordered order-list ">
                                                        <thead>
                                                            <tr class="rmtab">
                                                                <td></td>
                                                                <td>Raw Material Detail</td>
                                                                <td>Weight in kg</td>
                                                                <td style="text-align:center">Action</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Add Formula" />
                                                </div>

                                            </div>
                                        </form>
                                    </div>


                                    <div class="card-body card-block">
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <h2 style="margin-bottom:50px">Real Time Chart</h2>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                        <div class="col-md-12" style="width:100%; margin-bottom:40px;" id="realchartTotal">
                                                        
                                                        </div>
                                                    
                                                    <div class="col-md-12" style="width:100%" id="realchart">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
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

    <div id="snackbar"></div>

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
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>


    <script>
        var rawmaters = [];
        var rawquantity = [];
        $(document).ready(function() {

            $('#example11').DataTable({
                    "scrollX": true
                });


            var counter = 0;

            $("#addrow").on("click", function() {
                // alert("a");
                var newRow = $("<tr class='packtab'>");
                var cols = "";

                cols += '<td><i class="fa fa-circle"></i></td>';
                // cols += '<td><input type="text" class="form-control" name="packing' + counter + '"/></td>';
                cols += '<td>' +
                    '<select class="form-control pw" name="rawmaterial' + counter + '">' +
                    '<option value="select">select option</option><?php echo $opt1; ?>'





                    +
                    '</select>' +
                    '</td>';
                cols += '<td><input type="text" class="form-control qw" id="rawmaterialweight' + counter + '" name="rmweight' + counter + '" placeholder="Enter Weight..." ></td>';

                // cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
                cols += '<td class="table-data-feature"><i  class="far fa-plus-square realtimebutton" style="font-size:2rem;color:green;width:50%;height:100%;text-align:center"></i> <i class="ibtnDel fas fa-trash-alt" style="font-size:2rem;color:red;width:50%;height:100%;text-align:center"></i></td>';

                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });



            $("table.order-list").on("click", ".ibtnDel", function(event) {
                var a = $(this).closest("tr");
                var rawmat = a[0].cells[1].firstChild.value;
                if (rawmat != "select") {
                    //remove it.
                    const index = rawmaters.indexOf(parseInt(rawmat));
                    if (index > -1) {
                        //check if it is more than 1 than splice
                        var cd = checkDuplicity(parseInt(rawmat));
                        if (cd > 1) {
                            a.remove();
                            rawmaters.splice(index, 1);
                            rawquantity.splice(index, 1);
                            showRealTimeButton(parseInt(rawmat));
                            displayRealTimeTable();
                        } else {
                            rawmaters.splice(index, 1);
                            rawquantity.splice(index, 1);
                            a.remove();
                            displayRealTimeTable();
                        }
                    }
                } else {
                    a.remove();
                    displayRealTimeTable();
                }
                // counter -= 1;
            });

            $("table.order-list").on("click", ".realtimebutton", function(event) {
                var a = $(this).closest("tr");
                // console.log(a[0]);
                var rawmat = a[0].cells[1].firstChild.value;
                // alert(rawmat);
                if (rawmat != "select") {
                    var quantity = a[0].cells[2].firstChild.value;
                    var q = validateQuantity(quantity);
                    if (!q) {
                        snackbar("only numeral allowed in weight field.", "red");
                    } else if (quantity == "") {
                        snackbar("Enter weight in weight field.", "red");
                    } else {

                        //if already in there then nope
                        if (rawmaters.includes(parseInt(rawmat))) {


                            // snackbar("raw material is already added.", "red");
                            var cd = checkDuplicity(parseInt(rawmat));
                            if (cd > 1) {
                                snackbar("raw material is already selected, remove one of them", "red");
                            } else {
                                //array change
                                const indexr = rawmaters.indexOf(parseInt(rawmat));
                                if (indexr > -1) { // is there
                                    rawquantity[indexr] = parseFloat(q);
                                }
                                a[0].cells[3].firstChild.style.display = "none";
                                displayRealTimeTable();
                            }
                            // alert(prev);

                            // a[0].cells[3].firstChild.style.display = "none";
                            // displayRealTimeTable();

                        } else {

                            // var val = a[0].cells[1].firstChild.options[a[0].cells[1].firstChild.selectedIndex].value;
                            //good to go// add to the array.
                            rawmaters.push(parseInt(rawmat));
                            rawquantity.push(parseFloat(quantity));
                            // debugger;
                            // console.log(a);
                            a[0].cells[3].firstChild.style.display = "none";
                            displayRealTimeTable();
                            // call the chart 
                        }

                    }

                } else {
                    snackbar("select some raw material", "red");
                }
                // console.log(    );
                // counter -= 1;
            });
            // var previous;
            // $("table.order-list").on("focus", ".pw", function(event) {
            //     previous = this.value;
            //     var a = $(this).closest("tr");
            //     a[0].cells[3].firstChild.style.display = "block";
            // }).change(function() {
            //     // Do something with the previous value after the change
            //     alert(previous);

            //     // Make sure the previous value is updated
            //     previous = this.value;
            // });
            var prev;
            $("table.order-list").on("focus", ".pw", function(event) {
                var a = $(this).closest("tr");
                prev = a[0].cells[1].firstChild.value;
                if (prev != "select") {
                    prev = parseInt(a[0].cells[1].firstChild.value);
                }

            });

            // $("table.order-list").on("click", ".pw", function(event) {
            //     var a = $(this).closest("tr");
            //     a[0].cells[3].firstChild.style.display = "block";
            //     //remove prev
            //     const index = rawmaters.indexOf(prev);
            //     if (index > -1) {
            //         rawmaters.splice(index, 1);
            //     }


            // });
            $("table.order-list").on("click", ".pw", function(event) {
                var a = $(this).closest("tr");
                a[0].cells[3].firstChild.style.display = "block";
                //check if already there.
                var rawmat = a[0].cells[1].firstChild.value;
                // alert(rawmat);
                const index = rawmaters.indexOf(parseInt(rawmat));
                if (index > -1) { // is there
                    //already there
                    // debugger;    
                    if (parseInt(rawmat) != prev) {
                        snackbar("raw material Already there.", "red");
                        if (prev == "select") {
                            a[0].cells[1].firstChild.value = "select";

                        } else {
                            a[0].cells[1].firstChild.value = prev;

                        }
                    }

                } else { // not there
                    //delete prev
                    const index = rawmaters.indexOf(prev);
                    if (index > -1) {
                        rawmaters.splice(index, 1);
                        rawquantity.splice(index, 1);
                    }
                }
            });


            $("table.order-list").on("click", ".qw", function(event) {
                var a = $(this).closest("tr");
                a[0].cells[3].firstChild.style.display = "block";
                const index = rawmaters.indexOf(prev);
                if (index > -1) {
                    rawmaters.splice(index, 1);
                    rawquantity.splice(index, 1);
                }
            });


        });
    </script>

    <script>
        function checkDuplicity(what) {
            var els = document.getElementsByClassName('pw');
            var packArray = [];
            // var reason =1;
            for (var i = 0; i < els.length; i++) {
                var el = els[i];
                if (el.value != "select") {
                    packArray.push(parseInt(el.value));
                }
            }

            var count = 0;
            for (var i = 0; i < packArray.length; i++) {
                if (packArray[i] === what) {
                    count++;
                }
            }
            return count;


        }

        function showRealTimeButton(rm) {
            var els = document.getElementsByClassName('pw');
            for (var i = 0; i < els.length; i++) {
                var el = els[i];
                if (el.value == rm) {
                    el.parentElement.parentElement.childNodes[3].childNodes[0].style.display = "block";
                }
            }
        }



        function validateForm() {
            var bname = document.getElementById("brandedit").value;
            if (bname == "select") {
                snackbar("Please Select Brand name from drop down.", "red");
                return false;
            }

            var fname = document.getElementById("formulaname").value;
            if (fname == "") {
                snackbar("Formula name is required.", "red");
                return false;
            }


            var els = document.getElementsByClassName('pw');
            //alert(els.length);
            if (els.length == 0) {
                snackbar("No Raw Material Detail is added.", "red");
                return false;
            }
            var packArray = [];
            // var reason =1;
            for (var i = 0; i < els.length; i++) {
                var el = els[i];
                if (el.value == "select") {
                    snackbar("One of the raw material name is not selected.", "red");
                    return false;
                } else {
                    if (packArray.indexOf(el.value) > -1) {
                        //in the array
                        snackbar(el.options[el.selectedIndex].text + " option is selected twice.", "red");
                        return false;
                    } else {
                        packArray.push(el.value);
                        // console.log();
                    }

                }
            }

            var elq = document.getElementsByClassName('qw');
            // var reason =1;
            var formulaSum = 0.0;
            for (var i = 0; i < elq.length; i++) {
                var el = elq[i];


                if (el.value == "") {
                    snackbar("One of the weight field is empty.", "red");
                    return false;
                } else {
                    var v = validateQuantity(el.value);
                    if (!v) {
                        snackbar("only numeral allowed in weight field.", "red");
                        return false;
                    }
                }

                formulaSum += parseFloat(el.value);



            }

            if (formulaSum != 100.0000) {
                if (formulaSum < 100) {
                    snackbar("Formula is made for 100 kg , the cummulative sum of raw materials weight is less than 100", "red");
                    return false;
                } else {
                    snackbar("Formula is made for 100 kg , the cummulative sum of raw materials weight is greater than 100", "red");
                    return false;
                }
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



        <?php
        $opt = "";
        $sql =  "select Nutrition_id, nutrition_name from nutrition where deleted != 1";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $nutrientsdata = array();
            while ($row = $res->fetch_assoc()) {
                $opt .= '<th style="background-color:red;">' . substr($row['nutrition_name'], 0, 4) . '</th>';
                $nutrientsdata[] = $row;
                // 1 - Oil
                // 2 - Ash
                // 3 - Moisture
                // ... 
                //14 - Rate
            }
        }
        $js_nutrients = json_encode($nutrientsdata);


        $sql = "SELECT raw_material_id,raw_material_name FROM rawMaterial rm where rm.deleted != 1";
        $res = $conn->query($sql);
        $rawmaterialsdata = array();
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $rawmaterialsdata[] = $row;
                // 1 - Maize
                // 2 - Wheat Bran
                // 3 - Rice Polish
                // ... 
                //58 - Poultry Feed Wastage
            }
        }
        $js_rawmaterials = json_encode($rawmaterialsdata);



        $sql1 = "SELECT * FROM RawmaterialNutrients rmn where rmn.deleted != 1";
        $nutriinfo = array();
        $res = $conn->query($sql1);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $nutriinfo[] = $row;
            }
        }
        $js_rawmaterialnutrients = json_encode($nutriinfo);

        echo "var nutrients = " . $js_nutrients . ";";
        echo "var rawmaterials = " . $js_rawmaterials . ";";
        echo "var rawmaterialnutrients = " . $js_rawmaterialnutrients . ";";
        echo "var header = '" . $opt . "';";

        ?>
        // var nutrients = 

        function displayRealTimeTable() {
            // console.log(rawmaters);
            // console.log(rawquantity);
            
            $('#realchart').html('');
            $('#realchartTotal').html('');
            var data = "";
            var sumdata = "";
            var tweight = 0;
            var totalrow = [];
            nutrients.forEach(function(nutrientdetail){
                totalrow.push(0);
                });
            data += '<table id="example11" class="table table-striped table-bordered" style="width:100%;font-size:12px">';
            data += '<thead>';
            data += '<tr>';
            data += '<th>Sr.</th>';
            data += '<th>Items</th>';
            data += '<th style="background-color:red;">Weights</th>';
            data += header;
            data += '</tr>';
            data += '</thead>';
            data += '<tbody>';
            // var sumarray = [];
            rawmaters.forEach(function(rm, ndx) {
                
                // var rm = rm;
                var nameobj = rawmaterials.filter(obj => obj.raw_material_id == rm );
                var name = nameobj[0].raw_material_name;
                var rmn = rawmaterialnutrients.filter(obj => obj.raw_material_id == rm );
                var weight = rawquantity[ndx];
                tweight+=weight;
                debugger;
                data += '<tr>';
                data += '<td>'+(ndx+1)+'</td>';
                data += '<td>'+name+'</td>';
                data += '<td>'+weight+'</td>';
                var i = 0;
                nutrients.forEach(function(nutrientdetail){
                    var found = false;
                    rmn.forEach(function(nobj){
                        if(!found){
                            if(nutrientdetail.Nutrition_id == nobj.Nutrition_id){
                                data += '<td>'+(weight* nobj.percentageperkg).toFixed(3)+'</td>';
                                totalrow[i]+= (weight* nobj.percentageperkg);
                                found = true;
                            }
                        }

                    });
                    if(!found){ data += '<td>'+(weight* 0).toFixed(3)+'</td>'; totalrow[i]+= (weight* 0);}

                    i++;

                });
                data += '</tr>';

            });
            //all the data sum.

            data += '</tbody>';
            data += '</table>';


            $('#realchart').html(data);
            displayRealTimeTableTotal(tweight,totalrow);
            $('#example11').DataTable({
                    "scrollX": true
                    
                }
                );
            
        }

        function displayRealTimeTableTotal(tweight,totalrow) {
            var data1 = "";
            data1 += '<h2 style="text-align:center; margin-bottom:20px">Total</h2>';
            data1 += '<table class="table table-striped table-bordered" style="width:100%;font-size:12px">';
            data1 += '<thead>';
            data1 += '<tr>';
            data1 += '<th style="background-color:red;">Weights</th>';
            data1 += header;
            data1 += '</tr>';
            data1 += '</thead>';
            data1 += '<tbody>';
            data1 += '<tr>';
            // var sumarray = [];
            data1 += '<td>'+tweight+'</td>';
            totalrow.forEach(function(rm) {
                data1 += '<td>'+rm.toFixed(3)+'</td>';
            });
            data1 += '</tr>';

            //all the data sum.

            data1 += '</tbody>';
            data1 += '</table>';

            $('#realchartTotal').html(data1);
        }
    </script>

</body>

</html>
<!-- end document-->