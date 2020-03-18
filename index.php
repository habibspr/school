<?php
	include "header.php";
 ?>

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
	    
        <div class="row">
            <div>
    		    <h1 style="" class="text-center text-success">APPLICATIONS</h1>
    		</div>
		</div>
		<div class="menu-container">
		    <div class="row no-gutter">
		        <div class="col-sm-3">
		            <a class="menu-item" href="aagsn/atdn_print_all_student_summary.php">Report</a>
		        </div>
		        
		        <div class="col-sm-3">
                    <a class="menu-item" href="/aagsn">Attendance</a>
                </div>
                
                <div class="col-sm-3">
                    <a class="menu-item" href="/accounts">Accounts</a>
                </div>
                
                <div class="col-sm-3">
                    <a class="menu-item" href="/exam">Exam</a>
                </div>
                
                <div class="col-sm-3">
                    <a class="menu-item" href="/teacher">Teacher</a>    
                </div>
                <div class="col-sm-3">
                    <a class="menu-item" href="/image_uploader">Set Image</a>
                </div>
                <div class="col-sm-3">
		            <a class="menu-item" href="/student_leave">Student Leave</a>
		        </div>
                <div class="col-sm-3">
		            <a class="menu-item" href="/aagsw">Admission</a>
		        </div>
		    </div>
        </div>
	</div>