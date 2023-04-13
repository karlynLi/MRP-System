<?php
  session_start();
  require("scheduleModel.php");
  require("productModel.php");
  require("materialModel.php");
  
  $schedule = getSchedule();
  $product = getProduct();
  $material = getMaterialandBom();
?>

<html lang="en">
<head>
  <title>排程</title>
  <?php include("style/_site_header.php"); ?>
</head>
<body>
  <?php include("style/_site_navbar.php"); ?>
  
  <div class="container my-5 text-center">
    <h2>Schedule List</h2>
    <button type="button" class="btn btn-dark" onclick="location.href='scheduleAdd.php'">新增</button>
    <br><br>

    <table class="table table-striped table-bordered my-3">
      <thead class="thead-dark">
        <tr>
          <th scope="col">排程</th>
          <th scope="col">產品</th>
          <th scope="col">數量</th>
          <th scope="col">交貨日期</th>
          <th scope="col">備註</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($schedule as $i) {
            foreach ($product as $j) {
              if ($i['Pid'] == $j['Pid']) {
                echo "<tr><th scope='row'>" . $i['Sid'] . "</th>";
                echo "<td>" . $j['PName'] . "</td>";
                echo "<td>" . $i['Count'] . "</td>";
                echo "<td>" . $i['Deadline'] . "</td>";
                
                $temp = 0;
                foreach ($material as $k) {
                  if ($i['Pid'] == $k['Pid']) {
                    $count = $i['Count'] * $k['Count'];
                    $temp = $temp + $k['Lead Time'];
                    $deadline = date("Y-m-d", strtotime("-" . $temp . "day", strtotime($i['Deadline'])));
                    $result = '在' . $deadline . '之前需要' . $count . '個' . $k['Name'];
                      
                    echo "<tr><th scope='row'></th>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td>" . $result . "</td></tr>";
                  }
                }
              }
            }
          }
        ?>
      </tbody>
    </table>
  </div>
</body>

<script>
  function detail(sid, pid, mid) {
    location.href = "schedule.php?sid="+sid+"&pid="+pid+"&mid="+mid;
  }
</script>

<?php include("style/_site_footer.php"); ?>
</html>