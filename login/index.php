<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['login_id'])){
        header("Location: ..");
        die();
    }

?>
<!--FREE ACCESS HEADER-->
<?php include("free_access_header.php");?>

<!--I'm including this header inside these FREE ACCESS HEADER & FREE ACCESS FOOTER because i want to bypass the authentication which is decleared in the header.php file-->
<?php include("../aagsn/header.php");?>

<!--FREE ACCESS FOOTER-->
<?php include("free_access_footer.php");?>

<div style="max-width: 400px; margin: 0 auto;">
    
    <form id="login_form_id" class="form-horizontal" name="form_login" method="post" action="" role="form">
    
        <div class="page-header text-center"><h2>Please Sign In</h2></div>
        
        <div class="row">             
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="user_id" class="input-group-addon" id="sizing-addon1">Code: </span>
                    <input required="required" type="text" autofocus="" class="form-control" id="t_code" name="t_code" placeholder="Code" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="password" class="input-group-addon" id="sizing-addon1">Password: </span>
                    <input required="required" type="password" class="form-control" id="password" name="password" placeholder="Password" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button type="submit" name="Submit" class="btn btn-lg btn-block btn-primary glyphicon glyphicon-check">Login</button>
                <a type="button" href="../aagsn" name="Submit" class="btn btn-lg btn-block btn-danger">Attendance Page</a>
            </div>
        </div>
        
    </form>
    
</div>
<!--js code-->

<script type="text/javascript">
    $(document).ready(function(){
        $("#login_form_id").on("submit", function(e){
            e.preventDefault();
            var data = new FormData(this);
            data.append("login_submit", true);

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
                        $(location).attr('href', '..')
                    } else {
                        alert("Wrong info. Try again...");
                    }
                }
            });
        });
    });
</script>