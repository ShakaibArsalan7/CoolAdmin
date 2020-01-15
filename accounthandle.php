<?php
require_once("connection.php");

if (!$conn->connect_error) {


    // //$id = $_POST['fmodid'];
    $form = $_POST['fform'];

    if ($form === "showformulas") {

        $id = $_POST['bmodid'];
        // echo "<script>alert('$id')</script>";
        $opt1 = "";
        $sql1 = "SELECT f.formula_id, f.formula_name FROM formulas f WHERE f.brand_id = $id and f.deleted != 1";
        $res = $conn->query($sql1);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $opt1 .= '<option value=' . $row['formula_id'] . '>' . $row['formula_id'] . ' - ' . $row['formula_name'] . '</option>';
            }
        }
        echo '<div class="col col-md-2">';
        echo '<label for="hf-formulasid" class=" form-control-label">Formulas :</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<select class="form-control" id="formulasid" name="formulasid">';
        echo "<option value='select'>select option</option>$opt1";
        echo '</select>';
        echo '</div>';
    } else if ($form === "showpackings") {

        $id = $_POST['bmodid'];
        $opt2 = "";
        $sql1 = "SELECT pd.packing_size FROM packingDetail pd WHERE pd.brand_id = $id and pd.deleted != 1";
        $res = $conn->query($sql1);
        $data = array();
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $opt2 .= '<option value=' . $row['packing_size'] . '>' . $row['packing_size'] . ' kg</option>';
            }
        }

        echo '<div class="col col-md-2">';
        echo '<label for="hf-packingSizes" class=" form-control-label">Packing Sizes :</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<select class="form-control" id="packingSizes" name="packingSizes">';
        echo "<option value='select'>select option</option>$opt2";
        echo '</select>';
        echo '</div>';
    } else if ($form === "supplierdetails") {
        $sid = $_POST['supplierid'];

        $sql = "SELECT rm.raw_material_name,rms.* FROM rawMaterialStockAdditionHistory rms inner join rawMaterial rm on rm.raw_material_id = rms.rawmaterial_id WHERE rms.supplier_id = $sid and rms.deleted !=1";
        $res = $conn->query($sql);
        $totalPayment = 0;
        $totalPaymentmade = 0;
        $totalRemaining = 0;

        if ($res->num_rows > 0) {



            echo '<table id="example3" class="table table-striped table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Date</th>';
            echo '<th>Item</th>';
            echo '<th>Weight</th>';
            echo '<th>Rate</th>';
            echo '<th>Total Payment</th>';
            echo '<th>Payment made</th>';
            echo '<th>Discount</th>';
            echo '<th>Payment Due</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                $id = $row['rawmaterial_id'];
                $totalPayment +=  $row['totalpayment'];
                $totalPaymentmade += $row['paymentmade'];
                $totalRemaining += $row['remainingpayment'];

                echo  '<tr>';
                echo  '<td>' . $row['date_added'] . '</td>';
                echo  '<td>' . $row['raw_material_name'] . '</td>';
                echo  '<td>' . $row['weight_added'] . ' kg</td>';
                echo  '<td>' . $row['rate'] . '</td>';
                echo  '<td>' . $row['totalpayment'] . '</td>';
                echo  '<td>' . $row['paymentmade'] . '</td>';
                echo  '<td>' . $row['discount'] . '</td>';
                echo  '<td>' . $row['remainingpayment'] . '</td>';
                echo '<td style="text-align:center">
                        <button class="btn btn-info mid" data-toggle="modal" data-id=' . $row["id"] . '><i class="fas fa-angle-double-down"></i></button>
                        </td>';
                echo '</tr>';
            }




            echo '</tbody>';
            echo '</table>';

            // echo "<h3>Total Payment      : $totalPayment</h3>";
            // echo "<h3>Total Payment Made : $totalPaymentmade</h3>";
            // echo "<h3>Total Remaining    : $totalRemaining</h3>";

        }
    } else if ($form === "clientdetails") {
        $cid = $_POST['clientid'];

        $sql = "SELECT b.brand_name, f.formula_name,c.user_name,s.* FROM sales s inner join client c on c.client_id = s.client_id inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id WHERE s.client_id = $cid and s.deleted != 1";
        $res = $conn->query($sql);
        $totalPayment = 0;
        $totalPaymentmade = 0;
        $totalRemaining = 0;

        if ($res->num_rows > 0) {



            echo '<table id="example4" class="table table-striped table-bordered" style="width:100%">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Date</th>';
            echo '<th>Brand</th>';
            echo '<th>Formula</th>';
            echo '<th>Packing</th>';
            echo '<th>Bags</th>';
            echo '<th>Total Payment</th>';
            echo '<th>Payment made</th>';
            echo '<th>Disc.</th>';
            echo '<th>Due.</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                $id = $row['rawmaterial_id'];
                $totalPayment +=  $row['totalpayment'];
                $totalPaymentmade += $row['paymentmade'];
                $totalRemaining += $row['remainingpayment'];

                echo  '<tr>';
                echo  '<td>' . $row['date_added'] . '</td>';
                echo  '<td>' . $row['brand_name'] . '</td>';
                echo  '<td>' . $row['formula_name'] . '</td>';
                echo  '<td>' . $row['packing_size'] . ' kg</td>';
                echo  '<td>' . $row['noofbags'] . '</td>';
                echo  '<td>' . $row['totalpayment'] . '</td>';
                echo  '<td>' . $row['paymentmade'] . '</td>';
                echo  '<td>' . $row['discount'] . '</td>';
                echo  '<td>' . $row['remainingpayment'] . '</td>';
                echo '<td style="text-align:center">
                        <button class="btn btn-info clid" data-toggle="modal" data-id=' . $row["id"] . '><i class="fas fa-angle-double-down"></i></button>
                        </td>';
                echo '</tr>';
            }




            echo '</tbody>';
            echo '</table>';

            // echo "<h3>Total Payment      : $totalPayment</h3>";
            // echo "<h3>Total Payment Made : $totalPaymentmade</h3>";
            // echo "<h3>Total Remaining    : $totalRemaining</h3>";

        }
    } else if ($form === "salesmandetails") {
        $sid = $_POST['salesmanid'];

        $sql = "SELECT b.brand_name, f.formula_name,sa.user_name,s.* FROM sales s inner join salesman sa on sa.salesman_id = s.salesman_id inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id WHERE s.salesman_id = $sid and s.deleted != 1";
        $res = $conn->query($sql);
        $totalPayment = 0;
        $totalPaymentmade = 0;
        $totalRemaining = 0;

        if ($res->num_rows > 0) {



            echo '<table id="example5" class="table table-striped table-bordered" style="width:100%">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Date</th>';
            echo '<th>Brand</th>';
            echo '<th>Formula</th>';
            echo '<th>Packing</th>';
            echo '<th>Bags</th>';
            echo '<th>Total Payment</th>';
            echo '<th>Payment made</th>';
            echo '<th>Disc.</th>';
            echo '<th>Due.</th>';
            // echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                $id = $row['rawmaterial_id'];
                $totalPayment +=  $row['totalpayment'];
                $totalPaymentmade += $row['paymentmade'];
                $totalRemaining += $row['remainingpayment'];

                echo  '<tr>';
                echo  '<td>' . $row['date_added'] . '</td>';
                echo  '<td>' . $row['brand_name'] . '</td>';
                echo  '<td>' . $row['formula_name'] . '</td>';
                echo  '<td>' . $row['packing_size'] . ' kg</td>';
                echo  '<td>' . $row['noofbags'] . '</td>';
                echo  '<td>' . $row['totalpayment'] . '</td>';
                echo  '<td>' . $row['paymentmade'] . '</td>';
                echo  '<td>' . $row['discount'] . '</td>';
                echo  '<td>' . $row['remainingpayment'] . '</td>';
                // echo '<td style="text-align:center">
                //         <button class="btn btn-info clid" data-toggle="modal" data-id=' . $row["id"] . '><i class="fas fa-angle-double-down"></i></button>
                //         </td>';
                echo '</tr>';
            }




            echo '</tbody>';
            echo '</table>';

            // echo "<h3>Total Payment      : $totalPayment</h3>";
            // echo "<h3>Total Payment Made : $totalPaymentmade</h3>";
            // echo "<h3>Total Remaining    : $totalRemaining</h3>";

        }
    } else if ($form === "saleajax") {
        $brandid = $_POST['brandid'];
        $formulaid = $_POST['formulaid'];
        $packingsize = $_POST['packingsize'];
        $noofbags = $_POST['noofbags'];
        $clientid = $_POST['clientname'];
        $salesmanid = $_POST['salesmanname'];
        $modeofpayment = $_POST['modeofpayment'];
        $totalpayment = $_POST['totalpayment'];
        $paymentmade = $_POST['paymentmade'];
        $discount = $_POST['discount'];
        $remainingpayment = $_POST['remainingpayment'];
        $extrapayment = $_POST['extrapayment'];
        $date = $_POST['date'];

        $sql = "SELECT ps.id,ps.noofbags FROM productStockPackingWise ps WHERE ps.brand_id = $brandid and ps.formula_id = $formulaid and ps.packing_size =$packingsize and ps.deleted != 1";
        $obj = $conn->query($sql)->fetch_object();
        $bags = $obj->noofbags;
        $id = $obj->id;
        if ($noofbags > $bags) {
            echo "<script>snackbar('Bags available in Stock are less.','red')</script>";
        } else {
            //insert into sales
            //update no of bags
            $conn->autocommit(FALSE);
            $sql = "INSERT INTO sales(brand_id, formula_id, packing_size, noofbags,client_id, salesman_id, modeofpayment, totalpayment, paymentmade, discount, remainingpayment, extrapayment, date_added, deleted) VALUES (
                $brandid, $formulaid,$packingsize,$noofbags,$clientid,$salesmanid,'$modeofpayment',$totalpayment,$paymentmade,$discount,$remainingpayment,$extrapayment,'$date',false)";
            $res = $conn->query($sql); //one 
            if ($res) {
                //if inserted succesfully then update
                $sql = "UPDATE productStockPackingWise ps SET ps.noofbags = ps.noofbags - $noofbags  WHERE ps.id = $id and ps.deleted != 1";
                $res1 = $conn->query($sql); //two
                if ($res1) {
                    //updated successfully
                    $conn->commit();
                    echo "<script>snackbar('Sold Successfully.','green')</script>";
                } else {
                    echo "<script>snackbar('Database Error2.','red')</script>";
                    $conn->close();
                }
            } else {
                $conn->close();
                echo "<script>snackbar('Database Error1.','red')</script>";
            }
        }
    } else if ($form === "clearSupplierDue") {

        $id = $_POST['id'];

        $sql = "SELECT * FROM rawMaterialStockAdditionHistory rmsh WHERE rmsh.id = $id and rmsh.deleted != 1";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {

            $rem = 0;

            while ($row = $res->fetch_assoc()) {
                $rem = $row['remainingpayment'];
                echo "<h3>Total Payment&nbsp;&nbsp;&nbsp;&nbsp; $row[totalpayment]</h3>";
                echo "<h3>Payment Made&nbsp;&nbsp;&nbsp;$row[paymentmade]</h3>";
                if ((int) $row['discount'] < 0) {
                    echo "<h3>Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[discount]</h3>";
                } else {
                    echo "<h3>Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[discount]</h3>";
                }

                echo "<h3 style='color:green; margin-bottom:15px'>________________</h3>";

                echo "<h3 style='color:red; margin-bottom:25px' >Rem. Payment&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[remainingpayment]</h3>";
            }

            if ($rem <= 0) {
            } else {
                echo '<div class="row form-group">';
                echo '<div class="col col-md-3">';
                echo '<label for="hf-remaining" class=" form-control-label">Additional Payment:</label>';
                echo '</div>';
                echo '<div class="col col-md-4">';
                echo '<input type="number" id="hf-additionals" name="hf-additionals" class="form-control" oninput="additionalPaymentsuchange()">';
                echo '</div>';
                echo '<div class="col col-md-3">';
                echo "<input type=number id='rems' value='$rem' hidden />";
                echo '<button class="btn btn-info" id="additionalpayment"><i class="fas fa-angle-double-down"></i> Clear Due</button>';
                echo '</div>';
                echo '</div>';
            }


            // echo '<div class="row form-group">';
            // echo '<div class="col-12 col-md-4">';
            // echo '</div>';
            // echo '</div>';


        }
    } else if ($form === "clearClientDue") {

        $id = $_POST['id'];

        $sql = "SELECT * FROM sales s WHERE s.id = $id and s.deleted != 1";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {

            $rem = 0;

            while ($row = $res->fetch_assoc()) {
                $rem = $row['remainingpayment'];
                echo "<h3>Total Payment&nbsp;&nbsp;&nbsp;&nbsp; $row[totalpayment]</h3>";
                echo "<h3>Payment Made&nbsp;&nbsp;&nbsp;&nbsp;$row[paymentmade]</h3>";
                if ((int) $row['discount'] < 0) {
                    echo "<h3>Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[discount]</h3>";
                } else {
                    echo "<h3>Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[discount]</h3>";
                }

                echo "<h3 style='color:green; margin-bottom:15px'>________________</h3>";

                echo "<h3 style='color:red; margin-bottom:25px' >Rem. Payment&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[remainingpayment]</h3>";
            }

            if ($rem <= 0) {
            } else {
                echo '<div class="row form-group">';
                echo '<div class="col col-md-3">';
                echo '<label for="hf-remaining" class=" form-control-label">Additional Payment:</label>';
                echo '</div>';
                echo '<div class="col col-md-4">';
                echo '<input type="number" id="hf-additionalc" name="hf-additionalc" class="form-control" oninput="additionalPaymentclchange()">';
                echo '</div>';
                echo '<div class="col col-md-3">';
                echo "<input type=number id='remc' value='$rem' hidden />";
                echo '<button class="btn btn-info" id="additionalpaymentcl"><i class="fas fa-angle-double-down"></i> Clear Due</button>';
                echo '</div>';
                echo '</div>';
            }


            // echo '<div class="row form-group">';
            // echo '<div class="col-12 col-md-4">';
            // echo '</div>';
            // echo '</div>';


        }
    } else if ($form === "supplierRemainingamount") {
        $id = $_POST['id'];
        $rems = $_POST['rems'];
        $sql = "update rawMaterialStockAdditionHistory rms set rms.paymentmade = rms.paymentmade + $rems, rms.remainingpayment = rms.remainingpayment - $rems where rms.id = $id and rms.deleted != 1";
        $res = $conn->query($sql);
        if ($res) {
            echo "<script>snackbar('Updated Successfully.','green')</script>";
        } else {
            echo "<script>snackbar('Updated Unsuccessfull.','red')</script>";
        }
    } else if ($form === "clientRemainingamount") {
        $id = $_POST['id'];
        $remc = $_POST['remc'];
        $sql = "update sales s set s.paymentmade = s.paymentmade + $remc, s.remainingpayment = s.remainingpayment - $remc where s.id = $id and s.deleted != 1";
        $res = $conn->query($sql);
        if ($res) {
            echo "<script>snackbar('Updated Successfully.','green')</script>";
        } else {
            echo "<script>snackbar('Updated Unsuccessfull.','red')</script>";
        }
    }
}