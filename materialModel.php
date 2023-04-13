<?php
    require_once("dbconnect.php");

    function getMaterialandBom() {
        global $conn;
        // $sql = "SELECT * FROM `material`;";
        $sql = "SELECT * FROM `bom` JOIN `material` WHERE `bom`.`Mid`=`material`.`Mid` ORDER BY `bom`.`Pid`, `bom`.`Order` DESC  ";
        $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); // 執行SQL

        return $result;
    }

    function getOneMaterial($pid) {
        global $conn;
        $sql = "SELECT * FROM `material` WHERE `Pid` = $pid;";
        $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); // 執行SQL

        return $result;
    }

    function getMaterial() {
        global $conn;
        $sql = "SELECT * FROM `material`;";
        $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); // 執行SQL

        return $result;
    }
?>