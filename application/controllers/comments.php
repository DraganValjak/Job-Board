<?php

/**
 * Description of comments
 *
 * @author Dragan
 */
class Comments extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

        public function add_comment(){
      if(!$_POST){
          
          redirect(base_url().'drive/traveller/'.$this->uri->segment(3));
      } 
      $user_login = $this->session->userdata('is_logged_in');
      if(!$user_login){
          redirect(base_url().'login');
      }
      
      $this->load->model('model_comments');
      $email = $this->session->userdata('email');
      $user_id = $this->model_comments->user_id($email);
      
      $this->load->helper('date');
      $data = array(
          'postID' =>  $this->uri->segment(3),
          'user_id' => $user_id->user_id,
          'comment' => $this->input->post('comment')  
      );
      
      
      $this->model_comments->add_comment($data);
      redirect(base_url().'drive/traveller/'.$this->uri->segment(3));
      
      
  }
}


