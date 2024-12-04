<main id="main" class="main">

    <div class="pagetitle">
      <h1><?=$title;?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="<?=base_url();?>">Home</a></li>          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">          
            <div class="card table-responsive py-5">
              <div class="card-body">
                <table width="100%" border="0">
                    <tr>
                      <td><h5 class="card-title">List of Patient</h5></td>
                      <td align="right"><a href="<?=base_url();?>new_admission" class="btn btn-primary btn-sm rounded-pill"><i class="bi bi-plus-circle"></i> New Admission</td></td>
                    </tr>
                </table>              
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Birthdate</th>
                      <th>Gender</th>                    
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $x=1;
                    foreach($items as $item){
                      $check=$this->Clinic_model->checkActiveAdmission($item['patientidno']);
                      if($check){
                        $button="<a href='#' class='btn btn-outline-danger btn-sm' title='Still in'><i class='bi bi-exclamation-circle'></i></a>";
                      }else{
                        $button="<a href='".base_url()."re_admission/$item[patientidno]' class='btn btn-success btn-sm' title='Re-Admit'><i class='bx bxs-ambulance'></i></a>";
                      }
                      echo "<tr>";
                        echo "<td>$x.</td>";
                        echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
                        echo "<td>".date('m/d/Y',strtotime($item['birthdate']))."</td>";
                        echo "<td>$item[gender]</td>";
                        ?>
                        <td>
                          <!-- <a href="<?=base_url();?>re_admission/<?=$item['patientidno'];?>" class="btn btn-success btn-sm" title="Re-Admit"><i class="bx bxs-ambulance"></i></a> -->
                          <?=$button;?>
                          <a href="<?=base_url();?>patientprofile/<?=$item['patientidno'];?>" class="btn btn-info btn-sm" title="View Profile"><i class="bi bi-file-person"></i></a>
                        </td>
                        <?php
                      echo "</tr>";
                      $x++;
                    }
                    ?>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->

              </div>
            </div>          
        </div>
      </div>
    </section>

  </main><!-- End #main -->