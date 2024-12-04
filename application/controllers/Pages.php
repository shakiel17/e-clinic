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
            if($patientidno==""){
                $pid="PN".date('Ymdhis');
            }else{
                $pid=$patientidno;
            }
            $caseno="CN".date('Ymdhis');
            $admit=$this->Clinic_model->save_admission($patientidno,$pid,$caseno);
            if($admit){

            }else{
                
            }
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
    $data['title'] = "Patient List";
    $apcode=$this->session->apcode;
    $data['items'] = $this->Clinic_model->getAllPatientByDoc($apcode);
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

    }else{
        redirect(base_url()."admin");
    }
    $data['title'] = "Doctor List";
    $data['items'] = $this->Clinic_model->getAllDoctor();
    $this->load->view('includes/header');
    $this->load->view('includes/admin/navbar');
    $this->load->view('includes/admin/sidebar');
    $this->load->view('pages/admin/'.$page,$data);          
    $this->load->view('includes/admin/modal');           
    $this->load->view('includes/footer');
}

public function doctor_profile(){
    $page = "doctor_profile";
    if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
        show_404();
    }                  
    if($this->session->admin_login){

    }else{
        redirect(base_url()."admin");
    }
    $data['title'] = "Doctor List";
    $data['items'] = $this->Clinic_model->getAllDoctor();
    $this->load->view('includes/header');
    $this->load->view('includes/admin/navbar');
    $this->load->view('includes/admin/sidebar');
    $this->load->view('pages/admin/'.$page,$data);          
    $this->load->view('includes/admin/modal');           
    $this->load->view('includes/footer');
}
// end of admin functions
}

?>
