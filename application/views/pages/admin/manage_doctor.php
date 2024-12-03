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

          <div class="card">
            <div class="card-body">
              <table width="100%" border="0">
                  <tr>
                    <td><h5 class="card-title">List of Doctor</h5></td>
                    <td align="right"><a href="<?=base_url();?>new_doctor" class="btn btn-primary btn-sm rounded-pill"><i class="bi bi-plus-circle"></i> New Doctor</td></td>
                  </tr>
              </table>              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="text-center">No.</th>
                    <th class="text-start">Name</th>
                    <th class="text-center">Specialization</th>
                    <th class="text-center">PHIC No.</th>                    
                    <th class="text-center">Email Add.</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $x=1;
                    foreach($items as $item){
                        $status = $item['status'];
                        if($status == "Active"){

                        }
                ?>
                <tr>
                    <td class="text-center align-items-center"><?=$x.".";?></td>
                    <td class="text-start" style="border:1px solid red">
                        <div class="avatar">
                            <img 
                                src="<?= base_url('design/assets/img/profile-img.jpg'); ?>" 
                                alt="Profile Image" 
                                class="profile"
                                style="width: 40px; height: 40px; border-radius: 50%;"
                            >
                        </div>
                    </td>
                    <td class="text-center"><?=$item['specialization'];?></td>
                    <td class="text-center"><?=$item['phicacc'];?></td>
                    <td class="text-center"><?=$item['emailaddress'];?></td>
                    <td class="text-center align-items-center">
                       <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" title="View"><i class="bi bi-eye-fill"></i></button>
                    </td>
                </tr>
                <?php
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