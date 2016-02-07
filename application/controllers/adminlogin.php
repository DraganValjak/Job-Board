<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminlogin
 *
 * @author Dragan
 */
class Adminlogin  extends CI_Controller{
    
     public $data = array();
    public $error = array();
    public $key = '';
    
    public function __construct() {
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
		$this->login_view();
	}
        
     public function login_view()             
        {
                    // ako več postoji sesija preusmjeravamo korisnika na view jobs
        // to radimo zbog zaštite , da nebi netko preko kads se prijavi 
        // imao mogučnost ponovne prijave preko ovog linka: 
            if($this->session->userdata('is_logged_in')){
               redirect('superadmin/index');
            }
            $this->load->view('superadmin/login');
        } 
        
         // validacija za logiranje  korisnika  i firmi 
    public function login(){

            // bibloteka form validation je učitana u konfiguraciji
            $this->form_validation->set_rules('email','Email','required|trim|xss_clean');
            $this->form_validation->set_rules('password','Zaporku','required|md5|trim');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            $this->form_validation->set_message('required', 'Niste upisali %s');
 
            if($this->form_validation->run()){
                // pomocu emaila uzimamo sve podatke iz baze
                $this->load->model('model_users');
                $user_data = $this->model_users->fetch_user_data();
                 
                // sessija za korisnika o tipu zavisi koje ovlasti ima
                // ovisno gdje je kliknut submit uzimaju se pune se podaci u $data
             if($this->input->post('admin_submit') == true){
                                      $data = array(
                    'user_name' => $user_data->user_name,
                    'email' => $user_data->email,  
                    'user_image' =>   $user_data->user_image,                   
                    'admin_logged_in' => 1,
                    'type' => $user_data->type     
                     );
             }
                        

                $this->session->set_userdata($data);   
                redirect('superadmin/index');
               
            }
        }
        
        
        
        
    
}

?>
