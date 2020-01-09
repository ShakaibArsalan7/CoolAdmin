<?php
require_once("connection.php");






if (!$conn->connect_error) {


    // //$id = $_POST['fmodid'];
    $form = $_POST['fform'];

    if ($form === "sale") {



        $brandname  = "";
        $opt = "";
        $sql =  "select brand_id, brand_name from brand where deleted != 1";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $opt .= '<option value=' . $row['brand_id'] . '>' . $row['brand_id'] . ' - ' . $row['brand_name'] . '</option>';
            }
        }
        $today = date("Y-m-d");
        //brand id , formula id , packing sizes, no of bags , submit button

        $opt1 = "";
        $sql1 = "SELECT c.client_id, c.user_name FROM client c WHERE c.deleted != 1";
        $res = $conn->query($sql1);
        $data1 = array();
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $opt1 .= '<option value=' . $row['client_id'] . '>' . $row['client_id'] . ' - ' . $row['user_name'] . '</option>';
            }
        }

        // echo '<form action="" method="post" class="form-horizontal" >';
        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-brandid" class=" form-control-label">Brand :</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<select class="form-control" id="brandid" name="brandid">';
        echo "<option value='select'>select option</option>$opt";
        echo '</select>';
        echo '</div>';
        echo '</div>';

        echo '<div class="row form-group" id="formulashere">';

        echo '</div>';

        echo '<div class="row form-group" id="packingshere">';

        echo '</div>';


        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-noofbags" class=" form-control-label">No of Bags</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<input type="text" id="hf-noofbags" name="hf-noofbags" placeholder="Enter No. of Bags..." class="form-control" value="0">';
        echo '</div>';
        echo '</div>';

        // here comes the info  
        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-client" class=" form-control-label">Client</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<select class="form-control" id="clientname" name="clientname">';
        echo "<option value='select'>select option</option>$opt1";
        echo '</select>';
        echo '</div>';
        echo '</div>';

        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-modeofpayment" class=" form-control-label">Mode of Payment</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<select class="form-control" id="modeofpayment" name="modeofpayment">';
        echo "<option value='cash'>Cash</option>";
        echo "<option value='cheque'>Cheque</option>";
        echo "<option value='card'>Card</option>";
        echo '</select>';
        echo '</div>';
        echo '</div>';


        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-totalpayment" class=" form-control-label">Total Payment</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<input type="number" id="hf-totalpayment" name="hf-totalpayment" class="form-control" oninput="totalpaymentchange()">';
        echo '</div>';
        echo '</div>';

        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-paymentmade" class=" form-control-label">Payment Made</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<input type="number" id="hf-paymentmade" name="hf-paymentmade" placeholder="Enter Payment Made..." class="form-control" oninput="paymentmadechange()" value="0">';
        echo '</div>';
        echo '</div>';

        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-discount" class=" form-control-label">Discount(in Rs)</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<input type="number" id="hf-discount" name="hf-discount" placeholder="Enter Discount..." class="form-control" oninput="discountchange()" value="0">';
        echo '</div>';
        echo '</div>';

        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-remaining" class=" form-control-label">Remaining(to be made)</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<input type="number" id="hf-remaining" name="hf-remaining" class="form-control" readonly>';
        echo '</div>';
        echo '</div>';

        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-extrapayment" class=" form-control-label">Extra Payment</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<input type="number" id="hf-extrapayment" name="hf-extrapayment" class="form-control" readonly>';
        echo '</div>';
        echo '</div>';

        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-date" class=" form-control-label">Date</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo "<input type='date' id='hf-date' name='hf-date' placeholder='Enter Date...' class='form-control' value=$today>";
        echo '</div>';
        echo '</div>';

        echo '<div class="row form-group">';
        echo '<div class="col col-md-3">';
        echo '<button class="btn btn-primary btn-lg" id="saledone" onclick="return validateForm()">Sale</button>';
        echo '</div>';
        echo '</div>';
    } else if ($form === "showformulas") {

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
    } else if ($form === "supplieraccount") {
        // echo "<input type='hidden' name='id1' id='brandid1' value=$id >";
        $opt1 = "";
        $sql1 = "SELECT s.supplier_id, s.user_name FROM supplier s WHERE s.deleted != 1";
        $res = $conn->query($sql1);
        $data1 = array();
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $opt1 .= '<option value=' . $row['supplier_id'] . '>' . $row['supplier_id'] . ' - ' . $row['user_name'] . '</option>';
            }
        }


        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-supplier" class=" form-control-label">Supplier</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<select class="form-control" id="suppliername" name="suppliername">';
        echo "<option value='select'>select option</option>$opt1";
        echo '</select>';
        echo '</div>';
        echo '</div>';

        echo '<div id="supplierdetails">';
        echo '</div>';
    } else if ($form === "clientaccount") {
        // echo "<input type='hidden' name='id1' id='brandid1' value=$id >";
        $opt1 = "";
        $sql1 = "SELECT c.client_id, c.user_name FROM client c WHERE c.deleted != 1";
        $res = $conn->query($sql1);
        $data1 = array();
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $opt1 .= '<option value=' . $row['client_id'] . '>' . $row['client_id'] . ' - ' . $row['user_name'] . '</option>';
            }
        }


        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-client" class=" form-control-label">Client</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<select class="form-control" id="clientid" name="clientid">';
        echo "<option value='select'>select option</option>$opt1";
        echo '</select>';
        echo '</div>';
        echo '</div>';

        echo '<div id="clientdetails">';
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
            echo '<th>Remaining</th>';
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
    }else if ($form === "clientdetails") {
        $cid = $_POST['clientid'];

        $sql = "SELECT b.brand_name, f.formula_name,c.user_name,s.* FROM sales s inner join client c on c.client_id = s.client_id inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id WHERE s.client_id = $cid and s.deleted != 1";
        $res = $conn->query($sql);
        $totalPayment = 0;
        $totalPaymentmade = 0;
        $totalRemaining = 0;

        if ($res->num_rows > 0) {



            echo '<table id="example4" class="table table-striped table-bordered">';
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
            echo '<th>Rem.</th>';
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
    } else if ($form === "rrms") {

        $opt = "";
        $sql1 = "SELECT rm.raw_material_id, rm.raw_material_name FROM rawMaterial rm WHERE rm.deleted != 1";
        $res = $conn->query($sql1);
        $data = array();
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $opt .= '<option value=' . $row['raw_material_id'] . '>' . $row['raw_material_id'] . ' - ' . $row['raw_material_name'] . '</option>';
            }
        }
        $today = date("Y-m-d");
        echo '<form action="" method="post" class="form-horizontal" onsubmit="return validateremForm()">';
        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-rawmaterial" class=" form-control-label">Raw Material</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<select class="form-control" id="rawmaterial" name="rawmaterial">';
        echo "<option value='select'>select option</option>$opt";
        echo '</select>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-weight" class=" form-control-label">Weight (in kg)</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<input type="text" id="hf-weight" name="hf-weight" placeholder="Enter weight..." class="form-control" value="0">';
        echo '</div>';
        echo '</div>';
        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-comment" class=" form-control-label">Comment</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo '<textarea type="text" id="hf-comment" name="hf-comment" placeholder="any comments..." class="form-control" ></textarea>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row form-group">';
        echo '<div class="col col-md-2">';
        echo '<label for="hf-date" class=" form-control-label">Date</label>';
        echo '</div>';
        echo '<div class="col-12 col-md-4">';
        echo "<input type='date' id='hf-date' name='hf-date' placeholder='Enter Date...' class='form-control' value=$today>";
        echo '</div>';
        echo '</div>';
        echo '<div class="row form-group">';
        echo '<div class="col col-md-3">';
        echo '<input type="submit" class="btn btn-danger btn-lg" name="submita" value="Remove" />';
        echo '</div>';
        echo '</div>';
        echo '</form>';
    }else if ($form === "saleajax") {
        $brandid = $_POST['brandid'];
        $formulaid = $_POST['formulaid'];
        $packingsize = $_POST['packingsize'];
        $noofbags = $_POST['noofbags'];
        $clientid = $_POST['clientname'];
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
        if($noofbags > $bags){
            echo "<script>snackbar('Bags available in Stock are less.','red')</script>";
        }else{
            //insert into sales
            //update no of bags
            $sql = "INSERT INTO sales(brand_id, formula_id, packing_size, noofbags, client_id, modeofpayment, totalpayment, paymentmade, discount, remainingpayment, extrapayment, date_added, deleted) VALUES (
                $brandid, $formulaid,$packingsize,$noofbags,$clientid,'$modeofpayment',$totalpayment,$paymentmade,$discount,$remainingpayment,$extrapayment,'$date',false)";
            $res = $conn->query($sql);
            if($res){
                //if inserted succesfully then update
                $sql = "UPDATE productStockPackingWise ps SET ps.noofbags = ps.noofbags - $noofbags  WHERE ps.id = $id and ps.deleted != 1";
                $res1 = $conn->query($sql);
                if($res1){
                    //updated successfully
                    echo "<script>snackbar('Sold Successfully.','green')</script>";
                }

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
    }else if ($form === "clearClientDue") {

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
    }else if($form === "supplierRemainingamount"){
        $id = $_POST['id'];
        $rems = $_POST['rems'];
        $sql = "update rawMaterialStockAdditionHistory rms set rms.paymentmade = rms.paymentmade + $rems, rms.remainingpayment = rms.remainingpayment - $rems where rms.id = $id and rms.deleted != 1";
        $res = $conn->query($sql);
        if($res){
            echo "<script>snackbar('Updated Successfully.','green')</script>";
        }else{
            echo "<script>snackbar('Updated Unsuccessfull.','red')</script>";

        }
    }else if($form === "clientRemainingamount"){
        $id = $_POST['id'];
        $remc = $_POST['remc'];
        $sql = "update sales s set s.paymentmade = s.paymentmade + $remc, s.remainingpayment = s.remainingpayment - $remc where s.id = $id and s.deleted != 1";
        $res = $conn->query($sql);
        if($res){
            echo "<script>snackbar('Updated Successfully.','green')</script>";
        }else{
            echo "<script>snackbar('Updated Unsuccessfull.','red')</script>";

        }
    } else if ($form === "removedrawmaterialstockdetail") {

        $id = $_POST['fmodid'];

        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockLossHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id WHERE rmsh.rawmaterial_id = $id and rmsh.deleted != 1";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            echo '<table id="modalexample" class="table table-striped table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Raw material Name</th>';
            echo '<th>Weight Lost</th>';
            echo '<th>Added on</th>';
            echo '<th>Comment</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                $id = $row['rawmaterial_id'];
                echo  '<tr>';
                echo  '<td>' . $row['raw_material_name'] . '</td>';
                echo  '<td>' . $row['weight_lost'] . ' kg</td>';
                echo  '<td>' . $row['date_added'] . '</td>';
                echo  '<td>' . $row['comment'] . '</td>';
                echo '</tr>';
            }




            echo '</tbody>';
            echo '</table>';
        }
    }
}
