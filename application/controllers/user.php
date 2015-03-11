<?php

class User extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->output->enable_profiler(TRUE);

    }
    public function get($user_id = null){
        $result = $this->user_model->get($user_id);
        print_r($result);
    }

    
    public function insert(){
        $result = $this->user_model->insert(array(
            'login' => 'Ching'
        ));
        print_r($result);
    }

    public function update($user_id){
        $result = $this->user_model->update(array(
            'login' => 'Peggy'
        ),$user_id);
        print_r($result);
    }
    
    public function delete($user_id){
        $result = $this->user_model->delete($user_id);
        print_r($result);
    } 

    
}