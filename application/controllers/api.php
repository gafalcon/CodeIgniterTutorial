<?php

class Api extends CI_Controller {

    // -----------------------------------------------------------------

   public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    // -----------------------------------------------------------------

   private function _require_login(){
        $user_id = $this->session->userdata('user_id');
        if(!$user_id){
            $this->output->set_output(json_encode([
                'result' => 1,
                'error' => 'You are not authorized'
            ]));
            return false;
        }
        return true;
    } 

   // -----------------------------------------------------------------

   public function login(){

        $login = $this->input->post('login');
        $password = $this->input->post('password');

        $this->load->model('user_model');
        $result = $this->user_model->get([
            'login' => $login,
            'password' => hash('sha256', $password.SALT)
        ]);
        $this->output->set_content_type('application_json');
        if($result){
            $this->session->set_userdata([
                'user_id' => $result[0]['user_id'] 
            ]); 
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }

        $this->output->set_output(json_encode(['result' => 0]));
       
    }

    // -----------------------------------------------------------------

   
    public function register(){
        $this->output->set_content_type('application_json');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('login','Login','required|min_length[4]|max_length[15]|is_unique[user.login]');
        $this->form_validation->set_rules('email','Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password','Password','required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('passconf','Password confirmation','required|matches[password]');
        
        $this->load->model('user_model');
        if($this->form_validation->run() == false){
            $this->output->set_output(json_encode([
                'result' => 0,
                'error_array' => $this->form_validation->error_array()
            ]));
            //echo validation_errors();
            return false;
        }
        $login = $this->input->post('login');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $passconf = $this->input->post('passconf');

        $user_id = $this->user_model->insert([
            'login' => $login,
            'password' =>  hash('sha256', $password.SALT),
            'email' => $email,
        ]);
       
        if($user_id){
            $this->session->set_userdata([
                'user_id' => $user_id 
            ]); 
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }

        $this->output->set_output(json_encode([
            'result' => 0,
            'error_array' => array('Registration error'=>'User couldnt be regiistered')
        ]));
    }

   // -----------------------------------------------------------------

   public function get_todo($id = null){
        $this->_require_login();
        $this->load->model('todo_model');
        $data = ['user_id' => $this->session->userdata('user_id')];
        if($id != null){
            $data['todo_id'] = $id; 
        }
        $result = $this->todo_model->get($data);
        $this->output->set_output(json_encode($result));

    }
   // -----------------------------------------------------------------

   public function create_todo(){
       $this->_require_login();
       $this->load->library('form_validation');
       $this->form_validation->set_rules('content', 'Content', 'required|max_length[255]');
       if($this->form_validation->run() == false){
           $this->output->set_output(json_encode([
               'result' => 0,
               'error' => $this->form_validation->error_array()
           ]));
           return false;
       }
       $new_todo = [
           'content' => $this->input->post('content'),
           'user_id' => $this->session->userdata('user_id')
       ];
       $this->load->model('todo_model');
       $result = $this->todo_model->insert($new_todo);

       if($result){
           $new_todo['todo_id'] = $this->db->insert_id();
           $this->output->set_output(json_encode([
                'result' => 1,
                'data' => $new_todo
            ]));
            return false;
       }
       $this->output->set_output(json_encode([
           'result' => 0,
           'error' => 'Could not insert todo item'
       ]));

    }

   // -----------------------------------------------------------------


    public function update_todo(){
        $this->_require_login();
        $todo_id = $this->input->post('todo_id');
        $completed = $this->input->post('completed');

        $this->load->model('todo_model');

        $rows = $this->todo_model->update(
            ['completed' => $completed], $todo_id
        );
        
        if($rows > 0){
           $this->output->set_output(json_encode([
               'result' => 1
            ]));
            return false;
        }
        $this->output->set_output(json_encode([
            'result' => 0,
            'msg'=> 'Could not update'
        ]));

    }

   // -----------------------------------------------------------------

   public function delete_todo(){

        $this->_require_login();

        $this->output->set_content_type('application_json');
        $this->load->model('todo_model');
        $rows = $this->todo_model->delete([
            'todo_id' => $this->input->post('todo_id'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if($rows>0){
           $this->output->set_output(json_encode([
               'result' => 1
            ]));
            return false;
        }
        $this->output->set_output(json_encode([
            'result' => 0,
            'msg'=> 'Could not delete'
        ]));

    }

   // -----------------------------------------------------------------

   public function get_note($id = null){
       sleep(2);
       $this->_require_login();
       $this->load->model('note_model');
       $data = ['user_id' => $this->session->userdata('user_id')];
       if($id != null){
           $data['note_id'] = $id; 
       }
       $result = $this->note_model->get($data);
       $this->output->set_output(json_encode($result));


    }


    // -----------------------------------------------------------------

    public function create_note(){
        $this->_require_login();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[100]');
        $this->form_validation->set_rules('content', 'Content', 'required|max_length[255]');
        if($this->form_validation->run() == false){
            $this->output->set_output(json_encode([
                'result' => 0,
                'error' => $this->form_validation->error_array()
            ]));
            return false;
        }
        $new_note = [
            'content' => $this->input->post('content'),
            'user_id' => $this->session->userdata('user_id'),
            'title' => $this->input->post('title')
        ];
        $this->load->model('note_model');
        $result = $this->note_model->insert($new_note);
        
        if($result){
           $new_note['note_id'] = $this->db->insert_id();
           $this->output->set_output(json_encode([
                'result' => 1,
                'data' => $new_note 
            ]));
            return false;
        }
        $this->output->set_output(json_encode([
            'result' => 0,
            'error' => 'Could not insert note'
        ]));

    }

    // -----------------------------------------------------------------

    public function update_note(){
        $this->_require_login();
        $node_id = $this->input->post('note_id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[100]');
        $this->form_validation->set_rules('content', 'Content', 'required|max_length[255]');
        if($this->form_validation->run() == false){
            $this->output->set_output(json_encode([
                'result' => 0,
                'error' => $this->form_validation->error_array()
            ]));
            return false;
        }
        $note_id = $this->input->post('note_id');
        $update_note = [
            'content' => $this->input->post('content'),
            'title' => $this->input->post('title')
        ];
        $this->load->model('note_model');
        $result = $this->note_model->update($update_note, $note_id);
        
        if($result){
            $new_note['note_id'] = $this->db->insert_id();
            $this->output->set_output(json_encode([
                'result' => 1,
            ]));
            return false;
        }
        $this->output->set_output(json_encode([
            'result' => 0,
            'error' => 'Could not update note'
        ]));

    }

    // -----------------------------------------------------------------

    public function delete_note(){
        $this->_require_login();

        $this->output->set_content_type('application_json');

        $this->load->model('note_model');
        
        $rows = $this->note_model->delete([
            'note_id' => $this->input->post('note_id'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if($rows>0){
           $this->output->set_output(json_encode([
               'result' => 1
            ]));
            return false;
        }
        $this->output->set_output(json_encode([
            'result' => 0,
            'msg'=> 'Could not delete note'
        ]));


    }
}