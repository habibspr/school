<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "../aagsn/header.php";?>
<?php include "../nav-bar.php";?>
<?php

    include "../resources/db_aags_n.php" ;
    include "../global.php" ;

    $result_ss = mysqli_query($link, "SELECT * FROM global_session_mst ORDER BY gsm_id DESC");
    $result_class = mysqli_query($link, "SELECT * FROM st_class ORDER BY sc_id DESC");
    $result_head = mysqli_query($link, "SELECT * FROM ac_head_mst ORDER BY ac_hm_id DESC");
?>

<div class="container">

    <form id="sm_input_form" name="form_login" method="post" action="" role="form">
    
        <div class="page-header text-center text-success"><h3>Session wise fee details</h3></div>
        <div class="row">
            <div class="form-group has-success col-sm-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Session</span>
                    <select required="required" id="sm_session" class="form-control" name="sm_session">
                        <option selected disabled>Choose...</option>
                        <?php if(mysqli_num_rows($result_ss) > 0){ while($row_ss = mysqli_fetch_assoc($result_ss)){?>
                            <option value="<?php echo $row_ss['gsm_id'];?>"><?php echo $row_ss['gsm_session'];?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group has-success col-sm-6">
                <div class="input-group input-group-sm">
                    <span for="sm_amount" class="input-group-addon">Class</span>
                    <select required="required" id="sm_class" class="form-control" name="sm_class">
                        <option selected value="0">All</option>
                        <?php if(mysqli_num_rows($result_class) > 0){ while($row_class = mysqli_fetch_assoc($result_class)){?>
                            <option value="<?php echo $row_class['sc_id'];?>"><?php echo $row_class['sc_name'];?></option>
                        <?php } } ?>
                    </select>
                    <span for="sm_amount" id="sm_class_search" class="input-group-addon btn-block ">search</span>
                </div>
            </div>
            
            <div class="form-group has-success col-sm-6">
                <div class="input-group input-group-sm">
                    <span for="sm_amount" class="input-group-addon">AC Head </span>
                    <select required="required" id="sm_head" class="form-control" name="sm_head">
                        <option selected disabled>Choose...</option>
                        <?php if(mysqli_num_rows($result_head) > 0){ while($row_head = mysqli_fetch_assoc($result_head)){?>
                            <option value="<?php echo $row_head['ac_hm_id'];?>"><?php echo $row_head['ac_hm_name'];?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>             
            <div class="form-group has-success col-sm-5">
                <div class="input-group input-group-sm  ">
                    <span for="sm_amount" class="input-group-addon">Amount</span>
                    <input required="required" type="text" class="form-control" id="sm_amount" name="sm_amount" placeholder="Enter Amount">
                </div>
            </div>
            <div class="form-group has-success col-sm-1">
                <button type="submit" name="Submit" class="btn btn-sm btn-block btn-success"><span class="glyphicon glyphicon-check"></span> Submit</button>
            </div>
        </div>
    </form>
    
    <div id ="show_data"></div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#sm_input_form").on("submit", function(e){
            e.preventDefault();
            var data = new FormData(this);
            data.append("sm_form_submit", true);

            //ajax

            $.ajax({
                url: "functions.php",
                type: "POST",
                contentType: false,
                processData: false,
                data: data,
                success: function(data){
                    if(data == 1){
                        $("input").val("");
                        alert("New Session Master Data Added!");
                    } else if(data == 3){
                        alert("Data already exist!");
                    }
                    else {
                        alert("Something went wrong! Try again later.");
                    }
                    
                    fetch_data();
                }
            });
        });
    });
    
    
    
    
   // data showing 
   
       $(document).ready(function(){
        $("#sm_class_search").on("click", function(e){
            e.preventDefault();
            fetch_data();
        });
       });
    
     
      
      //fetch_data();

      function fetch_data(){ 
          var sm_class = $("#sm_class").val();
           $.ajax({  
                url:"data_showing_session_mst.php",  
                method:"POST",  
                data:{sm_class:sm_class},
                success:function(data){  
                     $('#show_data').html(data);  
                }  
           });  
      } 
    
</script>