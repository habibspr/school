<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "../aagsn/header.php";?>
<?php include "../nav-bar.php";?>

<link href="css/style.css" rel="stylesheet"> 
            <div class="container">
                <h1 class="text-center">Cash Receive</h1>
				<form action="" method="post" id="st_id_form">
				    
				    <!--option one-->
				    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="class_id" class="control-label">Class</label>
                            <select  class="form-control selectpicker" data-mobile="true" name="class" id="class_id">
                                <option value="" disabled>Select Class</option>
                            <?php 
                            $sql="SELECT * FROM st_class"; 
                            foreach ($link->query($sql) as $row){
                                echo "<option value=$row[sc_id]>$row[sc_name] </option>";
                            }
                            ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="roll" class="control-label">Roll</label>
                            <input type="text" name="txt" class="form-control" name="roll" placeholder="Roll" id="roll" />
                        </div>
                    </div>
                    <input type="submit" style="margin-bottom: 10px;" class="btn btn-primary btn-block" value="Search" />
                    <!--option one end-->
                    
                    <h4 class="text-center">Or</h4>
                    
                    <!--option two-->
					<div class="input-group" style="margin-bottom: 10px;">
						<input type = "text" class="form-control" id = "form_st_id" name = "st_id" placeholder="Student ID"/>
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary" name="submit" value=""> Search </button>
						</span>
					</div><!-- /input-group -->
					<!--option two end-->
				</form>
            </div>
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
                var st_id = "-1";
                /*st id submit*/

                $("#st_id_form").on("submit", function(e){
                    e.preventDefault();
                    st_id = $("#form_st_id").val();
                    
                    if(st_id == ""){
                        var class_id = $("#class_id").val();
                        var roll = $("#roll").val();
                        $("#basic_info_con").load("basic_info.php", {"class_id":class_id, "roll":roll});
                    } else {
                        $("#basic_info_con").load("basic_info.php", {"st_id":st_id});
                    }
                    
                    $("#form_st_id").val("");
                    $("#payment_form").load("blank.php");
                });
            });
        </script>
    </body>
</html>