<?php

class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->output->enable_profiler(TRUE);
    }

    public function index(){

        $data['title'] = 'Root page'; 
        $this->load->view('home/templates/header',$data);
        $this->load->view('home/index');
        $this->load->view('home/templates/footer');

    }

    public function test(){
        $this->load->model('user_model');
        $result =$this->user_model->get([
            'login' => 'chingada'

        ]);
        echo "<pre>";
        print_r($result);
    }

    public function register()
    {
        $data['title'] = 'Register'; 
        $this->load->view('home/templates/header',$data);
        $this->load->view('home/register');
        $this->load->view('home/templates/footer');

    }

} 