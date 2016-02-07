<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of terms
 *
 * @author Dragan
 */
class Terms extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function user(){
     $data['sitetitle'] = 'Posao na brzinu';       
    $this->load->view('userterms', $data);
    }
    
    public function data(){
       $data['sitetitle'] = 'Posao na brzinu';       
    $this->load->view('dataterms', $data); 
    }
    
    public function help(){
        $this->load->helper('share');
      $data['sitetitle'] = 'Posao na brzinu';       
    $this->load->view('help', $data);   
    }
    
    public function stopper(){
        $this->load->helper('share');
      $data['sitetitle'] = 'Posao na brzinu';       
    $this->load->view('stopper_help', $data);   
    }
    

}

?>
