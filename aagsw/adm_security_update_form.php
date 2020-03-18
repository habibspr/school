<!-- database connection -->
<?php include "../resources/db_aags_w.php" ;?>

<script> 
$(function () {
    $("#update_form").on("submit", function () {
        $.ajax({
            type: "post",
            url: "",
            data: $(this).serialize(),
            success: function (response) {
                if (response == "done") {
                    alert("Form submitted successfully!");
                } else {
                    alert("Form submission failed!");
                }
            },
            error: function (response) {
                alert(response);
            }
        });
        return false;
    });
});

</script> 

<div class="container contentlogin">
    
    <div class="page-header text-center">
        <h2> Security Update </h2>
    </div>
    <!-- adm_update_security_data.php -->
    <form class="form-horizontal" action="adm_update_security_data.php" method="post" id="update_form">
        <div class="row">             
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="Security_Session" class="input-group-addon" id="sizing-addon1">Session </span>
                    <select  class="form-control" id="Security_Session" data-mobile="true" name="Security_Session" aria-describedby="sizing-addon1">
                        <?php
                        $sql="SELECT distinct asec_session FROM adm_security_mst order by asec_session DESC"; 
                        foreach ($link->query($sql) as $row){
                            echo "<option value='$row[asec_session]'>$row[asec_session]</option>"; } ?>      
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="General_Security_Status" class="input-group-addon" id="sizing-addon1">General Security Status </span>
                    <select  class="form-control " id="General_Security_Status" data-mobile="true" name="General_Security_Status" aria-describedby="sizing-addon1">
                            <option Selected value="0"> UnLock</option>      
                            <option value="1"> Lock</option>      
                        </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="Mark_Security_Status" class="input-group-addon" id="sizing-addon1">Mark Security Status </span>
                    <select  class="form-control " id="Mark_Security_Status" data-mobile="true" name="Mark_Security_Status" aria-describedby="sizing-addon1">
                            <option Selected value="0"> UnLock</option>      
                            <option value="1"> Lock</option>      
                        </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="Result_Security_Status" class="input-group-addon" id="sizing-addon1">Result Security Status </span>
                    <select  class="form-control " id="Result_Security_Status" data-mobile="true" name="Result_Security_Status" aria-describedby="sizing-addon1">
                            <option Selected value="0"> UnLock</option>      
                            <option value="1"> Lock</option>      
                        </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button type="submit" id="submit" name="Submit" class="btn btn-lg btn-block btn-primary glyphicon glyphicon-check">Submit</button>
            </div>
        </div>
    </form>
    <div class="results">
    </div>
</div>
