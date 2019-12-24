<?php require_once('session.php') ?>

<?php
require_once("connection.php");
$username  = $emailaddress = $workphone = $mobilenumber = $workaddress = $homeaddress = $bankaccounttitle = $bankaccountnumber = $bankname = $profilepic = "";
$err = "";

if(!$conn->connect_error){// if database connected.
    
    if(isset($_REQUEST['submit'])){ // if submit button clicked
        
        $username  =  $_REQUEST['hf-username'];
        $emailaddress =  $_REQUEST['hf-emailaddress'];
        $workphone =  $_REQUEST['hf-workphone'];
        $mobilenumber =  $_REQUEST['hf-mobilenumber'];
        $workaddress =  $_REQUEST['hf-workaddress'];
        $homeaddress =  $_REQUEST['hf-homeaddress'];
        $bankaccounttitle =  $_REQUEST['hf-bankaccounttitle'];
        $bankaccountnumber =  $_REQUEST['hf-bankaccountnumber'];
        $bankname =  $_REQUEST['hf-bankname'];
        //$profilepic = $_REQUEST['hf-profilepic'];

        //echo $_REQUEST['hf-username'] . $_REQUEST['hf-emailaddress'];


   
    //validation passed

        $sql = "insert into client(user_name,email_address,work_phone,mobile_number,work_address,home_address,bank_account_title,bank_account_number,bank_name,profile_pic,deleted) values('$username','$emailaddress','$workphone','$mobilenumber','$workaddress','$homeaddress','$bankaccounttitle','$bankaccountnumber','$bankname','$profilepic',false)";
        $res = $conn->query($sql);
       if($res){
           //echo "inserted succesfully";
           $username  = $emailaddress = $workphone = $mobilenumber = $workaddress = $homeaddress = $bankaccounttitle = $bankaccountnumber = $bankname = $profilepic = "";
       }
           
   }else{// if not submit, first visit to page or refresh
    $username  = $emailaddress = $workphone = $mobilenumber = $workaddress = $homeaddress = $bankaccounttitle = $bankaccountnumber = $bankname = $profilepic = "";
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
    <title>Add Client</title>

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
                                        Add <strong>Client</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-username" class=" form-control-label">Client Name</label>
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <input type="text" id="hf-username" name="hf-username" placeholder="Enter Username..." class="form-control" value="<?php echo $username;?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-emailaddress" class=" form-control-label">Email Address</label>
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <input type="email" id="hf-emailaddress" name="hf-emailaddress" placeholder="Enter Email Address..." class="form-control" value="<?php echo $emailaddress;?>">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-workphone" class=" form-control-label">Work Phone</label>
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <input type="tel" id="hf-workphone" name="hf-workphone" placeholder="Enter Work Phone..." class="form-control" value="<?php echo $workphone;?>">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-mobilenumber" class=" form-control-label">Mobile Number</label>
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <input type="tel" id="hf-mobilenumber" name="hf-mobilenumber" placeholder="Enter Mobile Number..." class="form-control" value="<?php echo $mobilenumber;?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-workaddress" class=" form-control-label">Work Address</label>
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <input type="text" id="hf-workaddress" name="hf-workaddress" placeholder="Enter Work Address..." class="form-control" value="<?php echo $workaddress;?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-homeaddress" class=" form-control-label">Home Address</label>
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <input type="text" id="hf-homeaddress" name="hf-homeaddress" placeholder="Enter Home Address..." class="form-control" value="<?php echo $homeaddress;?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="hf-bankaccounttitle" class=" form-control-label">Bank Account Title</label>
                                                    </div>
                                                    <div class="col-12 col-md-7">
                                                        <input type="text" id="hf-bankaccounttitle" name="hf-bankaccounttitle" placeholder="Enter Bank Account Title..." class="form-control" value="<?php echo $bankaccounttitle;?>">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="hf-bankaccountnumber" class=" form-control-label">Bank Account Number</label>
                                                    </div>
                                                    <div class="col-12 col-md-7">
                                                        <input type="text" id="hf-bankaccountnumber" name="hf-bankaccountnumber" placeholder="Enter Bank Account Number..." class="form-control" value="<?php echo $bankaccountnumber;?>">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="hf-bankname" class=" form-control-label">Bank Name</label>
                                                    </div>
                                                    <div class="col-12 col-md-7">
                                                        <input type="text" id="hf-bankname" name="hf-bankname" placeholder="Enter Bank Name..." class="form-control" value="<?php echo $bankname;?>">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <div class="col col-md-3">
                                                                <label for="hf-profilepic" class=" form-control-label">Profile Picture</label>
                                                        </div>
                                                        <div class="col-12 col-md-7">
                                                                <input type="file" id="hf-profilepic" name="hf-profilepic" class="form-control-file">
                                                        </div>
                                                    </div>
                                                   
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Register" />
                                                </div>
                                                
                                            </div>

                                            
                                                
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer">
                                        
                                            <i class="fa fa-dot-circle-o"></i> Register
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Cancel
                                        </button>
                                    </div> -->
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
    var username = document.getElementById("hf-username").value;
    var emailaddress = document.getElementById("hf-emailaddress").value;
    var workphone = document.getElementById("hf-workphone").value;
    var mobilenumber = document.getElementById("hf-mobilenumber").value;
    var workaddress = document.getElementById("hf-workaddress").value;
    var homeaddress = document.getElementById("hf-homeaddress").value;
    var bankaccounttitle = document.getElementById("hf-bankaccounttitle").value;
    var bankaccountnumber = document.getElementById("hf-bankaccountnumber").value;
    var bankname = document.getElementById("hf-bankname").value;
    var profilepic = document.getElementById("hf-profilepic").value;
    if (username == "") {
    snackbar("Username is required.","red");
    return false;
    }
    if (emailaddress == "") {
    snackbar("Email Address is required.","red");
    return false;
    }
    if (workphone == "") {
    snackbar("Work Phone is required.","red");
    return false;
    }
    if (mobilenumber == "") {
    snackbar("Mobile Number is required.","red");
    return false;
    }
    if (workaddress == "") {
    snackbar("Work Address is required.","red");
    return false;
    }
    if (homeaddress == "") {
    snackbar("Home Address is required.","red");
    return false;
    }

    return true;
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
