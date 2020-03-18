<?php include "header.php";?>
<?php include '../nav-bar.php';?>

<div class="container">
    <h4 class="text-left">Click to Update</h4>
    <hr>
    <div class="col-sm-4 col-lg-12">
        <div class="form-group">
            <?php
            if (isset($_GET['submit'])) {
                $exm_id = $_GET['exm_id'];
                $exm_name = $_GET['exm_name'];
                $exm_cat = $_GET['exm_cat'];
                $exm_ex_mark1 = $_GET['exm_ex_mark1'];
                $exm_ex_mark2 = $_GET['exm_ex_mark2'];
                $exm_ex_mark3 = $_GET['exm_ex_mark3'];
                $exm_extra_percent = $_GET['exm_extra_percent'];
                $exm_current_percent = $_GET['exm_current_percent'];
                
                $query = mysqli_query($link,"UPDATE exm_mst SET exm_name='$exm_name', exm_year=CURRENT_DATE(), exm_cat='$exm_cat', exm_ex_mark1='$exm_ex_mark1', exm_ex_mark2='$exm_ex_mark2', exm_ex_mark3='$exm_ex_mark3', exm_extra_percent='$exm_extra_percent', exm_current_percent='$exm_current_percent'  WHERE exm_id='$exm_id'");
            }
            ?>
            <label for="exm_name" class="col-sm-4 control-label">
                <?php
                $query = mysqli_query($link, "SELECT * FROM exm_mst");
            while ($row = mysqli_fetch_array($query)) {?>
                <p>
                    <a href='exam_update_exam.php?update=<?php echo $row['exm_id'];?>' >
                    <?php echo $row['exm_name']."-".$row['exm_year'];?> </a>
                </p> <?php } ?>
            </label>   
            
            <div class="col-md-8">
                <?php 
                if (isset($_GET['update'])) {
                    $update = $_GET['update'];
                    $query1 = mysqli_query($link, "SELECT * FROM exm_mst WHERE exm_id=$update");
                    while ($row1 = mysqli_fetch_array($query1)){
                        $examcategory=$row1['exm_cat'];
                ?>
                <form class="form-horizontal" action="" role="form" method="get">
                    <input class='input' type='hidden' name='exm_id' value='<?php echo $row1['exm_id'];?>'/>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="exm_name" class="col-md-4 control-label">Exam Name </label>
                                <div class="col-md-8">
                                    <input type='text' name='exm_name' value="<?php echo $row1['exm_name'];?>" size="60px" /> 
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="exm_cat" class="col-md-4 control-label">Exam Catagory <small>[Single=0/Multiple=1]</small></label>
                                <div class="col-md-4">
                                    <input type='text' name='exm_cat' value='<?php echo $row1['exm_cat'];?>'/> 
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="exm_ex_mark1" class="col-md-4 control-label">Exam Mark1 </label>
                                <div class="col-md-4">
                                    <input type='text' name='exm_ex_mark1' value='<?php echo $row1['exm_ex_mark1'];?>'/>                        
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="exm_ex_mark2" class="col-md-4 control-label">Exam Mark2 </label>
                                <div class="col-md-4">
                                    <input type='text' name='exm_ex_mark2' value='<?php echo $row1['exm_ex_mark2'];?>'/> 
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="exm_ex_mark3" class="col-md-4 control-label">Exam Mark3 </label>
                                <div class="col-md-4">
                                    <input type='text' name='exm_ex_mark3' value='<?php echo $row1['exm_ex_mark3'];?>'/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="exm_extra_percent" class="col-md-4 control-label">Extra Exam Percent </label>
                                <div class="col-md-4">
                                    <input type='text' name='exm_extra_percent' value='<?php echo $row1['exm_extra_percent'];?>'/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="exm_current_percent" class="col-md-4 control-label">Current Exam Percent </label>
                                <div class="col-md-4">
                                    <input type='text' name='exm_current_percent' value='<?php echo $row1['exm_current_percent'];?>'/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <button type='submit' name='submit' class="btn btn-primary"><span class="glyphicon glyphicon-check"> Update</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                    }
                }
                if (isset($_GET['submit'])) {?>
                        Data Updated Successfuly......!!
            </div>
            <?php }
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
