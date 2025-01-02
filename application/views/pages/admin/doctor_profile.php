<?php if (isset($fth) && !empty($fth)): ?>
<main id="main" class="main">
<div class="pagetitle">
  <h1><?=$title;?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('adminmain');?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?=base_url('manage_doctor');?>">Doctor List</a></li>
      <li class="breadcrumb-item" active><?=$title;?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <?php if($fth['pic']== ""){ ?>
              <img src="<?=base_url('design/assets/img/maleDoc.png');?>" alt="Profile" class="rounded-circle">
          <?php } else { ?>
              <img src="data:image/jpg;charset=utf8;base64,<?=base64_encode($fth['pic']);?>" alt="Profile">
          <?php } ?>
          <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#UploadPicture"><i class="bi bi-arrow-bar-up"></i> Upload Pic</a>
          <h2><?="DR. ". strtoupper($fth['firstname'] . " " . strtoupper(substr($fth['middlename'], 0, 1)) . ". " . $fth['lastname']). " " . $fth['ext'] ; ?></h2>
          <h3><?=$fth['specialization'];?></h3>
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

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"> Change Password</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Profile Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                <div class="col-lg-9 col-md-8"><?=$fth['name'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Specialists</div>
                <div class="col-lg-9 col-md-8"><?=$fth['specialization'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">PHIC Accrediatation</div>
                <div class="col-lg-9 col-md-8"><?=$fth['phicacc'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">License No.</div>
                <div class="col-lg-9 col-md-8"><?=$fth['licenseno'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">PTR No.</div>
                <div class="col-lg-9 col-md-8"><?=$fth['ptrno'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">S2 No.</div>
                <div class="col-lg-9 col-md-8"><?=$fth['s2no'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><?=$fth['emailaddress'];?></div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
            <form method="POST" action="<?=base_url();?>updateDoctorProfile" id="updateDoctorForm">
                <div class="row mb-3">
                  <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="code" type="hidden" class="form-control" id="code" value="<?=$fth['code']?>">
                    <input name="lastname" type="text" class="form-control" id="lastname" value="<?=$fth['lastname']?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="firstname" type="text" class="form-control" id="firstname" value="<?=$fth['firstname']?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="middlename" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="middlename" type="text" class="form-control" id="middlename" value="<?=$fth['middlename']?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="suffix" class="col-md-4 col-lg-3 col-form-label">Suffix</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="suffix" type="text" class="form-control" id="suffix" value="<?=$fth['ext']?>">
                  </div>
                </div>


                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Specialization</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="specialization" class="form-select">
                      <?php
                          foreach ($speclist as $spec) {
                              // Mark the option as selected if it matches the current specialization
                              $isSelected = ($fth['specialization'] === $spec['specialization']) ? "selected" : "";
                              echo "<option value='" . htmlspecialchars($spec['specialization'], ENT_QUOTES, 'UTF-8') . "' $isSelected>" 
                                  . htmlspecialchars($spec['specialization'], ENT_QUOTES, 'UTF-8') . 
                                  "</option>";
                          }
                      ?>
                  </select>

                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Country" class="col-md-4 col-lg-3 col-form-label">PHIC Accrediatation</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phicacc" type="text" class="form-control" id="phicacc" value="<?=$fth['phicacc'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Address" class="col-md-4 col-lg-3 col-form-label">TIN</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="tinbir" type="text" class="form-control" id="tinbir" value="<?=$fth['tinbir'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">License No.</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="licenseno" type="text" class="form-control" id="licenseno" value="<?=$fth['licenseno'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">PTR No.</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="ptrno" type="text" class="form-control" id="ptrno" value="<?=$fth['ptrno'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">S2 No.</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="s2no" type="text" class="form-control" id="s2no" value="<?=$fth['s2no'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="Email" value="<?=$fth['emailaddress'];?>">
                  </div>
                </div>

                <div class="text-center">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationUpdateModal"><i class="bi bi-cloud-arrow-up-fill"></i> Update</button>
                </div>
              </form>

            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form action="<?=base_url('update_doctor_account');?>" method="POST">                
                <input type="hidden" name="code" value="<?=$fth['code'];?>">

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="text" class="form-control" id="currentPassword" value="">
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
                  <button type="button" class="btn btn-primary"> Update Account</button>
                </div>
              <!-- </form>End Change Password Form -->

            </div>

          </div><!-- End Bordered Tabs -->

        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->
<?php else: ?>
    <p> Doctor profile not found.</p>
<?php endif; ?>

<script>
    function submitUpdateDoctor() {
    const modal = document.getElementById('confirmationUpdateModal');
    const modalInstance = bootstrap.Modal.getInstance(modal);
    modalInstance.hide();
    document.getElementById('updateDoctorForm').submit();
  }
</script>