<?php
require_once("connection.php");






if (!$conn->connect_error) {


    // //$id = $_POST['fmodid'];
    $form = $_POST['fform'];

    if ($form === "supplierdelete") {


        $sid = (int) $_POST['sid'];
        $sql = "update supplier set deleted = 1 where supplier_id = $sid";
        $res = $conn->query($sql);
        if ($res) {
            echo "<script>snackbar('Successfully Deleted','green')</script>";
            //realod the table

        } else {
            echo "<script>snackbar('Deletion Failure','red')</script>";
        }
    } else if ($form === "loadsuppliertable") {

        $sql = 'select * from supplier where deleted != 1';
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Supplier Name</th>';
            echo '<th>Email Address</th>';
            echo '<th>Work Phone</th>';
            echo '<th>Work Address</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                $id = $row['supplier_id'];
                echo  '<tr>';
                echo  '<td>' . $row['user_name'] . '</td>';
                echo  '<td>' . $row['email_address'] . '</td>';
                echo  '<td>' . $row['work_phone'] . '</td>';
                echo  '<td>' . $row['work_address'] . '</td>';
                echo '<td style="text-align:center" class="table-data-feature">
<form action="update-supplier.php" method="POST">
<input type="hidden" name="id" value=' . $row["supplier_id"] .
                    '><button type="submit" name="edit" style="margin:3px" value="edit" class="btn btn-success"><i class="fas fa-edit"></i></button>
</form>
<button class="btn btn-danger did"  style="margin:3px" data-toggle="modal" data-id=' . $row["supplier_id"] . '><i class="fas fa-trash"></i></button>
<button class="btn btn-info mid" style="margin:3px" data-toggle="modal" data-id=' . $row["supplier_id"] . '><i class="fas fa-eye"></i></button>



</td>';
                echo '</tr>';
            }




            echo '</tbody>';
            echo '</table>';
        }
    } else if ($form === "nutrientdelete") {
        $nid = (int) $_POST['nid'];
        $sql = "update nutrition set deleted = 1 where Nutrition_id = $nid";
        $res = $conn->query($sql);
        if ($res) {
            echo "<script>snackbar('Successfully Deleted','green')</script>";
            //realod the table

        } else {
            echo "<script>snackbar('Deletion Failure','red')</script>";
        }
    } else if ($form === "loadnutrienttable") {

        $sql = 'select * from nutrition where deleted != 1';
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Nutrient ID</th>';
            echo '<th>Nutrient Name</th>';
            echo '<th>Usage unit</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                $id = $row['Nutrition_id'];
                echo  '<tr>';
                echo  '<td>' . $row['Nutrition_id'] . '</td>';
                echo  '<td>' . $row['nutrition_name'] . '</td>';
                echo  '<td>' . $row['unit_of_usage'] . '</td>';
                echo '<td class="table-data-feature">

<form action="update-nutrient.php" method="POST">
<input type="hidden" name="id" id="sid" value=' . $row["Nutrition_id"] .
                    '><button type="submit" name="edit" style="margin:3px" value="edit" class="btn btn-success"><i class="fas fa-edit"></i></button>
</form>

<button class="btn btn-danger did"  style="margin:3px" data-toggle="modal" data-id=' . $row["Nutrition_id"] . '><i class="fas fa-trash"></i></button>
<button class="btn btn-info mid" style="margin:3px" data-toggle="modal" data-id=' . $row["Nutrition_id"] . '><i class="fas fa-eye"></i></button>



</td>';
                echo '</tr>';
            }




            echo '</tbody>';
            echo '</table>';
        }
    } else if ($form === "rawmaterialdelete") {

        $id = (int) $_POST['rawid'];

        $sql = "update rawMaterial set deleted = 1 where raw_material_id = $id";

        $res = $conn->query($sql);
        if ($res) {
            //nutrient details in that raw material are also deleted.
            $sql = "update RawmaterialNutrients set deleted = 1 where raw_material_id = $id";

            $res = $conn->query($sql);
            if ($res) {
                echo "<script>snackbar('Successfully Deleted','green')</script>";
            } else {
                echo "<script>snackbar('Deletion Failure','red')</script>";
            }
        } else {
            echo "<script>snackbar('Deletion Failure','red')</script>";
            #echo "<script>alert('Deleted Failed')</script>";
        }
    } else if ($form === "loadrawmaterialtable") {

        $sql = 'select * from rawMaterial where deleted != 1';
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Raw material ID</th>';
            echo '<th>Raw material Name</th>';
            echo '<th>Usage unit</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                $id = $row['raw_material_id'];
                echo  '<tr>';
                echo  '<td>' . $row['raw_material_id'] . '</td>';
                echo  '<td>' . $row['raw_material_name'] . '</td>';
                echo  '<td>' . $row['unit_of_usage'] . '</td>';
                echo '<td class="table-data-feature">
            
            <form action="update-rawmaterial.php" method="POST">
                                                <button type="submit" name="edit" value="edit" class="btn btn-success"><i class="fas fa-edit"></i></button>
                </form>

                <button class="btn btn-danger did"  style="margin:3px" data-toggle="modal" data-id=' . $row["raw_material_id"] . '><i class="fas fa-trash"></i></button>
                <button class="btn btn-info mid" data-toggle="modal" data-id=' . $row["raw_material_id"] . '><i class="fas fa-eye"></i></button>
                
                
                
                </td>';
                echo '</tr>';
            }




            echo '</tbody>';
            echo '</table>';
        }
    } else if ($form === "salesmandelete") {
        $id = (int) $_POST['sid'];

        $sql = "update salesman set deleted = 1 where salesman_id = $id";

        $res = $conn->query($sql);
        if ($res) {
            echo "<script>snackbar('Successfully Deleted','green')</script>";
        } else {
            echo "<script>snackbar('Deletion Failure','red')</script>";
        }
    } else if ($form === "loadsalesmantable") {

        $sql = 'select * from salesman where deleted != 1';
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Salesman Name</th>';
            echo '<th>Email Address</th>';
            echo '<th>Work Phone</th>';
            echo '<th>Work Address</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                echo  '<tr>';
                echo  '<td>' . $row['user_name'] . '</td>';
                echo  '<td>' . $row['email_address'] . '</td>';
                echo  '<td>' . $row['work_phone'] . '</td>';
                echo  '<td>' . $row['work_address'] . '</td>';
                echo '<td class="table-data-feature">

<form action="update-salesman.php" method="POST">
<input type="hidden" name="id" value=' . $row["salesman_id"] .
                    '><button type="submit" name="edit" value="edit" class="btn btn-success"><i class="fas fa-edit"></i></button>
</form>

<button class="btn btn-danger did"  style="margin:3px" data-toggle="modal" data-id=' . $row["salesman_id"] . '><i class="fas fa-trash"></i></button>


<button class="btn btn-info mid" data-toggle="modal" data-id=' . $row["salesman_id"] . '><i class="fas fa-eye"></i></button>
</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
    } else if ($form === "employeedelete") {
        $id = (int) $_POST['eid'];

        $sql = "update employee set deleted = 1 where employee_id = $id";

        $res = $conn->query($sql);
        if ($res) {
            echo "<script>snackbar('Successfully Deleted','green')</script>";
            #echo "<script>alert('Deleted Successfully')</script>";
        } else {
            echo "<script>snackbar('Deletion Failure','red')</script>";
            #echo "<script>alert('Deleted Failed')</script>";
        }
    } else if ($form === "loademployeetable") {
        $sql = 'select * from employee where deleted != 1';
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Employee Name</th>';
            echo '<th>Email Address</th>';
            echo '<th>Work Phone</th>';
            echo '<th>Work Address</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                echo  '<tr>';
                echo  '<td>' . $row['user_name'] . '</td>';
                echo  '<td>' . $row['email_address'] . '</td>';
                echo  '<td>' . $row['work_phone'] . '</td>';
                echo  '<td>' . $row['work_address'] . '</td>';
                echo '<td class="table-data-feature">
                    
                    <form action="update-employee.php" method="POST">
                    <input type="hidden" name="id" value=' . $row["employee_id"] .
                    '><button type="submit" name="edit" value="edit" class="btn btn-success"><i class="fas fa-edit"></i></button>
                        </form>
                        <button class="btn btn-danger did"  style="margin:3px" data-toggle="modal" data-id=' . $row["employee_id"] . '><i class="fas fa-trash"></i></button>
                        <button class="btn btn-info mid" data-toggle="modal" data-id=' . $row["employee_id"] . '><i class="fas fa-eye"></i></button>
                        
                        </td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
    } else if ($form === "clientdelete") {
        $id = (int) $_POST['cid'];

        $sql = "update client set deleted = 1 where client_id = $id";

        $res = $conn->query($sql);
        if ($res) {
            echo "<script>snackbar('Successfully Deleted','green')</script>";
            #echo "<script>alert('Deleted Successfully')</script>";
        } else {
            echo "<script>snackbar('Deletion Failure','red')</script>";
            #echo "<script>alert('Deleted Failed')</script>";
        }
    } else if ($form === "loadclienttable") {
        $sql = 'select * from client where deleted != 1';
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Client Name</th>';
            echo '<th>Email Address</th>';
            echo '<th>Work Phone</th>';
            echo '<th>Work Address</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $res->fetch_assoc()) {
                echo  '<tr>';
                echo  '<td>' . $row['user_name'] . '</td>';
                echo  '<td>' . $row['email_address'] . '</td>';
                echo  '<td>' . $row['work_phone'] . '</td>';
                echo  '<td>' . $row['work_address'] . '</td>';
                echo '<td class="table-data-feature">

<form action="update-client.php" method="POST">
<input type="hidden" name="id" value=' . $row["client_id"] .
                    '><button type="submit" name="edit" value="edit" class="btn btn-success"><i class="fas fa-edit"></i></button>
</form>
<button class="btn btn-danger did"  style="margin:3px" data-toggle="modal" data-id=' . $row["client_id"] . '><i class="fas fa-trash"></i></button>

<button class="btn btn-info mid" data-toggle="modal" data-id=' . $row["client_id"] . '><i class="fas fa-eye"></i></button>

</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
    }else if($form === "expensedelete"){
        $id = (int)$_POST['exid'];
         
        $sql = "update expenses set deleted = true where id = $id";
        
        $res = $conn->query($sql);
        if($res){
            echo "<script>snackbar('Successfully Deleted','green')</script>";
            #echo "<script>alert('Deleted Successfully')</script>";
        }else{
            echo "<script>snackbar('Deletion Failure','red')</script>";
            #echo "<script>alert('Deleted Failed')</script>";
        }
    }else if($form === "loadexpensetable"){
        $sql = 'select * from expenses where deleted != 1';
        $res = $conn->query($sql);
        if($res->num_rows > 0 ){
            echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Date</th>';
                echo '<th>Amount</th>';
                echo '<th>Comment</th>';
                echo '<th>Actions</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while($row = $res->fetch_assoc()){
                    $id = $row['id'];
                    echo  '<tr>';
                    echo  '<td>' . $row['date'] . '</td>';
                    echo  '<td>' . $row['amount'] . '</td>';
                    echo  '<td>' . $row['comment'] . '</td>';
                    echo '<td class="table-data-feature">
                    
                    <form action="update-expense.php" method="POST">
                    <input type="hidden" name="id" value=' .$row["id"]. 
                        '><button type="submit" name="edit" value="edit" class="btn btn-success"><i class="fas fa-edit"></i></button>
                        </form>
                        <button class="btn btn-danger did"  style="margin:3px" data-toggle="modal" data-id=' . $row["id"] . '><i class="fas fa-trash"></i></button>
                        <button class="btn btn-info mid" data-toggle="modal" data-id=' . $row["id"] .'><i class="fas fa-eye"></i></button>
                        
                        
                        
                        </td>';
                    echo '</tr>';
                }
        
               
                
                
                echo '</tbody>';
            echo '</table>';
        
        
        }
    }
}
