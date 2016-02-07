<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function hr_oblik_datuma($datum)
{
$new_date_only = explode(" ", $datum);
$new = explode("-", $new_date_only[0]);

return $new[2].'/'.$new[1].'/'.$new[0];
}
