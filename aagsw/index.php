<?php include "header.php" ;?>

<?php 
include "adm_database_status.php";

if($General_Security_Status){ ?>
<div class="alert alert-success fade in">
    <strong>Permission ! </strong> You are not permitted !
</div> 

<?php die(); } ?>


<?php include "nav-bar.php" ;?>

<?php

if(date('m')>6){ 
    
    $Security_Session= date('Y')+1; 
    
}else{ 
    
    $Security_Session= date('Y'); 
    
}

$Paid=200;
?>


<div class="container">   
    
    <div class="page-header">
        <h1 class="text-center"> Admission Information - <?php echo "$Security_Session";?></h1>
    </div>
    
    <div class="table-responsive">        
       <table class="table table-bordered table-hover">
           <thead>
                <tr>
                    <th class="text-center" style="vertical-align:middle;"> # Serial No. </th>
                    <th class="text-center" style="vertical-align:middle;"> Class </th>
                    <th class="text-center" style="vertical-align:middle;"> Total Student </th>
                    <th class="text-center" style="vertical-align:middle;"> <congratulations> # </congratulations>Paid </th>
                    <th class="text-center" style="vertical-align:middle;"><sorry> # </sorry> Unpaid </th>

                </tr>
           </thead>
<?php 
    $Counter=1;
    $Class_Name=0;
    
    $resultclass= mysqli_query($link, "SELECT * FROM adm_class_mst ORDER BY acm_id ASC");
            while ($row = mysqli_fetch_array($resultclass)){
                $Class_Id=$row['acm_id'];
                $Class_Name=$row['acm_name'];
            
                $Total_Student=0;
                $studentcount = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_session='$Security_Session'");
                $Total_Student = mysqli_num_rows($studentcount);
                
                $Total_Student_Paid=0;
                $studentcountpaid = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_session='$Security_Session' AND aui_adf_payment='$Paid' ");
                $Total_Student_Paid = mysqli_num_rows($studentcountpaid);
                
                $Total_Student_Unpaid=0;
                $studentcountunpaid = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_session='$Security_Session' AND aui_adf_payment<'$Paid' ");
                $Total_Student_Unpaid = mysqli_num_rows($studentcountunpaid);
                
                $Total_Student_Class=0;
                $studentcount = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_class_id = $Class_Id AND aui_session = '$Security_Session'");
                $Total_Student_Class = mysqli_num_rows($studentcount); 
                
                $Total_Student_Paid_Class=0;
                $studentcountpaid = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_class_id=$Class_Id AND aui_session='$Security_Session' AND aui_adf_payment='$Paid' ");
                $Total_Student_Paid_Class = mysqli_num_rows($studentcountpaid);
                
                $Total_Student_Unpaid_Class=0;
                $studentcountunpaid = mysqli_query($link, "SELECT * FROM adm_user_info WHERE aui_class_id=$Class_Id AND aui_session='$Security_Session' AND aui_adf_payment<'$Paid' ");
                $Total_Student_Unpaid_Class = mysqli_num_rows($studentcountunpaid);
            ?>
           <tbody>
               <tr>
                    <td class="text-center" style="vertical-align:middle;"><?php echo $Counter++;?></td>
                    <td class="text-left" style="vertical-align:middle;"><?php echo $Class_Name;?></td>
                    <th class="text-center" style="vertical-align:middle;"><?php echo $Total_Student_Class;?></th>
                    <td class="text-center" style="vertical-align:middle;"><congratulations><?php echo $Total_Student_Paid_Class;?></congratulations></td>
                    <td class="text-center" style="vertical-align:middle;"><sorry><?php echo $Total_Student_Unpaid_Class;}?></sorry></td>
                </tr>
           </tbody>
           <tfoot>
                <tr>
                    <th class="text-right" style="vertical-align:middle;" colspan="2">Total</th>
                    <th class="text-center" style="vertical-align:middle;" ><?php echo $Total_Student;?></th>
                    <th class="text-center" style="vertical-align:middle;" ><?php echo $Total_Student_Paid;?></th>
                    <th class="text-center" style="vertical-align:middle;" ><?php echo $Total_Student_Unpaid;?></th>
                </tr>
           </tfoot>           
        </table>
    </div>
</div>




