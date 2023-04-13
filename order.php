<?php
  session_start();
  require("orderModel.php");
  require("scheduleModel.php");
  require("materialModel.php");
  
  $order = getOrder();
  $schedule = getSchedule();
  $material = getMaterial();
?>

<html lang="en">
<head>
  <title>訂購清單</title>
  <?php include("style/_site_header.php"); ?>
</head>
<body>
  <?php include("style/_site_navbar.php"); ?>
  
  <div class="container my-5 text-center">
    <h2>Order List</h2>

    <!-- accordion 下拉展開 -->
    <center>
      <a class='btn btn-dark my-3' href='orderAdd.php'> 新增 </a> 
      <br><br>

      <div class="accordion px-5" id="accordionExample">
        <?php
          while ($k = mysqli_fetch_assoc($schedule)) {
        ?>
            <div class='accordion-item' style='width:75%'>
              <h2 class='accordion-header' id='heading<?php echo $k['Sid']?>'>
                <button class='accordion-button btn-lg' type='button' data-bs-toggle='collapse' data-bs-target='#collapse<?php echo $k['Sid']?>' aria-expanded='false' aria-controls='collapse<?php echo $k['Sid']?>'>
                  <?php echo "排程" . $k['Sid']?>
                </button>
              </h2>

              <div id='collapse<?php echo $k['Sid']?>' class='accordion-collapse collapse show' aria-labelledby='heading<?php echo $k['Sid']?>' data-bs-parent='#accordionExample'>
                <div class='accordion-body'>
                  <table class='table  table-borderless' style='width:100%'>
                    <thead class='thead-dark text-center'>
                      <tr>
                        <th scope='col'>原料名稱</th>
                        <th scope='col'>訂購數量</th>
                        <th scope='col'>運送狀態</th>
                        <th scope="col">訂購日期</th>
                      </tr>
                    </thead>
                    <tbody>
            <?php
            foreach ($material as $j) {
              foreach ($order as $i) {
                if ($i['Mid'] == $j['Mid']) {
                  if ($i['Sid'] == $k['Sid']) {
                    echo "<tr><td class='text-center'>" . $j['Name'] . "</td>";
                    echo "<td class='text-center'>" . $i['Count'] . "</td>";
                    if ($i['Status'] == 1) {
                      echo "<td class='text-center'>已到貨</td>";
                    } else {
                      echo "<td class='text-center'>未運送</td>";
                    }
                    echo "<td class='text-center'>" . $i['Order_Date'] . "</td></tr>";
                  }
                }
              }
            }
            echo "</tbody></table></div></div></div>";
          }
        ?>
    </div>
    </center>
  </div>   
</body>

<?php include("style/_site_footer.php"); ?>
</html>