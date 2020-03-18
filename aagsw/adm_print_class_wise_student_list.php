<?php include "header.php" ;?>
<?php include 'nav-bar.php';?>
<div class="container">
    <?php 
    if(isset($_POST['adclass'])){ // Fetching variables of the form which travels in URL 
        
        $session = isset($_POST['session']) ? $_POST['session'] : '';
        $adclass = isset($_POST['adclass']) ? $_POST['adclass'] : '';
        $payment = isset($_POST['adfmayment']) ? $_POST['adfmayment'] : '';
    }
	
	// class name searching
	$resultClassName = mysqli_query($link,  "SELECT * FROM adm_class_mst WHERE acm_id='$adclass' ");
                        while($row = mysqli_fetch_array($resultClassName)){
                            $ClassName = $row['acm_name'];
                        }
	
	
	?>
    
    
    
    <style>
       congrats {
            font-weight:bold;
            color: green;
        }
        sorry {
            font-weight:bold;
            color: crimson;
        }
        
    </style>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align:middle;" colspan="6">
                    <h3><strong>Student List</strong> -  Admission test <?php echo "$session";?></h3>
                        <?php
                        $flag=0;
                        $resultpaid = mysqli_query($link,  "SELECT * FROM adm_user_info WHERE aui_class_id='$adclass' AND aui_session='$session' ");
                        while($row = mysqli_fetch_array($resultpaid)){
                            $flag=1;
                        }
                        if($flag==0){?>
                        <div class="alert alert-danger fade in text-left">
                            <strong>Notice ! </strong><?php echo "$adclass"; ?>  Data not found !
                        </div>
                        <?php die(); }  ?>
                    </th>                    
                </tr>
                <tr>
                    <th class="text-right" style="vertical-align:middle;">Session </th>
                    <th class="text-center" style="vertical-align:middle;">: </th>
                    <td class="text-left" style="vertical-align:middle;"><?php echo "$session";?> </td>
                     <th class="text-right" style="vertical-align:middle;">Class </th>
                    <th class="text-center" style="vertical-align:middle;">: </th>
                    <td class="text-left" style="vertical-align:middle;"><?php echo "$ClassName"; ?></td>
                </tr>
                <tr>
                    <th class="text-center" style="vertical-align:middle;">SL No.</th>
                    <th class="text-center" style="vertical-align:middle;">Form No.</th>
                    <th class="text-center" style="vertical-align:middle;">Name</th>
                    <th class="text-center" style="vertical-align:middle;">Date of Birth</th>
                    <th class="text-center" style="vertical-align:middle;">Mobile</th>
                    <th class="text-center" style="vertical-align:middle;">Status</th>
                </tr>
            </thead>
            <?php 
            $i=1; 
            if ($payment>0){
            $resultpaid = mysqli_query($link,  "SELECT * FROM adm_user_info WHERE aui_class_id='$adclass' AND aui_session='$session' ");
                while($row = mysqli_fetch_array($resultpaid)){
                    
            ?>
            <tr>
                <td class="text-center" style="vertical-align:middle;"><?php echo $i++;?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['aui_form_no'];?></td>
                <td class="text-left" style="vertical-align:middle;"><?php echo $row['aui_name'];?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['aui_dob'];?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['aui_mobile'];?></td>
                <td class="text-center" style="vertical-align:middle;"><congrats>Paid</congrats></td>
            </tr>
            <?php   }
                }else{
                $resultunpaid = mysqli_query($link,  "SELECT * FROM adm_user_info WHERE aui_class_id='$adclass' AND aui_session='$session' AND aui_adf_payment=0");
                while($row = mysqli_fetch_array($resultunpaid)){?>
            <tr>
                <td class="text-center" style="vertical-align:middle;"><?php echo $i++;?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['aui_form_no'];?></td>
                <td class="text-left" style="vertical-align:middle;"><?php echo $row['aui_name'];?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['aui_dob'];?></td>
                <td class="text-center" style="vertical-align:middle;"><?php echo $row['aui_mobile'];?></td>
                <td class="text-center" style="vertical-align:middle;"><sorry>Unpaid</sorry></td>
            </tr>
           <?php }
            }
            ?>
             <tfoot><th  class="text-center page-number" style="vertical-align:middle;" colspan="6"></th></tfoot>  
        </table>
    </div>
   
   <p class="text-left"><br> Head Master: </p>
</div><!-- container -->


