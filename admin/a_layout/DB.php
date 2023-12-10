<?php
$conn=mysqli_connect("localhost","root","","tat");
if($conn->connect_error)
{
    die("database connection unsucessfull". $conn->connect_error);
}
?>