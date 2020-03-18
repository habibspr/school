<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "../aagsn/header.php";?>
<?php include "../nav-bar.php";?>

<?php
    $data_result = mysqli_query($link, "SELECT * FROM global_session_mst ORDER BY gsm_id DESC");
?>
<style>
    .form-horizontal .form-group, .row {
	 margin-right: 0 !important; 
	 margin-left: 0!important; 
}
</style>
<div class="container contentlogin">
    
    <form id="ss_input_form" class="form-horizontal" name="form_login" method="post" action="" role="form">
    
        <div class="page-header text-center"><h2>Global Session</h2></div>
        
        <div class="row">             
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ss_name" class="input-group-addon" id="sizing-addon1">Session: </span>
                    <input required="required" type="text" autofocus="" class="form-control" id="ss_name" name="ss_name" placeholder="Enter Name" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">             
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ss_start" class="input-group-addon" id="sizing-addon1">Start Date: </span>
                    <input required="required" type="date" autofocus="" class="form-control" id="ss_start" name="ss_start"aria-describedby="sizing-addon1" value="<?php echo date('Y-01-01');?>">
                </div>
            </div>
        </div>
        <div class="row">             
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ss_end" class="input-group-addon" id="sizing-addon1">End Date: </span>
                    <input required="required" type="date" autofocus="" class="form-control" id="ss_end" name="ss_end"aria-describedby="sizing-addon1" value="<?php echo date('Y-01-31');?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button type="submit" name="Submit" class="btn btn-lg btn-block btn-primary glyphicon glyphicon-check">Submit</button>
            </div>
        </div>
        
    </form>
    
    <!--Showing data-->
    <table class="table table-bordered table-responsive">
        <thead class="bg-info">
            <tr>
                <th>Name</th>
                <th>Start</th>
                <th>End</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_assoc($data_result)){
            ?>
            <tr>
                <td><?php echo $row["gsm_session"];?></td>
                <td><?php echo $row["gsm_session_start"];?></td>
                <td><?php echo $row["gsm_session_end"];?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#ss_input_form").on("submit", function(e){
            e.preventDefault();
            var data = new FormData(this);
            data.append("ss_form_submit", true);

            //ajax

            $.ajax({
                url: "functions.php",
                type: "POST",
                contentType: false,
                processData: false,
                data: data,
                success: function(data){
                    if(data == 1){
                        $("input").val("");
                        alert("New Session Added!");
                    } else {
                        alert("Something went wrong! Try again later.");                    }
                }
            });
        });
    });
</script>