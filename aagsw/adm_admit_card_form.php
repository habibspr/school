<?php include "header.php" ;?>
<?php include "nav-bar.php" ;?>

<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type = "text/javascript" language = "javascript">
    $(document).ready(function() {
        $("#button").click(function(event){
            var form_no = $("#form_no").val();            
            $("#Details").load('adm_show_form_data.php', {form_no: form_no} );
        });
    });
    function onClick(){
        if(document.getElementById("form_no").value)
            document.getElementById('button').click();            
    }
        
    function onSubmit() {
        document.getElementById("FormSubmit").submit();
    }    
    
</script>

<div class="container">
    <div class="page-header">
        <h3 class="text-center">Admission test admit card</h3>
    </div>
    
    <?php 
    include "adm_database_status.php";
    if($General_Security_Status){?>
    <div class="alert alert-success fade in">
        <strong>Permission ! </strong> You are not permitted !
    </div> 
    <?php die(); } ?>
    
    <div class="row">
        <div class="col-sm-6">
            <form class="form-inline" action="adm_print_admitcard.php" method="POST" id="FormSubmit">
                    <div class="form-group">
                        <label class="control-label" for="form_no">Form No.</label>
                        <input type="text" class="form-control" onkeyup="onClick()" id="form_no" name="form_no" class="form-control"  autofocus />
                        <input type = "button"  id = "button" hidden="hidden" />
                    </div>
            </form>
        </div>
        <div class="col-sm-6" id = "Details"></div>
    </div>
    
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
