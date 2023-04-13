<?php
    require("scheduleModel.php");

    $pid = mysqli_real_escape_string($conn, $_POST['pid']);
    $count = mysqli_real_escape_string($conn, $_POST['count']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);

    if ($pid) { // if product is not empty
        addSchedule($pid, $count, $deadline);
        $msg = "Message updateded";
    } else {
        $msg = "Message product cannot be empty";
    }
    header("Location: schedule.php?m=$msg");
?>