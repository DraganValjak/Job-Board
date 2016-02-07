<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_model
 *
 * @author Dragan
 */
class Admin_model  extends CI_Model{
    
    
    protected $_primary_key = 'user_id';
    protected $_table_key = 'id';
    protected $_image_path = '';
    protected $_image_url_path = '';
    public $table_name = '';
    public $id = '';
    public $data = array();

    public function __construct() {
        parent::__construct();
        // path za pospremanje slika
        $this->_image_path = realpath(APPPATH .'../profile_images');
        $this->_image_url_path = base_url() .'profile_images/thumbs/';
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
    
    // izvlsčimo podatke po id ili sve
    public function get($id = NULL, $table_name){
        
        if($id != NULL){
            $id = (int)$id;
            $method = 'row';
            $this->db->where($this->_primary_key, $id);
        }else{
            $method = 'result';
        }

        return $this->db->get($table_name)->$method();
    }
    
    
     // izvlsčimo podatke po id ili sve
    public function admin_get($id = NULL, $table_name){
        
        if($id != NULL){
            $id = (int)$id;
            $method = 'row';
            $this->db->where($this->_table_user_or_company_id, $id);
        }else{
            $method = 'result';
        }

        return $this->db->get($table_name)->$method();
    }
    
    public function get_bay($where, $table_name){
        $this->db->where($where);
        $result =  $this->db->get($table_name);
        if($result->num_rows() > 0){
            return $result->result_array();
        }else{
            return false;
        }
    }
    
    public function save_data($id = NULL, $table_name, $data){  
        // insert
        if($id === NULL){
           !isset($id) || $id = NULL;
           $this->db->set($data);
           $this->db->insert($table_name);
           $id_return = $this->db->insert_id();
        }else{
        // update
        $id_return = intval($id);    
        $this->db->set($data);
        $this->db->where($this->_table_key, $id_return);
        $this->db->update($table_name);
        }
        return $id_return;
    }
        public function admin_save_data($id = NULL, $table_name, $data){  
        // insert
        if($id === NULL){
           !isset($id) || $id = NULL;
           $this->db->set($data);
           $this->db->insert($table_name);
           $id_return = $this->db->insert_id();
        }else{
        // update
        $id_return = intval($id);    
        $this->db->set($data);
        $this->db->where($this->_table_user_or_company_id, $id_return);
        $this->db->update($table_name);
        }
        return $id_return;
    }
    
    // brišemo
        public function delete_data($id, $table_name){
        $id = (int)$id;
        if($id === NULL){
            return false;    
        }
        $this->db->where($this->_table_key, $id);
        $this->db->limit(1);
        $this->db->delete($table_name);
        return true;         
    }
    
     // mijenjamo sliku profila
    public function do_upload($id, $table){
        
        $config = array(
            'allowed_types' => 'jpg|jpeg|gif|png',
            'upload_path'   => $this->_image_path,
            'max_size'	    => '1000',
            'encrypt_name'  => TRUE,
            'remove_spaces' => TRUE
        );
        $this->load->library('upload', $config);
        
        if(!$this->upload->do_upload()){
            $link_slike = '';
            return false;
            
        }else{
         // data je array svih podataka slike
       //  $data_image = array('upload_data' => $this->upload->data());
        // var_dump($data_image); die();
         $data_image = $this->upload->data();
         $config = array(
             'source_image' => $data_image['full_path'],
             'new_image'    => $this->_image_path . '/thumbs',
             'maintain_ration' => TRUE,
             'width' => 100,
             'height' => 100
         );
         $this->load->library('image_lib', $config);
         
         $this->image_lib->resize();
         
        // unlink($data_image['file_path']); ??
         
        $link_slike =  $this->_image_url_path.$data_image['file_name'];
        
        $id_return = intval($id);
        $this->db->set('user_image', $link_slike);
        $this->db->where($this->_table_user_or_company_id, $id_return);
        $this->db->update($table);
        
        /**
         * Moramo u sessiju staviti (promijeniti) novi link slike
         * posto se sidebar ne učitava iz controlera, kad promjenimo sliku ona se u sidebarau neije promijenila
         * jer je bila dio sesije i ili nije se učitavala direkno sa controlera
         */
                     $data = array(
                    'user_image' =>  $link_slike                          
                     );
                $this->session->set_userdata($data);
        
        return $id_return;
        }
    }
    
    // provjera emaila, kod promjene emaila
            public function is_free_email($table_name){
         $this->db->where('email', $this->input->post('email'));
         $query = $this->db->get($table_name);
  
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        } 
 
    }
    
// spremao stopere
    public function save_hitchhiker_data($table_name, $data){
           $this->db->set($data);
           $this->db->insert($table_name);
           return  $this->db->insert_id();
    }
    
    public function delete_hitchhiker_data($id, $table){
       $id = (int)$id;
        if($id === NULL){
            return false;    
        }
        // brišemo stopera
        $this->db->where('id', $id);
        $this->db->limit(1);
        $this->db->delete($table);
        // brišemo komentare vezane uz stopera
        $this->db->where('postID', $id);
        $this->db->delete('comment');
        return true;  
    }
    
}

?>
