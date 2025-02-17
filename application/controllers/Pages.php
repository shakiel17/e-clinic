<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit','2048M');
date_default_timezone_set('Asia/Manila');
    class Pages extends CI_Controller{
// start of user functions
        public function index(){
            $page = "index";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){
                redirect(base_url()."main");
            }
            $this->load->view('pages/'.$page);                     
        }
        public function register(){
            $page = "register";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                                         
            $this->load->view('pages/'.$page);                     
        } 
        public function registration(){
            $register=$this->Clinic_model->register();
            if($register){
                echo "<script>alert('You have successfully registered! Please sign in.');window.location='".base_url()."';</script>";
            }else{

                echo "<script>window.history.back();</script>";
            }
        } 
        public function authentication(){
            $user=$this->Clinic_model->authenticate();
            if($user){
                $userdata=array(
                    'username' => $user['username'],
                    'apcode' => $user['code'],
                    'fullname' => $user['firstname']." ".$user['lastname'],
                    'user_login' => true
                );
                $this->session->set_userdata($userdata);
                redirect(base_url()."main");
            }else{
                $this->session->set_flashdata('error','Invalid password!');
                redirect(base_url());
            }            
        }
        public function main(){
            $page = "main";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Patient List";
            $apcode=$this->session->apcode;
            $data['items'] = $this->Clinic_model->getAllPatientByDoc($apcode);
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
    
        public function user_logout(){
            $this->Clinic_model->logout();
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('apcode');
            $this->session->unset_userdata('fullname');
            $this->session->unset_userdata('user_login');
            redirect(base_url());
        }
        public function new_admission(){
            $page = "new_admission";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Patient Admission";
            $apcode=$this->session->apcode;
            $data['items'] = $this->Clinic_model->getAllPatientByDoc($apcode);
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }

        public function submitadmission(){
            $patientidno=$this->input->post('patientidno');
            $apcode=$this->session->apcode;
            if($patientidno==""){
                $pid="PN".date('Ymdhis');
            }else{
                $pid=$patientidno;
            }
            $caseno="CN".date('Ymdhis');
            $admit=$this->Clinic_model->save_admission($patientidno,$pid,$caseno,$apcode);
            if($admit){
                redirect(base_url()."patientdetails/$caseno");
            }else{
                echo "<script>alert('Unable to admit patient!');window.history.back();</script>";
            }
        }

        public function patientdetails($caseno){
            $page = "patientdetails";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            } else {
                redirect(base_url());
            }
            $data['title'] = "Patient Details";            
            $data['item'] = $this->Clinic_model->getPatientDetails($caseno);
            $data['rx'] = "";
            $data['rx_show'] = "";
            $data['overview'] = "active";
            $data['overview_show'] = "show";
            $data['history'] = "";
            $data['history_show'] = "";
            $data['diagnostic'] = "";
            $data['diagnostic_show'] = "";
            $data['casenum'] = "";            
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function view_rx($caseno){
            $page = "patientdetails";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            } else {
                redirect(base_url());
            }
            $data['title'] = "Patient Details";            
            $data['item'] = $this->Clinic_model->getPatientDetails($caseno);
            $data['rx'] = "active";
            $data['rx_show'] = "show";
            $data['overview'] = "";
            $data['overview_show'] = "";
            $data['history'] = "";
            $data['history_show'] = "";
            $data['diagnostic'] = "";
            $data['diagnostic_show'] = "";
            $data['casenum'] = "";
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function medical_history($caseno,$casenum){
            $page = "patientdetails";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            } else {
                redirect(base_url());
            }
            $data['title'] = "Patient Details";            
            $data['item'] = $this->Clinic_model->getPatientDetails($caseno);
            $data['rx'] = "";
            $data['rx_show'] = "";
            $data['overview'] = "";
            $data['overview_show'] = "";
            $data['history'] = "active";
            $data['history_show'] = "show";
            $data['diagnostic'] = "";
            $data['diagnostic_show'] = "";
            $data['casenum'] = $casenum;
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }

        public function view_diagnostic($caseno){
            $page = "patientdetails";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            } else {
                redirect(base_url());
            }
            $data['title'] = "Patient Details";            
            $data['item'] = $this->Clinic_model->getPatientDetails($caseno);
            $data['rx'] = "";
            $data['rx_show'] = "";
            $data['overview'] = "";
            $data['overview_show'] = "";
            $data['history'] = "";
            $data['history_show'] = "";
            $data['diagnostic'] = "active";
            $data['diagnostic_show'] = "show";
            $data['casenum'] = "";
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function active_patient(){
            $page = "active_patient";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Active Patient List";
            $apcode=$this->session->apcode;
            $data['items'] = $this->Clinic_model->getAllPatientByDocActive($apcode);
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function add_rx(){
            $caseno=$this->input->post('caseno');
            $add=$this->Clinic_model->save_rx();
            if($add){
                echo "<script>window.location='".base_url()."view_rx/$caseno';</script>";
            }else{
                echo "<script>alert('Unable to create Rx!');window.location='".base_url()."view_rx/$caseno';</script>";
            }
        }
        public function delete_rx($id,$caseno){            
            $add=$this->Clinic_model->delete_rx($id);
            if($add){
                echo "<script>alert('Rx successfully deleted!');window.location='".base_url()."view_rx/$caseno';</script>";
            }else{
                echo "<script>alert('Unable to delete Rx!');window.location='".base_url()."view_rx/$caseno';</script>";
            }
        }
        public function print_rx($id){
            $page="print_rx";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }                                    
            $data['items'] = $this->Clinic_model->getSingleRx($id);
            $this->load->view('pages/'.$page,$data);                      

        }
        public function re_admission($patientidno){
            $page = "re_admission";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Patient Admission"; 
            $data['patientidno'] = $patientidno;
            $data['item'] = $this->Clinic_model->getPatientProfile($patientidno);
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function patient_discharged($caseno){            
            $add=$this->Clinic_model->discharged_patient($caseno);
            if($add){
                echo "<script>alert('Patient successfully discharged!');window.location='".base_url()."active_patient';</script>";
            }else{
                echo "<script>alert('Unable to discharged patient!');window.location='".base_url()."active_patient';</script>";
            }
        }
        public function patientprofile($patientidno){
            $page = "patientprofile";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Patient Profile";            
            $data['item'] = $this->Clinic_model->getPatientProfile($patientidno);
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function userprofile(){
            $page = "userprofile";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Patient Profile";            
            $apcode=$this->session->apcode;
            $data['item'] = $this->Clinic_model->getUserProfile($apcode);
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function update_user_profile(){            
            $add=$this->Clinic_model->update_user_profile();
            if($add){
                echo "<script>alert('User profile successfully updated!');window.location='".base_url()."userprofile';</script>";
            }else{
                echo "<script>alert('Unable to update user profile!');window.location='".base_url()."userprofile';</script>";
            }
        }
        public function update_user_password(){            
            $add=$this->Clinic_model->update_user_password();
            if($add){
                echo "<script>alert('User password successfully updated!');window.location='".base_url()."userprofile';</script>";
            }else{
                echo "<script>alert('Unable to update user password!');window.location='".base_url()."userprofile';</script>";
            }
        }
        public function upload_user_picture(){            
            $add=$this->Clinic_model->upload_user_picture();
            if($add){
                echo "<script>alert('Profile picture successfully updated!');window.location='".base_url()."userprofile';</script>";
            }else{
                echo "<script>alert('Unable to update profile picture!');window.location='".base_url()."userprofile';</script>";
            }
        }
        public function appointment(){
            $page = "appointment";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Appointment Calendar";
            $data['datenow'] = date('Y-m-d');
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function search_appointment(){
            $page = "appointment";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $month=$this->input->post('month');
            $year=$this->input->post('year');
            $data['title'] = "Appointment Calendar";
            $data['datenow'] = $year."-".$month;
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function view_appointment($datearray){
            $page = "view_appointment";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Appointment Calendar";
            $apcode=$this->session->apcode;
            $data['datenow'] = $datearray;
            $data['items'] = $this->Clinic_model->getAllAppointment($apcode,$datearray);
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function admitpatient($id){
            $search=$this->Clinic_model->checkPatient($id);            
        }
        public function appoint_readmit($id,$patientidno){
            $page = "appoint_readmit";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Patient Admission"; 
            $data['patientidno'] = $patientidno;
            $data['id'] = $id;
            $data['item'] = $this->Clinic_model->getPatientProfile($patientidno);
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function appoint_admit($id){
            $page = "appoint_admit";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                  
            if($this->session->user_login){

            }else{
                redirect(base_url());
            }
            $data['title'] = "Patient Admission";             
            $data['id'] = $id;
            $data['item'] = $this->Clinic_model->getPatientProfileAppointment($id);
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);          
            $this->load->view('includes/modal');           
            $this->load->view('includes/footer');
        }
        public function cancel_appointment($id,$datearray){            
            $add=$this->Clinic_model->cancel_appointment($id);
            if($add){
                echo "<script>alert('Appointment successfully cancelled!');window.location='".base_url()."view_appointment/$datearray';</script>";
            }else{
                echo "<script>alert('Unable to cancel appointment!');window.location='".base_url()."view_appointment/$datearray';</script>";
            }
        }
        public function save_medical_history(){
            $caseno=$this->input->post('caseno');
            $add=$this->Clinic_model->save_medical_history();
            if($add){
                echo "<script>alert('Submit success!');window.location='".base_url()."patientdetails/$caseno';</script>";
            }else{
                echo "<script>alert('Submit failed!');window.location='".base_url()."patientdetails/$caseno';</script>";
            }
        }
        public function add_diagnostic(){
            $caseno=$this->input->post('caseno');                                        
            $add=$this->Clinic_model->save_diagnostic();
            if($add){
                echo "<script>alert('Diagnostic successfully saved!');window.location='".base_url()."view_diagnostic/$caseno';</script>";
            }else{
               echo "<script>alert('Unable to save diagnostic!');window.location='".base_url()."view_diagnostic/$caseno';</script>";
           }
        }
        public function remove_diagnostic($id,$caseno){            
            $add=$this->Clinic_model->remove_diagnostic($id);
            if($add){
                echo "<script>alert('Diagnostic successfully removed!');window.location='".base_url()."view_diagnostic/$caseno';</script>";
            }else{
                echo "<script>alert('Unable to remove diagnostic!');window.location='".base_url()."view_diagnostic/$caseno';</script>";
            }
        }
        public function view_test($id){
            $page="view_test";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }  
            $data['item'] = $this->Clinic_model->getSingleDiagnostic($id);
            $this->load->view('pages/'.$page,$data);
        }
// end of user functions

// start of admin functions
public function adminmain(){
    $page = "main";
    if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
        show_404();
    }                  
    if($this->session->admin_login){

    }else{
        redirect(base_url()."admin");
    }
    $data['title'] = "Admin Dashboard";
    $data['doctors'] = $this->Clinic_model->getAllDoctorsCount();
    $data['patients'] = $this->Clinic_model->getAllPatientCount();
    $appointmentsData = $this->Clinic_model->getAppointmentsWithCount();
    $data['appntsCount'] = $appointmentsData['appntCount'];
    $data['appointments'] = $appointmentsData['appointments'];
    $this->load->view('includes/header');
    $this->load->view('includes/admin/navbar');
    $this->load->view('includes/admin/sidebar');
    $this->load->view('pages/admin/'.$page,$data);          
    $this->load->view('includes/admin/modal');           
    $this->load->view('includes/footer');
}

public function admin(){
    $page = "index";
    if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
        show_404();
    }                  
    if($this->session->admin_login){
        redirect(base_url()."adminmain");
    }
    $this->load->view('pages/admin/'.$page);                     
}

public function admin_authentication(){
    $user=$this->Clinic_model->admin_authenticate();
    if($user){
        $userdata=array(
            'username' => $user['username'],
            'fullname' => $user['fullname'],
            'admin_login' => true
        );
        $this->session->set_userdata($userdata);
        redirect(base_url()."adminmain");
    }else{
        $this->session->set_flashdata('error','Invalid password!');
        redirect(base_url()."admin");
    }            
}

public function admin_logout(){
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('fullname');
    $this->session->unset_userdata('admin_login');
    redirect(base_url()."admin");
}

public function manage_doctor(){
    $page = "manage_doctor";
    if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
        show_404();
    }                  
    if($this->session->admin_login){

    } else {
        redirect(base_url()."admin");
    }
    $data['title'] = "Doctor List";
    $data['items'] = $this->Clinic_model->getAllDoctor();
    $data['gencode'] = $this->Clinic_model->getGenCodeForDoctor();
    $data['listspec'] = $this->Clinic_model->listSpecialization();
    $this->load->view('includes/header');
    $this->load->view('includes/admin/navbar');
    $this->load->view('includes/admin/sidebar');
    $this->load->view('pages/admin/'.$page,$data);          
    $this->load->view('includes/admin/modal');           
    $this->load->view('includes/footer');
}

public function doctor_profile($code){
    $page = "doctor_profile";
    if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
        show_404();
    }                  
    if($this->session->admin_login){

    } else {
        redirect(base_url()."admin");
    }
    $data['title'] = "Doctor Profile";
    $data['fth'] = $this->Clinic_model->getAllDoctorProfile($code)[0];
    $data['speclist'] = $this->Clinic_model->listSpecialization();
    $this->load->view('includes/header');
    $this->load->view('includes/admin/navbar');
    $this->load->view('includes/admin/sidebar');
    $this->load->view('pages/admin/'.$page,$data);          
    $this->load->view('includes/admin/modal');           
    $this->load->view('includes/footer');
}

public function uploadProfilePicture($code) {
    try {
        if (!empty($_FILES['drpic']['name'])) {
            $fileTmp = $_FILES['drpic']['tmp_name'];
            $fileSize = $_FILES['drpic']['size'];
            $fileType = mime_content_type($fileTmp);
            $allowedTypes = ['image/png', 'image/jpeg'];
            if (!in_array($fileType, $allowedTypes)) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Invalid file type. Only PNG and JPEG are allowed.']);
                return;
            }
            if ($fileSize > 25 * 1024 * 1024) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'File size exceeds the 25MB limit.']);
                return;
            }
            $fileContent = file_get_contents($fileTmp);

            $this->load->model('Clinic_model');
            $result = $this->Clinic_model->updateProfilePicture($code, $fileContent);

            if ($result) {
                http_response_code(200);
                echo json_encode(['status' => 'success', 'message' => 'Profile picture updated successfully.']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Failed to save profile picture.']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'No file uploaded.']);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
    }
}

public function manage_user(){
    $page = "doctor_account";
    if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
        show_404();
    }                  
    if($this->session->admin_login){

    }else{
        redirect(base_url()."admin");
    }
    $data['title'] = "Doctor Profile";
    $data['items'] = $this->Clinic_model->getAllDoctor();
    $this->load->view('includes/header');
    $this->load->view('includes/admin/navbar');
    $this->load->view('includes/admin/sidebar');
    $this->load->view('pages/admin/'.$page,$data);          
    $this->load->view('includes/admin/modal');           
    $this->load->view('includes/footer');
}

public function update_doctor_account(){
    $code=$this->input->post('code');
    $update=$this->Clinic_model->update_doctor_account();
    if($update){
        echo "<script>alert('Doctor account successfully updated!');window.location='".base_url()."doctor_profile/$code';</script>";
    } else {
        echo "<script>alert('Unable to update doctor account!');window.location='".base_url()."doctor_profile/$code';</script>";
    }
}

public function submit_new_doctor() {
    $page = "manage_doctor";
    $data['title'] = "Doctor List";
    $data['items'] = $this->Clinic_model->getAllDoctor();
    $data['gencode'] = $this->Clinic_model->getGenCodeForDoctor();
    $gencode = $this->input->post('gencode');
    $result = $this->Clinic_model->saveNewDoctor($this->input->post());
   if ($result === true) {
        echo "<script> document.addEventListener('DOMContentLoaded', function () { popupAlertSaveSuccess('$gencode'); }); </script>";
    } else {
        echo "<script> document.addEventListener('DOMContentLoaded', function () { popupAlertSaveFailed(); }); </script>";
    }
    $this->load->view('includes/header');
    $this->load->view('includes/admin/navbar');
    $this->load->view('includes/admin/sidebar');
    $this->load->view('pages/admin/' . $page, $data);
    $this->load->view('includes/admin/modal');
    $this->load->view('includes/footer');
}

public function updateDoctorProfile(){
    $page = "doctor_profile";
    $data['title'] = "Doctor Profile";
    $code = $this->input->post('code');
    $data['title'] = "Doctor Profile";
    $data['fth'] = $this->Clinic_model->getAllDoctorProfile($code)[0];
    $addnew = $this->Clinic_model->update_doctor_profile($this->input->post());
    if ($addnew) {
        echo "<script> document.addEventListener('DOMContentLoaded', function () { popupAlertUpdateSuccess('$code'); });</script>";
    } else {
        echo "<script> document.addEventListener('DOMContentLoaded', function () { popupAlertUpdateFailed('$code'); }); </script>";
    }
    $this->load->view('includes/header');
    $this->load->view('includes/admin/navbar');
    $this->load->view('includes/admin/sidebar');
    $this->load->view('pages/admin/'.$page, $data);          
    $this->load->view('includes/admin/modal');           
    $this->load->view('includes/footer');
}

public function updateDoctorsPassword() {
    try {
        $drcode = $this->input->post('drcode');
        $newpassword = $this->input->post('newPassword');
        if (!$drcode || !$newpassword) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
            return;
        }

        $this->load->model('Clinic_model');
        $result = $this->Clinic_model->updateDoctorsPassword($drcode, $newpassword);

        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Password updated successfully.']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
    }
}

public function specialization() {
    $page = "specialization";
    $data['title'] = "Specialization";
    $this->load->view('includes/header');
    $this->load->view('includes/admin/navbar');
    $this->load->view('includes/admin/sidebar');
    $this->load->view('pages/admin/' . $page, $data);
    $this->load->view('includes/admin/modal');
    $this->load->view('includes/footer');
}

// end of admin functions
}

?>
