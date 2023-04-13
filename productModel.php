<?php
    require_once("dbconnect.php");

    function getProduct() {
        global $conn;
        $sql = "SELECT * FROM `product`;";
        $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); // 執行SQL

        return $result;
    }
?>