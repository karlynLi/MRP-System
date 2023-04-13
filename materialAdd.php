<?php
  session_start();
  require("dbconnect.php");
?>

<html lang="en">
<head>
  <title>新增原物料</title>
  <?php include("style/_site_header.php"); ?>
</head>
<body>
  <?php include("style/_site_navbar.php"); ?>
  <div class="container my-5">
    <h2 class="text-center">Add Material</h2>
    <form method="post" action="materialAddController.php" >
        <div class="form-group mb-3">
            <label for="name">原料名稱</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="原料名稱" required>
        </div>
        <div class="form-group mb-3">
            <label for="stock">庫存</label>
            <input type="text" class="form-control" id="stock" name="stock" placeholder="沒有庫存請輸入0" required>
        </div>
        <div class="form-group mb-3">
            <label for="leadtime">Lead Time (Day)</label>
            <input type="text" class="form-control" id="leadtime" name="leadtime" placeholder="Lead Time (Day)" required>
        </div>

      <div class="text-center">
        <button type="submit" class="btn btn-dark my-3" id="saveBtn">Save</button>
      </div>
      
    </form>
  </div>
</body>
<?php include("style/_site_footer.php"); ?>
</html>