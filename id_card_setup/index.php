<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "../aagsn/header.php" ;?>
<?php include "../nav-bar.php" ;?>

<script type = "text/javascript" src = "myjavascript.js"></script>


<script>
    // for focusing the Student id field after submit //
    function getFocus() {
        document.getElementById("Studentid").focus();
    }    
</script>


<style>       
     congratulations {
         color:green;
         font-size: 20px;
     }
     sorry {
         color: crimson;
         font-variant-caps: all-petite-caps;
         font-size: 20px;
     }
</style>

<div class="container">
    <div class="page-header">
        <h2 class="text-center">Update Student Id Card</h2>
    </div>
    <div class="col-sm-12">
        <form class="form-horizontal" action="" role="form" method="post">
           <div class="form-group">               
               <div class="input-group input-group-lg">
                   <span for="Session" class="input-group-addon" id="sizing-addon1">Session</span>
                   <select  class="form-control selectpicker" data-mobile="true" name="Session" id="Session">
                       <?php 
                       $sql="SELECT distinct ss_year FROM st_session ORDER BY ss_year DESC"; 
                       foreach ($link->query($sql) as $row){
                           echo "<option value=$row[ss_year]>$row[ss_year]</option>";
                       }
                       ?>            
                       </select>
               </div>
            </div>
            
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="Studentid" class="input-group-addon" id="sizing-addon1">Student id</span>
                    <input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="Studentid" name="Studentid" class="form-control" id="sizing-addon1" autofocus />
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span for="student_rfid" class="input-group-addon" id="sizing-addon1">Card Number</span>
                    <input class="form-control" type="text" maxlength="10" id="student_rfid" name="student_rfid" id="sizing-addon1"/>
                </div>
            </div>
            
            <div class="form-group">
                    <button type = "button" onclick="getFocus()" class="btn btn-lg btn-block btn-primary" id = "button" aria-describedby="sizing-addon1"> Submit </button>
                </div>
           
            
        </form>                        
    </div>    
    <div id = "Details"></div>
    <div id = "Display"></div>
</div>
