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
    }
?>
