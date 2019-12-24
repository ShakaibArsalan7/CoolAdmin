<?php
require_once("connection.php");






if(!$conn->connect_error){


// //$id = $_POST['fmodid'];
$form = $_POST['fform'];

if($form === "expenseReport"){

    $time = $_POST['time'];
    $category = $_POST['category'];

    $sql ="";


    if($category == "all" && $time == "today"){

        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and date = CURDATE();";

    }else if($category == "all" && $time == "1w"){
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";

    }else if($category == "all" && $time == "tm"){
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());";
        
    }else if($category == "all" && $time == "1m"){
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        
    }else if($category == "all" && $time == "1y"){
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
        
    }else if($category != "all" && $time == "today"){
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and type_id = $category and date = CURDATE();";
        
    }else if($category != "all" && $time == "1w"){
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and type_id = $category and date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";

        
    }else if($category != "all" && $time == "tm"){
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and type_id = $category and MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE());";
        
    }else if($category != "all" && $time == "1m"){
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and type_id = $category and date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        
    }else if($category != "all" && $time == "1y"){
        $sql = "select et.expense_type, ex.* from expenses ex inner join expenseType et on et.id = ex.type_id where ex.deleted != 1 and type_id = $category and date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";

        
    }


    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
        echo '<table class="table table-data2" id="example" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Expense Type</th>';
        echo '<th>Comment</th>';
        echo '<th>Amount</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody >';
            $total =0;
    
            while($row = $res->fetch_assoc()){
                $total +=$row['amount']; 
                echo '<tr>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>';
                echo '<span class="block-email">' .$row['expense_type'] .'</span>';
                echo '</td>';
                echo '<td class="desc">' .$row['comment'] .'</td>';
                echo '<td>'. $row['amount'] .'</td>';
                echo '</tr>';
            }

            
            echo '</tbody>';
            echo '</table>';

            echo "<script>am($total)</script>";
    
    }else{
        echo '<table class="table table-data2" id="example" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Expense Type</th>';
        echo '<th>Comment</th>';
        echo '<th>Amount</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody >';
                echo '<tr>';
                echo  '<td></td>';
                echo  '<td></td>';
                echo  '<td>No Record Found</td>';
                echo  '<td></td>';

                
                echo '</tr>';
            echo '</tbody>';
            echo '</table>';

            echo "<script>am('0')</script>";

    }




}else if($form === "rawmaterialstockreport"){

    $time = $_POST['time'];
    $rawmaterial = $_POST['rawmaterial'];

    $sql ="";


    if($rawmaterial == "all" && $time == "today"){

        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id where rmsh.deleted != 1 and rmsh.date_added = CURDATE();";

    }else if($rawmaterial == "all" && $time == "1w"){
        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id where rmsh.deleted != 1 and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";

    }else if($rawmaterial == "all" && $time == "tm"){
        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id WHERE MONTH(rmsh.date_added) = MONTH(CURRENT_DATE()) AND YEAR(rmsh.date_added) = YEAR(CURRENT_DATE()) and rmsh.deleted != 1";
        
    }else if($rawmaterial == "all" && $time == "1m"){
        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id where rmsh.deleted != 1 and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        
    }else if($rawmaterial == "all" && $time == "1y"){
        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id where rmsh.deleted != 1 and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
        
    }else if($rawmaterial != "all" && $time == "today"){
        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id where rmsh.deleted != 1 and rmsh.rawmaterial_id = $rawmaterial and rmsh.date_added = CURDATE();";
        
    }else if($rawmaterial != "all" && $time == "1w"){
        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id where rmsh.deleted != 1 and rmsh.rawmaterial_id = $rawmaterial and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";

        
    }else if($rawmaterial != "all" && $time == "tm"){
        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id where rmsh.deleted != 1 and rmsh.rawmaterial_id = $rawmaterial and MONTH(rmsh.date_added) = MONTH(CURRENT_DATE()) AND YEAR(rmsh.date_added) = YEAR(CURRENT_DATE());";
        
    }else if($rawmaterial != "all" && $time == "1m"){
        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id where rmsh.deleted != 1 and rmsh.rawmaterial_id = $rawmaterial and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        
    }else if($rawmaterial != "all" && $time == "1y"){
        $sql = "SELECT rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id where rmsh.deleted != 1 and rmsh.rawmaterial_id = $rawmaterial and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";

        
    }


    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
        echo '<table class="table table-data2" id="example1" style="width:100%">';
     echo '<thead>';
     echo '<tr>';
     echo '<th>Raw Material Name</th>';
     echo '<th>Quantity</th>';
     echo '<th>Added on</th>';
     echo '</tr>';
     echo '</thead>';
     echo '<tbody >';
            while($row = $res->fetch_assoc()){
                echo  '<tr>';
                echo  '<td>' . $row['raw_material_name'] . '</td>';
                echo  '<td>' . $row['weight_added'] . ' kg</td>';
                echo  '<td>' . $row['date_added'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
    echo '</table>';
    
    }else{
        echo '<table class="table table-data2" id="example1" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Raw Material Name</th>';
        echo '<th>Quantity</th>';
        echo '<th>Added on</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody >';
                   echo  '<tr>';
                   echo  '<td></td>';
                   echo  '<td>No Record Found</td>';
                   echo  '<td></td>';
                   echo '</tr>';
               echo '</tbody>';
       echo '</table>';
    } 

}

}




?>