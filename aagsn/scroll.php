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
                    $query = $dbo->query('SELECT * FROM scroll');
                    while ($scroll = $query->fetch()){
                        echo "<b>".$scroll['srl_title']."</b>&nbsp;&nbsp;" .$scroll['srl_desc']. "&nbsp;&nbsp;"; 
                    }
                    ?>
                </marquee>
            </td>
        </tr>
    </table>    
