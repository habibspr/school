<style type="text/css">
  .payment_item {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }
  .payment_item>div {
    width: 30%;
    margin: 10px;
    box-sizing: border-box;
  }
</style>
<?php 
  include "../resources/db_aags_n.php";
  $result_ss = mysqli_query($link, "SELECT gsm_id, gsm_session FROM global_session_mst ORDER BY gsm_id DESC");
    $ss_row = mysqli_fetch_assoc($result_ss);
    $current_session_id = $ss_row["gsm_id"];
    $current_session = $ss_row["gsm_session"];
  
  if(isset($_POST["mr"])){
        $get_mr_id = $_POST["mr"];
        $get_st_id = $_POST["st_id"];

        $result_transaction_details = mysqli_query($link, "SELECT * FROM ac_cash_receive_dtl INNER JOIN ac_head_mst ON ac_crd_ahm_id = ac_hm_id WHERE ac_crd_mr_no = '$get_mr_id' AND ac_crd_gsm_id = '$current_session_id'");
    }
 
?>
<form id="pay_now_form_update" action="" method="post" enctype="multipart/form-data">
  <div class="all_items">
  	<?php
        if(mysqli_num_rows($result_transaction_details) > 0){
            $i = 1;
            $total_amount_of_transaction = 0;
            while ($row_transaction_details = mysqli_fetch_assoc($result_transaction_details)) {
    ?>
    <div class="payment_item payment_item_1">
      <div class="form-group options_field">
          <lebel class="form-group" >Fee Head</lebel>
        <select required="required" id="ac_crd_ahm_id_1" class="form-control ac_crd_ahm_id_1" name="ac_crd_ahm_id[]" required>
          <option selected disabled>Choose...</option>
          <?php $result_op = mysqli_query($link, "SELECT * FROM ac_head_mst");
            if(mysqli_num_rows($result_op) > 0){
              while($options = mysqli_fetch_assoc($result_op)){?>
           
          <option <?php if($row_transaction_details["ac_hm_id"] == $options["ac_hm_id"]){echo "selected";}?> value="<?php echo $options["ac_hm_id"];?>"><?php echo $options["ac_hm_name"];?></option>
          <?php }
            }
          ?>
        </select>
      </div>
      <div class="form-group">
          <lebel class="form-group" >Qty.</lebel>
        <input required="required" type="number" class="form-control qty" id="qty_1" name="qty[]" placeholder="Quantity" value='<?php echo $row_transaction_details["ac_crd_qty"];?>'>
      </div>
      <div class="form-group">
          <lebel class="form-group" >Amount</lebel>
        <input required="required" type="text" class="form-control amount" id="amount_1" name="amount[]" placeholder="Amount" value='<?php echo $row_transaction_details["ac_crd_amount"];?>'>
      </div>
      <div class="form-group">
        <input required="required" type="hidden" class="form-control ac_crd_id" id="ac_crd_id_1" name="ac_crd_id[]" value='<?php echo $row_transaction_details["ac_crd_id"];?>'>
      </div>
    </div>
<?php } }?>
  </div>
  <button type="submit" id="pay_now_btn" class="btn btn-primary">Update Now</button>
</form>

<script type="text/javascript">
  $(document).ready(function(){
    var count = 1;

    function autoComplete(){
      $("select").change(function(){
		var td_paid = $('#td_paid').text();		
							
        var option_type = $(this).val();
        var qty = $(this).parent().siblings(".form-group").children(".qty").val();
        var amount = $(this).parent().siblings(".form-group").children(".amount");
		
		
        $.ajax({
          url: "functions.php",
          type: "POST",
          data: {"autoComplete":true, "option_type":option_type, "qty":qty},
          success: function(data){
            amount.val(data);
			var new_paid_amount = eval(td_paid) + eval(data) ;
			$('#td_paid').text(new_paid_amount);
          }
        });
      });

      /*QTY on Change*/

      $("input").change(function(){
        var qty = $(this).val();
        var option_type = $(this).parent().siblings(".form-group").children("select").val();
        var amount = $(this).parent().siblings(".form-group").children(".amount");
        $.ajax({
          url: "functions.php",
          type: "POST",
          data: {"autoComplete":true, "option_type":option_type, "qty":qty},
          success: function(data){
            amount.val(data);
          }
        });
      });

      /*QTY on keyup*/

      $("input").keyup(function(){
        var qty = $(this).val();
        var option_type = $(this).parent().siblings(".form-group").children("select").val();
        var amount = $(this).parent().siblings(".form-group").children(".amount");
        $.ajax({
          url: "functions.php",
          type: "POST",
          data: {"autoComplete":true, "option_type":option_type, "qty":qty},
          success: function(data){
            amount.val(data);
          }
        });
      });
    }
    autoComplete();

    $("#pay_now_form_update").on("submit", function(e){
      e.preventDefault();
      var total_items = $(".payment_item").length;
      var get_st_id = $("#get_st_id").text();
      var data = new FormData(this);
      data.append("pay_form_submit_update", true);
      data.append("total_items", total_items);
      data.append("payment_st_id", get_st_id);

      $.ajax({
        url: "functions.php",
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data){
          if(data == 2){
            alert("Payment Failed!");
			
          }
          else {
            alert("Payment Updated!");
          }
          var st_id = $("#form_st_id").val();
          $("#basic_info_con").load("basic_info.php", {"st_id":st_id});
          $("#payment_form").load("blank.php");
        }

      });

    });
  });
</script>