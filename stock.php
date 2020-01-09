<?php
require_once("connection.php");






if(!$conn->connect_error){


// //$id = $_POST['fmodid'];
$form = $_POST['fform'];

if($form === "arms"){

    $opt = "";
    $sql1 = "SELECT rm.raw_material_id, rm.raw_material_name FROM rawMaterial rm WHERE rm.deleted != 1";
    $res = $conn->query($sql1);
    $data = array();
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $opt .='<option value='. $row['raw_material_id'] .'>'. $row['raw_material_id'] .' - '. $row['raw_material_name'] . '</option>';
    }

    }

    $opt1 = "";
    $sql1 = "SELECT s.supplier_id, s.user_name FROM supplier s WHERE s.deleted != 1";
    $res = $conn->query($sql1);
    $data1 = array();
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $opt1 .='<option value='. $row['supplier_id'] .'>'. $row['supplier_id'] .' - '. $row['user_name'] . '</option>';
    }

    }
    $today = date("Y-m-d"); 
echo '<form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">';

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
echo '<label for="hf-supplier" class=" form-control-label">Supplier</label>';
echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<select class="form-control" id="suppliername" name="suppliername">';
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
echo '<label for="hf-weight" class=" form-control-label">Weight (in kg)</label>';
echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<input type="number" id="hf-weight" name="hf-weight" placeholder="Enter weight..." class="form-control" oninput="weightchange()" value="0">';
echo '</div>';
echo '</div>';

echo '<div class="row form-group">';
echo '<div class="col col-md-2">';
echo '<label for="hf-rate" class=" form-control-label">Rate (per kg)</label>';
echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<input type="number" id="hf-rate" name="hf-rate" placeholder="Enter Rate..." class="form-control" oninput="ratechange()" value="0">';
echo '</div>';
echo '</div>';

echo '<div class="row form-group">';
echo '<div class="col col-md-2">';
echo '<label for="hf-totalpayment" class=" form-control-label">Total Payment</label>';
echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<input type="number" id="hf-totalpayment" name="hf-totalpayment" class="form-control" readonly>';
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
echo '<input type="submit" class="btn btn-primary btn-lg" name="submit" value="Add" />';
echo '</div>';
echo '</div>';
echo '</form>';

}else if($form === "vrms"){
    // echo "<input type='hidden' name='id1' id='brandid1' value=$id >";


    
    $sql = 'SELECT rms.rawmaterial_id,rm.raw_material_name,rms.weight FROM rawmaterialStock rms inner join rawMaterial rm on rms.rawmaterial_id = rm.raw_material_id; ';
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
        echo '<table id="example" class="table table-striped table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Raw material ID</th>';
            echo '<th>Raw material Name</th>';
            echo '<th>Weight Present</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while($row = $res->fetch_assoc()){
                $id = $row['rawmaterial_id'];
                echo  '<tr>';
                echo  '<td>' . $row['rawmaterial_id'] . '</td>';
                echo  '<td>' . $row['raw_material_name'] . '</td>';
                echo  '<td>' . $row['weight'] . ' kg</td>';
                echo '<td style="text-align:center">
                    <button class="btn btn-info mid" data-toggle="modal" data-id=' . $row["rawmaterial_id"] .'><i class="fas fa-eye"></i></button>
                    </td>';
                echo '</tr>';
            }
    
           
            
            
            echo '</tbody>';
        echo '</table>';
    
    }   
    
    


}else if($form === "rrms"){

    $opt = "";
    $sql1 = "SELECT rm.raw_material_id, rm.raw_material_name FROM rawMaterial rm WHERE rm.deleted != 1";
    $res = $conn->query($sql1);
    $data = array();
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $opt .='<option value='. $row['raw_material_id'] .'>'. $row['raw_material_id'] .' - '. $row['raw_material_name'] . '</option>';
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
    
}else if($form === "rawmaterialstockdetail"){

    $id = $_POST['fmodid'];

    $sql = "SELECT rm.raw_material_name,s.user_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id WHERE rmsh.rawmaterial_id = $id and rmsh.deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
        echo '<table id="modalexample" class="table table-striped table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Item</th>';
            echo '<th>Weight</th>';
            echo '<th>Rate</th>';
            echo '<th>Supplier</th>';
            echo '<th>total</th>';
            echo '<th>paid</th>';
            echo '<th>Date</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while($row = $res->fetch_assoc()){
                $id = $row['rawmaterial_id'];
                echo  '<tr>';
                echo  '<td>' . $row['raw_material_name'] . '</td>';
                echo  '<td>' . $row['weight_added'] . ' kg</td>';
                echo  '<td>' . $row['rate'] . '</td>';
                echo  '<td>' . $row['user_name'] . '</td>';
                echo  '<td>' . $row['totalpayment'] . '</td>';
                echo  '<td>' . $row['paymentmade'] . '</td>';
                echo  '<td>' . $row['date_added'] . '</td>';
                echo '</tr>';
            }
    
           
            
            
            echo '</tbody>';
        echo '</table>';
    
    }
}else if($form === "removedrawmaterialstockdetail"){

    $id = $_POST['fmodid'];

    $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockLossHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id WHERE rmsh.rawmaterial_id = $id and rmsh.deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
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
            while($row = $res->fetch_assoc()){
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

?>