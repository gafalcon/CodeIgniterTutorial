<?php

class Form extends CI_Controller {

    function index(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        $this->form_validation->set_message('required', 'El campo \'%s\' es requerido');

        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');
        $this->form_validation->set_rules('passconf', 'Confirma contraseña', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        
        if($this->form_validation->run() == FALSE){
            $this->load->view('forms/myform');
        }
        else{
            $this->load->view('forms/formsuccess');
        }

    }

}
?>