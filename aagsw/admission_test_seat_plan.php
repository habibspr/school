<!-- database connection -->

<?php include "../resources/db_aags_w.php" ;?>
<?php include "../global.php" ;?>

<?php

    //for session
    $current_session = date('Y');

    if(true){
        $get_st_id = 1;

        $result_student_details = mysqli_query($link, "SELECT *
                    FROM (adm_user_info
                    INNER JOIN adm_class_mst ON adm_class_mst.acm_id = adm_user_info.aui_class_id) 
                    WHERE aui_session = '$current_session' ORDER BY adm_class_mst.acm_id, adm_user_info.aui_id ASC" );
    }
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cover Page</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>
        <section class="main">
            <div class="container">
                    <div class="row">
                        <?php
    if(mysqli_num_rows($result_student_details) > 0){
        $i = 1;
        while ($row_student_details = mysqli_fetch_assoc($result_student_details)) {
?>
                        <div class="col-xs-6 col-md-4" style="padding: 10px">
                            <table class="table table-bordered table-responsive" style="margin-bottom: 0px;">
                                <tr>
                                    <th style = "width:200px">ID</th>
                                    <th><?php echo $row_student_details["aui_form_no"];?></th>

                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <th><?php echo $row_student_details["aui_name"];?></th>
                                </tr>
                                <tr>
                                    <th>Father's Name</th>
                                    <th><?php echo $row_student_details["aui_father_name"];?></th>
                                </tr>
                                 <tr>
                                    <th>Class</th>
                                    <th><?php echo $row_student_details["acm_name"];?></th>
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
        </section>
        <P style="page-break-before: always">
        
        <script type="text/javascript" src="../dist/js/jquery.min.js"></script>
        <script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
        </body>
</html>
