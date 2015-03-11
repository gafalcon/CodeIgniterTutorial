<?php

class Review_model extends CI_Model{


    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    /**
     * @usage
     * Single: $this->review_model->get(2);
     * All: $this->review_model->get();
     */
    public function get($review_id = null){
        if($review_id !== null){
            if(is_array($review_id)){
                $this->db->where($review_id);
            }else{
                $this->db->where('review_id', $review_id);
            }
        }
        $query = $this->db->get('review');
        return $query->result_array();
    }

    /**
     * @param array $review_data
     * @usage $result = $this->review_model->insert(['authore' => 'Zircon']);
     */
    public function insert($review_data){
        $date = time();
        $review_data['createdOn'] = $date;
        $this->db->insert('review', $review_data);
        return $this->db->insert_id();

    }
    /**
     * @param array $review_data
     * @param int $review_id
     * @usage $result = $this->review_model->update(['author' => 'Emerald'],1);
     */
    public function update($review_data, $review_id){
        $review_data['createdOn'] = time();
        $this->db->where('review_id', $review_id);
        $this->db->update('review', $review_data);
        return $this->db->affected_rows();
    }
    /**
     * @param int $review_id
     * @usage $result = $this->review_model->delete(1);
     */
    public function delete($review_id){
        $this->db->delete('review', ['review_id' => $review_id]);
        return $this->db->affected_rows();
    } 

    
}