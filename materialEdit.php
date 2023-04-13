<?php
  session_start();
  require("dbconnect.php");
  $msgID=(int)$_GET['id'];
  $sql = "SELECT * FROM material WHERE Mid='$msgID';";
  $result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
  $rs=mysqli_fetch_assoc($result)
?>

<html lang="en">
<head>
  <title>修改原物料</title>
  <?php include("style/_site_header.php"); ?>
</head>
<body>
  <?php include("style/_site_navbar.php"); ?>
  <div class="container my-5">
    <h2 class="text-center">Edit Material</h2>
    <form method="post" action="materialEditController.php" >
        <input name="id" type="hidden" id="id" value="<?php echo $msgID?>"/> <br>

        <div class="form-group mb-3">
            <label for="name">原料名稱</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $rs['Name']?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="stock">庫存</label>
            <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $rs['Stock']?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="leadtime">Lead Time (Day)</label>
            <input type="text" class="form-control" id="leadtime" name="leadtime" value="<?php echo $rs['Lead Time']?>" required>
        </div>

      <div class="text-center">
        <button type="submit" class="btn btn-dark my-3" id="saveBtn">Save</button>
      </div>
      
    </form>
  </div>
</body>
<?php include("style/_site_footer.php"); ?>
</html>