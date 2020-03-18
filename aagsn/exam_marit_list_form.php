<?php include "../aagsn/header.php";?>
<?php include '../nav-bar.php';?>

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
            <h3 class="page-heading text-success">Marit List</h3>
        </div>
        <div class="col-md-6">
            <button  class="btn btn-xs btn-primary pull-right hidden-print" style="padding: 3px 9px;" id="form_toggle">
                <span id="toggle_icon" class="glyphicon glyphicon-plus"></span>
                </button>
        </div>
    </div>
    <div class="row hidden-print" id="leave_form">
            <div class="form-group col-md-6 has-success">
                <label for="exam_id" class="control-label">Exam</label>
                <select  class="form-control selectpicker" data-mobile="true" name="class" id="exam_id" required>
                    <option value="" disabled>Select Exam</option>
                <?php 
                $sql="SELECT * FROM exm_mst ORDER BY exm_id DESC"; 
                foreach ($link->query($sql) as $row){
                    echo "<option value=$row[exm_id]>$row[exm_name], $row[exm_year] </option>";
                }
                ?>
                </select>
            </div>
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
                <button name="submit" class="btn btn-success" id="create_leave" ><span class="glyphicon glyphicon-floppy-disk"> Save </span></button>
            </div>
        </div>
    </div>
    <div id = "Show_marit_list"></div>
 
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

 // Show data
            
  $(document).on('click', '#create_leave', function(e){  
           e.preventDefault();
            var exam_id = $("#exam_id").val();
            var class_id = $("#class_id").val();
            
            if(  class_id=='' ){
                alert('Check inputs');
                return;
            }
                $.ajax({  
                     url:"exam_print_marit_list.php",  
                     method:"POST",  
                     data:{ exam_id:exam_id, class_id:class_id},  
                     success:function(data){  
                          $('#Show_marit_list').html(data); 
                            //$("#class_id").val('');
                     }  
                });  
      });  
      
  
    
      
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


    