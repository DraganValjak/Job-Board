<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of superadmin
 *
 * @author Dragan
 */
class Superadmin  extends CI_Controller{
    
    protected $_user = array();
    protected $_email = '';
    protected $_user_name = '';
    protected $_type = '';
    protected $_table_user = '';
    protected $_hitchhiker_table = 'hitchhikers';
    
    
    public function __construct() {
        parent::__construct();
        
        $data['sitetitle'] = 'Posao na brzinu';

        $data['add_categories'] = $this->model_cats->get_add_categories();
        $data['categories'] = $this->model_cats->get_categories();
        $data['category_options'] = $this->model_cats->get_categories_options();
        $data['state_options'] = $this->model_cats->get_state_options();
        $data['state_options_admin'] = $this->model_cats->get_state_options_for_admin();
        $data['license'] = $this->model_cats->get_licences();
        
        
        $this->_email = $this->session->userdata('email');
        $this->_user_name = $this->session->userdata('user_name');
        $this->_type = $this->session->userdata('type');
        $this->_table_user = 'users'; 
        // ucitavamo model
        $this->load->model('superadmin_model');
        $this->load->helper('hr_oblik_datuma');
         
        // pošto kategorije koristimo na svim stranicama uključiti čemo
        // ih u konstruktor funkcciju
         if(!$this->session->userdata('admin_logged_in')){
             $this->restricted();
         }
         
         if($this->session->userdata('type') != 2){
             $this->restricted();
         }
         
         $this->_user = $this->superadmin_model->user($this->_table_user,$this->_email);
         
         $data['user'] = $this->_user;
         
         $this->load->vars($data);
         
    }
    
      // u indeksu odmah izvlačimo sve posloprimce
         public function index(){
                $table_name = 'users';
                $data['all_users'] = $this->superadmin_model->get_all_users($table_name);
                $this->load->view('superadmin/admin', $data);
        }
        
        // izvlačimo sve poslodavce
        public function company(){
                $table_name = 'company';
                $data['all_company'] = $this->superadmin_model->get_all_users($table_name);
                $this->load->view('superadmin/company', $data);  
        }
        
         public function restricted(){
             redirect('nemate_pravo_pristupa');
        }
        
        public function admin(){
           $this->load->view('superadmin/admin'); 
        }
        
       
        
       // blokirajmo korisnika
        public function block_user(){
            $id = $this->uri->segment(3);
            $table_name = ($this->uri->segment(4) == '0') ? 'users' : 'company';
            $user_or_company_id = ($this->uri->segment(4) == '0') ? 'user_id' : 'company_id';
            $data = array('status' => 'passive');
            $return_id = $this->superadmin_model->save_data($id ,$user_or_company_id, $table_name, $data);
            
            if(is_numeric($return_id)){
                $this->session->set_flashdata('change_user_data', 'Uspiješno ste blokirali korisnika.');
                     redirect('superadmin/index');
                     }else{
                     $this->session->set_flashdata('change_user_data', 'Došlo je do greške molimo vas da pokušate ponovo.');
                     $this->load->view('superadmin/index');
                     } 
        }
        
        // de blokiramo korisnika
        public function deblock_user(){
            $id = $this->uri->segment(3);
            $table_name = ($this->uri->segment(4) == '0') ? 'users' : 'company';
            $user_or_company_id = ($this->uri->segment(4) == '0') ? 'user_id' : 'company_id';
            $data = array('status' => 'active');
            $return_id = $this->superadmin_model->save_data($id ,$user_or_company_id, $table_name, $data);
            
            if(is_numeric($return_id)){
                $this->session->set_flashdata('change_user_data', 'Uspiješno ste deblokirali korisnika.');
                     redirect('superadmin/index');
                     }else{
                     $this->session->set_flashdata('change_user_data', 'Došlo je do greške molimo vas da pokušate ponovo.');
                     $redirect('superadmin/index');
                     }               
        }
        
        // pregled pojedinog korisnika
        public function look_user(){
          $id = $this->uri->segment(3);
          $table_name = ($this->uri->segment(4) == '0') ? 'users' : 'company';
          $jobs_table_name = ($this->uri->segment(4) == '0') ? 'drivers' : 'jobs';
          $user_or_company_id = ($this->uri->segment(4) == '0') ? 'user_id' : 'company_id';  
          $hitchhiker_table_name =  $this->_hitchhiker_table;
          // izvlačimo korisnika
         $data['one_user'] = $this->superadmin_model->get_user($id,$user_or_company_id, $table_name);
         // izvlačimo korsinkove oglase
         $result = $this->superadmin_model->get_user_advertisements($id,$user_or_company_id, $jobs_table_name);
         if($result){
             $data['user_advertisements'] = $result;
            }else{
             $data['user_advertisements'] = false;        
         }
         
          // izvlačimo korsinkova stopiranja
         $result_hitchhicker = $this->superadmin_model->get_user_hitchhiker($id, $hitchhiker_table_name);
         if($result){
             $data['user_hitchhiker'] = $result_hitchhicker;
            }else{
             $data['user_hitchhiker'] = false;        
         }
         
         $this->load->view('superadmin/one', $data);
       }
       
       // blokiramo pojedini oglas
       public function block_advertisement(){
            $id = $this->uri->segment(3);
            $table_name = ($this->uri->segment(4) == '0') ? 'drivers' : 'jobs';
            
            $data = array('status' => 'passive');
            $return_id = $this->superadmin_model->save_advertisement($id , $table_name, $data);
            
            if(is_numeric($return_id)){
                $this->session->set_flashdata('change_user_data', 'Uspiješno ste blokirali događaj.');
                     redirect('superadmin/index');
                     }else{
                     $this->session->set_flashdata('change_user_data', 'Došlo je do greške molimo vas da pokušate ponovo.');
                     $redirect('superadmin/index');
                     }      
       }
       
       // deblokiramo pojedini oglas
       public function deblock_advertisement(){
            $id = $this->uri->segment(3);
            $table_name = ($this->uri->segment(4) == '0') ? 'drivers' : 'jobs';
            
            $data = array('status' => 'active');
            $return_id = $this->superadmin_model->save_advertisement($id , $table_name, $data);
            
            if(is_numeric($return_id)){
                $this->session->set_flashdata('change_user_data', 'Uspiješno ste deblokirali događaj.');
                     redirect('superadmin/index');
                     }else{
                     $this->session->set_flashdata('change_user_data', 'Došlo je do greške molimo vas da pokušate ponovo.');
                     $redirect('superadmin/index');
                     }      
       } 
       
       // brišemopojedini oglas
       public function delete_advertisement(){
            $id = $this->uri->segment(3);
            $table_name = ($this->uri->segment(4) == '0') ? 'drivers' : 'jobs';
            $this->superadmin_model->delete($id , $table_name);

            $this->session->set_flashdata('change_user_data', 'Uspiješno ste obrisali događaj.');
            redirect('superadmin/index');
       }
       // brišemo poojedino stopiranje
       public function delete_hitchhiking(){
           
            $id = $this->uri->segment(3);
            $table_name = $this->_hitchhiker_table;
            $this->superadmin_model->delete($id , $table_name);
            // trebamo obrisati i sve postojece komentare
            $this->superadmin_model->delete_comment($id);

            $this->session->set_flashdata('change_user_data', 'Uspiješno ste obrisali stopiranje.');
            redirect('superadmin/index');
           
       }
       
       // brišemo korisnika i sve njegove oglase
       public function delete_user(){
          $id = $this->uri->segment(3);
          $table_name = ($this->uri->segment(4) == '0') ? 'users' : 'company';
          $jobs_table_name = ($this->uri->segment(4) == '0') ? 'drivers' : 'jobs';
          $user_or_company_id = ($this->uri->segment(4) == '0') ? 'user_id' : 'company_id';   
          // izvlačimo korisnika
         $this->superadmin_model->user_delete_all($id, $table_name, $user_or_company_id, $jobs_table_name);
           
         $this->session->set_flashdata('change_user_data', 'Uspiješno ste obrisali korisnika i sve njegove oglase.');
            redirect('superadmin/index');
       }
       
       // dodajemo poslove
      // dodajemo oglase
        public function add(){
            $this->load->helper('date');
            $table_name = 'jobs';
            // id obavezno mora biti valiadan id iz tablice company, inace kod izlaznih podataka  nemoze ucitati oglas jer nema validan id
            // id korisnika hzzo id br 2.
            $id = '2';
            
          $now = time();
          $current_date_time = unix_to_human($now, TRUE, 'eu');  
           // var_dump($this->input->post());
            // ako je oglas došao od posloprimca
           if($this->input->post('submit_add_driver')){
               
                           // bibloteka form validation je učitana u konfiguraciji
            $this->form_validation->set_rules('title','Naslov oglasa','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezan');
            
            $this->form_validation->set_rules('name','Naziv poslodavca','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezan');
 
            $this->form_validation->set_rules('user_location','Lokacija poslodavca','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezana');
            
            $this->form_validation->set_rules('state_id','Država poslodavca','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezana');
            
            $this->form_validation->set_rules('user_tel','Telefon','trim|xss_clean');
            
            $this->form_validation->set_rules('user_email','Email','trim|xss_clean');
          

            $this->form_validation->set_rules('category','Kategorija posla','required|trim|xss_clean|callback_is_not_null');
            $this->form_validation->set_message('required', '%s je obavezna');            
            
            $this->form_validation->set_rules('job_type','Tip oglasa','trim|xss_clean');
            
            $this->form_validation->set_rules('exspirience','Iskustvo','trim|xss_clean');
            
        
            $this->form_validation->set_rules('newlicences[]', 'Potrebne vozačke dozvole', 'trim|required');
            $this->form_validation->set_message('required', '%s su obavezne');
           
            
           
            $this->form_validation->set_rules('body','Opis posla','trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezan');
            
            
            if(strlen($this->input->post('date_created'))){
              $this->form_validation->set_rules('date_created','Datum početka','trim|xss_clean|callback_valid_date');  
            }else{
            $this->form_validation->set_rules('date_created','Datum početka','trim|xss_clean');
            }
            $this->form_validation->set_rules('date_expires','Datum završetka oglasa','required|trim|xss_clean|callback_valid_date');
            $this->form_validation->set_message('required', '%s je obavezan'); 
            
            if($this->form_validation->run()){
                // ako nema nisšta u body uzeti cemo iz profila
                
                $date_created = (strlen($this->input->post('date_created'))) ? $this->form_validation->mysql_date($this->input->post('date_created')) : $current_date_time;
                $license = join(', ', list($a) = $this->input->post('newlicences'));
                
                $data = array(
                    'company_id'  => (int)$id,
                    'category_id' => (int)$this->input->post('category'),
                    'state_id' => (int)$this->input->post('state_id'),
                    'name' => $this->input->post('name'),
                    'user_email' => $this->input->post('user_email'),
                    'user_tel' => $this->input->post('user_tel'),
                    'user_location' => $this->input->post('user_location'),
                    'title' => $this->input->post('title'),
                    'exspirience' => $this->input->post('exspirience'),
                    'user_license'  => $license,
                    'job_type' => $this->input->post('job_type'),
                    'body'     => $this->input->post('body'),
                    'date_created' => $date_created,
                    'date_expires' => $this->form_validation->mysql_date($this->input->post('date_expires'))
                   );
               
                
                
             
               $id_return = $this->superadmin_model->save_job_data($table_name, $data);
			  // $str = $this->db->last_query();
			  // echo $str;
               
               if(is_int($id_return) && is_numeric($id_return)){
                   $this->session->set_flashdata('change_user_data', 'Uspiješno objavili vaš oglas.');
                   redirect('superadmin');
                   }else{
                   $this->session->set_flashdata('change_user_data', 'Došlo je do greške pokušajte ponovo.');
                   redirect('superadmin/add');
                   }
               }
               
           } 
          
          
            
           $this->load->view('superadmin/add');
        }
    
    
}

?>
