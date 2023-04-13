<?php
  session_start();
  require("scheduleModel.php");
  require("materialModel.php");

  $material = getMaterial();

  function fill_select_box($conn){
    
    $output = '';
    $schedule = getSchedule();
    
    foreach ($schedule as $i) {
      $output .= '<option value="'.$i['Sid'].'">排程'.$i['Sid'].'</option>';
    }
    return $output;
  }
?>

<html lang="en">
<head>
  <title>排程</title>
  <?php include("style/_site_header.php"); ?>
</head>
<body>
  <?php include("style/_site_navbar.php"); ?>
  <div class="container my-5">
    <h2 class="text-center">Add Order</h2>
    <form method="post" id="insert_form">
      <div id="item_table">
        <label for="sid">排程</label>
      </div>
      <!-- <div class="col-md-12 mb-3"><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></div> -->

      <br><br><br>
      <label for="mid">原料</label>
      <select class="form-control" name="mid" id="mid" />
        <option disabled selected value><?php echo '請選擇原料' ?></option>
        <?php foreach ($material as $i) { ?>
          <option value="<?php echo $i['Mid'] ?>"><?php echo $i['Name'] ?></option>
        <?php } ?>
      </select>
      <br>

      <label for="num">數量</label>
      <input class="form-control" name="num" type="text" id="num" placeholder="請輸入數量"/>
      <br><br><br>

      <div class="text-center">
        <button type="submit" class="btn btn-dark" id="saveBtn">送出</button>
      </div>
    </form>
  </div>

  <script>
    $(document).ready(function() {
      var count = 0;

      function add_input_field(count) {
        var html = '';

        html += '<div class="row">';
        html += '<div class="col-md-11 mb-3"><select name="item_select[]" class="form-control selectpicker" data-live-search="true"><option value="">請選擇排程</option><?php echo fill_select_box($conn); ?></select></div>';
        html += '<div class="col-md-1 mb-3"><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></div></div>';
        
        return html;
      }

      $('#item_table').append(add_input_field(0));
      $('.selectpicker').selectpicker('refresh');

      $(document).on('click', '.add', function() {
        count++;
        $('#item_table').append(add_input_field(count));
        $('.selectpicker').selectpicker('refresh');
      });

      $('#insert_form').on('submit', function(event) {
        event.preventDefault();
        var error = '';

        // count = 1;
        // $('.item_count').each(function() {
        //   if ($(this).val() == '') {
        //     error += "<li>Enter Item Count at " + count + " Row</li>";
        //   }
        //   count = count + 1;
        // });

        count = 1;
        $("select[name='item_select[]']").each(function() {
          if ($(this).val() == '') {
            error += "<li>Select item at " + count + " Row</li>";
          }
          count = count + 1;
        });

        var form_data = $(this).serialize();
        if (error == '') {
          $.ajax({
            url: "orderAddController.php",
            method: "POST",
            data: form_data,
            beforeSend: function() {
              $('#saveBtn').attr('disabled', 'disabled');
            },

            success: function(data) {
              if (data.msg != '') {
                // $('#item_table').find('tr:gt(0)').remove();
                // $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
                // $('#item_table').append(add_input_field(0));
                // $('.selectpicker').selectpicker('refresh');
                // $('#saveBtn').attr('disabled', false);
                window.location.href = "order.php?m=" + data.msg;
              }
            }
          })
        } else {
          $('#error').html('<div class="alert alert-danger"><ul>' + error + '</ul></div>');
        }
      });
    });
  </script>
</body>

<?php include("style/_site_footer.php"); ?>
</html>