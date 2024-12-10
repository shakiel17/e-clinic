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
                $checkPAN=$this->db->query("SELECT * FROM docfile WHERE phicacc='$pan' AND `status`='ACTIVE' AND phicacc <> ''");
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
            $result=$this->db->query("SELECT * FROM productout WHERE caseno='$caseno' ORDER BY datearray ASC");
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
            $result=$this->db->query("SELECT pp.*,po.*,a.*,d.name,d.ptrno,d.s2no FROM productout po INNER JOIN admission a ON a.caseno=po.caseno INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN docfile d ON d.code=a.ap WHERE po.id='$id'");
            return $result->row_array();
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
            $data="lastname='$lastname',firstname='$firstname',middlename='$middlename',ext='$suffix',name='$name',specialization='$specialization',tod='$specialization',phicacc='$phicacc',tinbir='$tin',phicacc1='$phicacc',emailaddress='$email',licenseno='$licenseno',ptrno='$ptrno',s2no='$s2no',vatex='$cater' WHERE code='$code'";
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
    }
?>
