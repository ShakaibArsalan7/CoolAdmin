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
echo '<label for="hf-weight" class=" form-control-label">Weight (in kg)</label>';
echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<input type="text" id="hf-weight" name="hf-weight" placeholder="Enter weight..." class="form-control" value="0">';
echo '</div>';
echo '</div>';
echo '<div class="row form-group">';
echo '<div class="col col-md-2">';
echo '<label for="hf-rate" class=" form-control-label">Rate (per kg)</label>';
echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<input type="text" id="hf-rate" name="hf-rate" placeholder="Enter Rate..." class="form-control" value="0">';
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

    $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id WHERE rmsh.rawmaterial_id = $id and rmsh.deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
        echo '<table id="modalexample" class="table table-striped table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Raw material Name</th>';
            echo '<th>Weight Added</th>';
            echo '<th>Added on</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while($row = $res->fetch_assoc()){
                $id = $row['rawmaterial_id'];
                echo  '<tr>';
                echo  '<td>' . $row['raw_material_name'] . '</td>';
                echo  '<td>' . $row['weight_added'] . ' kg</td>';
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