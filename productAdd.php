<?php
  session_start();
  require("materialModel.php");

  function fill_select_box($conn){
    
    $output = '';
    $material = getMaterial();
    foreach ($material as $i){
      $output .= '<option value="'.$i['Mid'].'">'.$i['Name'].'</option>';
    }
    return $output;
  }
?>

<html lang="en">
<head>
  <title>新增產品</title>
  <?php include("style/_site_header.php"); ?>
</head>
<body>
  <?php include("style/_site_navbar.php"); ?>
  <div class="container my-5">
    <h2 class="text-center">Add Product</h2>
    <form method="post" id="insert_form" >
      <div id="item_table">
        <div class="row">
          <div class="col mb-3"><label for="pname">產品名稱</label></div>
        </div>
        
        <div class="row">
          <div class="col mb-5"><input type="text" name="pname" class="form-control pname" placeholder="請輸入產品名稱" required/></div>
        </div>

        <div class="row">
          <div class="col mb-3">
            <label class="alert-danger">請按照產品製作順序新增原料</label>
          </div>
        </div>
      </div>
      
      <div class="text-center">
        <button type="submit" class="btn btn-dark my-3" id="saveBtn">Save</button>
      </div>
      
    </form>
  </div>
<script>
  $(document).ready(function(){

    var count = 0;

    function add_input_field(count){
      var html = '';

      html += '<div class="row">';
      html += '<div class="col-md-6 mb-3"><select name="item_select[]" class="form-control selectpicker" data-live-search="true"><option value="">請選擇原料</option><?php echo fill_select_box($conn); ?></select></div>';
      html += '<div class="col-md-5 mb-3"><input type="text" name="item_count[]" class="form-control item_count" placeholder="請輸入數量" required/></div>';
      html += '<div class="col-md-1 mb-3"><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></div></div>';
      
      return html;
    }

    $('#item_table').append(add_input_field(0));
	  $('.selectpicker').selectpicker('refresh');

    $(document).on('click', '.add', function(){

      count++;
      $('#item_table').append(add_input_field(count));
      $('.selectpicker').selectpicker('refresh');
    });

    $('#insert_form').on('submit', function(event){

      event.preventDefault();
      var error = '';

      count = 1;
      $('.item_count').each(function(){
        if($(this).val() == ''){
          error += "<li>Enter Item Count at "+count+" Row</li>";
        }
        count = count + 1;
      });

      count = 1;
      $("select[name='item_select[]']").each(function(){
        if($(this).val() == ''){
          error += "<li>Select item at "+count+" Row</li>";
        }
        count = count + 1;
      });

      var form_data = $(this).serialize();
      if (error == ''){
        $.ajax({
          url:"productAddController.php",
          method:"POST",
          data:form_data,
          beforeSend:function(){
            $('#saveBtn').attr('disabled', 'disabled');
          },

          success:function(data){
            console.log(data)
            if(data.msg != ''){
              window.location.href = "product.php";
            }
          }
        })
      } else {
        $('#error').html('<div class="alert alert-danger"><ul>'+error+'</ul></div>');
      }
    });  
  });
</script>
</body>
<?php include("style/_site_footer.php"); ?>
</html>