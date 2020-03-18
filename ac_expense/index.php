<?php include "../aagsn/header.php";?>
<?php include '../nav-bar.php';?>

<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";

?>
<style>
input[type="date"].form-control, input[type="time"].form-control, input[type="datetime-local"].form-control, input[type="month"].form-control {
	line-height: 1.42857143;
}
h3.page-heading {
    margin-top:0;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 class="page-heading text-success">Expense</h3>
        </div>
        <div class="col-md-6 hidden-print">
            <button  class="btn btn-xs btn-success pull-right" style="padding: 3px 9px;" id="form_toggle">
                <span id="toggle_icon" class="glyphicon glyphicon-plus"></span>
                </button>
        </div>
    </div>
                
   <div id="expense_form" class="hidden-print">
            <div class="row">
                <div class="form-group col-md-4 has-success">
                    <label for="ex_date" class="control-label has-success">Date</label>
                    <input class="form-control input-group date" type="text" name="ex_date" value="<?php echo date('Y-m-d');?>" id="ex_date" readonly>
                </div>
                <div class="form-group col-md-6 has-success">
                    <label for="ac_supplier_id" class="control-label">Supplier</label>
                    <select  class="form-control selectpicker" data-mobile="true" name="ac_head" id="ac_supplier_id" required>
                        <option value="" selected disabled>Select ..</option>
                    <?php 
                    $sql="SELECT * FROM supplier_mst"; 
                    foreach ($link->query($sql) as $row){
                        echo "<option value=$row[sm_id]>$row[sm_name], $row[sm_contact_person], $row[sm_address]</option>";
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <button name="show_supplier_form" class="form-control btn btn-info" id="show_supplier_form" style="margin-top: 25px;">Add Supplier</button>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4 has-success">
                    <label for="ac_head_id" class="control-label">Ac Head</label>
                    <select  class="form-control selectpicker" data-mobile="true" name="ac_head" id="ac_head_id" required>
                        <option value="" selected disabled>Select ..</option>
                    <?php 
                    $sql="SELECT * FROM ac_head_mst WHERE ac_hm_group='1'"; 
                    foreach ($link->query($sql) as $row){
                        echo "<option value=$row[ac_hm_id]>$row[ac_hm_name] </option>";
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group col-md-2 has-success">
                    <label for="ex_amount" class="control-label">Amount [BDT]</label>
                    <input type="number" min="0.00" class="form-control" name="ex_amount" placeholder="Amount" id="ex_amount" required/>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-10 has-success">
                    <input class="form-control" placeholder="Description " name="ex_comments" value="" id="ex_comments"/>
                </div>
                <div class="form-group col-md-2">
                    <button name="submit" class="form-control btn btn-success" id="create_expense" ><span class="glyphicon glyphicon-floppy-disk"> Save </span></button>
                </div>
            </div>
    </div>
    
    <div id="supplier_form" class="hidden-print">
            <div class="row">
                <div class="form-group col-md-6 has-success">
                    <label for="sm_name" class="control-label has-success">Name</label>
                    <input class="form-control" type="text" name="sm_name" placeholder="Supplier name..." value="" id="sm_name">
                </div>
                
                <div class="form-group col-md-6 has-success">
                    <label for="sm_contact_person" class="control-label has-success">Contact Person</label>
                    <input class="form-control" type="text" name="sm_contact_person" placeholder="Contact Person.." value="" id="sm_contact_person">
                </div>
                
                <div class="form-group col-md-6 has-success">
                    <label for="sm_contact_no" class="control-label has-success">Contact No.</label>
                    <input class="form-control" type="text" name="sm_contact_no" placeholder="Contact No. .." value="" id="sm_contact_no">
                </div>
                <div class="form-group col-md-6 has-success">
                    <label for="sm_address" class="control-label has-success">Contact Address</label>
                    <input class="form-control" type="text" name="sm_address" placeholder="Address ...." value="" id="sm_address">
                </div>
                
                <div class="form-group col-md-2">
                    <button name="supplier_save" class="form-control btn btn-success" id="supplier_save" ><span class="glyphicon glyphicon-floppy-disk"> Save </span></button>
                </div>
            </div>
            
    </div>

<div id = "Show_expense_data"></div>
 
 <script>
// toggle icon changing

$('#supplier_form').hide();

    $(document).ready(function(){
         $('#expense_form').hide();
        $('#form_toggle').click(function(){
            var status = $('#expense_form').is(':visible');
            
            
            
            if(status){
                $('#expense_form').hide('slow');
                $('#toggle_icon').removeClass('glyphicon glyphicon-minus');
                $('#toggle_icon').addClass('glyphicon glyphicon-plus');
            } else {
                $('#expense_form').show('slow');
                $('#toggle_icon').removeClass('glyphicon glyphicon-plus');
                $('#toggle_icon').addClass('glyphicon glyphicon-minus');
            }
        });
    }); 

 // insert data
            
  $(document).on('click', '#create_expense', function(e){  
           e.preventDefault();
            var ex_date = $("#ex_date").val();
            var ac_supplier_id = $("#ac_supplier_id").val();
            var ac_head_id = $("#ac_head_id").val();
            var ex_amount = $("#ex_amount").val();
            var ex_comments = $("#ex_comments").val();
            
            if(  ex_date=='' || ac_head_id=='' || ac_supplier_id=='' || ex_amount==''){
                alert('Check inputs');
                return;
            }
                $.ajax({  
                     url:"expense_create.php",  
                     method:"POST",  
                     data:{ 'ex_date':ex_date, 'ac_head_id':ac_head_id, 'ac_supplier_id':ac_supplier_id,  'ex_amount':ex_amount, 'ex_comments':ex_comments},  
                     success:function(data){ 
                         fetch_data(); // data show
                         $("#ac_supplier_id").val('');
                         $("#ac_head_id").val('');
                         $("#ex_amount").val('');
                         $("#ex_comments").val('');
                         
                         
                     }  
                });  
      });  
      
      
      
 // data delete
      $(document).on('click', '.btn_delete', function(){  
           var ace_id=$(this).data("id_delete");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"expense_delete.php",  
                     method:"POST",  
                     data:{ace_id:ace_id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });  
      
      
      
       // data approval
      $(document).on('click', '.btn_approved', function(){  
           var ace_id=$(this).data("approved");  
           if(confirm("Are you sure you want to Approve this?"))  
           {  
                $.ajax({  
                     url:"expense_approval.php",  
                     method:"POST",  
                     data:{ace_id:ace_id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });
      
      // data unapproval
      $(document).on('click', '.btn_unapproved', function(){  
           var ace_id=$(this).data("unapproved");  
           if(confirm("Are you sure you want to Approve this?"))  
           {  
                $.ajax({  
                     url:"expense_unapproval.php",  
                     method:"POST",  
                     data:{ace_id:ace_id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });
      
      // data showing 
      
      fetch_data();
      
      function fetch_data()  
      {  
           $.ajax({  
                url:"expense_select.php",  
                method:"POST",  
                success:function(data){  
                     $('#Show_expense_data').html(data);  
                }  
           });  
      } 
      
      
      //Button supplier show
      $(document).on('click', '#show_supplier_form', function(){ 
               $('#expense_form').hide('slow');
               $('#supplier_form').show('slow');
      });
      
      //Button supplier save
      $(document).on('click', '#supplier_save', function(){ 
               $('#expense_form').show('slow');
               $('#supplier_form').hide('slow');
      });
      
      
 </script>
 
 
 
</div><!--end Container -->


    