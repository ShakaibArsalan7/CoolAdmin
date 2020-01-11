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

}else if($form === "salesdetailsreport"){

    $time = $_POST['time'];
    $client = $_POST['client'];

    // echo "<script>alert('t - $time    --- c - $client')</script>";

    $sql ="";


    if($client == "all" && $time == "today"){

        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  where s.deleted != 1 and s.date_added = CURDATE();";

    }else if($client == "all" && $time == "1w"){
        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  where s.deleted != 1 and s.date_added >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";

    }else if($client == "all" && $time == "tm"){
        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  WHERE MONTH(s.date_added) = MONTH(CURRENT_DATE()) AND YEAR(s.date_added) = YEAR(CURRENT_DATE()) and s.deleted != 1";
        
    }else if($client == "all" && $time == "1m"){
        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  where s.deleted != 1 and s.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        
    }else if($client == "all" && $time == "1y"){
        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  where s.deleted != 1 and s.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
        
    }else if($client != "all" && $time == "today"){
        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  where s.deleted != 1 and c.client_id = $client and s.date_added = CURDATE();";
        
    }else if($client != "all" && $time == "1w"){
        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  where s.deleted != 1 and c.client_id = $client and s.date_added >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";

        
    }else if($client != "all" && $time == "tm"){
        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  where s.deleted != 1 and c.client_id = $client and MONTH(s.date_added) = MONTH(CURRENT_DATE()) AND YEAR(s.date_added) = YEAR(CURRENT_DATE());";
        
    }else if($client != "all" && $time == "1m"){
        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  where s.deleted != 1 and c.client_id = $client and s.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        
    }else if($client != "all" && $time == "1y"){
        $sql = "SELECT c.user_name,b.brand_name,f.formula_name,s.* FROM sales s inner join brand b on b.brand_id = s.brand_id inner join formulas f on f.formula_id = s.formula_id inner join client c on c.client_id = s.client_id  where s.deleted != 1 and c.client_id = $client and s.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";

        
    }


    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        echo '<table class="table table-data2" id="example4" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Client</th>';
        echo '<th>Brand</th>';
        echo '<th>Formula</th>';
        echo '<th>Packing Size</th>';
        echo '<th>Bags</th>';
        echo '<th>Total Payment</th>';
        echo '<th>Added on</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody >';
        while ($row = $res->fetch_assoc()) {
            echo  '<tr>';
            echo  '<td>' . $row['user_name'] . '</td>';
            echo  '<td>' . $row['brand_name'] . '</td>';
            echo  '<td>' . $row['formula_name'] . '</td>';
            echo  '<td>' . $row['packing_size'] . ' kg</td>';
            echo  '<td>' . $row['noofbags'] . '</td>';
            echo  '<td>' . $row['totalpayment'] . '</td>';
            echo  '<td>' . $row['date_added'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }else{
        echo '<table class="table table-data2" id="example4" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Client</th>';
        echo '<th>Brand</th>';
        echo '<th>Formula</th>';
        echo '<th>Packing Size</th>';
        echo '<th>Bags</th>';
        echo '<th>Total Payment</th>';
        echo '<th>Added on</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody >';
            echo  '<tr>';
            echo  '<td></td>';
            echo  '<td></td>';
            echo  '<td></td>';
            echo  '<td>No Record Found</td>';
            echo  '<td></td>';
            echo  '<td></td>';
            echo  '<td></td>';
            echo '</tr>';
        echo '</tbody>';
        echo '</table>';
    }


}else if($form === "purchasesdetailreport"){

    $time = $_POST['time'];
    $supplier = $_POST['supplier'];

    $sql ="";


    if($supplier == "all" && $time == "today"){

        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id where rmsh.deleted != 1 and rmsh.date_added = CURDATE();";

    }else if($supplier == "all" && $time == "1w"){
        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id where rmsh.deleted != 1 and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";

    }else if($supplier == "all" && $time == "tm"){
        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id WHERE MONTH(rmsh.date_added) = MONTH(CURRENT_DATE()) AND YEAR(rmsh.date_added) = YEAR(CURRENT_DATE()) and rmsh.deleted != 1";
        
    }else if($supplier == "all" && $time == "1m"){
        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id where rmsh.deleted != 1 and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        
    }else if($supplier == "all" && $time == "1y"){
        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id where rmsh.deleted != 1 and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
        
    }else if($supplier != "all" && $time == "today"){
        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id where rmsh.deleted != 1 and rmsh.supplier_id = $supplier and rmsh.date_added = CURDATE();";
        
    }else if($supplier != "all" && $time == "1w"){
        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id where rmsh.deleted != 1 and rmsh.supplier_id = $supplier and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";

        
    }else if($supplier != "all" && $time == "tm"){
        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id where rmsh.deleted != 1 and rmsh.supplier_id = $supplier and MONTH(rmsh.date_added) = MONTH(CURRENT_DATE()) AND YEAR(rmsh.date_added) = YEAR(CURRENT_DATE());";
        
    }else if($supplier != "all" && $time == "1m"){
        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id where rmsh.deleted != 1 and rmsh.supplier_id = $supplier and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        
    }else if($supplier != "all" && $time == "1y"){
        $sql = "SELECT s.user_name,rm.raw_material_name,rmsh.* FROM rawMaterialStockAdditionHistory rmsh inner join rawMaterial rm on rmsh.rawmaterial_id = rm.raw_material_id inner join supplier s on s.supplier_id = rmsh.supplier_id where rmsh.deleted != 1 and rmsh.supplier_id = $supplier and rmsh.date_added >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";

        
    }


    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        echo '<table class="table table-data2" id="example2" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Supplier</th>';
        echo '<th>Item</th>';
        echo '<th>weight</th>';
        echo '<th>rate</th>';
        echo '<th>Total payment</th>';
        echo '<th>Added on</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody >';
        while ($row = $res->fetch_assoc()) {
            echo  '<tr>';
            echo  '<td>' . $row['user_name'] . '</td>';
            echo  '<td>' . $row['raw_material_name'] . '</td>';
            echo  '<td>' . $row['weight_added'] . ' kg</td>';
            echo  '<td>' . $row['rate'] . '</td>';
            echo  '<td>' . $row['totalpayment'] . '</td>';
            echo  '<td>' . $row['date_added'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }else{
        echo '<table class="table table-data2" id="example2" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Supplier</th>';
        echo '<th>Item</th>';
        echo '<th>weight</th>';
        echo '<th>rate</th>';
        echo '<th>Total payment</th>';
        echo '<th>Added on</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody >';
            echo  '<tr>';
            echo  '<td></td>';
            echo  '<td></td>';
            echo  '<td></td>';
            echo  '<td>No Record Found</td>';
            echo  '<td></td>';
            echo  '<td></td>';
            echo '</tr>';
        echo '</tbody>';
        echo '</table>';
    }


}else if($form == "expensereport"){
    $month = $_POST['month'];
    $year = $_POST['year'];

    $sql = "SELECT * FROM expenseType et WHERE et.deleted != 1";
    $res = $conn->query($sql);
    $et = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $et[] =$row['expense_type'];
        }
    }



    $sql = "SELECT e.type_id,sum(e.amount) as total FROM expenses e WHERE e.deleted != 1 and MONTH(e.date) = $month AND YEAR(e.date) = $year group by e.type_id";
    $res = $conn->query($sql);
    $am = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $am[] = $row['total'];
        }
    }

    echo "<script>expensedetail(",json_encode($et),",",json_encode($am),");</script>";
}else if($form == "empattreport"){

    $month = $_POST['month'];
    $year = $_POST['year'];
    $id = $_POST['id'];


    $sql = "SELECT count(*) as total FROM AttenadnceType att WHERE att.deleted != 1";
    $total = $conn->query($sql)->fetch_object()->total;

    $sql = "select la.attendance_description,count(la.attendance_description) as totalc from laborAttendance la where la.deleted != 1 and MONTH(la.date) = $month AND YEAR(la.date) = $year and la.employee_id = $id group by la.attendance_description";
    $res = $conn->query($sql);
    $daatt = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $daatt[] = $row;
        }
    }
    $da = array();
    $s = count($daatt);
    if($s > 0){
        for($i = 1; $i <= $total; $i++){
            $f = false;
            foreach($daatt as $d){
                if($d['attendance_description'] == $i){
                    $da[] = $d['totalc'];
                    $f = true;
                }
            }
            if(!$f){
                $da[] = 0;
            }

        }

    }else{
        for($i = 1; $i <= $total; $i++){
                $da[] = 0;

        }
    }

    echo "<script>empattendancedetail(",json_encode($da),");</script>";

}else if($form == "rawreport"){
    $id = $_POST['id'];



    $sql = "SELECT * FROM rawMaterialStockAdditionHistory rms WHERE rms.deleted != 1 and rms.rawmaterial_id = $id order by rms.date_added desc limit 5";
    $res = $conn->query($sql);
    $dates = array();
    $weights = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $dates[] = $row['date_added'];
            $weights[] = $row['weight_added'];
        }
        echo "<script>rawmaterialRep(",json_encode($dates),",",json_encode($weights),");</script>";
    }else{
        echo "<script>rawmaterialRep([],[]);</script>";
    }

}

}




?>