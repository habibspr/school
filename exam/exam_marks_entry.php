<?php include "header.php";?>

<script type = "text/javascript" src = "exm_data.js"></script>

<div class="container-float">  
    <div class="page-header">
        <h2 class="text-center">Marks Entry</h2>
    </div>
    
    <div class="col-sm-6">
        <form id="myform">
        <div id="show" class="btn btn-lg btn-block btn-primary" style="width:100%; height:auto; padding:0.5em; " ><h4>Click to Show / Hide general inputs</h4></div>
            
            <div class="main_input_form" style="width:auto; height:auto; padding:0.5em; background-color:#154360; align: center;">
                
                <div class="row" style="width: auto; padding:3em;">
                    
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Session" class="input-group-addon" id="sizing-addon1">Session</span>
                            <select id="Session" name="Session" class="form-control selectpicker" data-mobile="true" aria-describedby="sizing-addon1">
                                <option selected value="" >Select session</option>
                                <?php
                                $query = $link->query("SELECT distinct ss_year FROM st_session ORDER BY ss_year DESC");
                                //Count total number of rows
                                $rowCount = $query->num_rows;
                                if($rowCount > 0){
                                    while($row = $query->fetch_assoc()){ 
                                        echo '<option value="'.$row['ss_year'].'">'.$row['ss_year'].'</option>';
                                    }
                                }else{
                                    echo '<option value="">Session not available</option>';
                                }
                                ?>            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Session" class="input-group-addon" id="sizing-addon1">Exam</span>
                            <select id="Exam" name="Exam" class="form-control selectpicker" data-mobile="true" aria-describedby="sizing-addon1">
                                <option value="">Select session first</option>        
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Session" class="input-group-addon" id="sizing-addon1">Class</span>
                            <select id="Class" name="Class" class="form-control selectpicker" data-mobile="true" aria-describedby="sizing-addon1">
                                <option selected value="">Select class</option>
                                <?php
                                $query = $link->query("SELECT * FROM st_class");
                                //Count total number of rows
                                $rowCount = $query->num_rows;
                                if($rowCount > 0){
                                    while($row = $query->fetch_assoc()){ 
                                        echo '<option value="'.$row['sc_id'].'">'.$row['sc_name'].'</option>';
                                    }
                                }else{
                                    echo '<option value="">Class not available</option>';
                                }
                                ?>            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Subject" class="input-group-addon" id="sizing-addon1">Subject</span>
                            <select id="Subject" name="Subject" class="form-control selectpicker" data-mobile="true" aria-describedby="sizing-addon1">
                                <option selected value="">Select class first</option>          
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Mark_Type_Selection" class="input-group-addon" id="sizing-addon1">Mark type selection </span>
                            <select id="Mark_Type_Selection" name="Mark_Type_Selection" class="form-control selectpicker" data-mobile="true" aria-describedby="sizing-ddon1">
                                <option selected value="0">Select mark type</option>
                                <option value="1">Creative only </option>
                                <option value="2">Creative and objective</option>
                                <option value="3">Creative and objective and practical</option>
                                <option value="4">Objective only</option>
                                <option value="5">Practical only</option>
                            </select>
                        </div>
                    </div>
                    <div id="Creative">
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span for="Creative_Full_Mark" class="input-group-addon" id="sizing-addon1">Creative full mark </span>
                                <input type="text" id="Creative_Full_Mark" onkeypress="return isNumberKey(event)" maxlength="3" name="Creative_Full_Mark" class="form-control " aria-describedby="sizing-addon1">
                            </div>
                        </div>
                    </div>
                    <div id="Objective">
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span for="Objective_Full_Mark" class="input-group-addon" id="sizing-addon1">Objective full mark </span>
                                <input type="text" id="Objective_Full_Mark" onkeypress="return isNumberKey(event)" maxlength="3" name="Objective_Full_Mark" class="form-control" aria-describedby="sizing-addon1">
                            </div>
                        </div>
                    </div>
                    <div id="Practical">
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span for="Practical_Full_Mark" class="input-group-addon" id="sizing-addon1">Practical full mark </span>
                                <input type="text" id="Practical_Full_Mark" onkeypress="return isNumberKey(event)" maxlength="3" name="Practical_Full_Mark" class="form-control" aria-describedby="sizing-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Pass_Mark_Percentage" class="input-group-addon" id="sizing-addon1">Pass mark percentage </span>
                            <input type="text" id="Pass_Mark_Percentage" onkeypress="return isNumberKey(event)" maxlength="2" name="Pass_Mark_Percentage" class="form-control" value="40" aria-describedby="sizing-addon1">
                        </div>
                    </div>
                </div>
        </div> <!-- end Show / hide -->
        
        <div style="width:auto; height:auto; padding:1em; background-color:#ecf2f9; align: center;">
            
            <div class="row" style="width:auto; padding:3em;">
                <div class="form-group">
                    <div class="input-group input-group-lg">
                        <span for="studentid" class="input-group-addon" id="sizing-addon1">Student roll </span>
                            <input type="text" id="Roll" name="Roll" onkeypress="return isNumberKey(event)" class="form-control" autofocus aria-describedby="sizing-addon1">
                    </div>
                </div>
                <div id="Creative_Achieved">
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Achieved_Creative_Mark" class="input-group-addon" id="sizing-addon1">Achieved creative mark </span>
                                <input type="text" id="Achieved_Creative_Mark" onkeypress="return isNumberKey(event)" maxlength="2" name="Achieved_Creative_Mark" class="form-control" aria-describedby="sizing-addon1">
                        </div>
                    </div>
                </div>
                <div id="Objective_Achieved">
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Achieved_Objective_Mark" class="input-group-addon" id="sizing-addon1">Achieved objective mark </span>
                                <input type="text" id="Achieved_Objective_Mark" onkeypress="return isNumberKey(event)" maxlength="2" name="Achieved_Objective_Mark" class="form-control" aria-describedby="sizing-addon1">
                        </div>
                    </div>
                </div>
                <div id="Practical_Achieved">
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Achieved_Practical_Mark" class="input-group-addon" id="sizing-addon1">Achieved practical mark </span>
                                <input type="text" id="Achieved_Practical_Mark" onkeypress="return isNumberKey(event)" maxlength="2" name="Achieved_Practical_Mark" class="form-control" aria-describedby="sizing-addon1">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type = "button" class="btn btn-lg btn-block btn-primary" id = "button"  value = "Add" aria-describedby="sizing-addon1"> Submit </button>
                </div>
            </div>
        </div>
        
        <div id="display">
            <div class="text-center alert alert-success fade in">
                <strong>Here ! </strong> Student information !
            </div>
        </div>
        </form>
    </div>
    <div class="col-sm-6">
        <div id = "details"></div>
    </div>
</div>
