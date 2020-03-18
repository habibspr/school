
<div class="container contentlogin">
    
    <div class="page-header text-center">
        <h2> Add Security Data </h2>
    </div>
    
    <form class="form-horizontal" action="adm_update_security_data.php" role="form" method="post">
        <div class="row">             
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="Security_Session" class="input-group-addon" id="sizing-addon1">Session </span>
                    <input type="text" class="form-control" id="Security_Session" name="Security_Session" maxlength="4" placeholder="Year" aria-describedby="sizing-addon1" autofocus>
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
                <div class="input-group input-group-lg">
                    <span for="Grand_Security_Status" class="input-group-addon" id="sizing-addon1">Grand Security Status </span>
                    <select  class="form-control " id="Grand_Security_Status" data-mobile="true" name="Grand_Security_Status" aria-describedby="sizing-addon1">
                            <option Selected value="0"> UnLock</option>      
                            <option value="1"> Lock</option>      
                        </select>
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