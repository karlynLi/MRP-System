<?php
    require("orderModel.php");

    $mid = mysqli_real_escape_string($conn, $_POST['mid']);
    $num = mysqli_real_escape_string($conn, $_POST['num']);
    $date = date('Y-m-d H:i:s');

    if (isset($_POST["item_select"])) {
        for($count = 0; $count < count($_POST["item_select"]); $count++) {
            $data = array(
                ':item_select' => $_POST["item_select"][$count],
            );

            $statement = $conn->prepare('INSERT INTO `order` (`Sid`, `Mid`, `Count`, `Order_Date`) VALUES (?, ?, ?, ?)');
            $statement->bind_param("iiis", $_POST["item_select"][$count], $mid, $num, $date);
            $statement->execute();
        }
        $msg ="add success";
    } else {
        $msg = "POST[item_select] failed";
    }
    return $msg;
?>