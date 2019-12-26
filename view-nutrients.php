<?php require_once('session.php') ?>

<?php
require_once("connection.php");

if(!$conn->connect_error){

    if(isset($_REQUEST['delete'])){
        $id = (int)$_POST['id'];
         
        $sql = "update nutrition set deleted = 1 where Nutrition_id = $id";
        
        $res = $conn->query($sql);
        if($res){
            #echo "<script>alert('Deleted Successfully')</script>";
        }else{
            #echo "<script>alert('Deleted Failed')</script>";
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
    <title>View Nutrients</title>

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


<?php 


if(!$conn->connect_error){

$sql = 'select * from nutrition where deleted != 1';
$res = $conn->query($sql);
if($res->num_rows > 0 ){
    echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nutrient ID</th>';
        echo '<th>Nutrient Name</th>';
        echo '<th>Usage unit</th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while($row = $res->fetch_assoc()){
            $id = $row['Nutrition_id'];
            echo  '<tr>';
            echo  '<td>' . $row['Nutrition_id'] . '</td>';
            echo  '<td>' . $row['nutrition_name'] . '</td>';
            echo  '<td>' . $row['unit_of_usage'] . '</td>';
            echo '<td class="table-data-feature">
            
            <form action="update-nutrient.php" method="POST">
            <input type="hidden" name="id" id="sid" value=' .$row["Nutrition_id"]. 
                '><button type="submit" name="edit" style="margin:3px" value="edit" class="btn btn-success"><i class="fas fa-edit"></i></button>
                </form>

                <form action="" method="POST">
            <input type="hidden" name="id" value=' .$row["Nutrition_id"]. 
                '> <button type="submit" name="delete" style="margin:3px" value="delete" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </form>
                <button class="btn btn-info mid" style="margin:3px" data-toggle="modal" data-id=' . $row["Nutrition_id"] .'><i class="fas fa-eye"></i></button>
                
                
                
                </td>';
            echo '</tr>';
        }

       
        
        
        echo '</tbody>';
    echo '</table>';


}   
}
?>




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

    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="largeModalLabel">Nutrient Detail</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                        <input  type="hidden" id="idval" value=""/>

							<p id="parawithdata">
								

                                
							</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end modal large -->

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
    $('#example').DataTable();

    $('body').on('click','.mid',function(){ // Click to only happen on announce links
    //var a = document.getElement
    $("#idval").val($(this).data('id'));
    // debugger;
    var modid = parseInt($("#idval").val());

    $('#parawithdata').load("viewModaldata.php", {
        fmodid : modid,
        fform : "nutrient"
    });


     $('#largeModal').modal('show');

   });

   


} );
    </script>

</body>

</html>
<!-- end document-->
