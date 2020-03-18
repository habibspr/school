// toogle plus minus

$(document).ready(function(){
    
    $(".plus").show();
    $(".minus").hide();    
    $(".jumbotron").hide();
    
    $(".plus").click(function(){
        $(".minus").show();
        $(".plus").hide();
        $(".jumbotron").show(); 
        $("#Display_Add_Form").show();
        $("#Display_Add_Form").load('etss_add.php');          
    });
    
    $(".add").click(function(){
        $(".minus").show();
        $(".plus").hide();
        $(".jumbotron").show(); 
        $("#Display_Add_Form").show();
        $("#Display_Add_Form").load('etss_add.php');          
    });
    
     $(".minus").click(function(){
         $(".minus").hide();
         $(".plus").show();
         $(".jumbotron").hide();
          $("#Display_Add_Form").hide();
     });      
});

// add in data
$(document).ready(function(){
        $(".submit").click(function(){ 
            
            var Session = $("#Session").val();
            var techer_id = $("#techer_id").val();
            var class_id = $("#class_id").val();
            var subject_id = $("#subject_id").val();
            var status_code = $("#status_code").val();
            
            $("#livesearch_table").load('etss_insert.php', {
                
                "Session":Session,
                "techer_id":techer_id,
                "class_id":class_id,
                "subject_id":subject_id,
                "status_code":status_code
            });
            // for auto load div
            $("#livesearch_table").load(location.href+" #livesearch_table>*","");
            
            $(".minus").hide();
            $(".plus").show();
            $(".jumbotron").hide();
        });
    });
  
// delete data
$(document).ready(function(){
        $(".delete").click(function(){ 
            
            var etss_id = $("#etss_id").val();
            
            $("#livesearch_table").load('etss_delete.php', {
            
                "etss_id":etss_id
            });
            
            // for auto load div
            $("#livesearch_table").load(location.href+" #livesearch_table<*","");
            
                        
            $(".minus").hide();
            $(".plus").show();
            $(".jumbotron").hide();
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