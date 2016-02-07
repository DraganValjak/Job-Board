<?php

/**
 * Description of model_sttopers
 *
 * @author Dragan
 */
class Model_sttopers  extends CI_Model{
    
    /**
     * Format datuma
     * @var String 
     */
    protected $date;
    public $query_arrray = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->_date = date('Y-m-d H:i:s');
    }
    
    /**
     * Svi podaci o stoperima
     * @return String podaci iz baze
     */
    public function get_hitchhikers($query_array, $num, $start){
        $data = array();
       // var_dump($query_array);die();
         $this->db->select('*');
         $this->db->from('hitchhikers');
         $this->db->join('users', 'users.user_id = hitchhikers.user_company_id', 'left');
          if($query_array['from']){
              $query_from = $query_array['from'];
                  $this->db->like('from', $query_from,'before'); 
                  }
         $this->db->where(array('hitchhikers.status'=>'active', 'hitchhikers.date_hitchhiking >='=> $this->_date));
         $this->db->order_by('hitchhikers.date_hitchhiking', 'desc');
         
         $this->db->limit($num,$start);
         
         $rows = $this->db->get();
      
        if($rows->num_rows() > 0){
            foreach($rows->result_array() as $row){
                $data[] = $row;
            }
        }
        $rows->free_result();
        return $data;
    }
    
        // izvlačimo detalje stopera
    public function get_traveller($id){
        $data = array();
        
        $options = array('hitchhikers.id' => $id);
        $q = $this->db->select('*')->from('hitchhikers')
                 ->join('users', 'users.user_id = hitchhikers.user_company_id','left')
                 ->where( $options, 1);
        
         $q = $this->db->get();
         
        if($q->num_rows() > 0){
            foreach($q->result_array() as $row){
                $data = $row;
            }
        }
        $q->free_result();
        return $data;
    }


    /**
     * Koliko je stopera ?
     * @return int
     */
    public function get_hitchhikers_count($query_array){
        $this->db->select('id')->from('hitchhikers');
        if($query_array['from']){
              $query_from = $query_array['from'];
                  $this->db->like('from', $query_from,'before'); 
                  }
        $this->db->where(array('status'=>'active', 'date_hitchhiking >='=> $this->_date));
        $row = $this->db->get();
        return $row->num_rows();
    }
    
    /**
     * Pošalji poruku
     * @param type $name Description
     */
    public function send_comment(){
        
    }
    
    
}


?>
