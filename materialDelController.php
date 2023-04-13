<?php
require("dbconnect.php");
if (isset($_GET['id'])) {
    $mid = $_GET['id'];
	$sql = "DELETE FROM `material` WHERE `Mid`='$mid';";
	mysqli_query($conn,$sql) or die("MySQL query error"); //執行SQL
    $msg = "Material has been deleted.";
    header("Location:material.php?m=$msg"); 
} else {
    $msg = "doesn't get Mid.";
    header("Location:material.php?m=$msg");
}
?>