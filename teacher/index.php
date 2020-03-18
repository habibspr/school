<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>
<?php include "../aagsn/header.php";?>
<?php include '../nav-bar.php';?>
<?php include "../resources/db_aags_n.php" ;?>
<link href="css/style.css" rel="stylesheet">  
        <section class="main">
            <div class="container">
				<h1 class="text-center">Add Teacher</h1>
				<form action="" method="post" id="t_info_insert_form">
					<div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Name</label>
	                        <input required="required"  class="form-control" id="name" type="text" name="name" placeholder="Farjana Akter">
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
	                        <input required="required"  class="form-control" id="designation" type="text" name="designation" placeholder="Principal">
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Join Date</label>
	                        <input  class="form-control" id="join_date" type="date" name="join_date"  value="<?php echo date('Y-m-d');?>">
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <label for="formdate" class="control-label">Subject</label>
	                        <input required="required"  class="form-control" id="subject" type="text" name="subject" placeholder="Math">
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
	                        <input required="required"  class="form-control" id="phone" type="text" name="phone" placeholder="01*********">
	                    </div>
	                </div>
	                <div class="col-sm-6 col-lg-6">
	                    <div class="form-group">
	                        <button style="margin: 20px 0 0 20px;" type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Submit</span></button>
	                        <a style="margin: 20px 0 0 20px;" class="btn btn-danger" href="update.php">Update Teacher</a>
	                    </div>
	                </div>
				</form>
            </div>
        </section>
        <section>
            <div class="container" id="basic_info_con">
                <!--jQuery Load-->
            </div>
        </section>
        <section>
            <div class="container">
                <div id="payment_form">
                </div>
            </div>
        </section>
        
        <script type="text/javascript">
            $(document).ready(function(){
                /*t_info_insert_form*/

                $("#t_info_insert_form").on("submit", function(e){
                    e.preventDefault();
                    var data = new FormData(this);
                    data.append("t_insert_info", true);

                    //ajax request

                    $.ajax({
                    	url: "functions.php",
                    	type: "post",
                    	data: data,
                    	contentType: false,
                    	processData: false,
                    	success: function(data){
                    		if(data == 1){
                    			$("input").val("");
                    			alert("New Teacher Added!");
                    		} else {
                    			alert("Failed to add new teacher.");
                    		}
                    	}
                    });
                });
            });
        </script>
    </body>
</html>