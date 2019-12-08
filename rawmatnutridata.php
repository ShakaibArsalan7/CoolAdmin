
<?php
require_once("connection.php");

$id = $_POST['fmodid'];


if(!$conn->connect_error){


$opt = "";
$sql =  "select Nutrition_id, nutrition_name from nutrition where deleted != 1";

$res = $conn->query($sql);

if($res->num_rows > 0 ){
    $data = array();
    while($row = $res->fetch_assoc()){
    $opt .= '<th>'.$row['nutrition_name'] . '</th>';
    $data[] = $row;
}
}




$sql2 =  "select raw_material_name from rawMaterial where raw_material_id = $id";
$rmn = $conn->query($sql2)->fetch_object()->raw_material_name;

$sql1 = "SELECT rm.raw_material_name,rmn.raw_material_id,rmn.Nutrition_id,rmn.percentageperkg,rmn.deleted from rawMaterial rm inner join RawmaterialNutrients rmn on rm.raw_material_id = rmn.raw_material_id where rmn.deleted != 1 and rmn.raw_material_id = $id";
$res1 = $conn->query($sql1);
if($res1->num_rows > 0 ){
    $data1 = array();
    while($row = $res1->fetch_assoc()){
    $data1[] = $row;
}
}

if($res1->num_rows > 0 ){
    echo '<table id="example" class="table table-striped table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Raw material</th>';
        echo $opt;
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        echo  '<tr>';
        echo  '<td>' . $rmn. '</td>';

        foreach($data as $nutridata){ // this will run 13 times.
            $found = false;

            foreach($data1 as $per){
                if($nutridata['Nutrition_id'] === $per['Nutrition_id']){
                    echo  '<td>' . $per['percentageperkg'] . '</td>';
                    $found = true;
                break;
                }
            }

            if($found == false){
                echo  '<td>0.0000</td>';
            }
            

        }


        

        echo '<td style="text-align:center">
            
        <form action="update-rawmatnutridata.php" method="POST">
        <input type="hidden" name="id" id="sid" value=' .$id. 
            '><button type="submit" name="edit" value="edit" class="btn btn-success"><i class="fas fa-edit"></i></button>
            </form>
            </td>';
        
        echo '</tr>';
        echo '</tbody>';
    echo '</table>';


}else{
    echo '<table id="example" class="table table-striped table-bordered">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Raw material</th>';
    echo $opt;
    echo '<th>Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    echo  '<tr>';
    echo  '<td colspan=15 style="text-align:center">No Record Found</td>';
    echo '</tr>';
    echo '</tbody>';
echo '</table>';
}
}
?>