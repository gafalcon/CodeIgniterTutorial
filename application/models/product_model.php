<?php

class Product_model extends CI_Model{


    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    /**
     * @usage
     * Single: $this->product_model->get(2);
     * All: $this->product_model->get();
     */
    public function get($product_id = null){
        if($product_id !== null){
            if(is_array($product_id)){
                $this->db->where($product_id);
            }else{
                $this->db->where('product_id', $product_id);
            }
        }
        $query = $this->db->get('product');
        $products = $query->result_array();
        $products2 = array();
        
        foreach($products as $product){
            $this->db->where('product_id',$product['product_id']);
            $review_query = $this->db->get('review');
            $product['reviews'] = $review_query->result_array();
            $this->db->where('product_id', $product['product_id']);
            $image_query = $this->db->get('images');
            $product['images'] = $image_query->result_array();
            array_push($products2, $product);

        }
        return $products2;
    }

    /**
     * @param array $product_data
     * @usage $result = $this->product_model->insert(['name' => 'Zircon']);
     */
    public function insert($product_data){
        $date = time();
        $this->db->insert('product', $product_data);
        return $this->db->insert_id();

    }
    /**
     * @param array $product_data
     * @param int $product_id
     * @usage $result = $this->product_model->update(['name' => 'Emerald'],1);
     */
    public function update($product_data, $product_id){
        $this->db->where('product_id', $product_id);
        $this->db->update('product', $product_data);
        return $this->db->affected_rows();
    }
    /**
     * @param int $product_id
     * @usage $result = $this->product_model->delete(1);
     */
    public function delete($product_id){
        $this->db->delete('product', ['product_id' => $product_id]);
        return $this->db->affected_rows();
    } 

    
}