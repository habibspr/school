<!--FREE ACCESS HEADER-->
<?php include($_SERVER["DOCUMENT_ROOT"]."/login/free_access_header.php");?>

<?php include "header.php";?>
<?php include "../nav-bar.php";?>

<!--FREE ACCESS FOOTER-->
<?php include($_SERVER["DOCUMENT_ROOT"]."/login/free_access_footer.php");?>


<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type = "text/javascript" language = "javascript">
    $(document).ready(function() {
        $("#button").click(function(event){
            var studentid = $("#studentid").val();
            
            $("#details").load('atdn_insert_data.php', {"studentid":studentid} );
            
            $('#studentid').val('');    // clear input
        });
    });
    
    function onClick(){
        if(document.getElementById("studentid").value.length>=10)
            document.getElementById('button').click();
    }    
</script>
<?php
// for auto reload page
$page = $_SERVER['PHP_SELF'];
$now = time();
$today = strtotime('00:00');
$tomorrow = strtotime('tomorrow 00:00');
if (($today - $now) > 0) {
    $refreshTime = $today - $now;
} else {
    $refreshTime = $tomorrow - $now;
}

header("Refresh: $refreshTime; url=$page");
?>
<div class="container">        
    <div class="row has-success">
        <div class="col-sm-12">         
            <h2 class="text-success">Enter ID:  <span style="color:red;"><?php echo date('F d, Y');?></span></h2>            
            <input type="text" onkeyup="onClick()" maxlength="10" id="studentid" name="studentid" class="form-control"  autofocus>
            <input type = "button"  id = "button" hidden="hidden" value = "Add" />
        </div>
        <div class="col-sm-12">
            <div id = "details"></div>
        </div>
    </div>
<?php include 'footer.php';?>