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
            <h3 class="page-heading text-success">Student Leave</h3>
        </div>
        <div class="col-md-6">
            <button  class="btn btn-xs btn-primary pull-right hidden-print" style="padding: 3px 9px;" id="form_toggle">
                <span id="toggle_icon" class="glyphicon glyphicon-plus"></span>
                </button>
        </div>
    </div>
                
   <div class="row hidden-print" id="leave_form">
        <div class="col-md-6">
            <div class="row">
                <div class="form-group col-md-6 has-success">
                    <label for="class_id" class="control-label">Class</label>
                    <select  class="form-control selectpicker" data-mobile="true" name="class" id="class_id" required>
                        <option value="" disabled>Select Class</option>
                    <?php 
                    $sql="SELECT * FROM st_class"; 
                    foreach ($link->query($sql) as $row){
                        echo "<option value=$row[sc_id]>$row[sc_name] </option>";
                    }
                    ?>
                    </select>
                </div>
                
                <div class="form-group col-md-6 has-success">
                    <label for="roll" class="control-label">Roll</label>
                    <input type="text" name="txt" class="form-control" name="roll" placeholder="Roll" id="roll" required />
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-6 has-success">
                    <label for="startdate" class="control-label">Start Date</label>
                    <input class="form-control input-group date" type="date" name="startdate" value="<?php echo date('Y-m-d');?>" id="startdate" required>
                </div>
                
                <div class="form-group col-md-6 has-success">
                    <label for="enddate" class="control-label">End Date</label>
                    <input class="form-control input-group date" type="date" name="enddate" value="<?php echo date('Y-m-d');?>" id="enddate" required>
                </div>
            </div>
            
            <div class="form-group">
                <button name="submit" class="btn btn-success" id="create_leave" ><span class="glyphicon glyphicon-floppy-disk"> Save </span></button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-success">
                <label for="comments" class="control-label">Notes</label>
                <textarea class="form-control" placeholder="Notes for leave" style="width: 100%; height: 150px;" name="comments" value="" id="comments" required></textarea>
            </div>
        </div>
    </div>


<div id = "Show_leave_data"></div>
 
 <script>
// toggle icon changing

    $(document).ready(function(){
         $('#leave_form').hide();
        $('#form_toggle').click(function(){
            var status = $('#leave_form').is(':visible');
            
            if(status){
                $('#leave_form').hide('slow');
                $('#toggle_icon').removeClass('glyphicon glyphicon-minus');
                $('#toggle_icon').addClass('glyphicon glyphicon-plus');
            } else {
                $('#leave_form').show('slow');
                $('#toggle_icon').removeClass('glyphicon glyphicon-plus');
                $('#toggle_icon').addClass('glyphicon glyphicon-minus');
            }
        });
    }); 

 // insert data
            
  $(document).on('click', '#create_leave', function(e){  
           e.preventDefault();
            var class_id = $("#class_id").val();
            var roll = $("#roll").val();
            var startdate = $("#startdate").val();
            var enddate = $("#enddate").val();
            var comments = $("#comments").val();
            
            if(  class_id=='' || roll=='' || startdate=='' || enddate=='' || comments==''){
                alert('Check inputs');
                return;
            }
                $.ajax({  
                     url:"leave_create.php",  
                     method:"POST",  
                     data:{ class_id:class_id, roll:roll, startdate:startdate, enddate:enddate, comments:comments},  
                     success:function(data){  
                          fetch_data();
                            $("#class_id").val('');
                            $("#roll").val('');
                            $("#startdate").val('');
                            $("#enddate").val('');
                            $("#comments").val('');
                     }  
                });  
      });  
      
      
      
 // data delete
      $(document).on('click', '.btn_delete', function(){  
           var sl_id=$(this).data("id_delete");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"leave_delete.php",  
                     method:"POST",  
                     data:{sl_id:sl_id},  
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
           var sl_id=$(this).data("approved");  
           if(confirm("Are you sure you want to Approve this?"))  
           {  
                $.ajax({  
                     url:"leave_approval.php",  
                     method:"POST",  
                     data:{sl_id:sl_id},  
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
           var sl_id=$(this).data("unapproved");  
           if(confirm("Are you sure you want to Approve this?"))  
           {  
                $.ajax({  
                     url:"leave_unapproval.php",  
                     method:"POST",  
                     data:{sl_id:sl_id},  
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
                url:"leave_select.php",  
                method:"POST",  
                success:function(data){  
                     $('#Show_leave_data').html(data);  
                }  
           });  
      } 
 </script>
 
 
 
</div><!--end Container -->


    