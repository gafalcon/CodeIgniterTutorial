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
    public function insert($data){
        $date = date('Y-m-d H:i:s');
        $data['date_added'] = $date;
        $data['date_modified'] = $date;
        return $this->db->insert($this->_table, $data);

    }
    /**
     * @param array $new_data
     * @param array $where
     * @usage $result = $this->user_model->update(['login' => 'TED'], ['date_created' => '0']);
     */
    public function update($new_data, $where){
        $new_data['date_modified'] = date('Y-m-d H:i:s');
        if(is_numeric($where)){
            $this->db->where($this->_primary_key, $where);

        }else if(is_array($where)){
            $this->db->where($where);
        }else{
            die('You must pass a second parameter to the UPDATE method');
        }
        $this->db->update($this->_table, $new_data);
        return $this->db->affected_rows();
    }

    /**
     * @param array $data
     * @param array $id
     * @usage $result = $this->user_model->insertUpdate(['login' => 'TED'],15);
     */   
    public function insertUpdate($data, $id = false){

        if(!$id){
            die("You must pass a second parameter to the insertUPDATE() method");
        }

        $this->db->where($this->_primary_key, $id);
        $num = $this->db->count_all_results($this->_table);
        if($num == 0){
            return $this->insert($data);
        }
        return $this->update($data, $id);
    }
    
    /**
     * @param int $crud_id
     * @usage $result = $this->crud_model->delete(1);
     */
    public function delete($id){
        $this->db->delete($this->_table, $id);
        return $this->db->affected_rows();
    } 




}