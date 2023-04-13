<?php
    require_once("dbconnect.php");

    function getSchedule() {
        global $conn;
        $sql = "SELECT * FROM `schedule`;";
        $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); // 執行SQL

        return $result;
    }

    function addSchedule($pid, $count, $deadline) {
        global $conn;
        $sql = "INSERT INTO `schedule` (`Pid`, `Count`, `Deadline`) values ('$pid', '$count', '$deadline');";
        $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); // 執行SQL	

        return $result;
    }
?>