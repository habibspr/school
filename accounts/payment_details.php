<!-- database connection -->

<?php include "../aagsn/header.php" ;?>
<?php include "methods.php" ;?>
<link href="css/style.css" rel="stylesheet">

<?php

    $result_ss = mysqli_query($link, "SELECT gsm_id, gsm_session FROM global_session_mst ORDER BY gsm_id DESC");
    $ss_row = mysqli_fetch_assoc($result_ss);
    $current_session_id = $ss_row["gsm_id"];
    $current_session = $ss_row["gsm_session"];

    if(isset($_POST["mr"])){
        $get_mr_id = $_POST["mr"];
        //$get_st_id = $_POST["st_id"];
        //$get_st_id=1;
        }
        
        $result_transaction_details = mysqli_query($link, "SELECT * FROM ac_cash_receive_dtl 
		INNER JOIN ac_head_mst ON ac_crd_ahm_id = ac_hm_id 
		WHERE ac_crd_mr_no = '$get_mr_id' AND ac_crd_gsm_id = '$current_session_id'");

        $result_payment_details = mysqli_query($link, "SELECT * FROM ac_cash_receive_dtl 
		INNER JOIN ac_head_mst ON ac_crd_ahm_id = ac_hm_id 
		WHERE ac_crd_mr_no = '$get_mr_id' AND ac_crd_gsm_id = '$current_session_id' LIMIT 1");
    
?>
        
        <section class="main">
            <div class="container">
                <div class="text-center" id="header_line" style="font-size:6px; color:darkgreen;">
                    The future begins here..The future begins here..The future begins here..The future begins here..The future begins here..The future begins here..The future begins here..The future begins here..The future begins here..The future begins here..The future begins here..The future begins here.. 
                </div>
                <h1 style="margin-top: -5px; margin-bottom: 0px; ">Money Receipt</h1>
                
                <div class="flex_row">
                    <div class="flex-item">
                        <table class="table-custom small" >
                            <tr>
                                <td>MR NO:</td>
                                <th><?php echo $get_mr_id;?></th>
                            </tr>
                            <?php
                                if(mysqli_num_rows($result_payment_details) > 0){
                                    while ($row_payment_details = mysqli_fetch_assoc($result_payment_details)) {
                                        $t_info = $row_payment_details["ac_crd_ref_id"];
                                        $get_st_id=$row_payment_details["ac_crd_st_id"];
                                        $result_ref = mysqli_query($link, "SELECT * FROM teacher_info WHERE t_id = '$t_info'");
                                        $ref_info = mysqli_fetch_assoc($result_ref);
                            ?>
                            <tr>
                                <td>Date:</td>
                                <th><?php echo $row_payment_details["ac_crd_date"];?></th>
                            </tr>
                            <tr>
                                <td>Time:</td>
                                <th><?php echo $row_payment_details["ac_crd_time"];?></th>
                            </tr>
                            <tr>
                                <td>Prepared By:</td>
                                <th><?php echo $ref_info["t_name"].", ".$ref_info["t_des"];?></th>
                            </tr>
                        <?php } } ?>
                        </table>
                    </div>
                    <div class="flex-item" style="padding-left: 20px;">
                        <table class="table table-bordered table-responsive small">
                            <?php $result_student_details = mysqli_query($link, "SELECT *
                                    FROM (((student_info
                                        INNER JOIN st_session ON student_info.st_id = st_session.ss_st_id)
                                        INNER JOIN st_class ON st_class.sc_id = st_session.ss_class_id) 
                                        INNER JOIN st_group ON st_group.sg_id = st_session.ss_group_id) 
                                        WHERE student_info.st_id = '$get_st_id'");
                            
                                    while ($row_student_details = mysqli_fetch_assoc($result_student_details)) {
                            ?>
                            <tr>
                                <td>ID</td>
                                <th><?php echo $row_student_details["st_code"];?></th>
                            </tr>
                            <tr>
                                <td>Name:</td>
                                <th><?php echo $row_student_details["st_name"];?></th>
                            </tr>
                            <tr>
                                <td>Class:</td>
                                <th><?php echo $row_student_details["sc_name"];?></th>
                            </tr>
                            <tr>
                                <td>Group:</td>
                                <th><?php echo $row_student_details["sg_group"];?></th>
                            </tr>
                            <tr>
                                <td>Roll:</td>
                                <th><?php echo $row_student_details["ss_roll"];?></th>
                            </tr>
                        <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="main">
            <div class="container">

                <h4>Details</h4>
                <table class="table table-bordered table-responsive small">
                    <tr>
                        <th># SL</th>
                        <th>Description</th>
                        <th>QTY</th>
                        <th>Amount (BDT)</th>
                    </tr>
                    <?php
                        if(mysqli_num_rows($result_transaction_details) > 0){
                            $i = 1;
                            $total_amount_of_transaction = 0;
                            while ($row_transaction_details = mysqli_fetch_assoc($result_transaction_details)) {
                                $total_amount_of_transaction += $row_transaction_details["ac_crd_amount"];
                            ?>
                                
                            
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row_transaction_details["ac_hm_name"];?></td>
                        <td><?php echo $row_transaction_details["ac_crd_qty"];?></td>
                        <td><?php echo $row_transaction_details["ac_crd_amount"];?> /-</td>
                    </tr>
                <?php $i++; }
                        }
                    ?>
                    <tr>
                        <th colspan="3" class="text-right">Total</th>
                        <th><?php echo $total_amount_of_transaction;?> /-</th>
                    </tr>
                </table>
                <p style="text-transform:capitalize;">Taka in word : <strong> <?php echo numberTowords($total_amount_of_transaction);?> </strong> Only</p> <br><br>
                <p style="border-top: 1px solid #ccc; display: inline-block;">Received By</p>
            </div>
        </section>
      
