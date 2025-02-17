<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <!-- <img src="<?=base_url();?>design/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
               <?php
               if($item['pic']==""){
                ?>                
                <?php
               }else{
               ?>
              <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($item['pic']);?>" alt="Profile">
              <?php
               }
               ?>
               <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#UploadPicture"><i class="bi bi-arrow-bar-up"></i> Upload Pic</a>
              <h2><?=$item['name'];?></h2>
              <h3><?=$item['specialization'];?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
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
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li> -->

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">                  

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=$item['name'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Specialization</div>
                    <div class="col-lg-9 col-md-8"><?=$item['specialization'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">PHIC Accreditation</div>
                    <div class="col-lg-9 col-md-8"><?=$item['phicacc'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">License No.</div>
                    <div class="col-lg-9 col-md-8"><?=$item['licenseno'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">PTR No.</div>
                    <div class="col-lg-9 col-md-8"><?=$item['ptrno'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">S2 No.</div>
                    <div class="col-lg-9 col-md-8"><?=$item['s2no'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$item['emailaddress'];?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="<?=base_url();?>update_user_profile" method="POST">  
                    <input type="hidden" name="code" value="<?=$item['code'];?>">                  
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control" id="fullName" value="<?=$item['lastname'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control" id="fullName" value="<?=$item['firstname'];?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="middlename" type="text" class="form-control" id="fullName" value="<?=$item['middlename'];?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Suffix</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="suffix" type="text" class="form-control" id="fullName" value="<?=$item['ext'];?>">
                      </div>
                    </div>                    

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Specialization</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="specialization" type="text" class="form-control" id="company" value="<?=$item['specialization'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">PHIC Accreditation</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phicacc" type="text" class="form-control" id="Job" value="<?=$item['phicacc'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">TIN</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="tin" type="text" class="form-control" id="Country" value="<?=$item['tinbir'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">License No.</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="licenseno" type="text" class="form-control" id="Country" value="<?=$item['licenseno'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">PTR No.</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="ptrno" type="text" class="form-control" id="Address" value="<?=$item['ptrno'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">S2 No.</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="s2no" type="text" class="form-control" id="Phone" value="<?=$item['s2no'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?=$item['emailaddress'];?>">
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">No. of Patient Catered per Day</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="cater" type="number" class="form-control" id="Email" value="<?=$item['vatex'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Clinic Days</label>
                      <div class="col-md-8 col-lg-9">
                        <?php
                        $d=str_split($item['PF']);
                        $sun="";$mon="";$tue="";$wed="";$thu="";$fri="";$sat="";
                        for($i=0;$i < sizeof($d); $i++){
                          if($d[$i]==0){
                            $sun="checked";
                          }
                          if($d[$i]==1){
                            $mon="checked";
                          }
                          if($d[$i]==2){
                            $tue="checked";
                          }
                          if($d[$i]==3){
                            $wed="checked";
                          }
                          if($d[$i]==4){
                            $thu="checked";
                          }
                          if($d[$i]==5){
                            $fri="checked";
                          }
                          if($d[$i]==6){
                            $sat="checked";
                          }
                        }
                        ?>
                        <input type="checkbox" name="days[]" value="0" <?=$sun;?>> Sunday<br>
                        <input type="checkbox" name="days[]" value="1" <?=$mon;?>> Monday<br>
                        <input type="checkbox" name="days[]" value="2" <?=$tue;?>> Tuesday<br>
                        <input type="checkbox" name="days[]" value="3" <?=$wed;?>> Wednesday<br>
                        <input type="checkbox" name="days[]" value="4" <?=$thu;?>> Thursday<br>
                        <input type="checkbox" name="days[]" value="5" <?=$fri;?>> Friday<br>
                        <input type="checkbox" name="days[]" value="6" <?=$sat;?>> Saturday
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Clinic Time</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="times" type="text" class="form-control" id="Email" value="<?=$item['rebates'];?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Date/s Unavailable</label>
                      <div class="col-md-8 col-lg-9">
                        <!-- <textarea name="date_unavailable" class="form-control" rows="3"><?=$item['date_unavailable'];?></textarea> -->
                         <input type="text" class="form-control date" placeholder="Pick multiple dates" name="date_unavailable" value="<?=$item['date_unavailable'];?>">                         
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <!-- <div class="tab-pane fade pt-3" id="profile-settings">

                  
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

                </div> -->

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="<?=base_url();?>update_user_password" method="POST">
                    <input type="hidden" name="code" value="<?=$item['code'];?>">
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
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->