<main id="main" class="main">

    <div class="pagetitle">
      <h1><?=$title;?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
          <li class="breadcrumb-item active">Appointment</a></li>          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card table-responsive py-5">
            <div class="card-body">                      
              <!-- Table with stripped rows -->
              <table class="table table-bordered" style="table-layout:fixed;">
                <thead>
                  <tr>
                    <td colspan="7" align="left">
<div style="float:left; margin-right:20px;">
                      <?=form_open(base_url('search_appointment'));?>
                      <input type="hidden" name="month" value="<?=date('m',strtotime('-1 month',strtotime($datenow)));?>">
                      <input type="hidden" name="year" value="<?=date('Y',strtotime('-1 month',strtotime($datenow)));?>">
                      <button type="submit" class="btn btn-primary btn-sm"><< Previous</button>
                      <?=form_close();?>
</div>
<div style="float:left;">
<b><?=date('F Y',strtotime($datenow));?></b>
</div>
<div style="float:left; margin-left:20px;">
                    <?=form_open(base_url('search_appointment'));?>
                      <input type="hidden" name="month" value="<?=date('m',strtotime('1 month',strtotime($datenow)));?>">
                      <input type="hidden" name="year" value="<?=date('Y',strtotime('1 month',strtotime($datenow)));?>">
                      <button type="submit" class="btn btn-primary btn-sm">Next >></button>
                      <?=form_close();?>
</div>
                    </td>
                  </tr>
                  <tr>
                      <td align="center"><b>SUN</b></td>
                      <td align="center"><b>MON</b></td>
                      <td align="center"><b>TUE</b></td>
                      <td align="center"><b>WED</b></td>
                      <td align="center"><b>THU</b></td>
                      <td align="center"><b>FRI</b></td>
                      <td align="center"><b>SAT</b></td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $w=0;                    
                    for($i=1;$i<=date('t',strtotime($datenow));$i++){
                      $date=date('Y-m',strtotime($datenow))."-".$i;                      
                      $apcode=$this->session->apcode;
                      $count=0;
                      $check=$this->Clinic_model->db->query("SELECT * FROM appointment WHERE apcode='$apcode' AND appointment_date='$date' AND `status`='pending'");
                      if($check->num_rows() > 0){
                        $items=$check->result_array();
                        foreach($items as $item){
                          $count++;
                        }
                      }
                      if(strtotime($date) == strtotime(date('Y-m-d'))){
                        $color="background-color:yellow;";                        
                      }else if(strtotime($date) < strtotime(date('Y-m-d'))){
                          $color="background-color:gray;";
                      }else{
                        $color="";
                      }                      
                      if($count > 0){
                        $remarks="<a href='".base_url()."view_appointment/$date'>You have $count pending appointment.</a>";
                      }else{
                        $remarks="";
                      }
                      if($i==1){
                        for($x=0;$x<7;$x++){
                            if(date('w',strtotime($date))==$x){                              
                                echo "<td style='width:14.285%; height: 100px; $color' align='center'><b style='float:right;'>$i</b><br>$remarks</td>"; 
                                $w++;
                                break;                                                                                                                                                     
                            }else{
                                echo "<td>&nbsp;</td>";
                                $w++;
                            }
                           
                       }
                    }else{ 
                      // if($date==date('Y-m-d')){
                      //   $color="background-color:yellow; color:yellow;";
                      // }else{
                      //   $color="";
                      // }
                      // if(strtotime($date) < strtotime(date('Y-m-d'))){
                      //   $color="";
                      // }else if(date('w',strtotime($date)) == 6 || date('w',strtotime($date))==0){                        
                      //   $color="";                   
                      // }elseif($date==date('Y-m-d')){
                      //   $color="background-color:yellow;";
                      // }else{  
                      //   $color="";
                      // }                   
                        echo "<td style='width:14.285%; height: 100px; $color' align='center'><b style='float:right;'>$i</b><br>$remarks</td>"; 
                        $w++;
                    }
                                                               
                   
                    if($w > 6){
                        $w=0;
                        echo "</tr>";
                    }
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
