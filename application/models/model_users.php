<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_users
 *
 * @author Dragan
 */
class Model_users  extends CI_Model{


    
    public function can_log_in(){
               
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', md5($this->input->post('password')));
        $this->db->where('status', 'active');
        // ako post dolazi sa prijave za korisnika uzimamo podatke iz baze 'users'
         if($this->input->post('user_submit') == true){
             $query = $this->db->get('users');
            }
        // ako post dolazi sa prijave za firmu  uzimamo podatke iz baze 'company'    
         if($this->input->post('company_submit') == true){
             $query = $this->db->get('company');
            }   
            
            // ako post dolazi sa prijave za superadmina  uzimamo podatke iz baze 'users'    
         if($this->input->post('admin_submit') == true){
             $query = $this->db->get('users');
            }   
        
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }  
    }
    
        public function not_verifed_email(){
        /* Provjeravamo dali u temp_users postoji ne potvrđeni email */
        $this->db->where('email', $this->input->post('email'));
        
                // ako post dolazi sa prijave za korisnika uzimamo podatke iz baze 'users'
         if($this->input->post('user_submit') == true){
             $query = $this->db->get('temp_users');
            }
        // ako post dolazi sa prijave za firmu  uzimamo podatke iz baze 'company'    
         if($this->input->post('company_submit') == true){
             $query = $this->db->get('temp_company');
            } 
        
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }  
    }
    // nije blokiran
            public function not_block(){
        /* Provjeravamo dali u temp_users postoji ne potvrđeni email */
 
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('status', 'passive');
        
                // ako post dolazi sa prijave za korisnika uzimamo podatke iz baze 'users'
         if($this->input->post('user_submit') == true){
             $query = $this->db->get('users');
            }
        // ako post dolazi sa prijave za firmu  uzimamo podatke iz baze 'company'    
         if($this->input->post('company_submit') == true){
             $query = $this->db->get('company');
            } 
  
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }  
    }
    
  public function fetch_user_data(){
              // ako post dolazi sa prijave za korisnika uzimamo podatke iz baze 'users'
         if($this->input->post('user_submit') == true){
                  $this->db->select('user_name,email,status,type,user_image');
                  $this->db->where('email', $this->input->post('email'));
                  $user_data = $this->db->get('users'); 
            }
        // ako post dolazi sa prijave za firmu  uzimamo podatke iz baze 'company'    
         if($this->input->post('company_submit') == true){
            $this->db->select('user_name,email,status,type, user_image');
            $this->db->where('email', $this->input->post('email'));
            $user_data = $this->db->get('company'); 
            } 
            
            // ako post dolazi sa prijave za administraciju uzimamo podatke iz baze 'company'    
         if($this->input->post('admin_submit') == true){
            $this->db->select('user_name,email,status,type, user_image');
            $this->db->where('email', $this->input->post('email'));
            $user_data = $this->db->get('users'); 
            } 

      
      
       if($user_data->num_rows() == 1){
            return $user_data->row();
        }else{
            return false;
        }
  }  
    
  public function add_temp_user($key){
      $data = array( 
      'user_name' => $this->input->post('first_name'), 
      'last_name' => $this->input->post('last_name'),    
      'email' => $this->input->post('email'),
      'password' => md5($this->input->post('password')),
      'key' => $key    
      );
      
      $query = $this->db->insert('temp_users', $data);
      if($query){
          return TRUE;
      }else{
          return FALSE;
      }  
  }
  // provjeravamo validnost $key koji smo poslali emailom
  public function is_key_valid($key){
      $this->db->where('key', $key);
      $query = $this->db->get('temp_users');

      if($query->num_rows() == 1){
          return TRUE;  
      }else{
          return FALSE;}
  }
  // dodajemo korsinika u bazu i brišemo ga iz temp tablice
  public function add_user($key){
      $this->db->where('key', $key);
      $temp_user = $this->db->get('temp_users');
      
      if($temp_user){
          $row = $temp_user->row();
          
          $data = array(
              'facebook_id' => '0',
              'state_id' => '0',
              'email' => $row->email,
              'password' => $row->password,
              'user_name' => $row->user_name,
              'last_name' => $row->last_name,
              'user_image' => base_url().'images/blog/avatars/intern.jpg'
          );
          /*
           * vracamo samo public data return $public_data
           */
          $public_data = array(
              'email' => $row->email,
              'user_name' => $row->user_name,
              'user_image' => base_url().'images/blog/avatars/intern.jpg'
          );
          
          $did_add_user = $this->db->insert('users', $data);
          
          if($did_add_user){
              $this->db->where('key', $key);
              $this->db->delete('temp_users');
              return $public_data;
          }else return false;
      }
  }
  /**
   * Registracija poduzeča isto kao i gore
   * U tablicz temp-compani privremeno dodajemo poduzeča dok ne potvrde svoj email
   */  
    public function add_temp_company($key){
      $data = array( 
      'user_name' => $this->input->post('company_name'),    
      'email' => $this->input->post('email'),
      'password' => md5($this->input->post('password')),
      'key' => $key    
      );
      
      $query = $this->db->insert('temp_company', $data);
      if($query){
          return TRUE;
      }else{
          return FALSE;
      }  
  }
  
   // provjeravamo validnost $key koji smo poslali emailom
  public function is_company_key_valid($key){
      $this->db->where('key', $key);
      $query = $this->db->get('temp_company');
      
      if($query->num_rows() == 1){
          return TRUE;  
      }else{
          return FALSE;}
  }
  
   // dodajemo korsinika u bazu i brišemo ga iz temp tablice
  public function add_company($key){
      $this->db->where('key', $key);
      $temp_user = $this->db->get('temp_company');
      
      if($temp_user){
          $row = $temp_user->row();
          
          $data = array(
              'state_id' => '0',              
              'email' => $row->email,
              'password' => $row->password,
              'user_name' => $row->user_name,
              'user_image' => base_url().'images/blog/avatars/intern.jpg'
          );
          // vračamo samo public data return $public_data
          $public_data = array(
              'email' => $row->email,
              'user_name' => $row->user_name,
              'user_image' => base_url().'images/blog/avatars/intern.jpg'
          );
          
          $did_add_user = $this->db->insert('company', $data);
          
          if($did_add_user){
              $this->db->where('key', $key);
              $this->db->delete('temp_company');
              return $public_data;
          }else return false;
      }
  }
  // provjeravamo dali unešeni email pripada jednom od korisnika
  public function valid_email(){
      /* Provjeravamo dali u users ili company postoji unešeni email
       * Ako postoji vračamo tru ako ne false
       * ako ništa od tohga nije točno vračamo false 
       * 
       */
       if($this->input->post('category') == 'primac'){
                  $this->db->where('email', $this->input->post('email'));
                  $query = $this->db->get('users');
                          if($query->num_rows() == 1){
                                 return true;
                                  }else{
                                  return false;
                                  } 
                  }elseif ($this->input->post('category') == 'pos') {
                  $this->db->where('email', $this->input->post('email'));
                  $query = $this->db->get('company');
                          if($query->num_rows() == 1){
                                 return true;
                                  }else{
                                  return false;
                                  }             
        }else{
            return false;
        }  
  }
  // dodajemo privrmeni key za promjenu zaporke u tablicu temp_password_key
  public function add_temp_password_key($key, $email){
      $data = array('key'=>$key, 'email'=>$email);
      $query = $this->db->insert('temp_password_key', $data);
            if($query){
          return TRUE;
      }else{
          return FALSE;
      }
  }
  
   // provjeravamo validnost $key koji smo poslali emailom
  public function is_recover_key_valid($key){
      $this->db->where('key', $key);
      $query = $this->db->get('temp_password_key');
      /*
       *  ako postoji samo jedan red sa tim ključom vrati nam email 
       * tako da možemo resetirati zaporku pomoću tog emaila
       */
      
      if($query->num_rows() == 1){
          $row = $query->row();
           $data = array('email'=>$row->email);
          return $data;  
      }else{
          return FALSE;}
  }
  
  /*
   * promjena zaporke
   * trebamo promijeniti zaporku i ako je to ok onda brišemo redak iz temp_password_key i to sve 
   * uz pomoć emaila korisnika
   */

  public function changepassword(){
      $email = $this->input->post('email');
      /*
       * moramo saznati koji je tip korisnika, da bi znali u kojoj tablici mijenjamo 
       * ako je user
       */
      $this->db->where('email', $email); 
      $query_user = $this->db->get('users');
      
      if($query_user->num_rows() == 1){
        $data = $query_user->row();
          
       $this->db->where('email', $email); 
       $update = $this->db->update('users',array('password'=> md5($this->input->post('password'))));
        if($update){
         $this->db->where('email', $email);
         $this->db->delete('temp_password_key');
         return $data;
        }
     }
     /*
      *  ako je company
      */

      $this->db->where('email', $email); 
      $query = $this->db->get('company');
      
      if($query->num_rows() == 1){
        $data = $query->row();
          
       $this->db->where('email', $email); 
       $update_company = $this->db->update('company',array('password'=> md5($this->input->post('password'))));
        if($update_company){
         $this->db->where('email', $email);
         $this->db->delete('temp_password_key');
         return $data;
        }
     }
     
        }// kraj funkcije
        
        
        /*
         * Facebook logiranje
         */
        public function is_member($facebook_user){
            // provjeravamo dali je korsinik član naše web stranice
             //print_r($facebook_user); 
            // echo $facebook_user['email'];
            $this->db->where('email', $facebook_user['email']);
            $query = $this->db->get('users');
            
            if($query->num_rows() == 1){
                return true;
            } else{
                return false;
            }
            
        }

        public function sign_up_from_facebook($facebook_user){

            $data = array(
                'facebook_id' => $facebook_user['id'],
                'state_id' => '0',
                'email' => $facebook_user['email'],
                'password' => md5(uniqid()),
                'user_name' => $facebook_user['first_name'],
                'last_name' => $facebook_user['last_name'],
                'user_image' => 'https://graph.facebook.com/'.$facebook_user['username'].'/picture?type=large',
                'about' => $facebook_user['bio']  
            );
            $this->db->insert('users', $data);
        }
          
}
# kraj klase model_users.php
