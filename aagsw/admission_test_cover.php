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
<head>
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
<?php
    if(mysqli_num_rows($result_student_details) > 0){
        while ($row_student_details = mysqli_fetch_assoc($result_student_details)) {
?>
        <header>
            <div class="container">
                <div>
                    <div class="text-center">
                        <img src="../images/logo.png" alt="Logo" width="80" height="70" />
                        <p>The future begings here.</p>
                        <h3>হাফেজ আব্দুর রাশিদ স্কুল এন্ড কলেজ</h3>
                        <h3>Hafez Abdur Rashid School & College</h3>
                    </div>
                </div>
            </div>
        </header>
        <h4 class="text-center"><strong>(Merit Evaluation Exam - 2020)</strong></h4>
        <p class="text-center">Date: 13 January 2020</p>
        <section class="main">
            <div class="container">
                    <table class="table table-bordered table-responsive" style="margin-top: 50px;">
                        <tr>
                            <td>ID</td>
                            <th><?php echo $row_student_details["aui_form_no"];?></th>
                            <th>Invigilator Sign</th>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <th><?php echo $row_student_details["aui_name"];?></th>
                            <td rowspan = "3"></td>
                        </tr>
                        <tr>
                            <td>Father's Name:</td>
                            <th><?php echo $row_student_details["aui_father_name"];?></th>
                        </tr>
                        <tr>
                            <td>Class:</td>
                            <th><?php echo $row_student_details["acm_name"];?></th>
                        </tr>
                    </table>
            </div>
        </section>
        <section>
            <div class="container">
                <table class="table table-bordered table-responsive sub-num">
                    <tr>
                        <th>Subject</th>
                        <th>Number</th>
                        <th>Examiner Sign</th>
                    </tr>
                    <tr>
                        <td>Bangla</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>English</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Math</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Science</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <div class="comment-box" style="height: 150px; width: 100%; border: 1px solid #000; margin-top: 100px">
                    <p style="padding: 10px;">Comment:</p>
                </div>
            </div>
        </section>
        <P style="page-break-before: always">
<?php } } ?>
        
        <script type="text/javascript" src="../dist/js/jquery.min.js"></script>
        <script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
        </body>
</html>
