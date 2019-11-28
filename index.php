<?php
if(isset($_COOKIE['EMAIL'])){
    //page displayed
    header("Location: ./dashboard.php"); 
}
?>

<?php
// if session is there then redirect to dashboard.
require_once("connection.php");
session_start();

$userid  = $password = "";
if(!$conn->connect_error){
    
    if(isset($_REQUEST['submit'])){
        $email  =  $_REQUEST['emailaddress'];
        $password =  $_REQUEST['password'];
        
        $password = md5($password);

        $sql = "select * from user where email_address = '$email' and password = '$password'";
        #echo "<script>console.log($sql)</script>";
        $res = $conn->query($sql);
        if($res->num_rows > 0 ){ // user exist if row > 0 so index.php goes here
            $cookie_value = $_REQUEST['emailaddress'];
            $cookie_name = 'EMAIL';
            setCookie($cookie_name, $cookie_value);

             

            //include_once("dashboard.php");
            header("Location: ./dashboard.php"); 
        }else{
            $disp = "inline";
            //user id or password is wrong.
            include_once("login.php");
                
    }

}

$disp = "none";
//user id or password is wrong.
include_once("login.php");
}

?>