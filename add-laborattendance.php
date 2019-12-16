<?php require_once('session.php') ?>

<?php
require_once("connection.php");

$rawmaterialname  = "";
$err = "";


 

if(!$conn->connect_error){// if database connected.
    
    if(isset($_REQUEST['submit'])){ // if submit button clicked
        
        $rawmaterialname  =  $_REQUEST['hf-rawmaterialname'];


   
    //validation passed
        $timestamp= time();
        $sql = "insert into rawMaterial(raw_material_name,unit_of_purchase,unit_of_usage,adding_timestamp,deleted) values('$rawmaterialname','kg','kg','$timestamp',false);";
        $res = $conn->query($sql);
       if($res){
           //echo "inserted succesfully";
           $rawmaterialname  = "";
           $sql2 = "select raw_material_id from rawMaterial where adding_timestamp = '$timestamp' && deleted != 1";
           $res1 = $conn->query($sql2)->fetch_object()->raw_material_id;
       
       
           //echo "<script>alert('$res1');</script>";
           foreach ($_POST as $name => $value) {
           if (strpos($name, 'nutrient') !== false) {
                $qname =  "quantity" .  substr($name,8);
                $qquan = $_POST[$qname];
               $que = "insert into RawmaterialNutrients(raw_material_id,Nutrition_id,percentageperkg,deleted) values('$res1','$value',$qquan,false)";
               $res2 = $conn->query($que);
           }
        //echo "<script>alert('$name - $value')</script>";

        }
       }
           
   }else{// if not submit, first visit to page or refresh

    $brandname  = "";
    $opt = "";
    $sql =  "select brand_id, brand_name from brand where deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        // echo "<script>alert('a')</script>";
        $opt .='<option value='. $row['brand_id'] .'>'. $row['brand_id'] . ' - ' . $row['brand_name'] .'</option>';

        }
    // echo "<script>alert('$opt')</script>";
    }
    
    $rawmaterialname  = "";
    $opt1 = "";
    $sql =  "select raw_material_id, raw_material_name from rawMaterial where deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        // echo "<script>alert('a')</script>";
        $opt1 .='<option value='. $row['raw_material_id'] .'>'. $row['raw_material_id'] . ' - ' . $row['raw_material_name'] .'</option>';

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
    <title>Add Labor Attendance</title>

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
                                <div class="card">
                                    <div class="card-header">
                                        Add <strong>Labor Attendance</strong>
                                    </div>


                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">
                                            <div class="row form-group">
                                                <div class="col col-md-8">
                                                    <div class="row">
                                                        <div class="col-sm-8" id="tabletitle"><h2>Attendance Details</h2></div>
                                                    </div>

                                                    <table id="myTable" class=" table table-bordered order-list ">
                                                        <thead>
                                                            <tr class="rmtab">
                                                                <td>Employee name</td>
                                                                <td>Attendance Status</td>
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
$(document).ready(function () {

     
    var counter = 0;

    $("#addrow").on("click", function () {
        // alert("a");
        var newRow = $("<tr class='packtab'>");
        var cols = "";

        cols += '<td><i class="fa fa-circle"></i></td>';
        // cols += '<td><input type="text" class="form-control" name="packing' + counter + '"/></td>';
        cols += '<td>'+
        '<select class="form-control pw" name="rawmaterial' + counter + '">'
        +'<option value="select">select option</option><?php echo $opt1;?>'

           
        


        +'</select>'
        +'</td>';
        cols+='<td><input type="text" class="form-control qw" id="rawmaterialweight' + counter +'" name="rmweight' + counter + '" placeholder="Enter Weight..." ></td>';

        // cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        cols +='<td><i class="ibtnDel fas fa-trash-alt" style="font-size:1.5 rem;color:red;display:inline-block;width:100%;text-align:center"></i></td>';
        
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counter -= 1;
    });


});
</script>

<script>
function validateForm() {
    var bname = document.getElementById("brandedit").value;
    if(bname == "select"){
        snackbar("Please Select Brand name from drop down.");
        return false;
    }

    var fname = document.getElementById("formulaname").value;
    if(fname == ""){
        snackbar("Formula name is required.");
        return false;
    }
    

    var els = document.getElementsByClassName('pw');
    //alert(els.length);
    if(els.length == 0){
        snackbar("No Raw Material Detail is added.");
        return false;
    }
    var packArray = [];
    // var reason =1;
    for(var i = 0; i< els.length; i++){
        var el = els[i];
        if(el.value == "select"){
        snackbar("One of the raw material name is not selected.");
        return false;
    }else{
        if(packArray.indexOf(el.value) > -1){
            //in the array
            snackbar(el.options[el.selectedIndex].text +" option is selected twice.");
            return false;
        }else{
            packArray.push(el.value);
            // console.log();
        }
        
    }
    }

    var elq = document.getElementsByClassName('qw');
    // var reason =1;
    var formulaSum = 0.0;
    for(var i = 0; i< elq.length; i++){
        var el = elq[i];
        
    
        if(el.value == ""){
        snackbar("One of the weight field is empty.");
        return false;
    }
    else{
        var v=  validateQuantity(el.value);
        if(!v){
            snackbar("only numeral allowed in weight field.");
            return false;
        }
    }

    formulaSum += parseFloat(el.value);



    }

    if(formulaSum != 100.0000){
        if(formulaSum < 100){
            snackbar("Formula is made for 100 kg , the cummulative sum of raw materials weight is less than 100");

        }else{
            snackbar("Formula is made for 100 kg , the cummulative sum of raw materials weight is greater than 100");

        }
    }


    return false;
}

function validateQuantity(s) {
    var rgx = /^[0-9]*\.?[0-9]*$/;
    return s.match(rgx);
}

function snackbar(message) {
  // Get the snackbar DIV
  var x = document.getElementById("snackbar");
  x.innerHTML =message;

  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>

</body>

</html>
<!-- end document-->
