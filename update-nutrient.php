<?php require_once('session.php') ?>

<?php
require_once("connection.php");

$nutrientname  = "";



$err = "";

if(!$conn->connect_error){// if database connected.
    
    if(isset($_REQUEST['submit'])){ // if submit button clicked
        
        $nutrientname  =  $_REQUEST['hf-nutrientname'];
        $id = $_REQUEST['id'];
        
   
    //validation passed
        
        $sql7 = "update nutrition set nutrition_name = '$nutrientname' where Nutrition_id = $id";
        
        $res = $conn->query($sql7);
       if($res){
           // updated , go to view page.
           header("Location: ./view-nutrients.php");
           //echo "inserted succesfully";
           #$username  = $emailaddress = $workphone = $mobilenumber = $workaddress = $homeaddress = $bankaccounttitle = $bankaccountnumber = $bankname = $profilepic = "";
       }else{
           //echo "update unsuccesfull";
       }
       
           
   }else{// if not submit, first visit to page or refresh
    $id = (int)$_REQUEST['id'];
    $sql2 = "select * from nutrition where Nutrition_id = $id";
    $res1 = $conn->query($sql2)->fetch_object();

    $nutrientname  =  $res1->nutrition_name;

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
    <title>Update Nutrients</title>

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
                            <div class="col-md-10">
                                <div class="card">
                                    <div class="card-header">
                                        Update <strong>Nutrients</strong> 
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-nutrientname" class=" form-control-label">Nutrient Name</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="text" id="hf-nutrientname" name="hf-nutrientname" placeholder="Enter Nutrient name..." class="form-control" value="<?php echo $nutrientname;?>">
                                                </div>
                                            </div>
                                                   
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                                <input type="submit" class="btn btn-primary btn-lg btn-success" name="submit" value="Update" />
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
    var nname = document.getElementById("hf-nutrientname").value;
    if (nname == "") {
    snackbar("Nutrient name is required.");
    return false;
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

</body>

</html>
<!-- end document-->
