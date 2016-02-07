<?php

/**
 * Description of driveme
 *
 * @author Dragan
 */
class Drive extends CI_Controller {
    
    /**
     * Ukupan broj stopera
     * @var int 
     */
    public $total_hitchhikers = '';
    
    public function __construct() {
        parent::__construct();
        
        $data['sitetitle'] = 'Posao na brzinu';
        $data['state_options'] = $this->model_cats->get_state_options();
        $data['no_jobs'] = 'Trenutno nema oglasa.';
        
        $this->load->vars($data);
    }
    
         public function index(){
        $this->hitchhikers();
    }
    
    public function hitchhikers($query_id = 0,$start=0){
        $this->load->helper('hr_oblik_datuma');
        
        $this->load->model('model_sttopers');
        
         $this->input->load_query($query_id);  
 
        $query_array = array(
            'from' => $this->input->get('from'),
        );
                // koliko je ukopno stopera ?
       $this->total_hitchhikers  = $this->model_sttopers->get_hitchhikers_count($query_array);
       
       $this->load->library('pagination');
        $config['base_url'] = site_url()."drive/hitchhikers/$query_id";
        $config['total_rows'] = $this->total_hitchhikers;
        $config['uri_segment'] = 4;
        $config['per_page'] = 6;
        $config['first_link'] = '';
        $config['last_link'] = '';
        $config['next_link'] = '';
        $config['prev_link'] = '';
        $config['next_tag_open'] = '<li class="last">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="first">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current"><strong>';
        $config['cur_tag_close'] = '</strong></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
   
        $data['pages'] = $this->pagination->create_links();
       // broj oglasa
        $data['total_jobs'] =  'Ukupno oglasa (' . $this->total_hitchhikers. ')';
       // svi podaci stopera
       $data['hitchhikers'] = $this->model_sttopers->get_hitchhikers($query_array, 6, $start);
        
        $this->load->view('hitchhikers', $data);
    }
    
        public function traveller(){
            
        $this->load->model('model_sttopers');
        $this->load->model('model_comments');		
        $this->load->helper('hr_oblik_datuma');
		if($this->session->userdata('is_logged_in') == FALSE){
		redirect($this->uri->segment(1));
		}else{
        $data['traveller'] = $this->model_sttopers->get_traveller($this->uri->segment(3));
        
        $data['comments'] = $this->model_comments->get_comments($this->uri->segment(3));
        $data['count_comments'] = $this->model_comments->count_comments($this->uri->segment(3));
        $this->load->view('traveller', $data);
		}
    }
    
     public function search(){

         // bibloteka form validation je učitana u konfiguraciji
            $this->form_validation->set_rules('set','Mjesto ili grad','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezno');
            
            if($this->form_validation->run() == TRUE){
                 $query_array = array(
            'from' => $this->input->post('set')
             );
                 $query_id = $this->input->save_query($query_array);
                 redirect("drive/hitchhikers/$query_id");
            }
        redirect("drive/hitchhikers");
    }

}
# end of file 'controlers/drive.php'