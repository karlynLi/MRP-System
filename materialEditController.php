<?php
require("dbconnect.php");
$mid = mysqli_real_escape_string($conn,$_POST['id']); 
$name = mysqli_real_escape_string($conn,$_POST['name']); 
$stock = mysqli_real_escape_string($conn,$_POST['stock']);
$leadtime = mysqli_real_escape_string($conn,$_POST['leadtime']);

if ($mid) {
	$sql = "UPDATE material SET `Name`='$name', `Stock`='$stock', `Lead Time`='$leadtime' WHERE `material`.`Mid` = '$mid';";
	mysqli_query($conn, $sql) or die("Update failed, SQL query error"); //執行SQL
	$msg = "Material edited <br>";
} else {
	$msg = "doesn't get Material id<br>";
}
header("Location:material.php?m=$msg");
?>