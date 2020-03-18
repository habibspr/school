src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js";
src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js";


// load add session form

$(document).ready(function() {
    $("#Button_Show_Session_From").click(function(){        
        $("#Show_Session_From").load('adm_add_session.php'); 
        $("#Button_Show_Session_From").hide();
    });    
});
