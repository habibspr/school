src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js";
src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js";

// input number only

function isNumberKey(evt){    
    var charCode = (evt.which) ? evt.which : event.keyCode    
    if (charCode > 31 && (charCode < 48 || charCode > 57 ))        
        return false;    
    return true;
}


// all values are free 
$(document).ready(function(){
    
    $('#Session').val(''); // clear seeeion
    $('#Class').val(''); // clear class
    $('#Group').val(''); // clear class
    $('#Subject').val(''); // clear class
    $('#Mark_Type_Selection').val('0'); // clear class
    
    $('#Roll').val('');    // clear input
    $('#Achieved_Creative_Mark').val('');    // clear input
    $('#Achieved_Objective_Mark').val('');    // clear input
    $('#Achieved_Practical_Mark').val('');    // clear input
    
});
    
// show / hide togle
$(document).ready(function(){
    $('#show').click(function() {
      $('.main_input_form').toggle('slow');
    });
});



// start form here 
$(document).ready(function() {
    $("#button").click(function(event){
        var Session = $("#Session").val();
        var Exam = $("#Exam").val();
        var Class = $("#Class").val();
        var Group = $("#Group").val();
        var Subject = $("#Subject").val();
        var Roll = $("#Roll").val();
        var Mark_Type_Selection = $("#Mark_Type_Selection").val();
        var Creative_Full_Mark = $("#Creative_Full_Mark").val();
        var Objective_Full_Mark = $("#Objective_Full_Mark").val();
        var Practical_Full_Mark = $("#Practical_Full_Mark").val();
        var Pass_Mark_Percentage = $("#Pass_Mark_Percentage").val();
        var Achieved_Creative_Mark = $("#Achieved_Creative_Mark").val();
        var Achieved_Objective_Mark = $("#Achieved_Objective_Mark").val();
        var Achieved_Practical_Mark = $("#Achieved_Practical_Mark").val();
        
        $("#details").load('exam_mark_data_insert_update.php', {
            "Session":Session, 
            "Exam":Exam,
            "Class":Class,
            "Group":Group,
            "Subject":Subject,
            "Roll":Roll, 
            "Mark_Type_Selection":Mark_Type_Selection, 
            "Creative_Full_Mark":Creative_Full_Mark, 
            "Objective_Full_Mark":Objective_Full_Mark, 
            "Practical_Full_Mark":Practical_Full_Mark, 
            "Pass_Mark_Percentage":Pass_Mark_Percentage, 
            "Achieved_Creative_Mark":Achieved_Creative_Mark,
            "Achieved_Objective_Mark":Achieved_Objective_Mark,
            "Achieved_Practical_Mark":Achieved_Practical_Mark
        });
                
        $('#Roll').val('');    // clear input
        $('#Achieved_Creative_Mark').val('');    // clear input
        $('#Achieved_Objective_Mark').val('');    // clear input
        $('#Achieved_Practical_Mark').val('');    // clear input
        //$('#display').hide(); // hide div display
        //$('#details').show(); // hide div display
        
    });
});


// live search 

$(document).ready(function() {
   $("#Roll").keyup(function() {
       var Session = $("#Session").val();
        var Class = $("#Class").val();
        var Group = $("#Group").val();
        var Roll = $("#Roll").val();
       
       $("#display").load('exam_view_student_data_without_insert_update.php', {
            "Session":Session, 
            "Class":Class,
            "Group":Group,
            "Roll":Roll
        });
        //$('#details').hide(); // hide div display
        //$('#display').show(); // hide div display
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
                data:'Session_id='+sessionID,
                success:function(html){
                    $('#Exam').html(html);
                }
            }); 
        
        }else{
            
            $('#Exam').html('<option value="">Select session first</option>');
            $('#Subject').html('<option value="">Select session first</option>');
        }
        
        $('#Class').val(''); // clear class
        $('#Subject').val(''); // clear class
        $('#Mark_Type_Selection').val('0'); // clear class
        
    });
});


// subject selection
$(document).ready(function(){ 
    
    $('#Class').val(''); // clear class
    
    $('#Class').on('change',function(){
        var ClassID = $(this).val();
        if(ClassID){
            $.ajax({
                type:'POST',
                url:'depandent_selection_data.php',
                data:'Class_id='+ClassID,
                success:function(html){
                    $('#Subject').html(html);
                }
            }); 
        }
        /*
        else{
            
            $('#Class').html('<option value="">Select session first</option>');
        }
        */
        $('#Subject').val(''); // clear class
        $('#Mark_Type_Selection').val('0'); // clear class
        
    });

});



// show hide exam type
$(function() {
    
    $('#Creative, #Objective, #Practical, #Creative_Achieved, #Objective_Achieved, #Practical_Achieved').hide();
    
    $('#Mark_Type_Selection').change(function(){
        if($('#Mark_Type_Selection').val() == '1') {
            $('#Objective, #Practical, #Objective_Achieved, #Practical_Achieved').hide();
            $('#Creative, #Creative_Achieved').show();
            
            $('#Creative_Full_Mark').val('');    // clear input
            $('#Objective_Full_Mark').val('');    // clear input
            $('#Practical_Full_Mark').val('');    // clear input
            
            $('#Achieved_Creative_Mark').val('');    // clear input
            $('#Achieved_Objective_Mark').val('');    // clear input
            $('#Achieved_Practical_Mark').val('');    // clear input
            
            
        } else if ($('#Mark_Type_Selection').val() == '2'){
            
            $('#Practical, #Practical_Achieved').hide();
            
            $('#Creative, #Objective, #Creative_Achieved, #Objective_Achieved').show();
            
            $('#Creative_Full_Mark').val('');    // clear input
            $('#Objective_Full_Mark').val('');    // clear input
            $('#Practical_Full_Mark').val('');    // clear input
            
            $('#Achieved_Creative_Mark').val('');    // clear input
            $('#Achieved_Objective_Mark').val('');    // clear input
            $('#Achieved_Practical_Mark').val('');    // clear input
            
        } else if ($('#Mark_Type_Selection').val() == '3'){
            
            $('#Creative, #Objective, #Practical, #Creative_Achieved, #Objective_Achieved, #Practical_Achieved').show();
            
            $('#Creative_Full_Mark').val('');    // clear input
            $('#Objective_Full_Mark').val('');    // clear input
            $('#Practical_Full_Mark').val('');    // clear input
            
            $('#Achieved_Creative_Mark').val('');    // clear input
            $('#Achieved_Objective_Mark').val('');    // clear input
            $('#Achieved_Practical_Mark').val('');    // clear input
            
        }else if ($('#Mark_Type_Selection').val() == '4'){
            $('#Creative, #Practical, #Creative_Achieved, #Practical_Achieved').hide();
            $('#Objective, #Objective_Achieved').show();
            
            $('#Creative_Full_Mark').val('');    // clear input
            $('#Objective_Full_Mark').val('');    // clear input
            $('#Practical_Full_Mark').val('');    // clear input
            
            $('#Achieved_Creative_Mark').val('');    // clear input
            $('#Achieved_Objective_Mark').val('');    // clear input
            $('#Achieved_Practical_Mark').val('');    // clear input
            
        }else if ($('#Mark_Type_Selection').val() == '5'){
            $('#Creative, #Objective, #Creative_Achieved, #Objective_Achieved').hide();
            $('#Practical, #Practical_Achieved').show();
            
            $('#Creative_Full_Mark').val('');    // clear input
            $('#Objective_Full_Mark').val('');    // clear input
            $('#Practical_Full_Mark').val('');    // clear input
            
            $('#Achieved_Creative_Mark').val('');    // clear input
            $('#Achieved_Objective_Mark').val('');    // clear input
            $('#Achieved_Practical_Mark').val('');    // clear input
            
        }else{
            $('#Creative, #Objective, #Practical, #Creative_Achieved, #Objective_Achieved, #Practical_Achieved').hide();
        }
    });
});

// enter key next
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




// alert dissmiss
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
