<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
    
   public function __construct($rules = array()) {
       parent::__construct($rules);
       
        $CI =& get_instance();
   }
    
    /**
     * Valid Date (ISO format)
     *
     * @access    public
     * @param    string
     * @return    bool
     */
   
   // ova funkcija vrača datum koji nam je potreban za bazu
   public function mysql_date($str)
    {
      
    
       
        if ( preg_match("/^([0-9]{1,2})\-([0-9]{1,2})\-([0-9]{4})/", $str) ) 
        {
            $arr = explode("-", $str);    // splitting the array
            $dd = $arr[0];            // first element of the array is day
            $mm = $arr[1];              // second element is month
            $yyyy = $arr[2];              // third element is year
            // if is correct date
            $uhr = date('H:i:s');
            return  "$yyyy-$mm-$dd  $uhr"; 
        
        } 
        else 
        {
            return FALSE;
        }
    }
    
    // ova funkcija služi za kontrolu ispravnosti datuma koji dolazi iz inputa
    public function valid_date($str){
     
    
        if ( preg_match("/^([0-9]{1,2})\-([0-9]{1,2})\-([0-9]{4})/", $str) ) 
        {
            $arr = explode("-", $str);    // splitting the array
            $dd = $arr[0];            // first element of the array is year
            $mm = $arr[1];              // second element is month
            $yyy = $arr[2];              // third element is days
            return ( checkdate($mm, $dd, $yyyy) );
        } 
        else 
        {
            $CI->form_validation->set_message('valid_date', 'Molimo vas unesite ispravan datum.');
            return false;
        }
    }
    
    // vračamo današnji datum ako je input početka oglasa prazan
    
}

?>
