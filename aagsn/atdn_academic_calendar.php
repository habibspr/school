<?php include "header.php"; ?>
<?php include "../nav-bar.php"; ?>

<div class="container">
    <h1 class="text-center">Academic Calendar <small>Settings</small></h1>
    <hr>
    <form class="form-horizontal" action="atdn_show-academic_calendar.php" role="form" method="post">
        <input type="hidden" name="action" value="submit">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="year" class="col-md-4 control-label">Session :</label>
                    <div class="col-md-6">
                        <select class="form-control selectpicker" data-mobile="true" name="year">
                            <option selected><?php echo date('Y')+1;?> </option>
                            <option value="<?php echo date('Y');?>"><?php echo date('Y');?> </option>
                            <option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label class="col-md-4 control-label">Status :</label>
                    <div class="col-md-6">
                        <select class="form-control selectpicker" data-mobile="true" name="status">
                            <option selected value="allday">All Day</option>
                            <option value="1">On Day</option>
                            <option value="0">Off Day</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary form-control"><span class="glyphicon glyphicon-search">
                            Show</span>  </button>
                    </div>
                </div>
            </div>
        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
    </form>
</div>
<?php include 'footer.php';?>