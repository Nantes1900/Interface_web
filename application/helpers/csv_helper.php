<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('guess_csv_type'))
{
     function guess_csv_type($data)
     {
         
         if ( array_key_exists('target', $data) or array_key_exists('source', $data) )
         {
             return 'relation';
         }
         
         if ( array_key_exists('Nom de l\'objet', $data) )
         {
             return 'objet';
         }
         
     }
    
    
}

/* End of file csv_helper.php */
/* Location : ./application/helpers/csv_helper.php */