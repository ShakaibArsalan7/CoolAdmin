<?php
require_once("connection.php");






if(!$conn->connect_error){



$id = $_POST['fmodid'];
$form = $_POST['fform'];


$sql2 =  "select raw_material_name from rawMaterial where raw_material_id = $id";
$rawmatname = $conn->query($sql2)->fetch_object()->raw_material_name;

$opt = "";
$sql =  "select Nutrition_id, nutrition_name from nutrition where deleted != 1";
$res = $conn->query($sql);

// echo "<script>alert('$res->num_rows')</script>";


if($res->num_rows > 0 ){
while($row = $res->fetch_assoc()){
    // echo "<script>alert('a')</script>";
    $opt .='<option value='. $row['Nutrition_id'] .'>'. $row['Nutrition_id'] . ' - ' . $row['nutrition_name'] .'</option>';

    

}

}


if($form === "updatenutri"){

    //update heading

    echo "<h2 style='color:#17a2b7;text-align:center;margin:10px'> Update $rawmatname Nutrients Information </h2>";
    //hidden input containing rawmaterial id, raw material name disabled input , nutrients dropdown , nutrient quantity input  , update button




    

echo '<div class="row form-group" style="width:50%;margin:5px auto">';

echo '<input type="hidden" name="rawmaterialid" id="rawmaterialid" value=' .$id .'>';
// echo '<div class="col-12 col-md-2">';
// echo '<input name="rawmaterialid" id="rawmaterialid" value=' . $rawmatname .  ' disabled>';
// echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<select class="form-control" id="nutrientID" name="nutrient">';
echo "<option value='select'>select option</option>$opt";
echo '</select>';
echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<input class="form-control" name="nutrientquantity" id="nutrientquantity" value="">';
echo '</div>';
echo '<div class="col-12 col-md-2">';
echo '<button type="button" class="btn btn-info form-control" id="updatenutriinfo">update</button>';
echo '</div>';


echo '</div>  ';
    

}else if($form === "updatevalue"){


    $nid = $_POST['nutrientID'];
    $ppk = (float) $_POST['quantity'];
    $sql2 = "SELECT * FROM RawmaterialNutrients rmn WHERE rmn.raw_material_id =$id and rmn.Nutrition_id =$nid and rmn.deleted !=1";
    $res = $conn->query($sql2);
    if($res->num_rows > 0 ){
        $sql7 = "update RawmaterialNutrients set percentageperkg = $ppk where raw_material_id = $id and Nutrition_id = $nid and deleted != 1";
        
        $res = $conn->query($sql7);
       if($res){
            //update heading

    echo "<h2 style='color:#17a2b7;text-align:center;margin:10px'> Update $rawmatname Nutrients Information </h2>";
    //hidden input containing rawmaterial id, raw material name disabled input , nutrients dropdown , nutrient quantity input  , update button




    

echo '<div class="row form-group" style="width:50%;margin:5px auto">';

echo '<input type="hidden" name="rawmaterialid" id="rawmaterialid" value=' .$id .'>';
// echo '<div class="col-12 col-md-2">';
// echo '<input name="rawmaterialid" id="rawmaterialid" value=' . $rawmatname .  ' disabled>';
// echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<select class="form-control" id="nutrientID" name="nutrient">';
echo "<option value='select'>select option</option>$opt";
echo '</select>';
echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<input class="form-control" name="nutrientquantity" id="nutrientquantity" value="">';
echo '</div>';
echo '<div class="col-12 col-md-2">';
echo '<button type="button" class="btn btn-info form-control" id="updatenutriinfo">update</button>';
echo '</div>';


echo '</div>  ';


        echo "<script>snackbar('Updated Successfully','green')</script>";
       }else{
           //echo "update unsuccesfull";
       }
    }else{

        //insert the nutrient
        $que = "insert into RawmaterialNutrients(raw_material_id,Nutrition_id,percentageperkg,deleted) values('$id','$nid',$ppk,false)";
        $res2 = $conn->query($que);
        if($res){
            //update heading

    echo "<h2 style='color:#17a2b7;text-align:center;margin:10px'> Update $rawmatname Nutrients Information </h2>";
    //hidden input containing rawmaterial id, raw material name disabled input , nutrients dropdown , nutrient quantity input  , update button




    

echo '<div class="row form-group" style="width:50%;margin:5px auto">';

echo '<input type="hidden" name="rawmaterialid" id="rawmaterialid" value=' .$id .'>';
// echo '<div class="col-12 col-md-2">';
// echo '<input name="rawmaterialid" id="rawmaterialid" value=' . $rawmatname .  ' disabled>';
// echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<select class="form-control" id="nutrientID" name="nutrient">';
echo "<option value='select'>select option</option>$opt";
echo '</select>';
echo '</div>';
echo '<div class="col-12 col-md-4">';
echo '<input class="form-control" name="nutrientquantity" id="nutrientquantity" value="">';
echo '</div>';
echo '<div class="col-12 col-md-2">';
echo '<button type="button" class="btn btn-info form-control" id="updatenutriinfo">update</button>';
echo '</div>';


echo '</div>  ';


        echo "<script>snackbar('Updated Successfully','green')</script>";
       }else{
           //echo "update unsuccesfull";
       }
    }





}
}
