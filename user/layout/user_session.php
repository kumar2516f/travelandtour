<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}else{

    $row = $_SESSION['user'];

    $uid = $row['uid'];
    $uname = $row['uname'];
    $uemail = $row['email'];
    $uphone = $row['uphone'];
   
}
    


?>