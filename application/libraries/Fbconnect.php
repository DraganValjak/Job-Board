<?php


/**
 * Description of Fbconnect
 * Facebook logiranje
 *
 * @author Dragan
 */

include(APPPATH.'libraries/facebook/facebook.php');

class Fbconnect extends Facebook{
    
    public $user = null;
    public $user_id = null;
    public $fb = false;
    public $fbSession = false;
    public $appkey = 0;


    public function __construct() {

        $CI =& get_instance();
        /*
         * ucitavamo facebook appId i secret iz mape config datoteka facebook.php
         *  TRUE se stavlja zato da bi vrijednosti bile u array-u
         */
        $CI->config->load('facebook', TRUE);
        
        /*
         * napravimo taj array
         *   na pr. echo $config['appId'];
         */
        $config = $CI->config->item('facebook');
        /*
         *  moramo napraviti ikonstruktor za klasu facebook
         * kojoj kao knfiguraciu dajemo appId i secret
         */
        parent::__construct($config);
        
        /*
         *  funkcija getUser vraca korisnikov Facebook id
         */
        $this->user_id = $this->getUser();
        /*
         * $me je facebook objekt
         */
        $me = null;
        if($this->user_id){
         try{
           $me = $this->api('/me');
           $this->user = $me;
        }  catch (FacebookApiException $e){
                error_log($e);
              }
        }
    }


    public function send_back($value){
       return $value; 
    }
    
    public function test(){
        
    }
}

# end of class Fbconnect
