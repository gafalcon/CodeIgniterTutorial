<?php

class Product extends CI_Controller{

    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->model('product_model');
        //$this->output->enable_profiler(TRUE);

    }
    public function get($product_id = null){
        //$this->output->set_content_type('application_json');
        $result = $this->product_model->get($product_id);
        //print_r($result);
        $this->output->set_output(json_encode($result));
    }

    
    public function insert(){
        $result = $this->product_model->insert(array(
            'name' => 'Ching'
        ));
        print_r($result);
    }

    public function update($product_id){
        $result = $this->product_model->update(array(
            'name' => 'Peggy'
        ),$product_id);
        print_r($result);
    }
    
    public function delete($product_id){
        $result = $this->product_model->delete($product_id);
        print_r($result);
    } 

    
}