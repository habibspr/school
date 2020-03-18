<!-- database connection -->
<?php include "../resources/db_aags_n.php" ;?>
<?php include "../resources/dbo_aags_n.php" ;?>
<?php include "../global.php" ;?>

<?php

$result_ss = mysqli_query($link, "SELECT * FROM global_session_mst ORDER BY gsm_id DESC");
$ss_row = mysqli_fetch_assoc($result_ss);
$current_session_id = $ss_row["gsm_id"];
$current_session = $ss_row["gsm_session"];
$current_session_start = $ss_row["gsm_session_start"];
$current_session_end = $ss_row["gsm_session_end"];

$current_date = date("Y-m-d");


$paid = 0;    
$st_id = -1;    
if(isset($_POST["st_id"]) or isset($_POST["roll"])){
    
        if(!isset($_POST["st_id"])){
            $class_id = $_POST["class_id"];
            $roll = $_POST["roll"];
            $result_st = mysqli_query($link, "SELECT ss_st_id FROM st_session WHERE ss_class_id = '$class_id' AND ss_roll = '$roll'");
            $st_id = mysqli_fetch_assoc($result_st)["ss_st_id"];
        } else {
            $st_id = $_POST["st_id"];
            
            //getting class id by st_id
            $result_cls = mysqli_query($link, "SELECT ss_class_id FROM st_session WHERE ss_st_id = '$st_id'");
            $cls_row = mysqli_fetch_assoc($result_cls);
            $cls_id = $cls_row["ss_class_id"];
        }

        $result = mysqli_query($link, "SELECT st_id, st_code, st_name, ss_year, ss_roll, ss_class_id, sc_name
                    FROM ((student_info
                    INNER JOIN st_session ON student_info.st_id = st_session.ss_st_id)
                    INNER JOIN st_class ON st_class.sc_id = st_session.ss_class_id) WHERE student_info.st_id = '$st_id'");
    $result_paid = mysqli_query($link, "SELECT * FROM ac_cash_receive_dtl INNER JOIN global_session_mst ON ac_cash_receive_dtl.ac_crd_gsm_id = global_session_mst.gsm_id WHERE ac_crd_st_id = '$st_id' AND gsm_session = '$current_session'");

    $result_due = mysqli_query($link, "SELECT * FROM ac_session_mst INNER JOIN ac_head_mst ON ac_head_mst.ac_hm_id = ac_session_mst.ac_sm_ahm_id WHERE ac_sm_gsm_id = '$current_session_id' AND ac_sm_class_id = '$cls_id'");
}

$result_transaction = mysqli_query($link, "SELECT DISTINCT ac_crd_mr_no, ac_crd_date, ac_crd_time, ac_crd_status FROM ac_cash_receive_dtl WHERE ac_crd_st_id = '$st_id' AND ac_crd_gsm_id = '$current_session_id' ORDER BY ac_crd_mr_no DESC");
                        
                
?>
<table class="table table-bordered table-responsive">
                    <?php
                        if($st_id <= 0){
                            die();
                        }
                        if (mysqli_num_rows($result) > 0) {?>
                    <tr style="background:#ebf1f2;">
                        <th>ID</th>
                        <th>Name</th>
                        <th >Class</th>
                        <th>Roll</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                            <?php
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {?>
                              <td><?php echo $row["st_code"]?></td>
                              <td><?php echo $row["st_name"]?></td>
                              <td id="sc" class="hidden"><?php echo $row["ss_class_id"]?></td>
                              <td><?php echo $row["sc_name"]?></td>
                              <td><?php echo $row["ss_roll"]?></td>
                              <td style="display: none;" id="get_st_id"><?php echo $row["st_id"]?></td>
                        <?php }
                            // output data of paid td
                            while($row_paid = mysqli_fetch_assoc($result_paid)) {
                                $paid = $paid + $row_paid["ac_crd_amount"]; }?>
                                <td id = "td_paid"><?php echo $paid;?></td>

                                <!--due calculation-->
                                <?php
                                    $month_qty = 0;
                                    $monthly_total = 0;
                                    $other_total = 0;

                                    //session calculation

                                    //session start data
                                    $date_start=date_create($current_session_start);
                                    $start_date_timestamp = strtotime($current_session_start);

                                    //session start data
                                    $date_end=date_create($current_session_end);
                                    $end_date_timestamp = strtotime($current_session_end);

                                    //running month
                                    $running_date = date_create(date("Y-m-d"));
                                    $running_date_timestamp = strtotime(date("Y-m-d"));

                                    //declear variable
                                    $total_money = 0;

                                        //calculate month
                                        $month_qty = date_diff($date_start,$running_date)->format("%m") + 1;

                                        while($row_due = mysqli_fetch_assoc($result_due)) {
                                            if($running_date_timestamp > $start_date_timestamp && $running_date_timestamp <= $end_date_timestamp && $row_due["ac_hm_category"] == "MONTHLY"){
                                                $monthly_total = (int)$month_qty * (int)$row_due["ac_sm_amount"];
                                            }
                                            else {
                                                $other_total = $other_total + (int)$row_due["ac_sm_amount"];
                                            }
                                        }
                                        $total_money = $monthly_total+$other_total;
                                        $total_money = $total_money-$paid;
                                ?>
                                <td style="color: red;"><?php echo $total_money;?></td>
                                <td style="cursor: pointer; color: green; font-weight: bold;" id="pay_form_btn">Pay Now</td>
                                
                    </tr>
                </table>
                <table class="table table-bordered table-responsive">

                      <?php
                            if (mysqli_num_rows($result_transaction) > 0) {?>
							
                                <tr style="background:#ebf1f2;">
									<th>MR. NO</th>
									<th>Date</th>
									<th>Time</th>
									<th>Amount</th>
									<th class="text-center">Action</th>
								</tr>
                                <?php
                                while($transaction_row = mysqli_fetch_assoc($result_transaction)){
                                    $mr = $transaction_row["ac_crd_mr_no"];
                                    $result_total_amount = mysqli_query($link, "SELECT sum(ac_crd_amount) as total_amount FROM ac_cash_receive_dtl WHERE ac_crd_mr_no = '$mr'");
                                    $total_amount = mysqli_fetch_assoc($result_total_amount)["total_amount"];

                         ?>
                      
								<tr>
                        
									<td><?php echo $transaction_row["ac_crd_mr_no"];?></td>
									<td><?php echo $transaction_row["ac_crd_date"];?></td>
									<td><?php echo $transaction_row["ac_crd_time"];?></td>
									<td><?php echo "$total_amount";?></td>
									<td class="text-center">
									    <span id='<?php echo $transaction_row["ac_crd_mr_no"];?>' class="view_now" style="cursor: pointer; color: green; font-weight: bold;">View</span>
									    <?php if($transaction_row["ac_crd_status"] == 0){?>
									    <span style="margin:0 20px;">|</span> <span data='<?php echo $transaction_row["ac_crd_mr_no"];?>' class="edit_now" style="cursor: pointer; color: red; font-weight: bold;"> Edit</span>
									    <?php } ?>
									</td>
								</tr>
                    <?php     }   
                            }
                            else {
                                ?>
                                <tr>
                                    <td style="background: #ff000038; font-weight: bold;">Nothing Paid!</td>
                                </tr>
                                <?php
                            }
                        ?>
                </table>
                <script type="text/javascript">
		            $(document).ready(function(){
		                var st_id = $("#form_st_id").val();
		                $("#pay_form_btn").click(function(){
		                    $("#payment_form").load("payment_form.php", {"sc_id": $("#sc").text()});
		                });
		                $(".view_now").click(function(){
		                    var mr_id = $(this).attr("id");
		                    $("body").load("payment_details.php", {"mr":mr_id, "st_id":st_id});
		                });

                        //update form

                        $(".edit_now").click(function(){
                            var mr_id = $(this).attr("data");
                            $("#payment_form").load("payment_edit.php", {"mr":mr_id, "st_id":st_id});
                        });

		            });
		        </script>
                <?php }  ?>