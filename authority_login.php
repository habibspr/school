<div class="container contentlogin">
    
    <form class="form-horizontal" name="form_login" method="post" action="<?php echo $currenturl;?>" role="form">
    
        <div class="page-header text-center"><h2>Please Sign In</h2></div>
        
        <div class="row">             
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="user_id" class="input-group-addon" id="sizing-addon1">User Name: </span>
                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Username" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="password" class="input-group-addon" id="sizing-addon1">Password: </span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button type="submit" name="Submit" class="btn btn-lg btn-block btn-primary glyphicon glyphicon-check">Submit</button>
            </div>
        </div>
        
    </form>
    
</div>