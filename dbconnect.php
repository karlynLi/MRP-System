<?php
$host = 'localhost:3307';
$user = 'root';
$pass = '';
$db = 'mrp';
$conn = mysqli_connect($host, $user, $pass, $db) or die('Error with MySQL connection'); //跟MyMSQL連線並登入
mysqli_query($conn,"SET NAMES utf8"); //選擇編碼
?>
