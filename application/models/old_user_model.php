<?php

class Old_User_model extends CI_Model{


    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    /**
     * @usage
     * Single: $this->user_model->get(2);
     * All: $this->user_model->get();
     */
    public function get($user_id = null){
        if($user_id !== null){
            if(is_array($user_id)){
                $this->db->where($user_id);
            }else{
                $this->db->where('user_id', $user_id);
            }
        }
        $query = $this->db->get('user');
        return $query->result_array();
    }

    /**
     * @param array $user_data
     * @usage $result = $this->user_model->insert(['login' => 'Jethro']);
     */
    public function insert($user_data){
        $date = date('Y-m-d H:i:s');
        $user_data['date_added'] = $date;
        $user_data['date_modified'] = $date;
        $this->db->insert('user', $user_data);
        return $this->db->insert_id();

    }
    /**
     * @param array $user_data
     * @param int $user_id
     * @usage $result = $this->user_model->update(['login' => 'Jethro'],1);
     */
    public function update($user_data, $user_id){
        $user_data['date_modified'] = date('Y-m-d H:i:s');
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $user_data);
        return $this->db->affected_rows();
    }
    /**
     * @param int $user_id
     * @usage $result = $this->user_model->delete(1);
     */
    public function delete($user_id){
        $this->db->delete('user', ['user_id' => $user_id]);
        return $this->db->affected_rows();
    } 

    
}