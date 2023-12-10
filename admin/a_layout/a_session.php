<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:login.php");
}else{

    $row = $_SESSION['admin'];
    $aid = $row['aid'];
    $aname = $row['aname'];
    $aemail = $row['aemail'];
   
}
    


?>