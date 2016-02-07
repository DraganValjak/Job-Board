<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
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

	public function index()
	{
		$this->login_view();
	}
        
        public function login_view()             
        {
                    // ako več postoji sesija preusmjeravamo korisnika na view jobs
        // to radimo zbog zaštite , da nebi netko preko kads se prijavi 
        // imao mogučnost ponovne prijave preko ovog linka: 
            if($this->session->userdata('is_logged_in')){
               redirect('jobs/listings');
            }
            $this->load->view('front');
        }
        
            // funkcija za pozivanje viewa       
         public function company_login(){
             // ulaz za poduzeča
              if($this->session->userdata('is_logged_in')){
               redirect('jobs/listings');
            }
            $this->load->view('company_login');
        }
        
        
        public function company_signup(){
            // ako več postoji sesija preusmjeravamo korisnika na view jobs
            if($this->session->userdata('is_logged_in')){
               redirect('jobs/listings');
            }
        $this->load->view('company_signup');
        }



        public function signup(){
            // ako več postoji sesija preusmjeravamo korisnika na view jobs
            if($this->session->userdata('is_logged_in')){
               redirect('jobs/listings');
            }
            $this->load->view('signup');
        }
        
       public function logout(){
            
            $this->session->sess_destroy(); 
            $this->load->view('front');
        }
       
        

        
        // validacija za logiranje  korisnika  i firmi 
    public function login_validation(){

            // bibloteka form validation je učitana u konfiguraciji
            $this->form_validation->set_rules('email','Email','required|trim|xss_clean|callback_validate_credentials');
            $this->form_validation->set_rules('password','Zaporku','required|md5|trim');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            $this->form_validation->set_message('required', 'Niste upisali %s');
 
            if($this->form_validation->run()){
                // pomocu emaila uzimamo sve podatke iz baze
                $this->load->model('model_users');
                $user_data = $this->model_users->fetch_user_data();
                 
                // sessija za korisnika o tipu zavisi koje ovlasti ima
                // ovisno gdje je kliknut submit uzimaju se pune se podaci u $data
             if($this->input->post('user_submit') == true){
                                      $data = array(
                    'user_name' => $user_data->user_name,
                    'email' => $user_data->email,  
                    'user_image' =>   $user_data->user_image,                   
                    'is_logged_in' => 1,
                    'type' => $user_data->type     
                     );
             }
             if($this->input->post('company_submit') == true){
                                      $data = array(
                    'user_name' => $user_data->user_name,
                    'email' => $user_data->email,
                    'user_image' =>   $user_data->user_image,                       
                    'is_logged_in' => 1,
                    'type' => $user_data->type     
                     );
             }

                $this->session->set_userdata($data);   
                redirect('jobs/listings');
               
            }else{ // ako nije prošla validacija
                // opet ovisno od kuda je poslan upit, učitavamao potreban view
                if($this->input->post('company_submit') == true){
                $this->load->view('company_login'); 
                }else{$this->load->view('front');}
            }
        }
        
         public function validate_credentials(){
             
            $this->load->model('model_users');
            
            if($this->model_users->can_log_in()){
                return true;
            }elseif($this->model_users->not_verifed_email()){ // ako nije potvđen email
                $this->form_validation->set_message('validate_credentials', 'Niste potvrdili vaš email.');
                return false;
            }elseif($this->model_users->not_block()){ // ako nije blokiran
                $this->form_validation->set_message('validate_credentials', 'Vaš račun je trenutačno blokiran. Molimo vas da se obratite adminstratoru.');
                return false;
            }
            else{// ako zaporka iemail ne odgovaraju ili krivi podaci   
                $this->form_validation->set_message('validate_credentials', 'Netočan email ili zaporka.');
                return false;
                 
            }
        }
        
     
        
       
        public function signup_validation(){
            // odustao sam od korisničkog imena
            //$this->form_validation->set_rules('user_name', 'Korisničko ime', 'required|trim|min_length[6]|max_length[10]|is_unique[users.user_name]');
           // $this->form_validation->set_message('is_unique', 'Email adresa je već zauzeta.');
            
            $this->form_validation->set_rules('first_name', 'ime', 'required|trim');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            $this->form_validation->set_rules('last_name', 'prezime','required|trim');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            $this->form_validation->set_message('is_unique', 'Email adresa je već zauzeta.');
            $this->form_validation->set_message('valid_email', 'Upišite važeču email adresu.');
            
            $this->form_validation->set_rules('password','Zaporka', 'required|trim');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            
            $this->form_validation->set_rules('cpassword','Potvrdi zaporku','required|trim|matches[password]');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            $this->form_validation->set_message('matches', 'Zaporke se ne podudaraju.');
            
            

            
            
            if($this->form_validation->run()){
                // no-reply@posaonabrzinu.com.hr
                
               // generate random key
                $key = md5(uniqid());
                
                $this->load->library('email',array('mailtype'=>'html'));
                $this->load->model('model_users');
                // send email to the user 
                $this->email->from('no-reply@posaonabrzinu.com.hr', 'admin');
                $this->email->to($this->input->post('email'));
                $this->email->subject("Potvrdite vaš račun");
                
                $message  = "<p><img src='".  base_url()."images/logo.png' alt='Posao na brzinu'/></p>";
                $message .= "<p>Zahvaljujemo na registraciji</p>";
                $message .= "<p><a href='".base_url()."login/register_user/$key'>Kliknite  </a> i potvrdite vaš račun</p>";
                
                $this->email->message($message);
                if($this->model_users->add_temp_user($key)){
                    if($this->email->send()){
                        $this->load->view('email_send');
                    }else{
                    echo 'nije poslano';
                    }                    
                }else{
                    echo "Problem kod dodavanja u bazu podataka.";
                }

            }else{
                
                $this->load->view('signup');
            }
        }
        
       
        
        public function register_user($key){
            $this->load->model('model_users');
            
            if($this->model_users->is_key_valid($key)){
                if($new_user = $this->model_users->add_user($key)){
                    $data = array(
                        'user_name' => $new_user['user_name'],
                        'email' => $new_user['email'],
                        'user_image' =>   $new_user['user_image'], 
                        'is_logged_in' => 1,
                        'type' => 0
                    );
                    
                    $this->session->set_userdata($data);
                    //treba ga preusmjeriti na stranicu gdje ce dopuniti podatke
                    //redirect('jobs/listings');
                    redirect('admin/newuser_updatedata');
                }else{
                    //$error['data_error']='Došlo je do greške kod vaše potvrde računa , molimo vas pokušajte ponovo ili kontaktirajte adninistratora.';
                    redirect('nemate_pravo_pristupa');
                }
            }else{
               // $error['data_error'] = 'Došlo je do greške.';
                redirect('nemate_pravo_pristupa');
            }
        }
        
        
        /* 
         * Registracija firmi
         * zbog razlika u bazama podataka skoro pa doslovno ponavljamo kod
         * kao da registriramo korisnika sa malim izmjenama
         */
        public function company_validation(){
            // odustao sam od korisničkog imena
            //$this->form_validation->set_rules('user_name', 'Korisničko ime', 'required|trim|min_length[6]|max_length[10]|is_unique[users.user_name]');
           // $this->form_validation->set_message('is_unique', 'Email adresa je već zauzeta.');
            
            $this->form_validation->set_rules('company_name', 'ime', 'required|trim');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            $this->form_validation->set_message('is_unique', 'Email adresa je već zauzeta.');
            $this->form_validation->set_message('valid_email', 'Upišite važeču email adresu.');
            
            $this->form_validation->set_rules('password','Zaporka', 'required|trim');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            
            $this->form_validation->set_rules('cpassword','Potvrdi zaporku','required|trim|matches[password]');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            $this->form_validation->set_message('matches', 'Zaporke se ne podudaraju.');
            

            if($this->form_validation->run()){
                // no-reply@posaonabrzinu.com.hr
                
               // generate random key
                $key = md5(uniqid());
                
                $this->load->library('email',array('mailtype'=>'html'));
                $this->load->model('model_users');
                // send email to the user 
                $this->email->from('no-reply@posaonabrzinu.com.hr', 'admin');
                $this->email->to($this->input->post('email'));
                $this->email->subject("Potvrdite vaš račun");
                
                $message  = "<p><img src='".  base_url()."images/logo.png' alt='Posao na brzinu'/></p>";
                $message .= "<p>Zahvaljujemo na registraciji</p>";
                $message .= "<p><a href='".base_url()."login/register_company/$key'>Kliknite  </a> i potvrdite vaš račun</p>";
                
                $this->email->message($message);
                if($this->model_users->add_temp_company($key)){
                    if($this->email->send()){
                        $this->load->view('email_send');
                    }else{
                    echo 'nije poslano';
                    }                    
                }else{
                    echo "Problem kod dodavanja u bazu podataka.";
                }

            }else{
                
                $this->load->view('company_signup');
            }
        }
        
      public function register_company($key){
            $this->load->model('model_users');
            
            if($this->model_users->is_company_key_valid($key)){
                if($new_user = $this->model_users->add_company($key)){
                    $data = array(
                        'user_name' => $new_user['user_name'],
                        'email' => $new_user['email'],
                        'is_logged_in' => 1,
                        'user_image' =>   $new_user['user_image'], 
                        'type' => 1
                    );
                    
                    $this->session->set_userdata($data);
                   // redirect('jobs/listings');
                   redirect('admin/newuser_updatedata'); 
                }else{
                   // echo 'Došlo je do greške kod vaše potvrde računa , molimo vas pokušajte ponovo ili kontaktirajte adninistratora.';
                    redirect('nemate_pravo_pristupa');
                }
            }else{
               // echo 'Došlo je do greške.';
                redirect('nemate_pravo_pristupa');
            }
        }
        
        /*
         * Zaboravljena zaporka
         * vidjeti koji je tip korisnika
         * poslati mu email sa privremenom zaporkom
         *  kod prvog logiranja natjerati ga da promijeni zaporku
         */
        public function forgot(){
                        // ako je korisnik  več  logiran postoji sesija preusmjeravamo korisnika na view jobs
            if($this->session->userdata('is_logged_in')){
               redirect('jobs/listings');
            }
            $this->load->view('forgot');
        }
        // validacija inputa
        public function forgot_validation(){
                                    // ako je korisnik  več  logiran postoji sesija preusmjeravamo korisnika na view jobs
            if($this->session->userdata('is_logged_in')){
               redirect('jobs/listings');
            }
           // prvo da viidimo koji je unos 
           $this->form_validation->set_rules('category','tip', 'trim|required');
           $this->form_validation->set_message('required', 'Niste izabrali  %s korisnika.');
           $this->form_validation->set_rules('email','Email', 'trim|required|valid_email|callback_validate_user_email');
          // $this->form_validation->set_message('valid_email', 'Molimo upišite validan email.');
           
           if($this->form_validation->run()){
               
               $this->load->library('email',array('mailtype'=>'html'));
               $this->load->model('model_users');
               // generate random key
                $key = md5(uniqid());
                // send email to the user 
                $this->email->from('no-reply@posaonabrzinu.com.hr', 'admin');
                $this->email->to($this->input->post('email'));
                $this->email->subject("Promjena zaporke");
                
                $message = "<p>Kliknite na link i promijenite zaporku.</p>";
                $message .= "<p><a href='".base_url()."login/click_for_password/$key'>Promjena zaporke  </a></p>";
                
                $this->email->message($message);
                /*
                 *  dodajemo unikatni ključ i email  funkciji  add_temp_password koja ga sprema u tablicu temp_password_key
                 * email dodajemo kako bismo znali koji je korisnik
                 */
                if($this->model_users->add_temp_password_key($key, $this->input->post('email'))){
                    if($this->email->send()){
                        $this->load->view('recovery_send');
                    }else{
                    echo 'nije poslano';
                    }                    
                }else{
                    echo "Problem kod dodavanja u bazu podataka.";
                }                
               
           }else{
              $this->load->view('forgot'); 
           }
        }
        
        public function validate_user_email(){
                                    // ako je korisnik  več  logiran postoji sesija preusmjeravamo korisnika na view jobs
            if($this->session->userdata('is_logged_in')){
               redirect('jobs/listings');
            }
              $this->load->model('model_users');
            
            if($this->model_users->valid_email()){
                return true;
            }else{// ako zaporka iemail ne odgovaraju ili krivi podaci   
                $this->form_validation->set_message('validate_user_email', 'Email adresa nije povezana niti sa jednim računom.');
                return false;
                 
            }
        }
           
        public function click_for_password($key){
                                    // ako je korisnik  več  logiran postoji sesija preusmjeravamo korisnika na view jobs
            if($this->session->userdata('is_logged_in')){
               redirect('jobs/listings');
            }
            
                        $this->load->model('model_users');
            // ova funkcija ide danas
            if($email = $this->model_users->is_recover_key_valid($key)){
                /*
                 * ako je validan key preusmjeravamo se na stranici za promjenu zaporke
                 * na toj stranici korisnik mora promijeniti zaporku
                 * email dobivamo iz baze podataka
                 */
                $this->load->view('changepassword', $email);
            }else{
               // echo 'Došlo je do greške.';
                redirect('nemate_pravo_pristupa');
            }
            
        }
        
        public function change_password(){
                                     // ako je korisnik  več  logiran postoji sesija preusmjeravamo korisnika na view jobs
            if($this->session->userdata('is_logged_in')){
               redirect('jobs/listings');
            }
           // opet moramo prenjeti email, u slučaju da korisnik unese pogrešne parametre
            $data['email'] =  $this->input->post('email');
            
            $this->form_validation->set_rules('email','email','required|trim|valid_email');
            $this->form_validation->set_message('required', 'Obrisali ste %s');
            $this->form_validation->set_message('valid_email', 'Vaš %e nije validan.');
            
            $this->form_validation->set_rules('password','Zaporka', 'required|trim');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            
            $this->form_validation->set_rules('cpassword','Potvrdi zaporku','required|trim|matches[password]');
            $this->form_validation->set_message('required', 'Niste upisali %s');
            $this->form_validation->set_message('matches', 'Zaporke se ne podudaraju.');
            
            if($this->form_validation->run()){
               /*
                *  ako je validacija prošla, mijenjamo zaporku korisniku
                *  brišemo redak iz tablice  temp_password_key
                *  logiramo  korisnika i preusmjeravamo ga na početnu stranicu
                */ 
                $this->load->model('model_users');
                
                if($user = $this->model_users->changepassword()){
                    $data = array(
                    'user_name' => $user->user_name,
                    'email' => $user->email,  
                    'user_image' => $user->user_image,    
                    'is_logged_in' => 1,
                    'type' => $user_data->type     
                     );
                    
                    $this->session->set_userdata($data);
                    redirect('jobs/listings');
                }else{
                    redirect('nemate_pravo_pristupa');
                }
                
            }else{
               // ako validacija nije prošla, ponovo učitavamo stranicu i prenosimo email
              $this->load->view('changepassword', $data); 
           }

        }
        
        /*
         * Facebook conect
         * napravili smo novu bibloteku fbconnect
         */
        public function facebook_request(){
            
                    // učtavamo biblioteku za facebook logiranje
        $this->load->library('fbconnect');
        /*
         * kuda nakon logiranja
         * scope su komaditci podataka , ako nisšta ne navedemo dobiti ćemo samo javne podatke
         * da bi zagarantirali podatke koje želimo trebamo unijeti željene refrence
         */
        $data = array(
            'redirect_uri' => site_url('login/handle_facebook_login'),
            'scope' => 'email'
        );
        redirect($this->fbconnect->getLoginUrl($data));
            
        }
        
        public function handle_facebook_login(){
                       // učtavamo biblioteku za facebook logiranje
        $this->load->library('fbconnect');
        $this->load->model('model_users');
        
        $facebook_user = $this->fbconnect->user;
        
        if($this->fbconnect->user){
            /*
             * print_r($this->fbconnect->user);
             * 
             * naoravimo model funkciju koja ce provjeriti dali postoji korisnikov email u bazi podataka
             * ako postoji jednostavno ga logira pomocu funkcije log_in()
             * ako ne postoji jednostavno ga upišemo u bazu pomocu funkcije
             * sign_up_from facebook i logiramo ga
             */
            if($this->model_users->is_member($facebook_user)){
                // ako is-member vrati true logiramo korisnika
                $this->log_in($facebook_user);
                redirect('admin'); 
            }else{ 

                  // registriramo korisnika
                  $this->model_users->sign_up_from_facebook($facebook_user);
              // ako uspiješno prijavimo korisnika, vracamo true i zatim ga logiramo
              $this->log_in($facebook_user);
              
                    // kod preve facebook registracije              
                    
                    redirect('admin/newuser_updatedata');  
 
            }
   
        }else{
            $data['erorr'] = 'Vi niste Facebook korisnik, registrirajte se normalnim putem.';
            $this->load->view('front',$data);
          }
        }
        
        // logiramo korisnika pomocu facebooka
            public function log_in($facebook_user){
            $data = array(
                'user_name' => $facebook_user['first_name'],
                'email' => $facebook_user['email'],
                'user_image' => 'https://graph.facebook.com/'.$facebook_user['username'].'/picture?type=large',
                'is_logged_in' => 1,
                'type' => 0     
                 );
            $this->session->set_userdata($data);
         
        }
        
   
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
