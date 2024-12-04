<main id="main" class="main">

    <div class="pagetitle">
      <h1><?=$title;?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>          
          <li class="breadcrumb-item active">New Admission</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">      
        <div class="col-12">     
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Patient Details</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="POST" action="<?=base_url();?>submitadmission">
                <input type="hidden" name="patientidno" value="<?=$item['patientidno'];?>">
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Last Name" name="lastname" required value="<?=$item['lastname'];?>">
                    <label for="floatingName">Last Name</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="First Name" name="firstname" required value="<?=$item['firstname'];?>">
                    <label for="floatingName">First Name</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Middle Name" name="middlename" value="<?=$item['middlename'];?>">
                    <label for="floatingName">Middle Name</label>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Suffix" name="suffix" value="<?=$item['suffix'];?>">
                    <label for="floatingName">Suffix</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating">
                    <input type="date" class="form-control" id="floatingEmail" placeholder="Your Email" name="birthdate" required value="<?=$item['birthdate'];?>">
                    <label for="floatingEmail">Date of Birth</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="State" required name="gender">
                        <option value="<?=$item['gender'];?>"><?=$item['gender'];?></option>
                      <option value="">Select Gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    <label for="floatingSelect">Gender</label>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="State" required name="discount">
                        <?php
                        if($item['is_senior']==1){
                            ?>
                            <option value="senior">Senior</option>
                            <?php
                        }else{
                            ?>
                            <option value="none">None</option>                            
                            <?php
                        }
                        ?>
                        <option value="none">None</option>
                        <option value="senior">Senior</option>
                        <option value="senior">PWD</option>
                    </select>
                    <label for="floatingSelect">Discount Type</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingCity" placeholder="City" name="contactno" value="<?=$item['contactno'];?>">
                      <label for="floatingCity">Contact No.</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="State" name="civilstatus">
                        <option value="<?=$item['civil_status'];?>"><?=$item['civil_status'];?></option>
                      <option value="">Select Status</option>
                      <option value="newborn">Newborn</option>
                      <option value="single">Single</option>
                      <option value="married">Married</option>
                      <option value="widowed">Widowed</option>
                      <option value="separated">Separated</option>
                    </select>
                    <label for="floatingSelect">Civil Status</label>
                  </div>
                </div>                
                <div class="col-lg-6 col-sm-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;" name="address"><?=$item['address'];?></textarea>
                    <label for="floatingTextarea">Address</label>
                  </div>
                </div>                
                <div class="col-md-6">
                  <div class="form-floating">
                  <textarea class="form-control" placeholder="Address" id="floatingZip" style="height: 100px;" name="initialdiagnosis"></textarea>
                    <label for="floatingZip">Chief Complaint</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="<?=base_url();?>main" class="btn btn-secondary">Back</a>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->