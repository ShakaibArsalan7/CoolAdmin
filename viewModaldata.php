<?php
require_once("connection.php");

$id = $_POST['fmodid'];
$form = $_POST['fform'];

if(!$conn->connect_error){

    if($form === 'client'){

        $sql = "select * from client where client_id = $id";
        $res = $conn->query($sql);
        if($res->num_rows > 0 ){
            $row = $res->fetch_assoc();
            echo "Client ID : " . $row["client_id"] . "<br>";
            echo "Client Name : " . $row["user_name"] . "<br>";
            echo "Client Email : " . $row["email_address"] . "<br>";
            echo "Client Work Phone : " . $row["work_phone"] . "<br>";
            echo "Client Mobile Number : " . $row["mobile_number"] . "<br>";
            echo "Client Work Address : " . $row["work_address"] . "<br>";
            echo "Client Home Address : " . $row["home_address"] . "<br>";
            echo "Client Bank Account Title : " . $row["bank_account_title"] . "<br>";
            echo "Client Bank Account Number : " . $row["bank_account_number"] . "<br>";
            echo "Client Bank Name : " . $row["bank_name"] . "<br>";
        }

    }else if($form === 'employee'){

        $sql = "select * from employee where employee_id = $id";
        $res = $conn->query($sql);
        if($res->num_rows > 0 ){
            $row = $res->fetch_assoc();
            echo "Employee ID : " . $row["employee_id"] . "<br>";
            echo "Employee Name : " . $row["user_name"] . "<br>";
            echo "Employee Email : " . $row["email_address"] . "<br>";
            echo "Employee Work Phone : " . $row["work_phone"] . "<br>";
            echo "Employee Mobile Number : " . $row["mobile_number"] . "<br>";
            echo "Employee Work Address : " . $row["work_address"] . "<br>";
            echo "Employee Home Address : " . $row["home_address"] . "<br>";
            echo "Employee Bank Account Title : " . $row["bank_account_title"] . "<br>";
            echo "Employee Bank Account Number : " . $row["bank_account_number"] . "<br>";
            echo "Employee Bank Name : " . $row["bank_name"] . "<br>";
        }

    }else if($form === 'purchaser'){

        $sql = "select * from purchaser where purchaser_id = $id";
        $res = $conn->query($sql);
        if($res->num_rows > 0 ){
            $row = $res->fetch_assoc();
            echo "Purchaser ID : " . $row["purchaser_id"] . "<br>";
            echo "Purchaser Name : " . $row["user_name"] . "<br>";
            echo "Purchaser Email : " . $row["email_address"] . "<br>";
            echo "Purchaser Work Phone : " . $row["work_phone"] . "<br>";
            echo "Purchaser Mobile Number : " . $row["mobile_number"] . "<br>";
            echo "Purchaser Work Address : " . $row["work_address"] . "<br>";
            echo "Purchaser Home Address : " . $row["home_address"] . "<br>";
            echo "Purchaser Bank Account Title : " . $row["bank_account_title"] . "<br>";
            echo "Purchaser Bank Account Number : " . $row["bank_account_number"] . "<br>";
            echo "Purchaser Bank Name : " . $row["bank_name"] . "<br>";
        }
        
    }else if($form === 'salesman'){

        $sql = "select * from salesman where salesman_id = $id";
        $res = $conn->query($sql);
        if($res->num_rows > 0 ){
            $row = $res->fetch_assoc();
            echo "Salesman ID : " . $row["salesman_id"] . "<br>";
            echo "Salesman Name : " . $row["user_name"] . "<br>";
            echo "Salesman Email : " . $row["email_address"] . "<br>";
            echo "Salesman Work Phone : " . $row["work_phone"] . "<br>";
            echo "Salesman Mobile Number : " . $row["mobile_number"] . "<br>";
            echo "Salesman Work Address : " . $row["work_address"] . "<br>";
            echo "Salesman Home Address : " . $row["home_address"] . "<br>";
            echo "Salesman Bank Account Title : " . $row["bank_account_title"] . "<br>";
            echo "Salesman Bank Account Number : " . $row["bank_account_number"] . "<br>";
            echo "Salesman Bank Name : " . $row["bank_name"] . "<br>";
        }
        
    }else if($form === 'supplier'){

        $sql = "select * from supplier where supplier_id = $id";
        $res = $conn->query($sql);
        if($res->num_rows > 0 ){
            $row = $res->fetch_assoc();
            echo "Supplier ID : " . $row["supplier_id"] . "<br>";
            echo "Supplier Name : " . $row["user_name"] . "<br>";
            echo "Supplier Email : " . $row["email_address"] . "<br>";
            echo "Supplier Work Phone : " . $row["work_phone"] . "<br>";
            echo "Supplier Mobile Number : " . $row["mobile_number"] . "<br>";
            echo "Supplier Work Address : " . $row["work_address"] . "<br>";
            echo "Supplier Home Address : " . $row["home_address"] . "<br>";
            echo "Supplier Bank Account Title : " . $row["bank_account_title"] . "<br>";
            echo "Supplier Bank Account Number : " . $row["bank_account_number"] . "<br>";
            echo "Supplier Bank Name : " . $row["bank_name"] . "<br>";
        }
        
    }


}

?>