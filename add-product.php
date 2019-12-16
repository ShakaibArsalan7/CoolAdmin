<?php require_once('session.php') ?>
<?php
require_once("connection.php");
if(!$conn->connect_error){// if database connected.
    
if(isset($_REQUEST['submit'])){ // if submit button clicked
    
    $productname = $profilepic  = $packingopt = "";

    $productname  =  $_REQUEST['hf-brandname'];
    //$profilepic = $_REQUEST['hf-profilepic'];
    $timestamp= time();
    $sql1 = "insert into brand(brand_name,profile_pic,adding_timestamp,deleted) values('$productname','$profilepic','$timestamp',false)";
    $res = $conn->query($sql1);
    $brandid = "";
    if($res){
        
    $sql2 = "select brand_id from brand where adding_timestamp = '$timestamp' && deleted != 1";
    $res1 = $conn->query($sql2)->fetch_object()->brand_id;


    //echo "<script>alert('$res1');</script>";
    foreach ($_POST as $name => $value) {
    if (strpos($name, 'packing') !== false) {
        $que = "insert into packingDetail(brand_id,packing_size,deleted) values('$res1','$value',false)";
        $res2 = $conn->query($que);
    }
 }
   }else{
    echo "<script>alert('failure');</script>";
   }

   
   //$res = $conn->query($sql);



}else{

    $opt = "";
    $sql =  "select id, packing_size from packings where deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        // echo "<script>alert('a')</script>";
        $opt .='<option value=\"'. $row['packing_size'] .'\">'. $row['packing_size'] . ' kg</option>';

        

    }
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
    <title>Add Brand</title>

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
                                        Add <strong>Brand</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-brandname" class=" form-control-label">Brand Name</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="text" id="hf-brandname" name="hf-brandname" placeholder="Enter Brand name..." class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                        <div class="col col-md-3">
                                                                <label for="hf-profilepic" class=" form-control-label">Profile Picture</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                                <input type="file" id="hf-profilepic" name="hf-profilepic" class="form-control-file">
                                                        </div>
                                                    </div>

        

                                            <div class="row form-group">
                                                <div class="col col-md-8">
                                                    <div class="row">
                                                        <div class="col-sm-8" id="tabletitle"><h2>Packing Details</h2></div>
                                                        <div class="col-sm-4">
                                                            <button type="button" class="btn btn-success add-new" id="addrow"><i class="fa fa-plus"></i> Add New</button>
                                                         </div>
                                                    </div>

                                                    <table id="myTable" class=" table table-bordered order-list ">
                                                        <thead>
                                                            <tr class="packtab">
                                                                <td></td>
                                                                <td>Packing Detail</td>
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
                                                <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Save" />
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

function validateForm() {
    var brandname = document.getElementById("hf-brandname").value;
    //var emailaddress = document.getElementById("hf-emailaddress").value;

    if (brandname == "") {
    snackbar("Brand name is required.");
    return false;
    }

    var els = document.getElementsByClassName('pw');
    //alert(els.length);
    if(els.length == 0){
        snackbar("No Packing Option is added.");
        return false;
    }
    var packArray = [];
    var reason =1;
    for(var i = 0; i< els.length; i++){
        var el = els[i];
        if(el.value == "select"){
        snackbar("One of the option field is empty.");
        return false;
    }else{
        if(packArray.indexOf(el.value) > -1){
            //in the array
            snackbar(el.value +" option is selected twice.");
            return false;
        }else{
            packArray.push(el.value);
            // console.log();
        }
        
    }
    }

    return true;
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

    <script>
$(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr class='packtab'>");
        var cols = "";

        cols += '<td><i class="fa fa-circle"></i></td>';
        // cols += '<td><input type="text" class="form-control" name="packing' + counter + '"/></td>';
        cols += '<td>'+
        '<select class="form-control pw" name="packing' + counter + '">'
            +'<option value="select">select option</option><?php echo $opt;?>'
            
        +'</select>'
        +'</td>';
        

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



</body>

</html>
<!-- end document-->
