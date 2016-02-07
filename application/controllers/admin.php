<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of company
 *
 * @author Dragan
 */
class Admin  extends CI_Controller{
    
    
    protected $_user = array();
    protected $_id = '';
    protected $_email = '';
    protected $_user_name = '';
    protected $_type = '';
    protected $_table_user = '';
    protected $_table_advertisement = '';
    public $_table_user_or_company_id  = '';
    protected $_company_or_user_id = '';
    
    
    public function __construct() {
        parent::__construct();
        
        $data['sitetitle'] = 'Posao na brzinu';

        $data['add_categories'] = $this->model_cats->get_add_categories();
        $data['categories'] = $this->model_cats->get_categories();
        $data['category_options'] = $this->model_cats->get_categories_options();
        $data['state_options'] = $this->model_cats->get_state_options();
        $data['state_options_admin'] = $this->model_cats->get_state_options_for_admin();
        $data['license'] = $this->model_cats->get_licences();
        
        
        
        // pošto kategorije koristimo na svim stranicama uključiti čemo
        // ih u konstruktor funkcciju
         if(!$this->session->userdata('is_logged_in')){
             $this->restricted();
         }
         $this->_email = $this->session->userdata('email');
         $this->_user_name = $this->session->userdata('user_name');
         $this->_type = $this->session->userdata('type');
         
         $this->load->model('admin_model');
         // tablica korisnika
         $this->_table_user = ($this->_type == 0) ? 'users' : 'company';
         // tablica oglasa
         $this->_table_advertisement = ($this->_type == 0) ? 'drivers' : 'jobs';
         // koji je user u tablicama ?
         $this->_company_or_user_id = ($this->_table_advertisement == 'jobs') ? 'company_id' : 'user_id';
         /**
          * @$this->_user  svi podaci o korisniku
          */
         
         $this->_user = $this->admin_model->user($this->_table_user,$this->_email);
         
         // koji id imamo u tablicama users ili company ? user_id  ili company_id
         $this->_id = ($this->_user->type == '0') ? $this->_user->user_id : $this->_user->company_id;
         
         // koji je id ? user_id ili company_id , ovo koristimo u modelu 
         $this->_table_user_or_company_id = ($this->_user->type == '0') ? 'user_id' : 'company_id';
         
         $this->load->helper('hr_oblik_datuma');
     
         $data['user'] = $this->_user;
         $this->load->vars($data);
    }
    
        
        public function index(){
            // $data['user'] sadži sve korisnićke podatke
                if($this->_user){    
                $data['advertisement'] = $this->advertisement(); 
                // samo korisnici mogu biti stoperi,pa tako samo za njih učitavamo moguće podatke
                if($this->_user->type == '0'){
                $data['hitchhiker'] = $this->hitchhiker();
                }
                $this->load->view('admin/user', $data);
                
                }else{
                    $this->restricted();
                }
               
 
        }
        
         public function restricted(){
             redirect('nemate_pravo_pristupa');
        }
        
        
                // funkcija za promjenu podataka korisnika kod potvrde emaila,
                // odnosno registracije putem facebooka
        public function newuser_updatedata(){
            
              // bibloteka form validation je učitana u konfiguraciji
            $this->form_validation->set_rules('street','Adresa','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezna');
            
            $this->form_validation->set_rules('city','Mjesto','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezno');

            
            $this->form_validation->set_rules('state','Država','required|trim|xss_clean|number');
            $this->form_validation->set_message('required', '%s je obavezno');
            $this->form_validation->set_message('alpha', 'Rubrika %s može sadržavati  samo  brojeve');            
            
            $this->form_validation->set_rules('tel','Telefon','required|trim|xss_clean|numeric');
            $this->form_validation->set_message('required', '%s je obavezan');
            $this->form_validation->set_message('numeric', 'Rubrika %s može sadržavati samo brojke');
            
            $this->form_validation->set_rules('about','O meni','trim|xss_clean');
            
            // samo ako imamo ulaz sa stranice, onda provjeri 
            if(strlen($this->input->post('web'))){
            $this->form_validation->set_rules('web','Web stranica','trim|xss_clean|callback_url_chekcing');
            }
            
            $this->form_validation->set_rules('licences', 'Vozačka dozvola', 'trim|required');
            $this->form_validation->set_message('required', '%s je obavezna');
 

         
                      
            if ($this->form_validation->run()){
                    // za državu moramo provjeriti dali je ispravan unos
                        $all_states = array('0','1','2','3','4');
                        $state = (in_array($this->input->post('state'), $all_states)) ? $this->input->post('state') : '0';
                   /*
                    *  moramo vidjeti koje kategorije vozač ima, 
                    * izvuči vrijednosti iz array-a i dodati im zareze    
                    */
                        $arr = $this->input->post('licences');
                        $licences =  join(', ', list($a) = $arr);
                     

        
                // ako je validacija zadovoljila skupljamo podatke u $data i presmjeravamo ih na glavnu admin stranicu s porukom da je sve ok
                $data = array(
                    'license' => $licences,
                    'location' => $this->input->post('street'). ', ' . $this->input->post('city'),
                    'state_id' => (int)$state,
                    'tel' => $this->input->post('tel'),
                    'url' => $this->input->post('web'),
                    'about' => $this->input->post('about')
                    );
                $table = $this->_table_user;
                $id = (int)$this->_id;
                
            $id_return = $this->admin_model->admin_save_data($id, $table, $data);
                     if(is_int($id_return) && is_numeric($id_return)){
                     $this->session->set_flashdata('change_user_data', 'Uspiješno ste promijenili vaše postavke.');
                     redirect('admin/index');
                     }else{
                     $this->session->set_flashdata('change_user_data', 'Došlo je do greške molimo vas da pokušate ponovo.');
                     $this->load->view('admin/newUpdate');
                     } 
            }

            $this->load->view('admin/newUpdate');
        }
        
        // funkcija za izlist svih oglasa korisnika
        public function advertisement(){
            $table = $this->_table_advertisement;
            $id = (int)$this->_id;
            $user_id = $this->_company_or_user_id;
            
            $where = array ($user_id => $id);
            $result = $this->admin_model->get_bay($where, $table);
            if($result ===  FALSE){
               return  FALSE;
            }else{
                return $result;
            }
            
        }
        // dodajemo oglase
        public function add(){
            $this->load->helper('date');
            $table_name = $this->_table_advertisement;
            $usrer_company_id = $this->_company_or_user_id;
            
          $now = time();
          $current_date_time = unix_to_human($now, TRUE, 'eu');  
           // var_dump($this->input->post());
            // ako je oglas došao od posloprimca
           if($this->input->post('submit_add_driver')){
               
                           // bibloteka form validation je učitana u konfiguraciji
            $this->form_validation->set_rules('title','Naslov oglasa','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezan');
 
            $this->form_validation->set_rules('category','Kategorija posla','required|trim|xss_clean|callback_is_not_null');
            $this->form_validation->set_message('required', '%s je obavezna');            
            
            $this->form_validation->set_rules('job_type','Tip oglasa','trim|xss_clean');
            
            $this->form_validation->set_rules('exspirience','Iskustvo','trim|xss_clean');
            
            if($this->_user->type == '1'){
            $this->form_validation->set_rules('newlicences[]', 'Potrebne vozačke dozvole', 'trim|required');
            $this->form_validation->set_message('required', '%s su obavezne');
            }
            
            if($this->_user->type == '1'){
            $this->form_validation->set_rules('body','Opis posla','trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezan');
            }else{
            $this->form_validation->set_rules('body','Preporuke','trim|xss_clean');   
            }
            
            if(strlen($this->input->post('date_created'))){
              $this->form_validation->set_rules('date_created','Datum početka','trim|xss_clean|callback_valid_date');  
            }else{
            $this->form_validation->set_rules('date_created','Datum početka','trim|xss_clean');
            }
            $this->form_validation->set_rules('date_expires','Datum završetka oglasa','required|trim|xss_clean|callback_valid_date');
            $this->form_validation->set_message('required', '%s je obavezan'); 
            
            if($this->form_validation->run()){
                // ako nema nisšta u body uzeti cemo iz profila
                $body = (strlen($this->input->post('body')))  ? $this->input->post('body') : $this->_user->about;
                $date_created = (strlen($this->input->post('date_created'))) ? $this->form_validation->mysql_date($this->input->post('date_created')) : $current_date_time;
                $license = ($this->_user->type == '1') ? join(', ', list($a) = $this->input->post('newlicences')) : $this->_user->license;
                // ako je nula tip korisnik
                if ($this->_user->type  == '0'){
                $data = array(
                    $usrer_company_id  => $this->_id,
                    'category_id' => (int)$this->input->post('category'),
                    'state_id' => (int)$this->_user->state_id,
                    'title' => $this->input->post('title'),
                    'exspirience' => $this->input->post('expirience'),
                    'job_license'  => $license,
                    'job_type' => $this->input->post('job_type'),
                    'body'     => $body,
                    'date_created' => $date_created,
                    'date_expires' => $this->form_validation->mysql_date($this->input->post('date_expires'))
                   );
                }
                
                // ako je 1 tip poslodavac
                if ($this->_user->type == '1'){
                $data = array(
                    $usrer_company_id  => $this->_id,
                    'category_id' => (int)$this->input->post('category'),
                    'state_id' => (int)$this->_user->state_id,
                    'name' => $this->_user->user_name,
                    'user_email' => $this->_user->email,
                    'user_tel' => $this->_user->tel,
                    'user_location' => $this->_user->location,
                    'title' => $this->input->post('title'),
                    'exspirience' => $this->input->post('expirience'),
                    'user_license'  => $license,
                    'job_type' => $this->input->post('job_type'),
                    'body'     => $body,
                    'date_created' => $date_created,
                    'date_expires' => $this->form_validation->mysql_date($this->input->post('date_expires'))
                   );
                }
                
                
             
               $id_return = $this->admin_model->save_data($id,$table_name, $data);
               
               if(is_int($id_return) && is_numeric($id_return)){
                   $this->session->set_flashdata('change_user_data', 'Uspiješno objavili vaš oglas.');
                   redirect('admin');
                   }else{
                   $this->session->set_flashdata('change_user_data', 'Došlo je do greške pokušajte ponovo.');
                   redirect('admin/add');
                   }
               }
               
           } 
          
          
            
           $this->load->view('admin/add');
        }

                /**
         * brišemo oglas u tablicama  drivers ili jobs
         * @$table  tablica $this->_table_advertisement
         * @$id  (int) dobivamo iz inputa
         * @change_user_data vracamo preko sesije kao odgovor
         */
        public function delete_advertisement(){
            $table = $this->_table_advertisement;
            $id = $this->uri->segment(3);
         //die($id);
            $result = $this->admin_model->delete_data($id, $table);
            if($result === true){
               $this->session->set_flashdata('change_user_data', 'Uspiješno ste izbrisali oglas.');
               redirect('admin');
            }else{
               $this->session->set_flashdata('change_user_data', 'Došlo je do greške molimo vas da pokušate ponovo.');
               redirect('admin');
            }            
             $this->index();
        }
        
        public function edit_advertisement(){
            
           
       $this->load->helper('hr_oblik_datuma');
            $this->load->helper('date');
            $now = time();
            $current_date_time = unix_to_human($now, TRUE, 'eu'); 
            
             $table_name = $this->_table_advertisement;
            $advertisement_id = $this->uri->segment(3);
            $usrer_company_id = $this->_company_or_user_id;
            $id = (int)$this->_id;
            
            $where = array('id' => $advertisement_id, $usrer_company_id => $id);
            $data['advertisement'] = $this->admin_model->get_bay($where, $table_name);
            
          if($this->input->post('submit')){
              
             // var_dump($this->input->post());
              
            $this->form_validation->set_rules('category','Kategorija posla','required|trim|xss_clean|callback_is_not_null');
            $this->form_validation->set_message('required', '%s je obavezna');                
          
            
            
           
             $this->form_validation->set_rules('job_type','Tip oglasa','trim|xss_clean');   
          
            
            
              $this->form_validation->set_rules('exspirience','Iskustvo','trim|xss_clean');  
         
            
            
            if($this->_user->type == '1'){
                if(is_array($this->input->post('newlicences'))){
              $this->form_validation->set_rules('newlicences[]', 'Potrebne vozačke dozvole', 'trim|required');
              $this->form_validation->set_message('required', '%s su obavezne'); 
                }
             } 

            
            
            if($this->_user->type == '1'){
            $this->form_validation->set_rules('body','Opis posla','trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezan');
            }else{
            $this->form_validation->set_rules('body','Preporuke','trim|xss_clean');
            }
            
            if(strlen($this->input->post('new_date_created'))){
              $this->form_validation->set_rules('new_date_created','Datum početka','trim|xss_clean|callback_valid_date');  
            }else{
            $this->form_validation->set_rules('date_created','Datum početka','trim|xss_clean');
            }
            
            if(strlen($this->input->post('new_date_created'))){
            $this->form_validation->set_rules('new_date_expires','Datum završetka oglasa','required|trim|xss_clean|callback_valid_date');
            $this->form_validation->set_message('required', '%s je obavezan');                
            }else{
            $this->form_validation->set_rules('date_expires','Datum završetka oglasa','trim|xss_clean|callback_valid_date');                
            }
 
            
            if($this->form_validation->run()){ 
                
               if($this->_user->type == '1'){
                  $license =  (is_array($this->input->post('newlicences'))) ?  join(', ', list($a) = $this->input->post('newlicences')) : $data['advertisement'][0]['job_license']; 
               }else{
                  $license =  $this->_user->license;
               
               }
              
              $date_created = (strlen($this->input->post('new_date_created'))) ? $this->form_validation->mysql_date($this->input->post('new_date_created')) : $data['advertisement'][0]['date_created'];
              $date_expires = (strlen($this->input->post('new_date_expires'))) ? $this->form_validation->mysql_date($this->input->post('new_date_expires')) : $data['advertisement'][0]['date_expires']; 
              $newdata = array(
                    'id' => $id,
                    'category_id' => (int)$this->input->post('category'),
                    'title' => $this->input->post('title'),
                    'exspirience' => $this->input->post('expirience'),
                    'job_license'  => $license,
                    'job_type' => $this->input->post('job_type'),
                    'body'     => $this->input->post('body'),
                    'date_created' => $date_created,
                    'date_expires' => $date_expires
                );
             
              $id_return =   $this->admin_model->save_data($advertisement_id, $table_name, $newdata); 
                if(is_int($id_return) && is_numeric($id_return)){
               $this->session->set_flashdata('change_user_data', 'Uspiješno ste uredili vaš oglas.');
               redirect('admin');
              }else{
                $this->session->set_flashdata('change_user_data', 'Došlo je do greške pokušajte ponovo.');
                redirect('admin/edit_advertisement');
              }
                   }
                   
          }// submit kraj     
          
           
            
         
              $this->load->view('admin/edit', $data); 
          
          
            
        }
        
        // funkcija za promjenu slike korisnika
        public function change_image(){
            $table = $this->_table_user;
            $id = (int)$this->_id;
   
            if($this->input->post('submit_image')){   
            $id_return =  $this->admin_model->do_upload($id, $table);
             if(is_int($id_return) && is_numeric($id_return)){
               $this->session->set_flashdata('change_user_data', 'Uspiješno ste promijenili vašu sliku.');
               redirect('admin');
              }else{
                $this->session->set_flashdata('change_user_data', 'Došlo je do greške pokušajte ponovo.');
                redirect('admin/change_image');
              }
            }
           
            
            $this->load->view('admin/image');
        }
        
        // funkcija za promijenu zaporke
        public function change_password(){
            $table = $this->_table_user;
            $id = (int)$this->_id;
            if($this->input->post('submit_password')){ 
                
                $this->form_validation->set_rules('password','Zaporka','trim|required|min_length[6]|xss_clean|callback_check_password');
                $this->form_validation->set_message('required', '%s je obavezna.');
                $this->form_validation->set_message('min_length', 'Minimalna dužina zaporke je 6 znakova.');
                
                $this->form_validation->set_rules('newpassword','Nova Zaporka','trim|required|min_length[6]|xss_clean');
                $this->form_validation->set_message('required', '%s je obavezna.');
                $this->form_validation->set_message('min_length', 'Minimalna dužina %s je 6 znakova.');
                
                $this->form_validation->set_rules('cnewpassword','Nova Ponovljena Zaporka','trim|required|min_length[6]|xss_clean|matches[newpassword]');
                $this->form_validation->set_message('required', '%s je obavezna.');
                $this->form_validation->set_message('min_length', 'Minimalna dužina %s je 6 znakova.');  
                $this->form_validation->set_message('matches', 'Zaporke se ne podudarju.');
                
                if($this->form_validation->run()){
                    $data = array('password' => md5($this->input->post('newpassword')));
                   $id_return =  $this->admin_model->admin_save_data($id, $table, $data);
                       if(is_int($id_return) && is_numeric($id_return)){
                          $this->session->set_flashdata('change_user_data', 'Uspiješno ste promijenili vašu zaporku.');
                          redirect('admin');
                          }else{
                          $this->session->set_flashdata('change_user_data', 'Došlo je do greške obratite se administratoru.');
                           redirect('admin/change_password');
                           }
                }
                
            }
            
            $this->load->view('admin/password');
        }
        
        // funkcija za promjenu podataka korisnika
        public function change_profil(){

            if($this->input->post('submit_profil')){ 
                // validacija unosa
              // bibloteka form validation je učitana u konfiguraciji
            $this->form_validation->set_rules('user_name','Ime','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezno'); 
            
            // ako je korisnik posloprimac onda imamo i ovo polje, pa trebamo provijeriti dali je unos
            if(strlen($this->input->post('last_name'))){
            $this->form_validation->set_rules('last_name','Prezime','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezno');
            }
            
            $this->form_validation->set_rules('email','Email','required|trim|xss_clean|valid_email|callback_check_email');
            $this->form_validation->set_message('required', '%s je obavezan');
                
            
            $this->form_validation->set_rules('location','Adresa','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezna');

            
            $this->form_validation->set_rules('state','Država','required|trim|xss_clean|number');
            $this->form_validation->set_message('required', '%s je obavezna');
            $this->form_validation->set_message('alpha', 'Rubrika %s može sadržavati  samo  brojeve');            
            
            $this->form_validation->set_rules('tel','Telefon','required|trim|xss_clean|numeric');
            $this->form_validation->set_message('required', '%s je obavezan');
            $this->form_validation->set_message('numeric', 'Rubrika %s može sadržavati samo brojke');
            
            $this->form_validation->set_rules('about','O meni','trim|xss_clean');
            
            // samo ako imamo ulaz sa stranice, onda provjeri 
            if(strlen($this->input->post('web'))){
            $this->form_validation->set_rules('web','Web stranica','trim|xss_clean|callback_url_chekcing');
            }
            if(is_array($this->input->post('newlicences'))){
            $this->form_validation->set_rules('newlicences[]', 'Vozačka dozvola', 'trim|required');
            $this->form_validation->set_message('required', '%s je obavezna');
            }else{
            $this->form_validation->set_rules('license', 'Vozačka dozvola', 'trim|required');
            $this->form_validation->set_message('required', '%s je obavezna');  
            }
                
              if($this->form_validation->run()){ 
                  $table = $this->_table_user;
                  $id = (int)$this->_id; 
                  // dozvole, zavisi dali je krsinik mijenjao dozvole ili ne, takav unos onda radimo
                  if(is_array($this->input->post('newlicences'))){
                        $arr = $this->input->post('newlicences');
                        $licences =  join(', ', list($a) = $arr);
                  }else{
                      $licences = $this->input->post('license');
                  }
                  
                  if(strlen($this->input->post('last_name'))){
                  $data = array(
                      'user_name' => $this->input->post('user_name'),
                      'last_name' => $this->input->post('last_name'),
                      'email' => $this->input->post('email'),
                      'location' => $this->input->post('location'),
                      'state_id' => (int)$this->input->post('state'),
                      'tel' => $this->input->post('tel'),
                      'about' => $this->input->post('about'),
                      'url' => $this->input->post('web'),
                      'license' => $licences
                      );     
                  }else{
                  $data = array(
                      'user_name' => $this->input->post('user_name'),
                      'email' => $this->input->post('email'),
                      'location' => $this->input->post('location'),
                      'state_id' => (int)$this->input->post('state'),
                      'tel' => $this->input->post('tel'),
                      'about' => $this->input->post('about'),
                      'url' => $this->input->post('web'),
                      'license' => $licences
                   );
                  }
                  

                  
                  $id_return = $this->admin_model->admin_save_data($id, $table, $data);
                   // obavezno treba promijeniti u sessiji korsisnčki email ili sessija ne raspoznaje korisnika
                  $this->session->set_userdata(array('email' => $this->input->post('email')));
                  if(is_int($id_return) && is_numeric($id_return)){
                      $this->session->set_flashdata('change_user_data', 'Uspiješno ste promijenili vaše podatke.');
                      redirect('admin');
                }else{
                     $this->session->set_flashdata('change_user_data', 'Došlo je do greške obratite se administratoru.');
                     redirect('admin/change_profil');
                     }
        
              }// form_validation->run()
            
           }// kraj glavni IF

            $this->load->view('admin/profil');
        }

        
        // funkcija za provjeru url-a u validaciji
        public function url_chekcing($str){
            
         $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
         if (!preg_match($pattern, $str))
         {
               $this->form_validation->set_message('url_chekcing', '%s stranica nije u ispravnom formatu');
               return FALSE;
          }
         
         return TRUE;
            
        }
        
        // provjeravamo postojeću zaporku kao callback funkciju
        public function check_password($pass){
            $table = $this->_table_user;
            $id = (int)$this->_id;
           $result = $this->admin_model->admin_get($id, $table);
          // echo $result->password; die();
             if($result->password == md5($pass) ){
                return true;
            }else{// ako zaporka  ne odgovaraju ili krivi podaci   
                $this->form_validation->set_message('check_password', 'Upisali ste pogrešnu zaporku.');
                return false;
                 
            }  
        }
        
        // provjerevamo email kod promjene podataka korsinika
            public function check_email($email){
            $table = $this->_table_user;
            $id = (int)$this->_id;
            // stari emeil
            $old_email = $this->_email; 
            // moramo provijeriti dali se taj email vec koristi u tablici
            if($this->admin_model->is_free_email($table) === FALSE || $email == $old_email){
                return true;               
            }else{
                $this->form_validation->set_message('check_email', 'Email se već koristi, izaberite drugi.');
                return false;                
             }
            }
        
          // korisnik šalje email
            public function sending_emails(){
                $this->load->view('admin/emails');
            }
            
            // provjeravamo input za izbor kategorije ako je nula vračamo false
            public function is_not_null($str){
                $cat = $this->input->post('category');
                
                if($cat != '0'){
                    return true;
                }else{
                $this->form_validation->set_message('is_not_null', 'Molimo vas izaberite kategoriju posla.');
                return false;                    
                }
            }
        
   // unošenje podataka za stopiranje
             public function addHitchhiker(){
            $this->load->helper('date');
            $table_name = 'hitchhikers';
            $user_id = $this->_company_or_user_id;;
            
          $now = time();
          $current_date_time = unix_to_human($now, TRUE, 'eu');  
           
           if($this->input->post('submit_add_hitchhiker')){
               
                           // bibloteka form validation je učitana u konfiguraciji
            $this->form_validation->set_rules('from','Mjesto polaska','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezno.');
            
            $this->form_validation->set_rules('to','Odredište','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezno.');
 
            $this->form_validation->set_rules('at_what_time','Sat polaska','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezan.');
            
            $this->form_validation->set_rules('body','opis','trim|xss_clean');
           
           
            
            if(strlen($this->input->post('date_expires'))){
             $this->form_validation->set_rules('date_expires','Datum početka','required|trim|xss_clean|callback_valid_date');  
            }else{
            $this->form_validation->set_rules('date_expires','Datum','required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s je obavezan.');
            }
   
            
            if($this->form_validation->run()){
                // moramo promjeniti datum i dodati sat stopiranja
                $arr = explode("-", $this->input->post('date_expires'));    // splitting the array
            $dd = $arr[0];            // first element of the array is day
            $mm = $arr[1];              // second element is month
            $yyyy = $arr[2];              // third element is year
            // dodajemo sate
            $uhr = $this->input->post('at_what_time') . ':00:00';
            // konacni oblik datuma za bazu
            $datum_final =  "$yyyy-$mm-$dd  $uhr";
                
                 $data = array(
                    'user_company_id' => (int)$this->_id,
                    'from' => $this->input->post('from'),
                    'to' => $this->input->post('to'),
                    'at_what_time' => $this->input->post('at_what_time').':00',
                    'body' => $this->input->post('body'),
                    'date_hitchhiking' => $datum_final
                );
             
               $id_return = $this->admin_model->save_hitchhiker_data($table_name, $data);
               
               if(is_int($id_return) && is_numeric($id_return)){
                   $this->session->set_flashdata('change_user_data', 'Uspiješno objavili vaš oglas.');
                   redirect('admin');
                   }else{
                   $this->session->set_flashdata('change_user_data', 'Došlo je do greške pokušajte ponovo.');
                   redirect('admin/addHitchhiker');
                   }
               } 
           } 
           $this->load->view('admin/addHitchhiker');
     }// kraj funkcije
     
       // funkcija za izlist svih stopiranja korisnika
        public function hitchhiker(){
            $table = 'hitchhikers';
            $id = (int)$this->_id;
            
            
            $where = array ('user_company_id' => $id);
            $result = $this->admin_model->get_bay($where, $table);
            if($result ===  FALSE){
               return  FALSE;
            }else{
                return $result;
            }
            
        }
        
        
          /**
         * brišemo oglas u tablici hitchhiker
         * brišemo sve komentare vezane uz  hitchhiker id u tablici comment
         */
        public function delete_hitchhiker(){
            $table = 'hitchhikers';
            $id = $this->uri->segment(3);
         //die($id);
            $result = $this->admin_model->delete_hitchhiker_data($id, $table);
            if($result === true){
               $this->session->set_flashdata('change_user_data', 'Uspiješno ste izbrisali Povezi Me oglas.');
               redirect('admin');
            }else{
               $this->session->set_flashdata('change_user_data', 'Došlo je do greške molimo vas da pokušate ponovo.');
               redirect('admin');
            }            
             $this->index();
        }
}// kraj klase

