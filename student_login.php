<div class="container">
    <form class="form-horizontal"  name="form_login" method="post" action="<?php echo $currenturl;?>" role="form">
        
        <div class="page-header text-center"><h2> Student Information </h2></div>
        
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="others_id" class="input-group-addon" id="sizing-addon1">Form No</span>
                    <input class="form-control" id="others_id" type="text" name="others_id" value="<?php if(date('m')>6){ echo date('Y')+1; } else { echo date('Y'); }?>000000" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="others_password" class="input-group-addon" id="sizing-addon1">Mobile No</span>
                    <input class="form-control" id="others_password" type="text" name="others_password" value="" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="others_dob" class="input-group-addon" id="sizing-addon1">Date of birth</span>
                    <input class="form-control" id="others_dob" type="date" name="others_dob" value="" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button type="submit" name="Submit" class="btn btn-lg btn-block btn-primary glyphicon glyphicon-check">Submit</button>
            </div>
        </div>
    </form>
    <hr>
    <p class="text-center">
        <b> N.B: </b>Please Log in as like as the following information <br>
        If New Please <a href="../atdn_create_account.php">Create New Account </a>
    </p>
</div>
