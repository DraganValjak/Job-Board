<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_drivers
 *
 * @author Dragan
 */
class Model_workers extends CI_Model {

     protected $_date;
    protected $_delete_datum;
    
    function __construct() {
        parent::__construct();
        $this->_date = date('Y-m-d H:i:s');
        $this->_delete_datum = date('Y-m-d 00:00:00', strtotime('-1 month'));
    }
    
    public function get_listings($query_array, $num, $start){
        $data = array();
       
        
        $this->db->select('*');
         $this->db->from('drivers');
        //$this->db->query('LEFT JOIN users  ON users.id = drivers.user_id  LEFT JOIN state ON state.id = drivers.state_id');
         $this->db->join('users', 'users.user_id = drivers.user_id', 'left');
         
         $this->db->join('state', 'state.state_id = drivers.state_id', 'left');
        
                 $this->db->where(array('drivers.status'=>'active', 'drivers.date_created <='=> $this->_date, 'drivers.date_expires >='=> $this->_date));

                  if($query_array['category']){
                        $all_category = array('0','1','2','3');
                        $query_category = (in_array($query_array['category'], $all_category)) ? $query_array['category'] : '0';
                  $this->db->where('category_id', $query_category);
                  }
                   if($query_array['state']){   
                        $all_states = array('0','1','2','3','4');
                        $query_states = (in_array($query_array['state'], $all_states)) ? $query_array['state'] : '0';
                  $this->db->where('drivers.state_id', $query_states);
                  }
                 $this->db->or_where('drivers.date_expires', '0000-00-00 00:00:00');
                 

                 $this->db->order_by('drivers.date_created', 'desc');
                 $this->db->limit($num,$start);
       
                 
               
        
  //print_r($q);die();
      
        $rows = $this->db->get();
      
        if($rows->num_rows() > 0){
            foreach($rows->result_array() as $row){
                $data[] = $row;
            }
        }
        $rows->free_result();
        return $data;
    }
    
    public function get_work_count($query_array){
        $this->db->select('id')->from('drivers');
                 $this->db->where(array('status'=>'active', 'date_created <='=> $this->_date, 'date_expires >='=> $this->_date));

                  if($query_array['category']){
                        $all_category = array('0','1','2','3');
                        $query_category = (in_array($query_array['category'], $all_category)) ? $query_array['category'] : '0';
                  $this->db->where('category_id', $query_category);
                  }
                   if($query_array['state']){   
                        $all_states = array('0','1','2','3','4');
                        $query_states = (in_array($query_array['state'], $all_states)) ? $query_array['state'] : '0';
                  $this->db->where('drivers.state_id', $query_states);
                  }
                 
                 $this->db->or_where('date_expires', '00-00-00 00:00:00');
 
        
        
        $row = $this->db->get();
        return $row->num_rows();
        
    }
    
    // izvlačimo detalje posla
    public function get_details($id){
        $data = array();
        
        $options = array('drivers.id' => $id);
        $q = $this->db->select('*')->from('drivers')
                 ->join('users', 'users.user_id = drivers.user_id','left')
                 ->join('state', 'state.state_id = drivers.state_id','left')
              ->where( $options, 1);
        
         $q = $this->db->get();
         
        if($q->num_rows() > 0){
            foreach($q->result_array() as $row){
                $data = $row;
            }
        }
        $q->free_result();
        return $data;
    }
    
    public function insert_job($data){
        $this->db->insert('drivers', $data);
        return $this->db->insert_id();
    }
    
    public function update_job($id, $data){
        $this->where('id', $id);
        $this->db->update('drivers', $data);
    }
    
    public function delete_job($id){
        $this->db->delete('drivers', array('id' => $id)); 
    }
    
    public function check_date(){
        $this->db->where('date_created <',  $this->_delete_datum);
        $this->db->delete('ci_query');
        
    }
}



