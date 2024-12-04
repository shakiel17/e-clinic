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
            $result=$this->db->query("SELECT pp.*,a.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.ap='$code' AND a.status='Active' GROUP BY a.patientidno ORDER BY pp.lastname ASC,pp.firstname ASC");
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
            $remarks=$this->input->post('remarks');
            $date=date('Y-m-d');
            $time=date('H:i:s');
            $result=$this->db->query("INSERT INTO productout(caseno,`description`,remarks,datearray,timearray) VALUES('$caseno','$description','$remarks','$date','$time')");
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
?>
