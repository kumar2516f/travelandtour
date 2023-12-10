<?php

include("a_layout/DB.php");
$p='admin@1234' ;
$hashed_password=md5($p);

    $sql="INSERT INTO admin (aname, aemail, apassword) VALUES ('super admin', 'admin@gmail.com', '$hashed_password')";
    $result=$conn->query($sql);
    if($result)
    {
        echo "<script>
        alert('admin add in DB sucessful');
        window.location.href='login.php';
        </script>";
    }
    else
    {
        echo "not sucessful";
    }
?>