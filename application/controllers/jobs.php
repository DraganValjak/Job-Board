<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of jobs
 *
 * @author Dragan
 */
class Jobs  extends CI_Controller{
    
    public $total_jobs = '';
    
    function __construct() {
       parent::__construct();  
       

        $data['sitetitle'] = 'Posao na brzinu';
        $data['categories'] = $this->model_cats->get_categories();
        $data['category_options'] = $this->model_cats->get_categories_options();
        $data['state_options'] = $this->model_cats->get_state_options();
        
        $this->load->vars($data);
        // pošto kategorije koristimo na svim stranicama uključiti čemo
        // ih u konstruktor funkcciju
    }
    
    public function index(){
        redirect('jobs/listings');
    }
    
   
    
    public function listings($query_id = 0,$start=0){
        
        $this->input->load_query($query_id);  
 
        $query_array = array(
            'category' => $this->input->get('category'),
            'state' => $this->input->get('state')
        );
        
        
       // koliko jee ukopno poslova 
          $this->total_jobs = $this->model_jobs->get_jobs_count($query_array);
        
        
      
        
        $this->load->library('pagination');
        $config['base_url'] = site_url()."jobs/listings/$query_id";
        $config['total_rows'] = $this->total_jobs;
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
        
        // napravili smo ovakav oblik izlaza zbog lakšeg outputa u view listings
        $data['no_jobs'] = 'Trenutno nema slobodnih radnih mjesta u traženoj kategoriji.';
        $data['total_jobs'] =  'Svi poslovi (' . $this->total_jobs. ')';
         //  $this->load->model('model_jobs'); uključio sam autolaoad
       $data['listings'] =  $this->model_jobs->get_listings($query_array, 6, $start);
        //var_dump( $data['listings']);
  
        $this->load->view('listings', $data);
        
    }
    
   
    
    public function details(){
        $this->load->helper('hr_oblik_datuma');
        $data['details'] = $this->model_jobs->get_details($this->uri->segment(3));
        $this->load->view('job_details', $data);
    }
    
    public function search(){
                // provjeravamo dali je koji od upita u tablici ci_query satariji od mjesec dana 
        // ako je brišemo ga iz baze, praznimo tablicu
        $this->model_jobs->check_date();
        
        

        $query_array = array(
            'category' => $this->input->post('category'),
            'state' => $this->input->post('state')
        );
        
        
        $query_id = $this->input->save_query($query_array);
        redirect("jobs/listings/$query_id");
              
    }
}
# end of file 'controlers/jobs.php'

