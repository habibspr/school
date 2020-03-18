<?php include "../aagsn/header.php";?>
<?php include '../nav-bar.php';?>
<?php include "../resources/db_aags_n.php" ;?>

<link href="css/style.css" rel="stylesheet">  
        <section class="main">
            <div class="container">
				<h1 class="text-center" style="margin-bottom: 30px;">Update Teacher</h1>
				<form action="" method="post" id="t_code_form" style="margin: 20px;">
                    <div class="input-group">
                        <select id="t_code" class="form-control selectpicker" data-mobile="true" name="blood">
                                	<?php 
                                $sql="SELECT * FROM teacher_info ORDER BY t_code ASC";
                                $result_teacher = mysqli_query($link, $sql);
                                while($b_row = mysqli_fetch_assoc($result_teacher)){ ?>
                                	<option value = '<?php echo $b_row['t_code'];?>' > <?php echo $b_row['t_code']."-".$b_row['t_name']."-".$b_row['t_des'];?> </option>
                                <?php } ?>
                            </select>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary" name="submit" value=""> Search </button>
                        </span>
                    </div><!-- /input-group -->
                </form>
                <div id="update_form" style="margin-top: 20px;"></div>
            </div>
        </section>
       
        <script type="text/javascript">
            $(document).ready(function(){
                /*t_info_insert_form*/

                $("#t_code_form").on("submit", function(e){
                    e.preventDefault();
                    var t_code = $("#t_code").val();

                    $("#update_form").load("update_form.php", {"t_code": t_code});
  
                });

                //on keyup

                $("#t_code").on("keyup", function(e){
                    e.preventDefault();
                    var t_code = $(this).val();

                    $("#update_form").load("update_form.php", {"t_code": t_code});
  
                });
            });
        </script>
    </body>
</html>