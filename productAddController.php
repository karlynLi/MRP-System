<?php
require("dbconnect.php");

if (isset($_POST["pname"])){
    $pname = $_POST["pname"];
    $sql = "INSERT INTO `product` (`Pid`, `PName`) VALUES (NULL, '$pname');";
    $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error"); //執行SQL
    $msg = "insert pname success";

    if ($msg == "insert pname success"){
        $getpid = "SELECT `product`.`Pid` FROM `product` WHERE `product`.`PName`= '$pname';";
        $result_pid = mysqli_query($conn, $getpid) or die("Insert failed, SQL query error");
        $rpid = mysqli_fetch_assoc($result_pid);

        if (isset($_POST["item_select"])){
            if (isset($_POST["item_count"])){
                $pid = $rpid['Pid'];
                $order = 0;
                for($count = 0; $count < count($_POST["item_select"]); $count++){
                    $data = array(
                        ':item_select' => $_POST["item_select"][$count],
                        ':item_count' => $_POST["item_count"][$count],
                    );
                    $order = $count + 1;
                    $statement = $conn->prepare('INSERT INTO bom (`Pid`, `Order`, `Mid`, `Count`) VALUES (?, ?, ?, ?)');
                    $statement->bind_param("iiis", $rpid['Pid'], $order, $_POST["item_select"][$count], $_POST["item_count"][$count]);
                    $statement->execute();
                }
                $msg ="add success";
            } else {
                $msg ="POST[item_count] failed";
            }
            
        } else {
            $msg = "POST[item_select] failed";
        }
    } else {
        $msg = "insert pname failed <br>";
    }
} else {
    $msg="doesn't get pname";
}
return $msg;

?>