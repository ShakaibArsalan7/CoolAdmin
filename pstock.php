<?php
require_once("connection.php");






if(!$conn->connect_error){


// //$id = $_POST['fmodid'];
$form = $_POST['fform'];

if($form === "arms"){

    $brandname  = "";
    $opt = "";
    $sql =  "select brand_id, brand_name from brand where deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $opt .='<option value='. $row['brand_id'] .'>'. $row['brand_id'] . ' - ' . $row['brand_name'] .'</option>';
        }
    }
    $today = date("Y-m-d"); 
//brand id , formula id , packing sizes, no of bags , submit button
echo '<form action="" method="post" class="form-horizontal" onsubmit="return validateForm()">';

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
}else if($form === "showformulas"){

    $id = $_POST['bmodid'];
    // echo "<script>alert('$id')</script>";
    $opt1 = "";
    $sql1 = "SELECT f.formula_id, f.formula_name FROM formulas f WHERE f.brand_id = $id and f.deleted != 1";
    $res = $conn->query($sql1);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $opt1 .='<option value='. $row['formula_id'] .'>'. $row['formula_id'] .' - ' . $row['formula_name'] . '</option>';
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

}else if($form === "showpackings"){

    $id = $_POST['bmodid'];
    $opt2 = "";
    $sql1 = "SELECT pd.packing_size FROM packingDetail pd WHERE pd.brand_id = $id and pd.deleted != 1";
    $res = $conn->query($sql1);
    $data = array();
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $opt2 .='<option value='. $row['packing_size'] .'>'. $row['packing_size'] . ' kg</option>';
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

}
else if($form === "vrms"){

    $sql = 'select b.brand_name,f.formula_name,ps.packing_size,ps.noofbags,ps.date from productStock ps inner join formulas f on ps.formula_id = f.formula_id inner join brand b on ps.brand_id = b.brand_id where ps.deleted !=1;';
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
        echo '<table id="example" class="table table-striped table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Brand</th>';
            echo '<th>Formula Name</th>';
            echo '<th>Packing Size</th>';
            echo '<th>No of Bags</th>';
            echo '<th>Date</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while($row = $res->fetch_assoc()){
                $id = $row['rawmaterial_id'];
                echo  '<tr>';
                echo  '<td>' . $row['brand_name'] . '</td>';
                echo  '<td>' . $row['formula_name'] . '</td>';
                echo  '<td>' . $row['packing_size'] . '</td>';
                echo  '<td>' . $row['noofbags'] . '</td>';
                echo  '<td>' . $row['date'] . '</td>';
                echo '</tr>';
            }
    
           
            
            
            echo '</tbody>';
        echo '</table>';
    
    }   

}else if($form === "rrms"){

    $brandname  = "";
    $opt = "";
    $sql =  "select brand_id, brand_name from brand where deleted != 1";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $opt .='<option value='. $row['brand_id'] .'>'. $row['brand_id'] . ' - ' . $row['brand_name'] .'</option>';
        }
    }
    $today = date("Y-m-d"); 
//brand id , formula id , packing sizes, no of bags , submit button
echo '<form action="" method="post" class="form-horizontal" onsubmit="return validateremForm()">';

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

}else if($form === "removedrawmaterialstockdetail"){


}


}

?>