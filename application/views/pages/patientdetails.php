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
                                                  
              <table width="100%" border="0" style="margin-top:20px;">              
                <tr>
                  <td colspan="3"><b>Admission History</b></td>
                </tr>
                <?php
                if($casenum==""){
                  $casenum = $item['caseno'];                                    
                }
                if($casenum==$item['caseno']){
                  $history_show="";
                }
              
                $past_hist=$this->Clinic_model->getMedicalHistory($item['patientidno'],$item['caseno'],$item['dateadmit']);
                if(count($past_hist) > 0 && $item['past_history']==""){
                  foreach($past_hist as $phistory){
                    $phist=$phistory['past_history'];                  
                  }                  
                }else{
                  $phist=$item['past_history'];
                }                
                $mhistory=$this->Clinic_model->getPatientMedicalHistory($item['patientidno'],$item['dateadmit']);
                if(count($mhistory) > 0){
                  foreach($mhistory as $row){
                    if($item['caseno'] <> $row['caseno']){
                ?>
                    <tr>
                      <td>
                        <?=$row['caseno'];?>
                      </td>
                      <td>
                        <?=date('m/d/Y',strtotime($row['dateadmit']));?>
                      </td>
                      <td>
                        <a href="<?=base_url();?>medical_history/<?=$item['caseno'];?>/<?=$row['caseno'];?>" class="btn btn-success btn-sm">Open</a>
                      </td>
                    </tr>                
                  <?php
                    }
                  }
                }
                ?>                
              </table>              
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <a href="<?=base_url();?>patientdetails/<?=$item['caseno'];?>" class="nav-link <?=$overview;?>">Overview</a>
                </li>

                <li class="nav-item">
                  <a href="<?=base_url();?>view_rx/<?=$item['caseno'];?>" class="nav-link <?=$rx;?>">Rx</a>
                </li>
                <?php                
                //if($history <> ""){
                ?>
                <li class="nav-item">
                  <a href="<?=base_url();?>medical_history/<?=$item['caseno'];?>/<?=$casenum;?>" class="nav-link <?=$history;?>">Medical History</a>
                </li>                
                <?php
               // }
                ?>
                <li class="nav-item" id="passwordchange" style="display:none;">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade <?=$overview_show;?> <?=$overview;?> profile-overview" id="profile-overview">
                
                <?=form_open(base_url()."save_medical_history");?>
                <input type="hidden" name="caseno" value="<?=$item['caseno'];?>">
                  <h5 class="card-title">Past Medical History</h5>
                  <p class="small fst-italic">                    
                      <textarea name="medical_history" class="form-control" rows="3" required><?=$phist;?></textarea>                    
                  </p>
                  <h5 class="card-title">Diagnosis</h5>
                  <p class="small fst-italic">                    
                      <textarea name="diagnosis" class="form-control" rows="3" required><?=$item['diagnosis'];?></textarea>                    
                  </p>
                  <h5 class="card-title">Physical Examination</h5>
                  <p class="small fst-italic">                    
                      <textarea name="pExam" class="form-control" rows="3" required><?=$item['physical_exam'];?></textarea>                    
                  </p>
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary" <?=$status;?>>Save Changes</button>
                    </div>
                  <?=form_close();?>                

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

                <div class="tab-pane fade <?=$rx_show;?> <?=$rx;?> profile-edit pt-3" id="profile-edit">
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
                    <div class="row mt-5">
                    <div style="width:500px;">
                      <table width="100%">
                          <tr>
                              <td align="center"><b style="font-size:18px;">Kidapawan Medical Specialists Center, Inc.</b><br>Brgy. Sudapin, Kidapawan City</td>
                          </tr>
                      </table>
                      <br>
                      <table width="100%" style="font-size:16px;" cellpadding="1">
                          <tr>
                              <td><b>Name:</b> <u><?=$item['firstname'];?> <?=$item['lastname'];?> <?=$item['suffix'];?></u></td>
                              <td align="right"><b>Date:</b> <u><?=date('m/d/Y');?></u></td>
                          </tr>
                          <tr>
                              <td colspan="2"><b>Address:</b> <u><?=$item['address'];?></u></td>                        
                          </tr>
                      </table>
                      <hr>
                      <h1>Rx</h1>
                      <table width="100%" style="font-size:16px;" cellpadding="1">
                        <?php
                          $items=$this->Clinic_model->getRxHistory($item['caseno']);
                          foreach($items as $item){
                          ?>
                          <tr>
                              <td width="10">&nbsp;</td>
                              <td colspan="2"><?=$item['description'];?><td>
                              <td align="right">#<?=$item['quantity'];?></td>
                          </tr>                          
                          <tr>
                              <td width="10">&nbsp;</td>
                              <td width="10">&nbsp;</td>
                              <td colspan="2"><?=$item['remarks'];?><td>            
                          </tr>
                          <tr>
                            <td colspan="3">&nbsp;</td>
                          </tr>
                          <?php
                          }
                          ?>
                      </table>                      
                      <hr>                                            
                      <a href="<?=base_url();?>print_rx/<?=$item['caseno'];?>" class="btn btn-primary btn-sm" target="_blank">Print Rx</a>
                      <!-- <table width="100%" style="font-size:16px;" cellpadding="1">                        
                          <tr>
                              <td width="40%">&nbsp;</td>
                              <td style="border-bottom:1px solid;" align="center"><?=$item['name'];?>, MD</td>
                          </tr>
                          <tr>
                              <td width="40%">&nbsp;</td>
                              <td><b>PTR No.</b> <u><?=$item['ptrno'];?></u></td>
                          </tr>
                          <tr>
                              <td width="40%">&nbsp;</td>
                              <td><b>S2 No.</b> <u><?=$item['s2no'];?></u></td>
                          </tr>
                      </table> -->
                  </div>
                        <!-- <b>Rx History</b><br>
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
                        </table> -->
                    </div>
                </div>

                <div class="tab-pane fade <?=$history_show;?> <?=$history;?> pt-3" id="profile-settings">
                          <?php
                            $details=$this->Clinic_model->getPatientDetails($casenum);
                          ?>
                          <h5 class="card-title">Past Medical History</h5>
                          <p class="small fst-italic">                    
                              <?=$details['past_history'];?>
                          </p>
                          <h5 class="card-title">Diagnosis</h5>
                          <p class="small fst-italic">                    
                              <?=$details['diagnosis'];?>
                          </p>
                          <h5 class="card-title">Medications</h5>
                                             
                          <table width="100%" border="0" style="font-size:16px;" cellpadding="1">
                            <tr>        
                              <td width="10">&nbsp;</td>                      
                              <td colspan="2"><b>Description</b></td>
                              <td align="right"><b>Qty</b></td>                              
                            </tr>
                        <?php
                          $med=$this->Clinic_model->getRxHistory($casenum);
                          foreach($med as $item){
                          ?>                          
                          <tr>
                              <td width="10">&nbsp;</td>
                              <td colspan="2"><?=$item['description'];?><td>
                              <td>#<?=$item['quantity'];?></td>
                          </tr>                          
                          <tr>
                              <td >&nbsp;</td>
                              <td colspan="2" style="padding-left:20px;"><?=$item['remarks'];?></td>
                              <td><td>            
                          </tr>
                          <tr>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <?php
                          }
                          ?>
                      </table>
                          
                          <h5 class="card-title">Diagnostics</h5>
                          <p class="small fst-italic">
                             
                          </p>
                </div>

                    <!-- <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>                   -->

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->