src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js";
src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js";

// input number only

function isNumberKey(evt){    
    var charCode = (evt.which) ? evt.which : event.keyCode    
    if (charCode > 31 && (charCode < 48 || charCode > 57 ))        
        return false;    
    return true;
}

 
// show / hide togle
$(document).ready(function(){
    $('#show').click(function() {
      $('.main_input_form').toggle('slow');
    });
});




$(document).ready(function() {
   $("#Studentid").on('keydown', function(e) {  
       if (e.keyCode == 13) {
           $("#Details").show();
           $("#Display").hide();
           var Studentid = $("#Studentid").val();
           var Session = $("#Session").val();
           
           $("#Details").load('atdn_show_student_id_data.php', {
               "Studentid":Studentid,
               "Session":Session
           });
       }
   });
    
});


// start form here 
$(document).ready(function() {
    $("#button").click(function(){
        
        $("#Details").hide();
        $("#Display").show();
        
        var Session = $("#Session").val();
        var Studentid = $("#Studentid").val();
        var student_rfid = $("#student_rfid").val();
      
        $("#Display").load('atdn_update_student_id_data.php', {
            "Session":Session, 
            "Studentid":Studentid, 
            "student_rfid":student_rfid 
        });
        
        $('#Studentid').val('');    // clear input
        $('#student_rfid').val('');    // clear input
        
    });
    
});





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
   


