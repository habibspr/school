src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js";
src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js";
src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js";
// input number only

function isNumberKey(evt){    
    var charCode = (evt.which) ? evt.which : event.keyCode    
    if (charCode > 31 && (charCode < 48 || charCode > 57 ))        
        return false;    
    return true;
}


// all values are free on page refreshing 
$(document).ready(function(){
    $('#Session').val(''); // clear seeeion
    $('#Class_Id').val(''); // clear seeeion    
    });
    
    
    
    
// show / hide togle
$(document).ready(function(){
    $('#show').click(function() {
      $('.main_input_form').toggle('slow');
    });
});


// view updated data on button click

$(document).ready(function() {
   $("#button").click(function(event){
       var Session = $("#Session").val();
        var Class_Id = $("#Class_Id").val();
       
       $("#displayUpdated").load('table_editable_student.php', {
            "Session":Session, 
            "Class_Id":Class_Id
           
        });
   });
});



// exam selection
$(document).ready(function(){    
    $('#Session').on('change',function(){
        var sessionID = $(this).val();
        if(sessionID){
            $.ajax({
                type:'POST',
                url:'depandent_selection_data.php',
                data:'Session='+sessionID,
                success:function(html){
                    $('#Class_Id').html(html);
                }
            }); 
        
        }else{
            
            $('#Class_Id').html('<option value="">Select session first</option>');
        }
        
    });
});

// alert dissmiss
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
