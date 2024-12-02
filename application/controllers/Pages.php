<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit','2048M');
date_default_timezone_set('Asia/Manila');
    class Pages extends CI_Controller{
        public function index(){
            $page = "index";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                             
            $this->load->view('includes/header');
            $this->load->view('includes/navbarmain');
            $this->load->view('pages/'.$page);         
            $this->load->view('includes/footer');               
        }  
        public function about(){
            $page = "about";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                             
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('pages/'.$page);         
            $this->load->view('includes/footer');               
        } 
        public function services(){
            $page = "services";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                             
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('pages/'.$page);         
            $this->load->view('includes/footer');               
        }     
}
?>
