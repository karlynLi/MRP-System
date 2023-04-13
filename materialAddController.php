<?php
require("dbconnect.php");
$name = mysqli_real_escape_string($conn,$_POST['name']); // 做安全辨認，避免裡面出現sql指令
$stock = mysqli_real_escape_string($conn,$_POST['stock']);
$leadtime = mysqli_real_escape_string($conn,$_POST['leadtime']);

if ($name) {
	$sql = "INSERT INTO `material` (`Mid`, `Name`, `Stock`, `Lead Time`) VALUES (NULL, '$name', '$stock', '$leadtime');";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL
	$msg = "Material added <br>";
} else {
	$msg = "Material name cannot be empty <br>";
}
header("Location:material.php?m=$msg");

?>