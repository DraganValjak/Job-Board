<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of superadmin_model
 *
 * @author Dragan
 */
class Superadmin_model extends CI_Model {
   
    protected $_primary_key = 'user_id';
    protected $_table_key = 'id';
    protected $_image_path = '';
    protected $_image_url_path = '';
    public $table_name = '';
    public $id = '';
    public $data = array();
    
    public function __construct() {
        parent::__construct();
    }
    
    
     // svi podaci korisnika
    public function user($table_name, $email){
       
        $this->db->where(array('email' => $email));
        $query = $this->db->get($table_name);
        $data = $query->row();
        if($query->num_rows() == 1){
            return $data;
        }else{
            return false;
        }
    }
    
    // izvlačimo sve korisnike
        public function get_all_users($table_name){
       return $this->db->get($table_name)->result();
    }
    
    // update
        public function save_data($id, $user_or_company_id , $table_name, $data){  
      
        // update
        $id_return = intval($id);    
        $this->db->set($data);
        $this->db->where($user_or_company_id, $id_return);
        $this->db->update($table_name);
       
        return $id_return;
    }
    
    // izvlačimo pojedinog korisnika
    public function get_user($id,$user_or_company_id, $table_name){
        
        $id_return = intval($id);
        $this->db->where($user_or_company_id, $id_return);
        return $this->db->get($table_name)->row();  
    }
    
    // izvlačimo sve korisnikove oglase
    public function  get_user_advertisements($id, $user_or_company_id, $table_name){
        $id_return = intval($id);
        $this->db->where($user_or_company_id, $id_return);
        $result =  $this->db->get($table_name); 
        
        if($result->result() > 0){
            return $result->result_array();;
        }else{
            return false;
        }
    }
    
    public function get_user_hitchhiker($id, $hitchhiker_table_name){
            $id_return = intval($id);
        $this->db->where('user_company_id', $id_return);
        $result =  $this->db->get($hitchhiker_table_name); 
        
        if($result->result() > 0){
            return $result->result_array();;
        }else{
            return false;
        }
    }
    
      // update oglas
        public function save_advertisement($id,  $table_name, $data){  
      
        // update
        $id_return = intval($id);    
        $this->db->set($data);
        $this->db->where($this->_table_key, $id_return);
        $this->db->update($table_name);
       
        return $id_return;
    }
    
    // brišemo oglas
    public function delete($id , $table_name){
        $id = (int)$id;
        $this->db->where($this->_table_key, $id);
        $this->db->delete($table_name);
    }
    
    // brišemo komentare vezane uz stopiranje
    public function delete_comment($id){
        $id = (int)$id;
        $this->db->where('postID', $id);
        $this->db->delete('comment');
    }
    
    // brišemo korisnika i sve njegove oglase
    public function user_delete_all($id, $table_name, $user_or_company_id, $jobs_table_name){
        $id = (int)$id;
        $tables = array($table_name, $jobs_table_name);
        $this->db->where($user_or_company_id, $id);
        $this->db->delete($tables);
        
    }
    

 public function save_job_data($table_name, $data){  
       
           $this->db->set($data);
           $this->db->insert($table_name);
           $id_return = $this->db->insert_id();
        
        return $id_return;
    }

}
