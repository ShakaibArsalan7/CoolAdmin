<?php require_once('session.php') ?>
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
    <title>Add User</title>

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
                                        Add <strong>User</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-username" class=" form-control-label">User Name</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="text" id="hf-username" name="hf-username" placeholder="Enter Username..." class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-userid" class=" form-control-label">User ID</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="text" id="hf-userid" name="hf-userid" placeholder="Enter User ID..." class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-role" class=" form-control-label">Role</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                        <select name="hf-role" id="select" class="form-control">
                                                                <option value="0">Please select</option>
                                                                <option value="1">Role #1</option>
                                                                <option value="2">Role #2</option>
                                                                <option value="3">Role #3</option>
                                                            </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-workphone" class=" form-control-label">Work Phone</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="tel" id="hf-workphone" name="hf-workphone" placeholder="Enter Work Phone..." class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-mobilephone" class=" form-control-label">Mobile Phone</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="tel" id="hf-mobilephone" name="hf-mobilephone" placeholder="Enter Mobile Phone..." class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-workaddress" class=" form-control-label">Work Address</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="text" id="hf-workaddress" name="hf-workaddress" placeholder="Enter Work Address..." class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-homeaddress" class=" form-control-label">Home Address</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="text" id="hf-homeaddress" name="hf-homeaddress" placeholder="Enter Home Address..." class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <div class="col col-md-2">
                                                        <label for="hf-bankaccount" class=" form-control-label">Bank Account</label>
                                                    </div>
                                                    <div class="col-12 col-md-5">
                                                        <input type="text" id="hf-bankaccount" name="hf-bankaccount" placeholder="Enter Bank Account..." class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <div class="col col-md-2">
                                                                <label for="hf-profilepic" class=" form-control-label">Profile Picture</label>
                                                        </div>
                                                        <div class="col-12 col-md-5">
                                                                <input type="file" id="hf-profilepic" name="hf-profilepic" class="form-control-file">
                                                        </div>
                                                    </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-createpassword" class=" form-control-label">Create Password</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="password" id="hf-createpassword" name="hf-createpassword" placeholder="Enter Password.." class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label for="hf-recreatepassword" class=" form-control-label">Re-Enter Password</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <input type="password" id="hf-recreatepassword" name="hf-recreatepassword" placeholder="Re-Enter Password.." class="form-control">
                                                </div>
                                            </div>

                                            

                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
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

</body>

</html>
<!-- end document-->
