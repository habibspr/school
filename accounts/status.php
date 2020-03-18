<?php include "../aagsn/header.php" ;?>
<?php include "../nav-bar.php" ;?>
<?php
    if($_SESSION["login_t_des"] != "director"){
        header("Location: index.php");
    }
?>
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

$result_transaction = mysqli_query($link, "SELECT DISTINCT ac_crd_mr_no, ac_crd_date, ac_crd_time, ac_crd_st_id FROM ac_cash_receive_dtl WHERE ac_crd_status = 0 ORDER BY ac_crd_mr_no DESC");
?>

<div class="container">
    <div class="page-header text-center text-success">
        <h4>Transection Requests</h4>
    </div>
    <div class="row">
        <input class="form-control pull-right" id="search_box" type="text" placeholder="Search.." >
    </div>
    <div class="row">
        <table class="table table-bordered table-responsive">
            <thead>
                <tr class="success">
                    <th>MR. NO</th>
                    <th>ST ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Amount</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php
            if (mysqli_num_rows($result_transaction) > 0) {
            while($transaction_row = mysqli_fetch_assoc($result_transaction)){
            $mr = $transaction_row["ac_crd_mr_no"];
            $result_total_amount = mysqli_query($link, "SELECT sum(ac_crd_amount) as total_amount FROM ac_cash_receive_dtl WHERE ac_crd_mr_no = '$mr'");
            $total_amount = mysqli_fetch_assoc($result_total_amount)["total_amount"];
            ?>
            <tbody id="transaction_approval">
                <tr>
                    <td><?php echo $transaction_row["ac_crd_mr_no"];?></td>
                    <td><?php echo $transaction_row["ac_crd_st_id"];?></td>
                    <td><?php echo $transaction_row["ac_crd_date"];?></td>
                    <td><?php echo $transaction_row["ac_crd_time"];?></td>
                    <td><?php echo "$total_amount";?></td>
                    <td class="text-center">
                    <span id='<?php echo $transaction_row["ac_crd_mr_no"];?>' class="view_now" style="cursor: pointer; color: green; font-weight: bold;">Approve</span>
                    </td>
                </tr>
            <?php }
                }else{
            ?>
                <tr>
                <td style="background: #ff000038; font-weight: bold;">Nothing Paid!</td>
                </tr>
            <?php    }    ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".view_now").click(function(){
            var mr_id = $(this).attr("id");
            $.ajax({
                url: "functions.php",
                method: "POST",
                data: {"status_form_submit":true, "mr_id":mr_id},
                success: function(data){
                    if(data == "1"){
                        $("#"+mr_id).parent().parent().remove();
                        alert("Transection Approved!");
                    } else {
                        alert(data);
                    }
                }
            });
        });

    });
    
    
    // live search
    $(document).ready(function(){
        $("#search_box").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#transaction_approval tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
</script>