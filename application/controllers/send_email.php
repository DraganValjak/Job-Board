<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of send_email
 *
 * @author Dragan
 */
class Send_Email extends CI_Controller {
   
    public $email_from = '';
    public $user = '';
    public $email_to = '';
    public $message = '';
    public $data = array();
 
    public function __construct() {
        parent::__construct();
        
    }
    
    public function send(){
        if(!$this->session->userdata('is_logged_in')){
            redirect('nemate_pravo_pristupa');
        }
        $rules = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        'message' => array(
            'field' => 'message',
            'label' => 'Tekst poruke',
            'rules' => 'trim|required|xss_clean'
        )
    );
        
                
         $this->email_from = $this->session->userdata('email');
         $this->user_name = $this->session->userdata('user_name');
       
         
        
        $this->form_validation->set_rules($rules);
           if($this->input->post('submit_email')){
           
           if($this->form_validation->run()){
               $this->load->library('email',array('mailtype'=>'html'));
               
               // send email to the user 
                $this->email->from("$this->email_from", "$this->user_name");
                $this->email->to($this->input->post('email'));
                $this->email->subject("Javljnje sa web stranice PosaoNaBrzinu");
                
                $message = "<p><img src='".  base_url()."images/logo.png' alt='Posao na brzinu'/></p>";
                $message .= "<p>".$this->input->post('message')."</p>";
                $message .= "<p><a href=".base_url().">Posao na brzinu</a></p>";
                
                $this->email->message($message);
 
                if($this->email->send()){
                    $this->session->set_flashdata('change_user_data', 'Uspiješno ste poslali email.');
                    redirect('admin/index');
                    }else{
                    $this->session->set_flashdata('change_user_data', 'Došlo je do pogreške pokušajte ponovo.');    
                    redirect('admin/sending_emails');
                    } 
                
               }else{

                   $this->session->set_flashdata('change_user_data', 'Niste upisali ispravan email ili niste popunili formu.'); 
                   redirect('admin/sending_emails');
                   
               }
           }
    }
    
    public function emailsending(){
        
    
        $this->form_validation->set_rules('newname', 'Vaše ime', 'required|trim|xss_clean');
        $this->form_validation->set_message('required', 'Niste upisali %s');
        $this->form_validation->set_rules('newemail', 'Email', 'required|trim|valid_email|xss_clean');
        $this->form_validation->set_message('required', 'Niste upisali %s');
        $this->form_validation->set_message('valid_email', 'Upišite validan %s');
        $this->form_validation->set_rules('newmessage', 'Poruku', 'required|trim|xss_clean');
        $this->form_validation->set_message('required', 'Niste ništa upisali u %s');
        
        if($this->form_validation->run()){
               $this->load->library('email',array('mailtype'=>'html'));
               
               // send email to the user 
                $this->email->from("$this->input->post('newemail)", "$this->input->post('newname')");
                $this->email->to('udruga@convoy.hr');
                $this->email->subject("Javljnje sa web stranice PosaoNaBrzinu");
                
                $message   = "<p><img src='".  base_url()."images/logo.png' alt='Posao na brzinu'/></p>";
                $message  .= "<p>Javljanje sa web stranice PosaoNaBrzinu</p>";
                $message  .= "<p>Javljanje sa upitne forme.</p>";
                $message  .= "<p>".$this->input->post('newmessage')."</p>";
                
                $this->email->message($message);
 
                if($this->email->send()){
                   
                   redirect('email_je_poslan'); 
                }
        }
        
            redirect('email_nije_poslan');
             
    }
}

?>
