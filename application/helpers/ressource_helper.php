<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This helper contains various tools about ressources
 *
 * @author paulyves
 */

if (!function_exists('check_ressource')) {
    //this check that the two args correspond to a valid type of ressource
    //and an existing ressource
    //it return true or false
    function check_ressource($typeRessource, $ressource_id){
        if ($typeRessource != 'ressource_texte' && $typeRessource != 'ressource_graphique' && $typeRessource != 'ressource_video'){
            return FALSE;
        } else {
            $managerName = ucfirst($typeRessource).'_model';
            require_once ('application/models/'.$typeRessource.'_model.php');
            $manager = new $managerName();
            return $manager->exist($ressource_id);
        }
    }
    
}

if (!function_exists('check_typeRessource')) {
    //this check that the arg correspond to a valid
    //type of ressource
    function check_typeRessource($typeRessource){
        if ($typeRessource != 'ressource_texte' && $typeRessource != 'ressource_graphique' && $typeRessource != 'ressource_video'){
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
}


/* End of file ressource_helper.php */
/* Location : ./application/models/ressource_helper.php */

