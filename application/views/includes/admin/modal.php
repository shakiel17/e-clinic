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
        <form id="addDoctorForm" method="POST" action="<?=base_url();?>submitNewDoctor">
        <div class="modal-body">

            <div class="row">
                <div class="col-md-3">
                    <label for="dclastname" class="form-label"> Last Name</label>
                    <input type="text" class="form-control" id="dclastname" name="dclastname" placeholder="" required>
                </div>
                <div class="col-md-3">
                    <label for="dcfirstname" class="form-label"> First Name</label>
                    <input type="text" class="form-control" id="dcfirstname" name="dcfirstname" placeholder="" required>
                </div>
                <div class="col-md-3">
                    <label for="dcmiddlename" class="form-label"> Middle Name</label>
                    <input type="text" class="form-control" id="dcmiddlename" name="dcmiddlename" placeholder="" required>
                </div>
                <div class="col-md-3">
                    <label for="dcsuffix" class="form-label"> Suffix</label>
                    <input type="text" class="form-control" id="dcsuffix" name="dcsuffix" placeholder="">
                </div>
                <div class="col-md-3 mt-2">
                    <label for="specialization" class="form-label"> Specialization</label>
                    <select type="text" class="form-control" id="specialization" name="specialization" placeholder="" required>
                        <option value="" class="text-center">--- select ---</option>
                        <option value="ROD"> ROD</option>
                        <option value="ANESTHESIOLOGISTS, ANESTHESIOLOGY"> Anesthesiology</option>
                        <option value="CARDIOLOGY"> Cardiology</option>
                        <option value="DENTAL"> Dental</option>
                        <option value="EENT"> EENT</option>
                        <option value="ENDOCRINOLOGIST, IM_ENDO"> Endocrinology</option>
                        <option value="FAMILY MED, FAMILY MEDICINE"> Family Medicine</option>
                        <option value="GENERAL PRACTICIONER"> General Practitioner</option>
                        <option value="IM, INTERNAL MEDICINE, INTERNAL MEDICINE (PT)"> Internal Medicine</option>
                        <option value="NEPHROLOGY"> Nephrology</option>
                        <option value="NEURO, NEURO (ADULT), NEUROLOGIST"> Neurology</option>
                        <option value="OB-GYNE	Obstetrics and Gynecology"> (OB-GYNE)</option>
                        <option value="OPHTHA, Ophthalmologist, OPTHA"> Ophthalmology</option>
                        <option value="Orthopedic Spine Surgery"> Orthopedic Spine Surgery</option>
                        <option value="PATHOLOGIST"> Pathology</option>
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
                <div class="col-md-2 mt-2">
                    <label for="" class="form-label"> Rebates</label>
                    <input type="text" class="form-control" id="rebates" name="rebates" placeholder="">
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
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
            <div class="content">
                <p>Are you sure, do you want to update this doctor's information?</p>
            </div>
            </div>
            <div class="conf-btn">
                <button class="btn btn-secondary"> No</button>
                <button class="btn btn-success"> Yes</button>
            </div>
        </div>
      </div>
    </div>
</div>
