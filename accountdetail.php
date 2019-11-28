<?php
require_once("connection.php");
if(!$conn->connect_error){
    $cookie_value = $_COOKIE['EMAIL'];
    $sql = "select * from user where email_address = '$cookie_value'";
    $res = $conn->query($sql);
    if($res->num_rows > 0 ){
        $row = $res->fetch_assoc();
        $name = $row['user_name'];
        $email = $row['email_address'];
    }
}
?>

<div class="header-wrap float-right">
                                
                                <div class="header-button ">
                                   
                                    <div class="account-wrap ">
                                        <div class="account-item clearfix js-item-menu">
                                            <div class="image">
                                                <img src="images/icon/avatar-01.jpg" alt="Asad Ali" />
                                            </div>
                                            <div class="content">
                                                <a class="js-acc-btn" ><?php echo "$name";?></a>
                                            </div>
                                            <div class="account-dropdown js-dropdown">
                                                <div class="info clearfix">
                                                    <div class="image">
                                                        <a href="#">
                                                            <img src="images/icon/avatar-01.jpg" alt="Asad Ali" />
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h5 class="name">
                                                            <a><?php echo "$name";?></a>
                                                        </h5>
                                                        <span class="email"><?php echo "$email";?></span>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="view-users.php">
                                                            <i class="zmdi zmdi-account"></i>Account Details</a>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__footer">
                                                    <a href="logout.php">
                                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>