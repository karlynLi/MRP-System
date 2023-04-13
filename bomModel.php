<?php
    require_once("dbconnect.php");

    function getBom() {
        global $conn;
        $sql = "SELECT * FROM `bom`;";
        $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); // 執行SQL

        return $result;
    }
?>