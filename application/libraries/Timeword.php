<?php if( ! defined('BASEPATH'))exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Timeword
 *
 * @author Dragan
 */
class Timeword {
     
    function convert($from_time, $to_time=0, $include_seconds = true){
        // ako nije zadano vrijeme, koristi trenutno vrijeme
        if($to_time == 0){$to_time = time();}
        
        $distance_in_minutes =  round(abs($to_time - $from_time) / 60);
        $distance_in_seconds = round(abs($to_time - $from_time));
        
        if($distance_in_minutes >= 0 && $distance_in_minutes <= 1){
            if(!$include_seconds){
                return ($distance_in_minutes == 0) ? ' manje od minute' : ' 1 minute';
            }else{
                if($distance_in_seconds >= 0 && $distance_in_seconds <= 4){
                    return ' manje od 5 sekundi';
                }elseif ($distance_in_seconds >= 5 && $distance_in_seconds <= 9) {
                    return ' manje od 10 sekundi';
                }elseif ($distance_in_seconds >= 10 && $distance_in_seconds <= 19) {
                    return ' manje od 20 sekundi';
                }elseif ($distance_in_seconds >= 20 && $distance_in_seconds <= 39) {
                    return ' pola minute';
                }elseif($distance_in_seconds >= 40 && $distance_in_seconds <= 59){
                    return ' manje od minute';
                }else{
                    return ' 1 minute';
                }
            }   
        }elseif ($distance_in_minutes >= 2 && $distance_in_minutes <= 44) {
            return $distance_in_minutes . ' minuta';
        }elseif($distance_in_minutes >= 45 && $distance_in_minutes <= 89){
            return ' sat vremena';
        }elseif ($distance_in_minutes >= 90 && $distance_in_minutes <= 1439) {
            return round(floatval($distance_in_minutes) / 60.0) . ' sata';  
        }elseif ($distance_in_minutes >= 1440 && $distance_in_minutes <= 2879) {
            return ' jednog dana';
        }elseif ($distance_in_minutes >= 2880 && $distance_in_minutes <= 43199) {
            return round(floatval($distance_in_minutes) / 1440) . ' dana';   
        }elseif ($distance_in_minutes >= 43200 && $distance_in_minutes <= 86399) {
            return ' mjesec dana';
        }elseif ($distance_in_minutes >= 86400 && $distance_in_minutes <= 525599) {
            return round(floatval($distance_in_minutes) / 525600) . ' mjeseca';
        }elseif ($distance_in_minutes >= 525600 && $distance_in_minutes <= 1051199) {
            return ' godinu dana';
        }else{
            return 'više od ' . round(floatval($distance_in_minutes) / 525600) . ' godina';
        }
        
    }// funkcija
}// klasa

?>
