<?php
  session_start();
  require("productModel.php");

  $result = getProduct();
?>

<html lang="en">
<head>
  <title>排程</title>
  <?php include("style/_site_header.php"); ?>
</head>
<body>
  <?php include("style/_site_navbar.php"); ?>
  <div class="container my-5">
    <h2 class="text-center">Add Schedule</h2>

    <form method="post" action="scheduleAddController.php">
      <label for="pid">產品</label>
      <select class="form-control" name="pid" id="pid">
        <option disabled selected value><?php echo '請選擇產品' ?></option>
        <?php foreach ($result as $i) { ?>
          <option value="<?php echo $i['Pid'] ?>"><?php echo $i['PName'] ?></option>
        <?php } ?>
      </select>
      <br>

      <label for="count">數量</label>
      <input class="form-control" name="count" type="text" id="count" placeholder="請輸入數量"/>
      <br>
      
      <label for="deadline">交貨日期</label>
      <div class="input-group date" id="time" onchange="myFunction()">
        <input type="text" class="form-control" />
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-calendar"></i>
        </span>
        <input type="hidden" id="deadline" name="deadline" value="" />
      </div>
      <br><br><br>

      <div class="text-center">
        <button type="submit" class="btn btn-dark">送出</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.bootcss.com/moment.js/2.18.1/moment-with-locales.min.js"></script>
  <script src="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <script>
    $('#time').datetimepicker({
      // date: new Date(), // 一開始輸入框的日期為現在日期
      format: 'YYYY-MM-DD', // 日期的顯示格式
      locale: moment.locale('zh-tw'), // 國別
    });
  </script>
  <script>
    function myFunction() {
      var x = document.getElementById("time").value;
      document.getElementById("deadline").value = x;
    }
  </script>
</body>

<?php include("style/_site_footer.php"); ?>
</html>