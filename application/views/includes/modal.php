<div class="modal fade" id="user_logout" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Leaving so soon?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Do you wish to sign out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal">No, I will stay</button>
                <a href="<?=base_url();?>user_logout" class="btn btn-danger btn-sm">Yes, sign me out</a>
            </div>
        </div>
    </div>
</div>

<!-- doctor's Profile -->
<div class="modal fade" id="UploadPicture" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Upload Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?=form_open_multipart(base_url()."upload_user_picture");?>
            <input type="hidden" name="code" value="<?=$this->session->apcode;?>">
            <div class="modal-body">
               <div class="form-group">
                    <label>Select Picture</label>
                    <input type="file" name="file" class="form-control" required>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success btn-sm" value="Upload">
            </div>
            <?=form_close();?>
        </div>
    </div>
</div>
