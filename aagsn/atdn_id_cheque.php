<?php include "header.php"; ?>
<?php include '../nav-bar.php';?>
<script>
    function check()
    {
        if(document.getElementById("studentid").value.length>=10)
            document.getElementById("inter_result_form").submit();
        
    }
</script>
<div class="container">
    <h3 class="text-center">Id Cheque</h3>
    <div class="row">
        <div class="col-sm-1">
            <a href="../aags/atdn_front_page.php">Login</a>
        </div>
        <div class="col-sm-3">         
            <form class="form-horizontal" name="inter_result_form" id="inter_result_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <h2>Enter Id</h2>
                    <input type="text" onKeyUp="check()" maxlength="10" id="studentid" name="studentid" class="form-control"  autofocus>
                    <input type="submit" hidden="hidden" value="Submit">
                    <h4><?php echo "Today : " .date('F d, Y'). " [" .date('l'). "]";?></h4>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            <?php include_once "atdn_insert_data_id_cheque.php";//insert and show data?>
        </div> 
    </div>
</div>

<?php include "footer.php";?>