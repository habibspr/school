<!--Auth Check-->
<?php include $_SERVER["DOCUMENT_ROOT"]."/login/check_auth.php";?>

<?php include "../aagsn/header.php";?>
<?php include "../nav-bar.php";?>
 <style type="text/css">
    .menu-container {
        padding: 0;
        margin: 0;
        list-style: none;
        margin: 0 auto;
      }
  
  .menu-item {
    display: block;
    background: #2e4053 ;
    padding: 5px;
    height: 150px;
    margin-top: 10px;
    line-height: 130px;
    color: white;
    font-weight: bold;
    font-size: 1.8em;
    text-align: center;
    
  }


  a {
      color: white;
      margin: 0 auto;
      display: block;
  }
  
  a:hover {
      background-color:  #5d6d7e;
      text-decoration: none;
      color: orange;
  }
  
 </style>
 
<div class="container">
    <div class="menu-container">
	    <div class="row no-gutter">
    		<div class="col-sm-4">
    		    <a class="menu-item" href="cash_receive.php">Cash Receive</a>
    		</div>
    		<div class="col-sm-4">
    		    <a class="menu-item" href="../ac_expense">Expense</a>
    		</div>
	        <div class="col-sm-4">
	            <a class="menu-item" href="../aagsn/ac_collection_form.php">Cash Reveive Report</a>
	        </div>
            <div class="col-sm-4">
	            <a class="menu-item" href="../aagsn/ac_student_payment_report_form.php">Students Payment Report</a>
	        </div>
        </div>
    </div>
</div>
        