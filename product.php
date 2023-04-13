<?php
  session_start();
  require("dbconnect.php");
  $sql = "SELECT * FROM `product`;";
  $result = mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
  if (isset($_GET['m'])){
    $msg=$_GET['m'];
  } else {
    $msg='';
  }
?>

<html lang="en">
<head>
  <title>產品清單</title>
  <?php include("style/_site_header.php"); ?>
</head>
<body>
  <?php include("style/_site_navbar.php"); ?>
  <div class="container my-5 text-center">
    <h2>Product List</h2>
    <h5><?php echo $msg?></h5>
    <!-- accordion 下拉展開 -->
    <center>
    <a class='btn btn-dark my-3' href='productAdd.php'> 新增 </a> 
    <div class="accordion px-5" id="accordionExample">
      <?php
        while($rs = mysqli_fetch_assoc($result)){?>
          <div class='accordion-item' style='width:75%'>
            <h2 class='accordion-header' id='heading<?php echo $rs['Pid']?>'>
              <button class='accordion-button btn-lg' type='button' data-bs-toggle='collapse' data-bs-target='#collapse<?php echo $rs['Pid']?>' aria-expanded='false' aria-controls='collapse<?php echo $rs['Pid']?>'>
                <?php echo $rs['PName']?>
              </button>
            </h2>

          <div id='collapse<?php echo $rs['Pid']?>' class='accordion-collapse collapse show' aria-labelledby='heading<?php echo $rs['Pid']?>' data-bs-parent='#accordionExample'>
            <div class='accordion-body'>
            <table class='table table-sm table-borderless' style='width:50%'>
              <thead class='thead-dark text-center'>
              <tr>
                <th scope='col'>製作順序</th>
                <th scope='col'>原料名稱</th>
                <th scope='col'>所需原料數量</th>
              </tr>
            </thead>
            
            <tbody>
            <?php 
            $pos = $rs['Pid'];
            $sql_2 = "SELECT material.Name, bom.Order, bom.Count FROM `bom`, `material` WHERE bom.Pid=$pos and bom.Mid=material.Mid Order BY bom.Order ASC;";
            $result_2 = mysqli_query($conn,$sql_2) or die("DB Error: Cannot retrieve message.");
            while ($row = mysqli_fetch_assoc($result_2)){
              echo "<tr><td class='text-center'>".$row['Order']."</td>";
              echo "<td class='text-center'>".$row['Name']."</td>";
              echo "<td class='text-center'>".$row['Count']."</td></tr>";
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