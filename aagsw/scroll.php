<?php include "../aagsw/resources/db_aagsw.php" ;?>
<?php include "../aagsw/resources/dbo_aagsw.php" ;?>

<style type="text/css">
    #scrollheader{
        border-color: transparent;
        border: 0px;
        width: 100px;
        color: white;
        text-align: right;
        background-color:blue;
        box-shadow: 4px 4px 4px #d9d9d9;
        
    }
    #scrollcontent{
        border-color: transparent;
        border: 0px;
        color: red;        
        background-color: transparent;
        box-shadow: 4px 4px 4px #d9d9d9;
    }
</style>
<table class="table">
        <tr>
            <th id="scrollheader"><span>দৃষ্টি আকর্ষণ:</span></th>
            <td id="scrollcontent">
                <marquee>
                    <?php
                    $result = mysqli_query($link, "SELECT * FROM scroll ORDER BY srl_id ASC");
                    while($row = mysqli_fetch_array($result)){
                        echo "<b>".$row['srl_title']."</b>&nbsp;&nbsp;".$row['srl_desc']."&nbsp;&nbsp;";
                    }
                    // Close connection
                            mysqli_close($link);
                    ?>
                </marquee>
            </td>
        </tr>
    </table>    
