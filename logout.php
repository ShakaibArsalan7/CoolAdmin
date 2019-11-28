<?php

setcookie("EMAIL",'', time() - 3600);

header("Location: ./index.php"); 

?>