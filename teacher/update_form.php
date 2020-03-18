<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "../resources/db_aags_n.php" ;?>


<?php
if($link == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>


<?php
$t_code = 0;
	if(isset($_POST["t_code"])){
		$t_code = $_POST["t_code"];
	}
?>

<form action="" method="post" id="t_info_update_form">
	<?php
		$sql="SELECT * FROM teacher_info WHERE t_code = '$t_code'"; 
        $t_result = mysqli_query($link, $sql);
        while ($t_row = mysqli_fetch_assoc($t_result)){
	?>
					<div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Name</label>
	                        <input required="required"  class="form-control" id="name" type="text" name="name" value="<?php echo $t_row['t_name'];?>">
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Gender</label>
	                        <select id="gender" class="form-control selectpicker" data-mobile="true" name="gender">
                                <option <?php if($t_row['t_sex'] == "2"){echo "selected";}?> value = '2' > MALE </option>
                                <option <?php if($t_row['t_sex'] == "1"){echo "selected";}?> value = '1' > FEMALE </option>
                            </select>
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Designation</label>
	                        <input required="required"  class="form-control" id="designation" type="text" name="designation" value="<?php echo $t_row['t_des'];?>">
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Join Date</label>
	                        <input  class="form-control" id="join_date" type="date" name="join_date"  value="<?php echo $t_row['t_joindate'];?>">
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Subject</label>
	                        <input required="required"  class="form-control" id="subject" type="text" name="subject" value="<?php echo $t_row['t_subject'];?>">
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Blood Group</label>
	                        <select id="blood" class="form-control selectpicker" data-mobile="true" name="blood">
                                <?php 
                                $sql="SELECT * FROM st_blood ORDER BY stb_id DESC";
                                $result_b = mysqli_query($link, $sql);
                                while($b_row = mysqli_fetch_assoc($result_b)){ ?>
                                	<option <?php if($t_row['t_bgroup'] == $b_row['stb_id']){echo "selected";}?> value = '<?php echo $b_row['stb_id'];?>' > <?php echo $b_row['stb_name'];?> </option>
                                <?php } ?>            
                            </select>
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Phone</label>
	                        <input required="required"  class="form-control" id="phone" type="text" name="phone" value="<?php echo $t_row['t_phone'];?>">
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Password</label>
	                        <input required="required"  class="form-control" id="phone" type="password" name="t_pass" value="">
	                        <!--hidden field-->
	                        <input required="required"  class="form-control" id="t_code" type="hidden" name="t_code" value="<?php echo $t_row['t_code'];?>">
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Status</label>
	                        <select id="teacherstatus" class="form-control selectpicker" data-mobile="true" name="teacherstatus">
                                <option <?php if($t_row['t_status'] == "0"){echo "selected";}?> value = '0' > Active </option>
                                <option <?php if($t_row['t_status'] == "1"){echo "selected";}?> value = '1' > Inactive </option>
                            </select>
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Class Teacher</label>
	                        <select id="t_class_id" class="form-control selectpicker" data-mobile="true" name="t_class_id">
	                            <option value="0" selected>Select</option>
                                <option <?php 
                                $sql="SELECT * FROM st_class ORDER BY sc_id ASC";
                                $result_class = mysqli_query($link, $sql);
                                while($b_row = mysqli_fetch_assoc($result_class)){ ?>
                                	<option <?php if($t_row['sc_name'] == $b_row['sc_id']){echo "selected";}?> value = '<?php echo $b_row['sc_id'];?>' > <?php echo $b_row['sc_name'];?> </option>
                                <?php } ?> 
                            </select>
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <button style="margin: 20px 0 0 20px;" type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Submit</span></button>
	                    </div>
	                </div>
	            <?php } ?>
				</form>


				<script type="text/javascript">
            $(document).ready(function(){
                /*t_info_insert_form*/

                $("#t_info_update_form").on("submit", function(e){
                    e.preventDefault();
                    var data = new FormData(this);
                    data.append("t_update_info", true);

                    //ajax request

                    $.ajax({
                        url: "functions.php",
                        type: "post",
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data == 1){
                                alert("Teacher Updated!");
                            } else {
                                alert("Failed to update.");
                            }
                        }
                    });
                });
            });
        </script>