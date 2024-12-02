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
                    <td><h5 class="card-title">List of Patient</h5></td>
                    <td align="right"><a href="<?=base_url();?>new_admission" class="btn btn-primary btn-sm rounded-pill"><i class="bi bi-plus-circle"></i> New Admission</td></td>
                  </tr>
              </table>              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>
                      <b>Name</b>
                    </th>
                    <th>Birthdate</th>
                    <th>Gender</th>                    
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
                      echo "<td>".date('m/d/Y',strtotime($itme['birthdate']))."<td>";
                      echo "<td>$item[gender]</td>";
                      ?>
                      <td></td>
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