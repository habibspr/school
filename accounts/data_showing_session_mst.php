 <!--Showing data-->
    <?php 
    include "../resources/db_aags_n.php" ;

   
    $session = date('Y');
    $sm_class = $_POST['sm_class'];
    
    $i=1;
    if($sm_class){
        $data_result = mysqli_query($link, "SELECT gsm_session, sc_name, ac_hm_name, ac_sm_amount FROM 
        ac_session_mst, 
        global_session_mst, 
        st_class, 
        ac_head_mst 
        WHERE ac_session_mst.ac_sm_gsm_id = global_session_mst.gsm_id 
        AND ac_session_mst.ac_sm_class_id = st_class.sc_id 
        AND ac_head_mst.ac_hm_id=ac_session_mst.ac_sm_ahm_id
        AND st_class.sc_id='$sm_class'
        ORDER BY ac_sm_id DESC");
    }else{
        $data_result = mysqli_query($link, "SELECT gsm_session, sc_name, ac_hm_name, ac_sm_amount FROM 
        ac_session_mst, 
        global_session_mst, 
        st_class, 
        ac_head_mst 
        WHERE ac_session_mst.ac_sm_gsm_id = global_session_mst.gsm_id 
        AND ac_session_mst.ac_sm_class_id = st_class.sc_id 
        AND ac_head_mst.ac_hm_id=ac_session_mst.ac_sm_ahm_id
        ORDER BY ac_sm_id DESC");
        
    }
    ?>
    <table class="table table-bordered table-condensed table-responsive">
        <thead class="bg-success">
            <tr>
                <th>#Serial</th>
                <th>Session</th>
                <th>Class</th>
                <th>Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_assoc($data_result)){
            ?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $row["gsm_session"];?></td>
                <td><?php echo $row["sc_name"];?></td>
                <td><?php echo $row["ac_hm_name"];?></td>
                <td><?php echo $row["ac_sm_amount"];?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>