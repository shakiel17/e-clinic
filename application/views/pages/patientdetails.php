<main id="main" class="main">

    <div class="pagetitle">
      <h1><?=$title;?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url();?>active_patient">Active Patient</a></li>
          <li class="breadcrumb-item active">Patient Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?=base_url();?>design/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?=$item['firstname'];?> <?=$item['lastname'];?></h2>
              <small><?=$item['caseno'];?></small>
              <div class="social-links mt-2">
                <?=$item['status'];?>
              </div>
              <?php
              $status="";
              $lock="";
              if($item['status']=="Active"){
                ?>
              <a href="<?=base_url();?>patient_discharged/<?=$item['caseno'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you wish to discharge this patient?');return false;"><i class="bi bi-box-arrow-in-up"></i> Discharge</a>
              <?php
              }else{
                $status="disabled";
                $lock="style='display:none;'";
              }
              ?>                                                
              <table width="100%" border="0">
              <form name="f1" action="<?=base_url('patientdetails/'.$item['caseno']);?>" method="POST">
                <tr>
                  <td colspan="2"><b>Medical History</b></td>
                </tr>
                <tr>
                  <td><input type="submit" name="viewSettings" value="View"> <input type="submit" name="closeSettings" value="Close"></td>
                  <td>&nbsp;</td>
                </tr>
                </form> 
              </table>                           
              <div class="social-links mt-2">
                <a href="#" onclick="viewPassword()">Password</a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Rx</button>
                </li>
                <?php
                if(isset($_POST['viewSettings'])){
                  $this->session->set_userdata('viewSettings','settings');
                  redirect(base_url('patientdetails/'.$item['caseno']));
               }
               if(isset($_POST['closeSettings'])){
                $this->session->unset_userdata('viewSettings');
                redirect(base_url('patientdetails/'.$item['caseno']));
             }
                if($this->session->viewSettings){
                ?>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>                
                <?php
                }
                ?>
                <li class="nav-item" id="passwordchange" style="display:none;">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Chief Complaint</h5>
                  <p class="small fst-italic"><?=$item['chief_complaint'];?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Patient ID</div>
                    <div class="col-lg-9 col-md-8"><?=$item['patientidno'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=$item['firstname'];?> <?=$item['middlename'];?> <?=$item['lastname'];?> <?=$item['suffix'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?=date('F d, Y',strtotime($item['birthdate']));?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?=$item['gender'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Civil Status</div>
                    <div class="col-lg-9 col-md-8"><?=$item['civil_status'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?=$item['address'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?=$item['contactno'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date/Time Admitted</div>
                    <div class="col-lg-9 col-md-8"><?=date('m/d/Y',strtotime($item['dateadmit']));?> | <?=date('h:i A',strtotime($item['timeadmit']));?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <div class="row mb-3">
                        <?=form_open(base_url()."add_rx");?>
                        <input type="hidden" name="caseno" value="<?=$item['caseno'];?>">
                        <table width="100%" border="0" cellspacing="2">
                            <tr>
                                <td><b>Description</b></td>
                                <td><textarea name="description" rows="3" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                                <td><b>Quantity</b></td>
                                <td><input type="text" class="form-control" name="quantity"></td>
                            </tr>
                            <tr>
                                <td><b>Route & Frequency</b></td>
                                <td><textarea name="remarks" rows="3" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" class="btn btn-primary" value="Submit" <?=$status;?>></td>
                            </tr>
                        </table>
                        <?=form_close();?>
                    </div>
                    <div class="row mt-2">
                        <b>Rx History</b><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Route & Frequency</th>
                                    <th></th>
                                </tr>                                
                            </thead>
                            <tbody>
                                <?php
                                $items=$this->Clinic_model->getRxHistory($item['caseno']);
                                foreach($items as $item){
                                ?>
                                <tr>
                                    <td><?=$item['description'];?></td>
                                    <td><?=$item['quantity'];?></td>
                                    <td><?=$item['remarks'];?></td>
                                    <td><a href="<?=base_url();?>print_rx/<?=$item['id'];?>" class="btn btn-info btn-sm" title="Print" target="_blank"><i class="bi bi-printer"></i></a> <a href="<?=base_url();?>delete_rx/<?=$item['id'];?>/<?=$item['caseno'];?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Do you wish to delete this item?');return false;" <?=$lock;?>><i class="bi bi-trash"></i></a></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                 
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->