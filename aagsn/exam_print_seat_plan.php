<!-- database connection -->
<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
<?php include "../resources/db_aags_n.php" ;?>

<div class="container">
<?php 
        if(isset($_POST['exam'])){
            $exam = $_POST['exam'];  
            $result = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id='$exam'");
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        $ExamLock=$row['exm_lock'];
                        $examName = $row['exm_name'];
                        $Session=$row['exm_year'];
                    }
                }
            }
            
if($ExamLock){?> 
<div class="row text-center" style="margin-top:100px;">
        <div class="col-sm-12">
            <div class="alert alert-danger fade in">
                <strong>Warning!</strong> Exam Locked!
            </div>
        </div>
    </div>
    
<?php die(); }
                    
    //for session
    $current_session = date('Y');

    if(true){
        $get_st_id = 1;
        $result_student_details = mysqli_query($link, "SELECT *
                    FROM ((
                    st_session
                    INNER JOIN st_class ON st_class.sc_id = st_session.ss_class_id )
                    INNER JOIN student_info ON st_session.ss_st_id = student_info.st_id)
                    WHERE st_session.ss_year = '$current_session' AND student_info.st_status = '0' 
                    ORDER BY st_class.sc_id, st_session.ss_roll ASC" );
    }
?>

    <style type="text/css">
            .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
                    border: 1px solid #000;
            }
            .table-bordered {
                     border: 1px solid #000;
             }
             @media print{
            .table thead tr td,.table tbody tr td, .table-bordered > tbody > tr > th{
                border-width: 1px !important;
                border-style: solid !important;
                border-color: #000 !important;
            }
            .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #000;
}
        }
        .sub-num tr td, .sub-num tr th {
            padding: 10px !important;
        }

    </style>


<style media="print">
  .table thead tbody tfoot tr td {
     border: 1px solid #000000!important;
  }
</style>
             <div class="row">
                        <?php
    if(mysqli_num_rows($result_student_details) > 0){
        $i = 1;
        while ($row_student_details = mysqli_fetch_assoc($result_student_details)) {
?>
                        <div class="col-xs-6 col-md-4" style="padding: 10px">
                            
                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                <tr>
                                    <th colspan = "2" class="text-center">Hafez Abdur Rashid School & College</th>
                                </tr>
                                <tr>
                                    
                                    <th colspan = "2" class="text-center"><?php echo $examName, - $Session;?></th>

                                </tr>
                                <tr>
                                    <th style = "width:100px">Name</th>
                                    <th><?php echo $row_student_details["st_name"];?></th>

                                </tr>
                                <tr>
                                    <th>Class</th>
                                    <th><?php echo $row_student_details["sc_name"];?></th>
                                </tr>
                                <tr>
                                    <th>Roll No.</th>
                                    <th><?php echo $row_student_details["ss_roll"];?></th>
                                </tr>
                            </table>
                        </div>
                        <?php
                            if($i == 10){
                                echo '<P style="page-break-before: always">';
                                $i = 1;
                                continue;
                            }
                            $i++;
                            } } 
                         ?>
                    </div>
            </div>
        <P style="page-break-before: always">
        <script type="text/javascript" src="../dist/js/jquery.min.js"></script>
        <script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
        </body>
</html>
