<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_cats
 *
 * @author Dragan
 */
class Model_cats extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    public function get_categories(){
        $data = array();
        
        $this->db->order_by('id','asc');
        $q = $this->db->get('categories');
        
        if($q->num_rows() > 0){
            foreach($q->result_array() as $row){
                $data[] = $row;
            }
        }
        
        $q->free_result();
        return $data;
    }


    public function get_categories_options(){
       
        $rows = $this->db->select('name')->from('categories')->get();

        
        $category_options = array('0' => 'Sve');
            foreach($rows->result_array() as $row){
              $category_options[] = $row['name'];
            }
        
        return $category_options;
    }
    
       public function get_add_categories(){
       
        $rows = $this->db->select('name')->from('categories')->get();

        
        $category_options = array('0' => 'Izaberi kategoriju');
            foreach($rows->result_array() as $row){
              $category_options[] = $row['name'];
            }
        
        return $category_options;
    }
    
        public function get_state_options(){
       
        $rows = $this->db->select('state_name')->from('state')->get();

        
        $state_options = array('0' => 'Sve' );
            foreach($rows->result_array() as $row){
              $state_options[] = $row['state_name'];
            }
        
        return $state_options;
    }
    
        // razlika u ovoj funkciji je samo u prvoj stvaki arraya    
    public function get_state_options_for_admin(){
       
        $rows = $this->db->select('state_name')->from('state')->get();

        
        $state_options = array('0' => 'Izaberi državu' );
            foreach($rows->result_array() as $row){
              $state_options[] = $row['state_name'];
            }
        
        return $state_options;
    }
    
        public function get_licences(){
        $data = array();
        
        $this->db->order_by('id','asc');
        $q = $this->db->get('licence');
        
        if($q->num_rows() > 0){
            foreach($q->result_array() as $row){
                $data[] = $row;
            }
        }
        
        $q->free_result();
        return $data;
    }
}

?>
