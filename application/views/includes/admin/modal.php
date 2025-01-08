<div class="modal fade" id="admin_logout" tabindex="-1" data-bs-backdrop="false">
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
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal"> No, I will stay</button>
                <a href="<?=base_url();?>admin_logout" class="btn btn-danger btn-sm"> Yes, sign me out</a>
            </div>
        </div>
    </div>
</div>

<!-- New doctor -->
<div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDoctorModalLabel">Add New Doctor</h5>
          <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addDoctorForm" method="POST" action="<?= base_url(); ?>submit_new_doctor">
        <div class="modal-body">
            <input type="hidden" class="form-control" name="gencode" value="<?=$gencode;?>">
            <div class="row">
                <div class="col-md-3">
                    <label for="dclastname" class="form-label"> Last Name</label>
                    <input type="text" class="form-control" id="dclastname" name="dclastname" placeholder="" oninput="this.value = this.value.toUpperCase();" required>
                </div>
                <div class="col-md-3">
                    <label for="dcfirstname" class="form-label"> First Name</label>
                    <input type="text" class="form-control" id="dcfirstname" name="dcfirstname" placeholder="" oninput="this.value = this.value.toUpperCase();" required>
                </div>
                <div class="col-md-3">
                    <label for="dcmiddlename" class="form-label"> Middle Name</label>
                    <input type="text" class="form-control" id="dcmiddlename" name="dcmiddlename" placeholder="" oninput="this.value = this.value.toUpperCase();" required>
                </div>
                <div class="col-md-3">
                    <label for="dcsuffix" class="form-label"> Suffix</label>
                    <input type="text" class="form-control" id="dcsuffix" name="dcsuffix" placeholder="" oninput="this.value = this.value.toUpperCase();">
                </div>
                <div class="col-md-5 mt-2">
                    <label for="specialization" class="form-label">Specialization</label>
                    <select class="selectsearch" id="specialization" name="specialization" data-placeholder="--- select specialization ---" required>
                        <?php
                            foreach ($listspec as $spec) {
                                echo "<option value='" . htmlspecialchars($spec['specialization'], ENT_QUOTES, 'UTF-8') . "'>" 
                                . htmlspecialchars($spec['specialization'], ENT_QUOTES, 'UTF-8') . 
                                "</option>";
                            }
                        ?>
                    </select> 
                </div>
                <div class="col-md-3 mt-2">
                    <label for="phicaccno" class="form-label"> PHIC Accrediation No.</label>
                    <input type="text" class="form-control" id="phicaccno" name="phicaccno" placeholder="" required>
                </div>
                <div class="col-md-2 mt-2">
                    <label for="" class="form-label"> TIN</label>
                    <input type="text" class="form-control" id="tin" name="tin" placeholder="" required>
                </div>
                <div class="col-md-2 mt-2">
                    <label for="" class="form-label"> PF</label>
                    <input type="text" class="form-control" id="pf" name="pf" placeholder="">
                </div>
                <div class="col-md-3 mt-2">
                    <label for="" class="form-label"> Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                </div>
                <div class="col-md-3 mt-2">
                    <label for="" class="form-label"> License No.</label>
                    <input type="text" class="form-control" id="license" name="license" placeholder="" required>
                </div>
                <div class="col-md-3 mt-2">
                    <label for="" class="form-label"> PTR No.</label>
                    <input type="text" class="form-control" id="ptrno" name="ptrno" placeholder="" required>
                </div>
                <div class="col-md-3 mt-2">
                    <label for="" class="form-label"> S2 No.</label>
                    <input type="text" class="form-control" id="s2no" name="s2no" placeholder="">
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel</button>
          <button type="submit" form="addDoctorForm" class="btn btn-primary"> Save Doctor</button>
        </div>

        </form>
      </div>
    </div>
</div>

<!-- modal File upload  -->
<div class="modal fade" id="UploadPicture" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-logo">
                <span class="logo-circle">
                    <svg width="25" height="25" viewBox="0 0 512 419.116">
                    <defs> <clipPath id="clip-folder-new"> <rect width="512" height="419.116"></rect> </clipPath></defs>
                    <g id="folder-new" clip-path="url(#clip-folder-new)">
                        <path id="Union_1" data-name="Union 1" d="M16.991,419.116A16.989,16.989,0,0,1,0,402.125V16.991A16.989,16.989,0,0,1,16.991,0H146.124a17,17,0,0,1,10.342,3.513L227.217,57.77H437.805A16.989,16.989,0,0,1,454.8,74.761v53.244h40.213A16.992,16.992,0,0,1,511.6,148.657L454.966,405.222a17,17,0,0,1-16.6,13.332H410.053v.562ZM63.06,384.573H424.722L473.86,161.988H112.2Z" fill="var(--c-action-primary)" stroke="" stroke-width="1"></path>
                    </g>
                    </svg>
                </span>
                </div>
                <button data-bs-dismiss="modal" class="btn-close">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" fill="var(--c-text-secondary)"></path>
                </svg>
                </button>
            </div>
            <form id="upload-form" method="POST" enctype="multipart/form-data" action="<?= base_url('uploadProfilePicture/' . $fth['code'])?>">
            <div class="modal-body">
                <p class="modal-title">Upload Profile Picture</p>
                <p class="modal-description">Choose and adjust your profile picture below.</p>
                <label for="file-upload" class="upload-area" id="fileupload">
                    <span class="upload-area-icon">
                        <svg width="35" height="35" viewBox="0 0 340.531 419.116">
                            <g id="files-new" clip-path="url(#clip-files-new)"> <path id="Union_2" data-name="Union 2" d="M-2904.708-8.885A39.292,39.292,0,0,1-2944-48.177V-388.708A39.292,39.292,0,0,1-2904.708-428h209.558a13.1,13.1,0,0,1,9.3,3.8l78.584,78.584a13.1,13.1,0,0,1,3.8,9.3V-48.177a39.292,39.292,0,0,1-39.292,39.292Zm-13.1-379.823V-48.177a13.1,13.1,0,0,0,13.1,13.1h261.947a13.1,13.1,0,0,0,13.1-13.1V-323.221h-52.39a26.2,26.2,0,0,1-26.194-26.195v-52.39h-196.46A13.1,13.1,0,0,0-2917.805-388.708Zm146.5,241.621a14.269,14.269,0,0,1-7.883-12.758v-19.113h-68.841c-7.869,0-7.87-47.619,0-47.619h68.842v-18.8a14.271,14.271,0,0,1,7.882-12.758,14.239,14.239,0,0,1,14.925,1.354l57.019,42.764c.242.185.328.485.555.671a13.9,13.9,0,0,1,2.751,3.292,14.57,14.57,0,0,1,.984,1.454,14.114,14.114,0,0,1,1.411,5.987,14.006,14.006,0,0,1-1.411,5.973,14.653,14.653,0,0,1-.984,1.468,13.9,13.9,0,0,1-2.751,3.293c-.228.2-.313.485-.555.671l-57.019,42.764a14.26,14.26,0,0,1-8.558,2.847A14.326,14.326,0,0,1-2771.3-147.087Z" transform="translate(2944 428)" fill="var(--c-action-primary)" ></path></g>
                        </svg>
                    </span>
                    <span class="upload-area-title">Drag file(s) here to upload.</span>
                    <span class="upload-area-description">Alternatively, you can select a file by <br /><strong> clicking here.</strong></span>
                    <input id="file-upload" name="drpic" type="file" accept="image/png, image/jpeg, image/jpg" style="display: none;" />
                    <input type="hidden" class="form-control" id="drcode" value="<?=$fth['code'];?>">
                </label>
                <div id="crop-container" class="crop-container hidden">
                    <img id="crop-image" src="" alt="Image to Crop" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="location.reload();">Cancel</button>
                <button type="button" class="btn-primary" id="save-crop">Upload File</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- modal alerts -->
<div class="modal fade" id="confirmationUpdateModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
            <div class="content">
                <i class="bi bi-check2-square"></i><span class="cont-hdr"> Confirmation</span>
                <p>Are you sure, do you want to update this doctor's information?</p>
            </div>
            </div>
            <div class="conf-btn">
                <button class="btn btn-secondary" data-bs-dismiss="modal"> No</button>
                <button class="btn btn-success" onclick="submitUpdateDoctor()"> Yes</button>
            </div>
        </div>
      </div>
    </div>
</div>

<!-- pop up alerts / toast notifications -->
    <!-- success -->
    <div class="modal fade" id="popupAlertSuccess" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox success center animate">r
                <div class="icon">
			    	<span class="bi bi-check-lg"></span>
			    </div>
			    <h1>Success!</h1>
			    <p id="alertMessage"></p>
			    <button type="button" class="btn confSBtn" style="text-align:center">Ok</button>
            </div>
        </div>
    </div>
    <!-- failed -->
    <div class="modal fade" id="popupAlertFailed" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox error center animate">
                <div class="icon">
			    	<span class="bi bi-x-lg"></span>
			    </div>
                <h1>Database Error</h1>
                <p>We encountered an issue while saving the information. Please check your input or contact the system administrator for assistance.</p>
			    <button type="button" class="btn confEBtn" style="text-align:center">OK</button>
            </div>
        </div>
    </div>
      <!-- warning -->
    <div class="modal fade" id="popupAlertWarning" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modalbox warning center animate">
                <div class="icon">
			    	<span class="bi bi-exclamation-lg"></span>
			    </div>
			    <h1>Warning!</h1>
			    <p id="alertWMessage">Oops! Something went wrong,</p>
			    <button type="button" class="btn confWBtn" style="text-align:center">OK</button>
            </div>
        </div>
    </div>