<?php 
 $cn = new mysqli("localhost","root","","php");
 $cn->set_charset("utf8");
?>
<div class='frm' style="width:70%;">
    <div class='head'>
        <span>News</span>
        <i class='fas fa-times' id='btnClose'></i>
    </div>
    <form class='upl'>
        <div class='body'>
            <div class='box1'>
                <input type="text" name="txt-edit-id" id="txt-edit-id" value="0">
                <label for="">ID</label>
                <input type="text" name="txt-id" id="txt-id" class='frm-control'>
                <label for="">Menu</label>
                <select name="txt-menu" id="txt-menu" class='frm-control'>
                <option value="0"></option>
                <?php
                    $sql = "SELECT id,name FROM tbl_menu WHERE status=1";
                    $res = $cn->query($sql);
                    if($res->num_rows>0){
                        while($row = $res->fetch_array()){
                            ?>
                                <option value="<?php echo $row[0];?>">
                                    <?php echo $row[1]; ?>
                                </option>
                            <?php
                        }
                    }
                ?>
                </select>
                <label for="">OD</label>
                <input type="text" name="txt-od" id="txt-od" class='frm-control'>
                <label for="">Status</label>
                <select name="txt-status" id="txt-status"  class='frm-control'>
                <option value="1">1</option>
                <option value="2">2</option>
                </select>
                <label for="">Photo</label>
                <div class='img-box'>
                    <input type="file" name="txt-file" id="txt-file" class='txt-file'>
                    <input type="text" name="txt-photo" id="txt-photo" class='txt-file'>
                </div>
            </div>
            <div class='box2'>
                <label for="">Title</label>
                <input type="text" name="txt-title" id="txt-title" class='frm-control'>
                <br><br><br>
                <label for="">Description</label>
                <textarea class='frm-control' name="txt-des" id="txt-des"></textarea>
            </div>
        </div>
        <div class='footer'>
            <div class='btn btn-save'>
                <i class='fas fa-save'></i>Save Change
            </div>
        </div>
    </form>
</div>