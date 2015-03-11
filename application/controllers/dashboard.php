<?php

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if(!$user_id){
            $this->logout();
        }

    }
    public function index(){
        $data['title'] = 'dashboard';
        $this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('dashboard/templates/footer');
    }

    public function logout(){
        $this->session->sess_destroy();
        //session_destroy();
        redirect('/');
    }


}