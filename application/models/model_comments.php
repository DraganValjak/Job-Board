<?php

/**
 * Description of model_comments
 *
 * @author Dragan
 */
class model_Comments  extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add_comment($data){
        $this->db->set($data);
        $this->db->insert('comment');
    }
    
    public function get_comments($postID){
        $this->db->select('comment.*, users.user_name, users.user_image')->from('comment')
             ->join('users', 'users.user_id = comment.user_id', 'left')
             ->where('postID', $postID)
             ->order_by('created_at', 'asc');  
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_comments($postID){
        $this->db->select('id')->from('comment')
             ->where('postID', $postID);
        $row = $this->db->get();
        return $row->num_rows();
    }
    
    public function user_id($email){
        $this->db->select('user_id')->where(array('email' => $email));
        $query = $this->db->get('users');
        $data = $query->row();
        if($query->num_rows() == 1){
            return $data;
        }else{
            return false;
        }
    }
}


