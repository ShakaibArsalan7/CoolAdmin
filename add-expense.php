<?php require_once('session.php') ?>

<?php
require_once("connection.php");

if(!$conn->connect_error){


    if(isset($_REQUEST['submit'])){ // if submit button clicked
        
        $expensetype  =  $_REQUEST['expensetype'];
        $date =  $_REQUEST['hf-date'];
        $amount =  $_REQUEST['hf-amount'];
        $comment =  $_REQUEST['hf-comment'];


   
    //validation passed
        $sql = "insert into expenses(type_id,date,amount,comment,deleted) values($expensetype,'$date',$amount,'$comment',false);";
        $res = $conn->query($sql);
       if($res){
           //echo "inserted succesfully";
           
       }
           
   }else{

    $opt = "";
    $sql =  "select id, expense_type from expenseType where deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        // echo "<script>alert('a')</script>";
        $opt .='<option value='. $row['id'] .'>'. $row['expense_type'] .'</option>';

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
    <title>Add Expense</title>

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
                                        Add <strong>Expense</strong>
                                        <!-- drop down -- date -- amount --submit button -->
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-expensetype" class=" form-control-label">Expense Type</label>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                <select class="form-control" id="expensetype" name="expensetype">
                                                    <option value="select">select option</option><?php echo $opt;?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-date" class=" form-control-label">Date</label>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <input type="date" id="hf-date" name="hf-date" placeholder="Enter Date..." class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-amount" class=" form-control-label">Amount</label>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <input type="text" id="hf-amount" name="hf-amount" placeholder="Enter expense amount..." class="form-control" value="0">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-comment" class=" form-control-label">Comment</label>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <textarea type="text" id="hf-comment" name="hf-comment" placeholder="any comments..." class="form-control" ></textarea>
                                                </div>
                                            </div>
                                                   
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Register" />
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
    <!-- <script>
$(document).ready(function () {

    $('body').on('click','#aen',function(){ // Click to only happen on announce links
        $("#exptypeform").text("");
        $('#exptypeform').load("expensesajax.php", {
            fform : "aen"
         });

   });

    });
    </script> -->
    <script>
function validateForm() {
    
    var expensetype = document.getElementById('expensetype').value;
    var date = document.getElementById('hf-date').value;
    var amount = document.getElementById('hf-amount').value;
    var comment = document.getElementById('hf-comment').value;
    // alert(expensetype);
    // alert(date);
    // alert(amount);
    // alert(comment);
    if(expensetype == "select"){
        snackbar("Expense type is required");
        return false;
    }
    if(date == ""){
        snackbar("Expense date is required");
        return false;
    }
    if(amount == '0' || amount == ''){
        snackbar("Expense amount is required");
        return false;
    }
    
    if(comment == ""){
        snackbar("describe nature of expense in comment section");
        return false;
    }
    var fl = validateQuantity(amount);
    if(!fl){
            snackbar("Amount field is not valid. only numeral allowed.");
            return false;
        }

        if(parseFloat(amount) < 0 ){
        snackbar("Expense amount can't be negetive.");
        return false;
    }

    return true;
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