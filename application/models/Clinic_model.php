<?php
    date_default_timezone_set('Asia/Manila');
    class Clinic_model extends CI_model{
        public function __construct(){
            $this->load->database();
        }        
        public function register(){
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $pan=$this->input->post('phicacc');
            $checkUserExist=$this->db->query("SELECT * FROM docfile WHERE username='$username'");
            if($checkUserExist->num_rows() > 0){
                echo "<script>alert('Unable to save account details! Username already exist!');</script>";
                return false;
            }else{
                $checkPAN=$this->db->query("SELECT * FROM docfile WHERE phicacc='$pan' AND phicacc <> ''");
                if($checkPAN->num_rows() > 0){
                    $result=$this->db->query("UPDATE docfile SET username='$username',`password`='$password' WHERE phicacc='$pan'");
                    if($result){
                        return true;
                    }else{
                        echo "<script>alert('Unable to save account details!');</script>";
                        return false;
                    }
                }else{
                    echo "<script>alert('Unable to save account details! PAN not found!');</script>";
                    return false;
                }
            }
        }
        public function authenticate(){
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $check=$this->db->query("SELECT * FROM docfile WHERE username='$username' AND `password`='$password'");
            if($check->num_rows() > 0 ){
                $this->db->query("UPDATE docfile SET `status`='Active' WHERE username='$username'");
                return $check->row_array();
            }else{
                return false;
            }
        }
        public function getAllPatientByDoc($code){
            $result=$this->db->query("SELECT pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.ap='$code' GROUP BY a.patientidno ORDER BY pp.lastname ASC,pp.firstname ASC");
            return $result->result_array();
        }

        public function getAllPatientByDocActive($code){
            $result=$this->db->query("SELECT pp.*,a.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.ap='$code' AND a.status='Active' GROUP BY a.caseno ORDER BY pp.lastname ASC,pp.firstname ASC");
            return $result->result_array();
        }

        public function admin_authenticate(){
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $check=$this->db->query("SELECT * FROM `admin` WHERE username='$username' AND `password`='$password'");
            if($check->num_rows() > 0 ){
                return $check->row_array();
            }else{
                return false;
            }
        }
        public function getAllDoctor(){
            $result=$this->db->query("SELECT * FROM docfile ORDER BY lastname ASC");
            return $result->result_array();
        }
        public function getAllDoctorProfile($code){
            $result=$this->db->query("SELECT * FROM docfile WHERE code = '$code'");
            return $result->result_array();
        }
        public function save_admission($patientidno,$pid,$caseno,$ap){
            $lastname=$this->input->post('lastname');
            $firstname=$this->input->post('firstname');
            $middlename=$this->input->post('middlename');
            $suffix=$this->input->post('suffix');
            $birthdate=$this->input->post('birthdate');
            $gender=$this->input->post('gender');
            $discount=$this->input->post('discount');
            $nationality=$this->input->post('contactno');
            $civilstatus=$this->input->post('civilstatus');
            $address=$this->input->post('address');
            $complaint=$this->input->post('initialdiagnosis');
            $appoint_id=$this->input->post('id');
            if($discount=="senior"){
                $senior="1";
            }else{
                $senior="0";
            }

            $date=date('Y-m-d');
            $time=date('H:i:s');

            $check=$this->db->query("SELECT * FROM patientprofile WHERE lastname='$lastname' AND firstname='$firstname' AND middlename='$middlename' AND birthdate='$birthdate' AND patientidno <> '$pid'");
            if($check->num_rows() > 0){
                $p=$check->row_array();
                $patientidno=$p['patientidno'];
                $pid=$patientidno;
            }

            if($patientidno==""){
                $this->db->query("INSERT INTO patientprofile(patientidno,lastname,firstname,middlename,suffix,birthdate,gender,is_senior,datearray,timearray) VALUE('$pid','$lastname','$firstname','$middlename','$suffix','$birthdate','$gender','$senior','$date','$time')");
            }else{
                $this->db->query("UPDATE patientprofile SET lastname='$lastname',firstname='$firstname',middlename='$middlename',suffix='$suffix',birthdate='$birthdate',gender='$gender',is_senior='$senior' WHERE patientidno='$pid'");
            }
            if($appoint_id <> ""){
                $this->db->query("UPDATE appointment SET `status`='completed' WHERE id='$appoint_id'");
            }

            $result=$this->db->query("INSERT INTO admission(patientidno,caseno,ap,dateadmit,timeadmit,chief_complaint,civil_status,`address`,contactno,`status`,datearray,timearray) VALUES('$pid','$caseno','$ap','$date','$time','$complaint','$civilstatus','$address','$nationality','Active','$date','$time')");
            if($result){
                return true;
            }else{
                return false;
            }

        }
        public function getPatientDetails($caseno){
            $result=$this->db->query("SELECT pp.*,a.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno='$caseno'");
            return $result->row_array();
        }
        public function getRxHistory($caseno){
            $result=$this->db->query("SELECT po.*,a.chief_complaint FROM productout po INNER JOIN admission a ON a.caseno=po.caseno WHERE a.caseno='$caseno' ORDER BY po.datearray ASC");
            return $result->result_array();
        }
        public function save_rx(){
            $caseno=$this->input->post('caseno');
            $description=$this->input->post('description');
            $quantity=$this->input->post('quantity');
            $remarks=$this->input->post('remarks');
            $date=date('Y-m-d');
            $time=date('H:i:s');
            $result=$this->db->query("INSERT INTO productout(caseno,`description`,quantity,remarks,datearray,timearray) VALUES('$caseno','$description','$quantity','$remarks','$date','$time')");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function delete_rx($id){
            $result=$this->db->query("DELETE FROM productout WHERE id='$id'");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function getSingleRx($id){
            $result=$this->db->query("SELECT pp.*,po.*,a.*,d.name,d.ptrno,d.s2no FROM productout po INNER JOIN admission a ON a.caseno=po.caseno INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile d ON d.code=a.ap WHERE po.caseno='$id'");
            return $result->result_array();
        }
        public function getPatientProfile($patientidno){
            $result=$this->db->query("SELECT pp.*,a.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE pp.patientidno='$patientidno' GROUP BY pp.patientidno ORDER BY a.dateadmit DESC LIMIT 1");
            return $result->row_array();
        }
        public function discharged_patient($caseno){
            $result=$this->db->query("UPDATE admission SET `status`='discharged' WHERE caseno='$caseno'");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function checkActiveAdmission($patientidno){
            $result=$this->db->query("SELECT * FROM admission WHERE patientidno='$patientidno' AND `status`='Active'");
            if($result->num_rows()>0){
                return true;
            }else{
                return false;
            }
        }
        public function getAdmissionHistory($patientidno){
            $apcode=$this->session->apcode;
            $result=$this->db->query("SELECT * FROM admission WHERE patientidno='$patientidno' AND ap='$apcode'");
            return $result->result_array();
        }
        public function getUserProfile($code){
            $result=$this->db->query("SELECT * FROM docfile WHERE code='$code'");
            return $result->row_array();
        }
        public function update_user_profile(){
            $code=$this->input->post('code');
            $lastname=$this->input->post('lastname');
            $firstname=$this->input->post('firstname');
            $middlename=$this->input->post('middlename');
            $suffix=$this->input->post('suffix');
            $name=$firstname." ".$middlename." ".$lastname." ".$suffix;
            $specialization=$this->input->post('specialization');
            $phicacc=$this->input->post('phicacc');
            $tin=$this->input->post('tin');
            $licenseno=$this->input->post('licenseno');
            $ptrno=$this->input->post('ptrno');
            $s2no=$this->input->post('s2no');
            $email=$this->input->post('email');
            $cater=$this->input->post('cater');
            $clinic=$this->input->post('days');
            $unavailable=$this->input->post('date_unavailable');
            // $av=explode(',',$unavailable);
            // $avail="";
            // for($i=0;$i<sizeof($av); $i++){
            //     $avail .=",".date('Y-m-d',strtotime($av[$i]));
            // }
            $days="-";
            foreach($clinic as $day){
                $days .=$day;
            }
            $ctime=$this->input->post('times');
            $data="lastname='$lastname',firstname='$firstname',middlename='$middlename',ext='$suffix',name='$name',specialization='$specialization',tod='$specialization',phicacc='$phicacc',tinbir='$tin',phicacc1='$phicacc',emailaddress='$email',licenseno='$licenseno',ptrno='$ptrno',s2no='$s2no',vatex='$cater',PF='$days',rebates='$ctime',date_unavailable='$unavailable' WHERE code='$code'";
            $result=$this->db->query("UPDATE docfile SET $data");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function update_user_password(){
            $code=$this->input->post('code');
            $password=$this->input->post('password');
            $newpassword=$this->input->post('newpassword');
            $confirmpassword=$this->input->post('renewpassword');
            if($confirmpassword==$newpassword){
                $check=$this->db->query("SELECT * FROM docfile WHERE code='$code' AND `password`='$password'");
                if($check->num_rows()>0){
                    $result=$this->db->query("UPDATE docfile SET `password`='$newpassword' WHERE code='$code'");
                    if($result){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function upload_user_picture(){
            $code=$this->input->post('code');
            $fileName=basename($_FILES["file"]["name"]);
            $fileType=pathinfo($fileName, PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType,$allowTypes)){
                $image = $_FILES["file"]["tmp_name"];
                $imgContent=addslashes(file_get_contents($image));
                $result=$this->db->query("UPDATE docfile SET `pic`='$imgContent' WHERE code='$code'");            
            }else{
                return false;
            }            
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function getAllAppointment($code,$date){
            $result=$this->db->query("SELECT * FROM appointment WHERE apcode='$code' AND appointment_date='$date' AND `status`='pending' ORDER BY id ASC");
            return $result->result_array();
        }
        public function checkPatient($id){
            $query=$this->db->query("SELECT * FROM appointment WHERE id='$id'");
            $result=$query->row_array();
            $lastname=$result['lastname'];
            $firstname=$result['firstname'];
            $middlename=$result['middlename'];
            $birthdate=$result['birthdate'];
            $checkExist=$this->db->query("SELECT * FROM patientprofile WHERE lastname='$lastname' AND firstname='$firstname' AND middlename='$middlename' AND birthdate='$birthdate'");
            if($checkExist->num_rows()>0){
                $row=$checkExist->row_array();
                $patientidno=$row['patientidno'];
                redirect(base_url()."appoint_readmit/$id/$patientidno");
            }else{
                redirect(base_url()."appoint_admit/$id");
            }
        }
        public function getPatientProfileAppointment($id){
            $result=$this->db->query("SELECT * FROM appointment WHERE id='$id'");
            return $result->row_array();
        }
        public function cancel_appointment($id){
            $result=$this->db->query("UPDATE appointment SET `status`='cancel' WHERE id='$id'");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        
        //admin dashboard query 
        public function getAllDoctorsCount(){ 
            $result = $this->db->query("SELECT * FROM docfile WHERE `status` = 'Active' AND (username IS NOT NULL AND username != '') AND (password IS NOT NULL AND password != '')");
            return $result->result_array();
        }

        public function getAllPatientCount(){ 
            $result = $this->db->query("SELECT COUNT(patientidno) AS ptCount FROM admission");
            return $result->row_array();
        }

        public function getAppointmentsWithCount(){
            $countQuery = "SELECT COUNT(apcode) AS appntCount FROM appointment";
            $countResult = $this->db->query($countQuery)->row_array();
            $listQuery = "SELECT appointment.*, docfile.name FROM appointment JOIN docfile ON appointment.apcode = docfile.code ORDER BY appointment.appointment_date DESC";
            $listResult = $this->db->query($listQuery)->result_array();
            return [
                'appntCount' => $countResult['appntCount'],
                'appointments' => $listResult,
            ];
        }
        
        public function update_doctor_account(){
            $code=$this->input->post('code');
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $newpassword=$this->input->post('newpassword');
            $renewpassword=$this->input->post('renewpassword');
            if($newpassword==$renewpassword){
                $result=$this->db->query("UPDATE docfile SET username='$username',`password`='$newpassword' WHERE code='$code'");
            }else{
                return false;
            }
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function getPatientMedicalHistory($patientidno,$dateadmit){
            $result=$this->db->query("SELECT * FROM admission WHERE patientidno='$patientidno' AND dateadmit < '$dateadmit'");
            return $result->result_array();
        }
        public function getMedicalHistory($patientidno,$caseno,$dateadmit){
            $result=$this->db->query("SELECT * FROM admission WHERE patientidno='$patientidno' AND caseno <> '$caseno' AND dateadmit < '$dateadmit' ORDER BY dateadmit DESC");
            return $result->result_array();            
        }
        public function save_medical_history(){
            $caseno=$this->input->post('caseno');
            $history=$this->input->post('medical_history');
            $diagnosis=$this->input->post('diagnosis');
            $pExam=$this->input->post('pExam');
            $result=$this->db->query("UPDATE admission SET diagnosis='$diagnosis',past_history='$history',physical_exam='$pExam' WHERE caseno='$caseno'");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function getAllDiagnostics($caseno,$type){
            $result=$this->db->query("SELECT * FROM diagnostics WHERE caseno='$caseno' AND `type`='$type'");
            return $result->result_array();            
        }
        public function getAllDiagnosticsByType($caseno){
            $result=$this->db->query("SELECT * FROM diagnostics WHERE caseno='$caseno' GROUP BY `type` ORDER BY `type` ASC");
            return $result->result_array();            
        }
        public function getSingleDiagnostic($id){
            $result=$this->db->query("SELECT * FROM diagnostics WHERE id='$id'");
            return $result->row_array();            
        }
        public function save_diagnostic(){
            $caseno=$this->input->post('caseno');
            $remarks=$this->input->post('type');            
            $date=date('Y-m-d');
            $time=date('H:i:s');                                    
            for($i=0;$i < sizeof($_FILES['file']['name']);$i++){                    
                $fileName=basename($_FILES["file"]["name"][$i]);
                $fileType=pathinfo($fileName, PATHINFO_EXTENSION);
                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType,$allowTypes) && $_FILES['file']['size'][$i] < 128000){
                    $image = $_FILES["file"]["tmp_name"][$i];
                    $imgContent=addslashes(file_get_contents($image));
                    $result=$this->db->query("INSERT INTO diagnostics(caseno,`type`,`image`,datearray,timearray) VALUES('$caseno','$remarks','$imgContent','$date','$time')");            
                }
            }

            //$result=$this->db->query("INSERT INTO diagnostics(caseno,remarks,datearray,timearray) VALUES('$caseno','$remarks','$date','$time')");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function remove_diagnostic($id){
            $result=$this->db->query("DELETE FROM diagnostics WHERE id='$id'");
            if($result){
                return true;
            }else{
                return false;
            }            
        }
        public function logout(){
            $username=$this->session->username;
            $result=$this->db->query("UPDATE docfile SET `status`='' WHERE username='$username'");
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function checkLogin(){
            $username=$this->session->username;
            $result=$this->db->query("SELECT * FROM docfile WHERE `status`='Active' AND username='$username' AND username <> ''");
            if($result->num_rows() > 0){
                return true;
            }else{
                return false;
            }

        }

        // new code for new Doctor
        public function getGenCodeForDoctor(){
            $query = $this->db->query("SELECT MAX(code) as max_code FROM docfile");
            $row = $query->row();
            $newCode = isset($row->max_code) ? (int)$row->max_code + 1 : 1;
            return $newCode;
        }

        public function saveNewDoctor() {
            $docname = $this->input->post('gencode');
            $dclastname = $this->input->post('dclastname');
            $dcfirstname = $this->input->post('dcfirstname');
            $dcmiddlename = $this->input->post('dcmiddlename');
            $dcsuffix = $this->input->post('dcsuffix');
            $specialization = $this->input->post('specialization');
            $phicaccno = $this->input->post('phicaccno');
            $tin = $this->input->post('tin');
            $pf = $this->input->post('pf');
            $email = $this->input->post('email');
            $license = $this->input->post('license');
            $ptrno = $this->input->post('ptrno');
            $s2no = $this->input->post('s2no');
            $fname = $dcfirstname . " " . substr($dcmiddlename, 0, 1) . ". " . $dclastname . " " . $dcsuffix;
            $check = $this->db->query("SELECT * FROM docfile WHERE firstname = ? AND lastname = ?", [$dcfirstname, $dclastname]);
            if ($check->num_rows() > 0) {
                return "exist";
            } else {
                $query = $this->db->query(
                    "INSERT INTO docfile 
                    (`code`, `name`, `specialization`, `tod`, `phicacc`, `tinbir`, `PF`, `phicacc1`, `emailaddress`, `licenseno`, `ptrno`, `s2no`, `lastname`, `firstname`, `middlename`, `ext`)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                    [$docname, $fname, $specialization, $specialization, $phicaccno, $tin, $pf, $phicaccno, $email, $license, $ptrno, $s2no, $dclastname, $dcfirstname, $dcmiddlename, $dcsuffix]
                );
        
                return $query ? true : false;
            }
        }        

        public function update_doctor_profile(){
            $code = $this->input->post('code');
            $lastname = $this->input->post('lastname');
            $firstname = $this->input->post('firstname');
            $middlename = $this->input->post('middlename');
            $suffix = $this->input->post('suffix');
            $specialization = $this->input->post('specialization');
            $phicacc = $this->input->post('phicacc');
            $tinbir = $this->input->post('tinbir');
            $licenseno = $this->input->post('licenseno');
            $ptrno = $this->input->post('ptrno');
            $s2no = $this->input->post('s2no');
            $email = $this->input->post('email');
            $fname = $firstname. " " . substr($middlename, 0, 1). ". " . $lastname. " " . $suffix;  

            $query = $this->db->query("UPDATE docfile SET name='$fname', specialization = '$specialization', tod='$specialization', phicacc='$phicacc', tinbir='$tinbir', phicacc1='$phicacc', licenseno='$licenseno', ptrno='$ptrno', s2no='$s2no', lastname='$lastname', firstname='$firstname', middlename='$middlename', ext='$suffix' WHERE code ='$code'");
            if($query){
                return true;
            } else {
                return false;
            }
        }

        public function listSpecialization(){
            $query = $this->db->query("SELECT * FROM docfile WHERE specialization !='' GROUP BY specialization ORDER BY specialization ASC");
            return $query->result_array();            
        }

        public function updateProfilePicture($code, $fileContent) {
            $data = [ 'pic' => $fileContent, ];
            $this->db->where('code', $code);
            return $this->db->update('docfile', $data);
        }

        public function updateDoctorsPassword($drcode, $newpassword) {
            $data = ['password' => $newpassword];
            $this->db->where('code', $drcode);
            return $this->db->update('docfile', $data);
        }
        

    }
?>
