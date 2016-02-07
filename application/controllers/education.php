<?php
/**
 * Description of education
 *
 * @author Dragan
 */
class Education extends CI_Controller{
    public $data = '';
    public function __construct() {
        parent::__construct();
        
        $this->data['sitetitle'] = 'Posao na brzinu';
    }
    
    public function index(){
        $this->load->view('education/edukacija', $this->data);
    }


    public function kod95(){
        $this->load->view('education/kod', $this->data);
    }
    
    public function vozac(){
        $this->load->view('education/vozac', $this->data);
    }
    
    public function adr(){
        $this->load->view('education/adr', $this->data);
    }
    
     public function strojevi(){
        $this->load->view('education/strojevi', $this->data);
    }
    
     public function tahograf(){
        $this->load->view('education/tahograf', $this->data);
    }
}


