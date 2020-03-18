<?php 
// exm_teacher_subject_setting   index.php //
//https://material.io/collections/getting-started/  for google icon//

include '../aagsn/header.php';
include '../aagsn/nav-bar.php';

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


<script>
    // live search
    $(document).ready(function(){
        $("#search").keyup(function(){
            _this = this;
            
            // Show only matching TR, hide rest of them
            $.each($("#livesearch_table tbody tr"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                {  
                    $(this).hide();
                }
                else
                {
                    $(this).show();
                }
            });
        });
    });
</script>

<!--  for use icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Java Script Functions -->
<script type="text/javascript" src="etss_script.js"></script>

<div class="container">   
    <div class="col-sm-12">
        <h2 style="color: green; "> Attendance Setup Panel
            <button type="button" class="btn btn-success plus pull-right"><i class="fa fa-plus"></i></button>
            <button type="button" class="btn btn-success minus pull-right"><i class="fa fa-minus"></i></button>
        </h2>

        <div class="jumbotron">
            <h3>Teacher Subject Data Add </h3>

<form class="form-horizontal" action="" role="form" method="post">
    <div class="form-group">
        <div class="input-group input-group-lg">
            <span for="Session" class="input-group-addon" id="sizing-addon1">Session</span>
            <select  class="form-control selectpicker" data-mobile="true" name="Session" id="Session">
                <?php 
                $sql="SELECT distinct ss_year FROM st_session ORDER BY ss_year DESC"; 
                foreach ($link->query($sql) as $row){
                    echo "<option value=$row[ss_year]>$row[ss_year]</option>";
                }
                ?>            
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <div class="input-group input-group-lg">
            <span for="techer_id" class="input-group-addon" id="sizing-addon1">Teacher</span>
            <select  class="form-control selectpicker" data-mobile="true" name="techer_id" id="techer_id">
                <?php 
                $sql="SELECT * FROM teacher_info ORDER BY t_name ASC"; 
                foreach ($link->query($sql) as $row){
                    echo "<option value=$row[t_id]>$row[t_name]</option>";
                }
                ?>            
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <div class="input-group input-group-lg">
            <span for="class_id" class="input-group-addon" id="sizing-addon1">Class</span>
            <select  class="form-control selectpicker" data-mobile="true" name="class_id" id="class_id">
                <?php 
                $sql="SELECT * FROM st_class ORDER BY sc_id ASC"; 
                foreach ($link->query($sql) as $row){
                    echo "<option value=$row[sc_id]>$row[sc_name]</option>";
                }
                ?>            
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <div class="input-group input-group-lg">
            <span for="subject_id" class="input-group-addon" id="sizing-addon1">Subject</span>
            <select  class="form-control selectpicker" data-mobile="true" name="subject_id" id="subject_id">
                <?php 
                $sql="SELECT * FROM exm_subject_mst ORDER BY exm_sub_id ASC"; 
                foreach ($link->query($sql) as $row){
                    echo "<option value=".$row['exm_sub_id'].">".$row['exm_sub_code']." - ".$row['exm_sub_name']." </option>";
                }
                ?>            
            </select>
        </div>
    </div>
    
     <div class="form-group">
        <div class="input-group input-group-lg">
            <span for="status_code" class="input-group-addon" id="sizing-addon1">Status</span>
            <select  class="form-control selectpicker" data-mobile="true" name="status_code" id="status_code">
                <option selected>Select Status</option>            
                <option select='0'>Active</option>            
                <option select='1'>Inactive</option>            
            </select>
        </div>
    </div>
    
    
    <div class="form-group">
        <button type = "button" class="btn btn-lg btn-block btn-primary submit" aria-describedby="sizing-addon1"> Submit </button>
    </div>
</form> 
        </div> 
        
    </div>
    <div class="form-group">
        <div class="input-group input-group-lg">
            <span for="techer_id" class="input-group-addon" id="sizing-addon1">Search</span>
            <input type="text" class="form-control" id="search" class="form-control" id="sizing-addon1" autofocus />
        </div>
    </div>
    
    <div class="col-sm-12" >  
        <div class="table-responsive" id="livesearch_table">
            <table class="table table-bordered table-striped table-hover">   
                <thead >
                    <tr style=" background-color:green; color: white; ">
                        <th class="text-center" style="vertical-align:middle;">#Sl No.</th>
                        <th class="text-center" style="vertical-align:middle;"> Teacher Name </th>
                        <th class="text-center" style="vertical-align:middle;" > Session </th>
                        <th class="text-center" style="vertical-align:middle;" > Class </th>
                        <th class="text-center" style="vertical-align:middle;" > Subject </th>
                        <th class="text-center" style="vertical-align:middle;" > Status </th>
                        <th class="text-center" style="vertical-align:middle;" >  </th>
                    </tr>
                </thead>
                <?php
                $i = 1;
                $Result_Subject_Setting = mysqli_query($link, "SELECT * FROM exm_teach_sub_set, teacher_info WHERE t_id = etss_teach_id ORDER BY etss_teach_id ASC, etss_class_id ASC, etss_sub_id ASC");
                while ($row = mysqli_fetch_array($Result_Subject_Setting)){
                    
                    
                ?>
                <tbody>  
                    <tr>
                        <th class="text-center" style="vertical-align:middle;"><?php echo $i++;?></th>
                        <td class="text-left" style="vertical-align:middle;" >
                            <input type="text" name="etss_id" value = "<?php echo $row['etss_id'];?>"/>
                        </td>
                        <td class="text-left" style="vertical-align:middle;"><?php echo $row['t_name'];?></td>
                        <td class="text-center" style="vertical-align:middle;"><?php echo $row['etss_session'];?></td>
                        <td class="text-center" style="vertical-align:middle;"><?php echo $row['etss_class_id'];?></td> 
                        <td class="text-center" style="vertical-align:middle;"><?php echo $row['etss_sub_id'];?></td>
                        <td class="text-center" style="vertical-align:middle;" ><?php  echo $row['etss_status'];?></td>
                        <td class="text-center" style="vertical-align:middle;" >
                            <button type="button" class="btn btn-success add ">
                                <span style="font-size: 16px; color: white;"><i class="fa fa-plus-circle"></i></span>
                            </button>
                            <button type="button" class="btn btn-info edit ">
                            <span style="font-size: 16px; color: white;"><i class="fa fa-edit"></i></span>
                            </button>
                            <button type="button" class="btn btn-danger delete ">
                            <span style="font-size: 16px; color: white;"><i class="fa fa-minus-circle"></i></span>
                            </button>
                        </td>
                        <?php }?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
