<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php" ;?>
<?php include "../nav-bar.php" ;?>

<div class="container">
    <div class="row">
        <form class="form-horizontal" action="atdn_print_create_account.php" role="form" method="post"> 
            <h3 class="text-center">Create Student Code</h3>
            <hr>
            <div class="row">                
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="formdate" class="col-md-4 control-label">Date</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="formdate" type="text" name="formdate" <?php if (isset($_POST['date'])) echo 'value="'.$_POST['date'].'"';?> value="<?php echo date('Y-m-d');?>" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="mobile" class="col-md-4 control-label">Mobile No.</label>
                        <div class="col-md-8">
                            <input class="form-control" id="mobile" type="text" name="mobile" placeholder="01711223344" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <label for="dob" class="col-md-4 control-label">Date of birth</label>
                        <div class="col-md-8">
                            <input  class="form-control" id="dob" type="date" name="dob" <?php if (isset($_POST['date'])) echo 'value="'.$_POST['date'].'"';?> value="" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <div class="col-md-4">
                            <a href="../aags/atdn_create_account.php">
                            <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"> Create</span></button>
                                </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
        </form>
</div><!-- End containder -->