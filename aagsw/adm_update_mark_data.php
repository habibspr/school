<!-- database connection -->
<?php include "../resources/db_aags_w.php" ;?>
<?php

    if(isset($_POST['form_no'])){ // Fetching variables of the form which travels in URL 
        $form_no = isset($_POST['form_no']) ? $_POST['form_no'] : '';
        $admark = isset($_POST['admark']) ? $_POST['admark'] : '';
        
        if(!empty($admark)){
            $resultmark=mysqli_query($link,"SELECT * FROM adm_marks WHERE am_form_id='$form_no'");
            
            if(mysqli_num_rows($resultmark)>0){                    
                mysqli_query($link, "UPDATE adm_marks SET am_mark='$admark' , am_status = '0' WHERE am_form_id='$form_no'");
                $markStatus="...Updated";
            }else{
                mysqli_query($link, "INSERT INTO adm_marks (am_form_id , am_mark, am_status ) VALUES('$form_no', '$admark', '0')");
                $markStatus="...Inserted";
            }
        }
        
        $resultprint = mysqli_query($link,  "SELECT * FROM adm_user_info, adm_marks, adm_class_mst WHERE aui_id=am_form_id AND acm_id=aui_class_id AND aui_id='$form_no'");
            if(mysqli_num_rows($resultprint) > 0){
                while($row = mysqli_fetch_array($resultprint)){            
                    
    ?>

    <div class="table-responsive">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <tr>
                <th class="text-center" style="vertical-align:middle;" colspan="3">D E T A I L S </th>
            </tr>
            <tr>
                <th class="text-right" style="vertical-align:middle;">Form No.</th>
                <th class="text-center" style="vertical-align:middle;">:</th>
                <td class="text-left" style="vertical-align:middle;" ><congratulations><b><?php echo $row['aui_form_no'];?></b></congratulations></td>
            </tr>
            <tr>
                <th class="text-right" style="vertical-align:middle;">Name</th>
                <th class="text-center" style="vertical-align:middle;">:</th>
                <td class="text-left" style="vertical-align:middle;" ><?php echo $row['aui_name'];?></td>
            </tr>
            <tr>
                <th class="text-right" style="vertical-align:middle;">Session</th>
                <th class="text-center" style="vertical-align:middle;">:</th>
                <td class="text-left" style="vertical-align:middle;" ><?php echo $row['aui_session'];?></td>
            </tr>
            <tr>
                <th class="text-right" style="vertical-align:middle;">Class</th>
                <th class="text-center" style="vertical-align:middle;">:</th>
                <td class="text-left" style="vertical-align:middle;" ><?php echo $row['acm_name'];?></td>
            </tr>
            <tr>
                <th class="text-right" style="vertical-align:middle;">Mark</th>
                <th class="text-center" style="vertical-align:middle;">:</th>
                <td class="text-left" style="vertical-align:middle;" ><sorry><strong><?php echo $row['am_mark'];?></strong></sorry></td>
            </tr>
            <tr>
                <th class="text-right" style="vertical-align:middle;">Status</th>
                <th class="text-center" style="vertical-align:middle;">:</th>
                <td class="text-left" style="vertical-align:middle;" ><congratulations><strong><?php echo "$markStatus"; }?></strong></congratulations></td>
            </tr>
        </table>                        
        <?php }  }?>
    </div>
