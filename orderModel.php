<?php
    require_once("dbconnect.php");

    function getOrder() {
        global $conn;
        $sql = "SELECT * FROM `order`;";
        $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); // 執行SQL

        return $result;
    }

    function addOrder($sid, $mid, $count, $date) {
        global $conn;
        $sql = "INSERT INTO `order` (`Sid`, `Mid`, `Count`, `Order_Date`) values ('$sid', '$mid', '$count', '$date');";
        $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); // 執行SQL	

        return $result;
    }
?>