<div class='frm'>
    <div class='head'>
        <span>Menu</span>
        <i class='fas fa-times' id='btnClose'></i>
    </div>
    <form class='upl'>
        <div class='body'>
            <input type="text" name="edit-id" id="edit-id" value="0">
            <input type="hidden" name="txt-edit-id" id="txt-edit-id" value="0">
            <label for="">ID</label>
            <input type="text" name="txt-id" id="txt-id" class='frm-control'>
            <label for="">Name</label>
            <input type="text" name="txt-name" id="txt-name" class='frm-control'>
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
                <input type="" name="txt-photo" id="txt-photo">
            </div>

        </div>
        <div class='footer'>
            <div class='btn btn-save'>
                <i class='fas fa-save'></i> Save Change
            </div>
        </div>
    </form>
</div>