<?php


class CRUD_model extends CI_Model {


    protected $_table = null;
    protected $_primary_key = null;
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    /**
     * @usage
     * Single: $this->crud_model->get(2);
     * All: $this->crud_model->get();
     * Custom: $this->user_model->get(['any' => 'param']);
     */
    public function get($id = null, $order_by = null){
        if(is_numeric($id)){
            $this->db->where($this->_primary_key, $id);
        }else if(is_array($id))
            $this->db->where($id);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    /**
     * @param array $crud_data
     * @usage $result = $this->crud_model->insert(['login' => 'Jethro']);
     */
    public function insert($crud_data){
        $date = date('Y-m-d H:i:s');
        $crud_data['date_added'] = $date;
        $crud_data['date_modified'] = $date;
        $this->db->insert('crud', $crud_data);
        return $this->db->insert_id();

    }
    /**
     * @param array $crud_data
     * @param int $crud_id
     * @usage $result = $this->crud_model->update(['login' => 'Jethro'],1);
     */
    public function update($crud_data, $crud_id){
        $crud_data['date_modified'] = date('Y-m-d H:i:s');
        $this->db->where('crud_id', $crud_id);
        $this->db->update('crud', $crud_data);
        return $this->db->affected_rows();
    }
    /**
     * @param int $crud_id
     * @usage $result = $this->crud_model->delete(1);
     */
    public function delete($crud_id){
        $this->db->delete('crud', ['crud_id' => $crud_id]);
        return $this->db->affected_rows();
    } 




}