<main id="main" class="main">

    <div class="pagetitle">
      <h1><?=$title;?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url();?>appointment">Appointment</a></li>          
          <li class="breadcrumb-item active">View Appointment</a></li>          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card table-responsive">
            <div class="card-body">
              <table width="100%" border="0">
                  <tr>
                    <td><h5 class="card-title">List of Patient (<?=date('M-d-Y',strtotime($datenow));?>)</h5></td>
                    <td align="right"></td>
                  </tr>
              </table>              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No.</th>                    
                    <th>Name</th>                    
                    <th>Birth Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $x=1;
                  foreach($items as $item){
                    echo "<tr>";
                      echo "<td>$x.</td>";                      
                      echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";                                            
                      echo "<td>".date('m/d/Y',strtotime($item['birthdate']))."</td>";
                      ?>
                      <td><a href="<?=base_url();?>admitpatient/<?=$item['id'];?>" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> View Details</a></td>
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