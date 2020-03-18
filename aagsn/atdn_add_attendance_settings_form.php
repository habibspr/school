<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<div class="container contentlogin">
    
    <div class="page-header text-center">
        <h2> Add Attendance Setup Data </h2>
    </div>
    
    <form class="form-horizontal" action="atdn_update_attendance_settings_data.php" role="form" method="post">
        <div class="row">             
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ASM_Session" class="input-group-addon" id="sizing-addon1">Session </span>
                    <input type="text" class="form-control" id="ASM_Session" name="ASM_Session" maxlength="4" placeholder="Year" aria-describedby="sizing-addon1" autofocus>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ASM_Cetegory" class="input-group-addon" id="sizing-addon1"> Cetegory </span>
                    <select  class="form-control " id="ASM_Cetegory" data-mobile="true" name="ASM_Cetegory" aria-describedby="sizing-addon1">
                            <option Selected value="0"> Teacher</option>      
                            <option value="1"> Student</option>      
                        </select>
                </div>
            </div>
        </div>        
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ASM_Date_From" class="input-group-addon" id="sizing-addon1">Date from</span>
                    <input type="date" class="form-control" id="ASM_Date_From" name="ASM_Date_From" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ASM_Intime" class="input-group-addon" id="sizing-addon1">In Time </span>
                    <input type="time" class="form-control" id="ASM_Intime" name="ASM_Intime" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ASM_Outtime" class="input-group-addon" id="sizing-addon1">Out Time </span>
                    <input type="time" class="form-control" id="ASM_Outtime" name="ASM_Outtime" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="ASM_Fine" class="input-group-addon" id="sizing-addon1">Fine </span>
                    <input type="text" class="form-control" id="ASM_Fine" name="ASM_Fine" aria-describedby="sizing-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button type="submit" id="submit" name="Submit" class="btn btn-lg btn-block btn-primary glyphicon glyphicon-check">Submit</button>
            </div>
        </div>
    </form>
</div>