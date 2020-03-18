<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "../aagsn/header.php";?>
<?php include "../nav-bar.php";?>

<?php
    $data_result = mysqli_query($link, "SELECT * FROM ac_head_mst ORDER BY ac_hm_id DESC");
?>
<style>
    .form-horizontal .form-group, .row {
	 margin-right: 0 !important; 
	 margin-left: 0!important; 
}
</style>

<div class="container contentlogin">
    
    <form id="ac_hm_input_form" class="form-horizontal" name="form_login" method="post" action="" role="form">
    
        <div class="page-header"><h2>Account Head</h2></div>
        
        <div class="row">             
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ac_hm_name" class="input-group-addon" id="sizing-addon1">Name: </span>
                    <input required="required" type="text" autofocus="" class="form-control" id="ac_hm_name" name="ac_hm_name" placeholder="Enter Name" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div style="width: 100%;" class="input-group input-group-lg">
                    <select required="required" id="ac_hm_category" class="form-control ac_hm_category" name="ac_hm_category">
                        <option selected>Choose...</option>
                        <option value="ANNUALLY">ANNUALLY</option>
                        <option value="MONTHLY">MONTHLY</option>
                        <option value="INDIVIDUALLY">INDIVIDUALLY</option>
                    </select>
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
    <table class="table table-bordered table-condensed table-responsive">
        <thead class="bg-info">
            <tr>
                <th>Name</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_assoc($data_result)){
            ?>
            <tr>
                <td><?php echo $row["ac_hm_name"];?></td>
                <td><?php echo $row["ac_hm_category"];?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#ac_hm_input_form").on("submit", function(e){
            e.preventDefault();
            var data = new FormData(this);
            data.append("ac_hm_submit", true);

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
                        alert("New Account Head Data Added!");
                    } else {
                        alert("Try again!");
                    }
                }
            });
        });
    });
</script>