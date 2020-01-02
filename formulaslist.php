<?php

require_once("connection.php");



$form = $_POST['fform'];


if(!$conn->connect_error){


    if($form === "formulaslist"){
    $id = $_POST['fmodid'];


    $opt = "";
    $sql1 = "SELECT f.formula_id, f.formula_name FROM formulas f WHERE f.brand_id = $id and f.deleted != 1";
    $res = $conn->query($sql1);
    if($res->num_rows > 0 ){
    while($row = $res->fetch_assoc()){
        $opt .='<option value='. $row['formula_id'] .'>'. $row['formula_id'] .' - ' . $row['formula_name'] . '</option>';
    }


    echo "<input type='hidden' name='id' id='brandid' value=$id >";
    echo '<div class="col col-md-2">';
    echo '<label for="formulaid" class=" form-control-label">Formula Name</label>';
    echo '</div>';
    echo '<div class="col-12 col-md-5" >';
    echo '<select class="form-control" id="formulaid" name="formulaid">';
    echo '<option value="select">select option</option>' , $opt;
    echo '</select>';
    echo '</div>';

    }else{
        //no formulas exist
        echo "<input type='hidden' name='id' id='brandid' value=$id >";
        echo '<div class="col col-md-12">';
        echo '<p style="text-align:center">No Formulas exists.</p>';
        echo '</div>';

    }



    }else if($form === "rawmatlist"){


        $bid = $_POST['bmodid'];
        $fid = $_POST['fmodid'];

        $opt = "";
        $sql =  "select Nutrition_id, nutrition_name from nutrition where deleted != 1";
        $res = $conn->query($sql);
        if($res->num_rows > 0 ){
            $nutrientsdata = array();
            while($row = $res->fetch_assoc()){
                $opt .= '<th style="background-color:red;">'.$row['nutrition_name'] . '</th>';
                $nutrientsdata[] = $row;
                // 1 - Oil
                // 2 - Ash
                // 3 - Moisture
                // ... 
                //14 - Rate
            }
        }

        $sql = "SELECT brand_id,brand_name FROM brand b where b.deleted != 1";
        $res = $conn->query($sql);
        $brandsdata = array();
        if($res->num_rows > 0 ){
        while($row = $res->fetch_assoc()){
            $brandsdata[] = $row;
            // 1 - Anmol
            // 2 - Austrian
            // 3 - sahab
            }
        }

        $sql = "SELECT formula_id,formula_name FROM formulas f where f.deleted != 1";
        $res = $conn->query($sql);
        $formulasdata = array();
        if($res->num_rows > 0 ){
        while($row = $res->fetch_assoc()){
            $formulasdata[] = $row;
            // 1 - Anmol sp
            // 2 - Austrain sp1
            // 3 - Austrain sp2
            // 4 - sahab special
            }
        }

        $sql = "SELECT raw_material_id,raw_material_name FROM rawMaterial rm where rm.deleted != 1";
        $res = $conn->query($sql);
        $rawmaterialsdata = array();
        if($res->num_rows > 0 ){
        while($row = $res->fetch_assoc()){
            $rawmaterialsdata[] = $row;
                // 1 - Maize
                // 2 - Wheat Bran
                // 3 - Rice Polish
                // ... 
                //58 - Poultry Feed Wastage
            }
        }

        // $opt = "";
        //$sql1 = "SELECT * FROM brandFormula bf where bf.brand_id = $bid and bf.formula_id = $fid";
        $sql1 = "SELECT bf.id,rm.raw_material_name,bf.brand_id, bf.formula_id, bf.rawmaterial_id,bf.weightinkg FROM brandFormula bf inner join rawMaterial rm on bf.rawmaterial_id = rm.raw_material_id where bf.brand_id = $bid and bf.formula_id =$fid";
        $res = $conn->query($sql1);
        $brandformulasdata = array();
        if($res->num_rows > 0 ){
        while($row = $res->fetch_assoc()){
            $brandformulasdata[] = $row;
            // 1  Maize         1  1  1  23
            // 2  Wheat Bran    1  1  2  43
            // 3  Rice Polish   1  1  3  12
            // 4  Gluten 30%    1  1  12 22
            }
        }

        $tabledata = array();
        
        foreach($brandformulasdata as $id=>$weightage){ // this will run the number of raw materials in formula, for example 11 in this case.
            $tabledatarow = array();
            $tabledatarow[] = $id+1;
            $tabledatarow[] = $weightage['raw_material_name'];
            $tabledatarow[] = $weightage['weightinkg'];
            // if we get the nutrient data in raw materials





            $sql1 = "SELECT * FROM RawmaterialNutrients rmn where rmn.raw_material_id = $weightage[rawmaterial_id] and rmn.deleted != 1";
            //echo "<script>alert('$sql1')</script>";
            // multiply the weight with nutrient data
            $nutriinfo =array();
            $res = $conn->query($sql1);
            if($res->num_rows > 0 ){
                while($row = $res->fetch_assoc()){
                    $nutriinfo[] = $row;
                }
            }

            foreach($nutrientsdata as $nutrient){
                $found = false;
                foreach($nutriinfo as $info){
                    if(!$found){
                        if($nutrient['Nutrition_id'] == $info['Nutrition_id']){
                            $tabledatarow[]  = $weightage['weightinkg'] * $info['percentageperkg'];
                            $found = true;
                        }
                    }
                }
                if(!$found){ $tabledatarow[]  = $weightage['weightinkg'] * 0.0; }
            }



            //$tabledatarow[]  = $weightage['weightinkg'] * $row['percentageperkg'];



            //add to table data array.
            $tabledata[] = $tabledatarow;



            

        }

        // echo "<script>alert('Are you ready ')</script>";
        // // get the last row of sums.
        $sumrow = array();
        $size = count($nutrientsdata);

        function getSumOfId($array, $id) {
            $sumOfId = 0;
         
            foreach($array as $arr) {
               $sumOfId += $arr[$id];
            }
            return $sumOfId;
         }

         
        
        $i = 3;
        foreach($nutrientsdata as $nd){
            $sumrow[]=  getSumOfId($tabledata ,$i);
            $i++;
        }
         array_unshift($sumrow, "", "Total", "100.0");
        


        //all rows are available




        



        if(count($brandformulasdata) > 0 ){
                echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Sr.</th>';
                echo '<th>Items</th>';
                echo '<th style="background-color:red;">Weights</th>';
                echo $opt;
                echo '</tr>';
                echo '</thead>';


                echo '<tbody>';
                



                foreach($tabledata as $tdr){
                     // this will run 13 times.
                    $i=0;
                    $s = count($tdr)-1;
                    echo  '<tr>';
                    foreach($tdr as $td){
                        // echo "<script>alert('$td[$i]')</script>";
                        if($i == 0){
                            echo  '<td  style="background-color:white;">' . $td . '</td>';
                        }else if($i == 1){
                            echo  '<td  style="background-color:yellow;">' . $td . '</td>';
                        }else if($i == 2){
                            echo  '<td  style="background-color:red;">' . $td . '</td>';
                        }else{
                            echo  '<td  style="background-color:white;">' . $td . '</td>';
                        }
                        $i++;
                    }
                    echo '</tr>';
                }

                    echo  '<tr>';
                    $i = 0;
                    foreach($sumrow as $td){
                        if($i == 0){
                            echo  '<td  style="background-color:light-green;">' . $td . '</td>';
                        }else if($i == 1){
                            echo  '<td  style="background-color:light-green;">' . $td . '</td>';
                        }else{
                            echo  '<td  style="background-color:red;">' . $td . '</td>';
                        }
                        $i++;
                    }
                    echo '</tr>';



                echo '</tbody>';
            echo '</table>';
        
        
        
        
        }
    
    



    
    
    
        }



}
