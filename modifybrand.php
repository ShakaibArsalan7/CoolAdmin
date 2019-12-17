<?php
require_once("connection.php");






if(!$conn->connect_error){



$id = $_POST['fmodid'];
$form = $_POST['fform'];

if($form === "one"){
    echo "<input type='hidden' name='id' id='brandid' value=$id >";
    echo '<button type="button" style="margin:15px 5px" class="btn btn-info" id="cbn">Change Brand Name</button>';
    echo '<button type="button" style="margin:15px 5px" class="btn btn-success" id="apo">Add Packing Option</button>';
    echo '<button type="button" style="margin:15px 5px" class="btn btn-danger" id="rpo">Remove Packing Option</button>';

}else if($form === "cbn"){
    echo "<input type='hidden' name='id1' id='brandid1' value=$id >";

    echo '<div class="col col-md-2">';
    echo '<label for="hf-brandname" class=" form-control-label">Brand Name</label>';
    echo '</div>';

    echo '<div class="col col-md-4">';
    echo '<input type="text" id="hf-brandname" name="hf-brandname" placeholder="Enter Brand name..." class="form-control">';
    echo '</div>';


    echo '<div class="col col-md-2">';
    echo '<button type="button" class="btn btn-info form-control" id="changebname">Change</button>';
    echo '</div>';


}else if($form === "apo"){

    $opt = "";
    $sql1 = "SELECT pd.packing_size FROM packingDetail pd WHERE pd.brand_id = $id and pd.deleted != 1";
    $res = $conn->query($sql1);
    $data = array();
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }

    $sql =  "select id, packing_size from packings where deleted != 1";

    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        // echo "<script>alert('a')</script>";
        $already = false;
        foreach($data as $packSize){
            if($packSize['packing_size'] == $row['packing_size']){
                $already = true;
            break;
            }
        }
        if($already == false){
            $opt .='<option value='. $row['packing_size'] .'>'. $row['packing_size'] . ' kg</option>';
        }
        

        

    }
}
    }

    

    echo "<input type='hidden' name='id2' id='brandid2' value=$id >";

    // packing option drop down 
    // add option button --> request to modify brand --> check if option already there then not add else add.

    echo '<div class="col col-md-3">';
    echo '<label for="packingSizes" class=" form-control-label">Packing Options</label>';
    echo '</div>';

    echo '<div class="col col-md-3">';
    echo '<select class="form-control" id="packingopt" name="packingopt">';
    echo "<option value='select'>select option</option>$opt";
    echo '</select>';
    echo '</div>';

    echo '<div class="col col-md-2">';
    echo '<button type="button" class="btn btn-success" id="addPackingSize">Add Size</button>';
    echo '</div>';
    
}else if($form === "rpo"){


    $opt = "";
    $sql1 = "SELECT pd.packing_size FROM packingDetail pd WHERE pd.brand_id = $id and pd.deleted != 1";
    $res = $conn->query($sql1);
    $data = array();
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $opt .='<option value='. $row['packing_size'] .'>'. $row['packing_size'] . ' kg</option>';
    }

    }

    

    echo "<input type='hidden' name='id3' id='brandid3' value=$id >";

    // packing option drop down 
    // add option button --> request to modify brand --> check if option already there then not add else add.

    echo '<div class="col col-md-3">';
    echo '<label for="packingSizes" class=" form-control-label">Packing Options</label>';
    echo '</div>';

    echo '<div class="col col-md-4">';
    echo '<select class="form-control" id="packingopt" name="packingopt">';
    echo "<option value='select'>select option</option>$opt";
    echo '</select>';
    echo '</div>';

    echo '<div class="col col-md-2">';
    echo '<button type="button" style="margin:5px" class="btn btn-success" id="addPackingSize">Add Size</button>';
    echo '</div>';
    
    


}else if($form === "changebname"){

        $name  =$_POST['bname'];
        $sql7 = "update brand set brand_name = '$name' where brand_id = $id";
        
        $res = $conn->query($sql7);
       if($res){
        echo "<input type='hidden' name='id1' id='brandid1' value=$id >";


        echo '<div class="col col-md-4">';
        echo '<label for="hf-brandname" class=" form-control-label">Brand Name</label>';
        echo '</div>';

        echo '<div class="col col-md-6">';
        echo '<input type="text" id="hf-brandname" name="hf-brandname" placeholder="Enter Brand name..." class="form-control">';
        echo '</div>';


        echo '<div class="col col-md-2">';
        echo '<button type="button" class="btn btn-info form-control" id="changebname">Change</button>';
        echo '</div>';


        echo "<script>snackbar('Name Changed Succesfully')</script>";
       }else{
           //echo "update unsuccesfull";
       }




 
    }else if($form === "addPackingOption"){

        //$id
        $pval = $_POST['psize'];



        //select all the options from database where brand id is 

        $sql7 = "insert into packingDetail(brand_id,packing_size,deleted) values('$id','$pval',false)";
        
        $res = $conn->query($sql7);

       if($res){

        $opt = "";
        $sql1 = "SELECT pd.packing_size FROM packingDetail pd WHERE pd.brand_id = $id and pd.deleted != 1";
        $res = $conn->query($sql1);
        $data = array();
        if($res->num_rows > 0 ){
        while($row = $res->fetch_assoc()){
            $data[] = $row;
        }
    
        $sql =  "select id, packing_size from packings where deleted != 1";
    
        $res = $conn->query($sql);
        if($res->num_rows > 0 ){
        while($row = $res->fetch_assoc()){
            // echo "<script>alert('a')</script>";
            $already = false;
            foreach($data as $packSize){
                if($packSize['packing_size'] == $row['packing_size']){
                    $already = true;
                break;
                }
            }
            if($already == false){
                $opt .='<option value='. $row['packing_size'] .'>'. $row['packing_size'] . ' kg</option>';
            }
            
    
            
    
        }
    }
        }
    
        
    
        echo "<input type='hidden' name='id2' id='brandid2' value=$id >";


        // packing option drop down 
        // add option button --> request to modify brand --> check if option already there then not add else add.
    
        echo '<div class="col col-md-3">';
        echo '<label for="packingSizes" class=" form-control-label">Packing Options</label>';
        echo '</div>';
    
        echo '<div class="col col-md-3">';
        echo '<select class="form-control" id="packingopt" name="packingopt">';
        echo "<option value='select'>select option</option>$opt";
        echo '</select>';
        echo '</div>';
    
        echo '<div class="col col-md-2">';
        echo '<button type="button" class="btn btn-success" id="addPackingSize">Add Size</button>';
        echo '</div>';

        echo "<script>snackbar('Size Added Succesfully')</script>";
       }else{
           //echo "update unsuccesfull";
       }




 
    }else if($form === "remPackingOption"){

        //$id
        $pval = $_POST['psize'];



        //select all the options from database where brand id is 

        $sql7 = "update packingDetail set deleted = true where brand_id = $id && packing_size= $pval";
        
        $res = $conn->query($sql7);

       if($res){

        $opt = "";
        $sql1 = "SELECT pd.packing_size FROM packingDetail pd WHERE pd.brand_id = $id and pd.deleted != 1";
        $res = $conn->query($sql1);
        $data = array();
        if($res->num_rows > 0 ){
        while($row = $res->fetch_assoc()){
            $opt .='<option value='. $row['packing_size'] .'>'. $row['packing_size'] . ' kg</option>';
        }
    
        }
    
        
    
        echo "<input type='hidden' name='id2' id='brandid2' value=$id >";
    
        // packing option drop down 
        // add option button --> request to modify brand --> check if option already there then not add else add.
    
        echo '<div class="col col-md-3">';
        echo '<label for="packingSizes" class=" form-control-label">Packing Options</label>';
        echo '</div>';

        echo '<div class="col col-md-4">';
        echo '<select class="form-control" id="packingopt" name="packingopt">';
        echo "<option value='select'>select option</option>$opt";
        echo '</select>';
        echo '</div>';

        echo '<div class="col col-md-2">';
        echo '<button type="button" style="margin:5px" class="btn btn-success" id="addPackingSize">Add Size</button>';
        echo '</div>';

        echo "<script>snackbar('Size Removed Succesfully')</script>";
       }else{
           //echo "update unsuccesfull";
       }




 
    }

}

?>