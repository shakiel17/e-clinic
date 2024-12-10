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
                    <!-- <td align="right"><a href="<?=base_url();?>new_doctor" class="btn btn-primary btn-sm rounded-pill"><i class="bi bi-plus-circle"></i> New Doctor</td></td> -->
                  </tr>
              </table>              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="text-center">No.</th>
                    <th class="text-start">Name</th>
                    <th class="text-center">PHIC No./TIN</th>                    
                    <th class="text-center">Email Add.</th>
                    <th class="text-start">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $x=1;
                    foreach($items as $item){
                        $status = $item['status'];
                        if($status == "Active"){ }
                ?>
                <tr>
                    <td class="text-center" vlign="center" style="width:5%;"><?=$x.".";?></td>
                    <td class="text-start" style="width:55%">
                        <div class="row d-flex justify-content-start align-items-center">
                            <img src="<?=base_url('design/assets/img/maleDoc.png');?>" alt="Profile Image" class="avatar" style="width:80px; height: auto; border-radius:50%;">
                            <div class="profile" style="width:70%;"><span class="fw-bold fs-5"><?=$item['name'];?></span><br><span class="fs-6"><?=$item['code'];?> / </span><span class="fs-6"><?=$item['specialization'];?></span></div>
                        </div>
                    </td>
                    <td class="text-center" style="width:15%;"><?=$item['phicacc'];?><br><?=$item['tinbir'];?></td>
                    <td class="text-center" style="width:15%;"><?=$item['emailaddress'];?></td>
                    <td class="text-center align-items-center" style="width:10%;">
                    <a type="button" class="btn btn-primary" href="<?=base_url('doctor_profile/' . $item['code']); ?>" target="_blank">
                        <i class="bi bi-eye-fill"></i>
                    </a>
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