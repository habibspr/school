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
  $result_op = mysqli_query($link, "SELECT * FROM ac_head_mst");
  
  /// mobile nubmer ////
  $mobile_No = 0;
  $result_mobile_no = mysqli_query($link, "SELECT * FROM student_info, ac_cash_receive_dtl WHERE st_id = ac_crd_st_id ");
 if(mysqli_num_rows($result_mobile_no) > 0){
              while($row_mobile_amount = mysqli_fetch_assoc($result_mobile_no)){
				  $mobile_No = $row_mobile_amount['st_mobile'];
			  }
 }
 
 //getting sc_id
 $sc = 0;
 if(isset($_POST["sc_id"])){
     $sc = $_POST["sc_id"];
 }
 
?>
<form id="pay_now_form" action="" method="post" enctype="multipart/form-data">
  <div class="all_items">
    <div class="payment_item payment_item_1">
      <div class="form-group options_field">
        <select required="required" id="ac_crd_ahm_id_1" class="form-control ac_crd_ahm_id_1" name="ac_crd_ahm_id[]" required>
          <option selected disabled>Choose...</option>
          <?php
            if(mysqli_num_rows($result_op) > 0){
              while($options = mysqli_fetch_assoc($result_op)){?>
           
          <option value="<?php echo $options["ac_hm_id"];?>"><?php echo $options["ac_hm_name"];?></option>
          <?php }
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <input required="required" type="number" class="form-control qty" id="qty_1" name="qty[]" placeholder="Quantity" value="1">
      </div>
      <div class="form-group">
        <input readonly="readonly" required="required" type="text" class="form-control amount" id="amount_1" name="amount[]" placeholder="Amount">
      </div>
      <span class="delete_input">&#10006;</span>
    </div>
  </div>
  <button type="button" id="add_field" class="btn btn-info">Add New</button>
  <button type="submit" id="pay_now_btn" class="btn btn-primary">Pay Now</button>
</form>

<script type="text/javascript">
  $(document).ready(function(){
    var count = 1;
    
    $(".delete_input").click(function(){
        $(this).parent().remove();
    });

    function autoComplete(){
      $("select").change(function(){
		var td_paid = $('#td_paid').text();		
							
        var option_type = $(this).val();
        var qty = $(this).parent().siblings(".form-group").children(".qty").val();
        var amount = $(this).parent().siblings(".form-group").children(".amount");
		
		
        $.ajax({
          url: "functions.php",
          type: "POST",
          data: {"autoComplete":true, "option_type":option_type, "qty":qty, "sc":"<?php echo $sc;?>"},
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
          data: {"autoComplete":true, "option_type":option_type, "qty":qty, "sc":"<?php echo $sc;?>"},
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
          data: {"autoComplete":true, "option_type":option_type, "qty":qty, "sc":"<?php echo $sc;?>"},
          success: function(data){
            amount.val(data);
          }
        });
      });
    }
    autoComplete();

    $("#add_field").click(function(e){
      e.preventDefault();
      var id = "";
      for(var i = 1; i<=count; i++){
        id += "."+$("#ac_crd_ahm_id_"+i).val();
      }
      console.log(id);
      count++;
      $.ajax({
        url: "functions.php",
        type: "post",
        data: {"get_options":true},
        success: function(response){
          var item_count = 1;
          var all = response.split("|");
          var items_length = response.split("|").length;
          var option = "";
          while(item_count < items_length){ 
            var single_item = all[item_count].split("---");
              var a = id.split(".");
              var b = a.length;
              var check;
              for(var ii = 1; ii<b; ii++){
                console.log("Present-"+a[ii]+"num:"+ii);
                if(a[ii] == single_item[0]){check = false; break;}
                else {check = true;}
              }
            if(check == true){option += '<option value="'+single_item[0]+'">'+single_item[1]+'</option>';}
            item_count++;
          }

          $(".all_items").append('<div class="payment_item payment_item_'+count+'"><div class="form-group options_field"><select id="ac_crd_ahm_id_'+count+'" class="form-control ac_crd_ahm_id_'+count+'" name="ac_crd_ahm_id[]"><option selected>Choose...</option>'+option+'</select></div><div class="form-group"><input type="number" class="form-control qty" id="qty_'+count+'" name="qty[]" placeholder="Quantity" value="1"></div><div class="form-group"><input readonly="readonly" type="text" class="form-control amount" id="amount_'+count+'" name="amount[]" placeholder="Amount"></div><span class="delete_input">&#10006;</span></div>');
          $(".delete_input").click(function(){
        $(this).parent().remove();
      });
      autoComplete();
        }
      });
    });

    $("#pay_now_form").on("submit", function(e){
      e.preventDefault();
      var total_items = $(".payment_item").length;
      var get_st_id = $("#get_st_id").text();
      var data = new FormData(this);
      data.append("pay_form_submit", true);
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
			
          }else {
            alert("Payment Successfully submitted!");
/**
            var datas = data.split("-");

            // SMS System

            $.ajax({
              url: "../send_sms.php",
              type: "POST",
              data: {send_sms:true, number: datas[0], msg: "Hafez Abdur Rashid School & College - Name: "+datas[1]+", ID: "+datas[2]+". Payment Confirmed with TK "+datas[3]+"! Thank you."},
              success: function(data){
                alert(data);
              }
            });
**/
            //SMS System code end
          }
          var st_id = $("#form_st_id").val();
          $("#basic_info_con").load("basic_info.php", {"st_id":st_id});
          $("#payment_form").load("blank.php");
        }

      });

    });
  });
</script>