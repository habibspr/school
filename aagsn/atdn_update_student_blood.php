<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>


<?php include "header.php" ;?>
<?php include "../nav-bar.php" ;?>

<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type = "text/javascript" language = "javascript">
    $(document).ready(function() {
        $("#button").click(function(event){
            var Studentid = $("#Studentid").val();            
            $("#Details").load('atdn_show_student_id_data.php', {"Studentid":Studentid} );
        });
    });
    function onClick(){
        if(document.getElementById("Studentid").value)
            document.getElementById('button').click();            
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
       <h2>Update student blood group </h2>
    </div>
        <form class="form-horizontal" action="" role="form" method="post">
            <div class="col-sm-6">
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Session" class="input-group-addon" id="sizing-addon1">Student id</span>
                            <input class="form-control" value="<?php echo date('Y');?>" type="text" size="6" id="Session" name="Session" readonly />
                        </div>
                    </div>  
                
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span for="Studentid" class="input-group-addon" id="sizing-addon1">Student id</span>
                            <input type="text" class="form-control" onkeyup="onClick()" id="Studentid" name="Studentid" class="form-control" aria-describedby="sizing-addon1"  autofocus />
                            <input type = "button"  id = "button" hidden="hidden" />
                        </div>
                    </div>
                
                    <div class="form-group">                   
                        <div class="input-group input-group-lg">
                            <span for="blood_group" class="input-group-addon" id="sizing-addon1">Blood Group</span>
                            <select  class="form-control" id="blood_group" data-mobile="true" name="blood_group" aria-describedby="sizing-addon1">
                                <?php
                                $sql="SELECT * FROM st_blood"; 
                                foreach ($link->query($sql) as $row){
                                    echo "<option value='$row[stb_id]'>$row[stb_name]</option>"; } ?>      
                            </select>
                            <input type="button" id="button" hidden="hidden" />
                        </div>
                    </div>
                </div>
        </form>      
        <div class="col-sm-6" id = "Details"><?php include 'atdn_update_student_blood_data.php';?></div>
    <script type = "text/javascript" language = "javascript">
        //key next
        $('body').on('keydown', 'input, select, textarea', function(e) {
            var self = $(this)
            , form = self.parents('form:eq(0)')
            , focusable
            , next
            , prev
            ;
            
            if (e.shiftKey) {
                if (e.keyCode == 13) {
                    focusable =   form.find('input,a,select,button,textarea').filter(':visible');
                    prev = focusable.eq(focusable.index(this)-1);                
                    if (prev.length) {
                        prev.focus();
                    } else {
                        form.submit();
                    }
                }
            }else if (e.keyCode == 13) {
                focusable = form.find('input,a,select,button,textarea').filter(':visible');
                next = focusable.eq(focusable.index(this)+1);
                if (next.length) {
                    next.focus();
                } else {                    
                    form.submit();                    
                }
                return false;                
            }
        });    
    </script>
</div><!-- End containder -->
