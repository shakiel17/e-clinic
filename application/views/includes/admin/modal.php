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
                    <label for="specialization" class="form-label"> Specialization</label>
                    <select type="text" class="selectsearch" id="specialization" name="specialization" data-placeholder="--- select specialization ---" required>
                        <?php
                            foreach($listspec as $spec){
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
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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