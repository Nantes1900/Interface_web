<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of documentation_model
 *
 * @author paulyves
 */
class Documentation_model extends CI_Model{
    
    public function __construct() {
	parent::__construct();

	//Connexion à la base de données
	$this->load->database();

    }
    
    public function import_csv($csvData, $transaction){
        $this->load->model('ressource_texte_model');
        $this->load->model('ressource_graphique_model');  
        $this->load->model('ressource_video_model');
        
        $failure = array();
        
        if($transaction){$this->db->trans_start();}
        foreach ($csvData as $documentationCsv){
            $errorBegin = 'la documentation entre '.$relationcsv['Nom de l\'objet'].' et '.$relationcsv['Titre de la ressource']; //common beginning of error message
        }
        if($transaction){$this->db->trans_complete();}
        
        return $failure;
    }
}

/* End of file documentation_model.php */
/* Location : ./application/models/documentation_model.php */

