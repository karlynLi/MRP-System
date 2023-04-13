<?php
session_start();
require("dbconnect.php");
if (isset($_GET['hidden_id'])){
  $msg=$_GET['hidden_id'];
} else {
  $msg='';
}
$sql = "select * from material;";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
?>

<html lang="en">
<head>
    <title>物料清單</title>
    <?php include("style/_site_header.php"); ?>
</head>
<body>
  <?php include("style/_site_navbar.php"); ?>
  <div class="container my-5 text-center">
    <h2>Material List</h2>
    <h5><?php echo $msg?></h5>
    <center>
      <a class='btn btn-dark my-3' href='materialAdd.php'> 新增 </a> 
    </center>
    <div class="table-responsive px-5">
      <table class="table table-striped table-bordered my-3">
        <thead class="thead-dark text-center" >
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Lead Time (Day)</th>
            <th scope="col">Operation</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while (	$rs=mysqli_fetch_assoc($result)) {
            echo "<tr><th class='text-center' scope='row'>".$rs['Mid']."</th>";
            echo "<td class='text-center'>".$rs['Name']."</td>";
            echo "<td class='text-center'>".$rs['Stock']."</td>";
            echo "<td class='text-center'>".$rs['Lead Time']."</td>";  
            echo "<td class='text-center'>".
              "<a class='btn btn-success' href='materialEdit.php?id=".$rs['Mid']."'> 修改 </a>" .
              " <a class='btn btn-danger' href='materialDelController.php?id=".$rs['Mid']."'> 刪除 </a></td></tr>";
            echo "<input type='hidden' name='hidden_id' id='hidden_id' value='".$rs['Mid']."'/>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
<?php include("style/_site_footer.php"); ?>
</body>


</html>