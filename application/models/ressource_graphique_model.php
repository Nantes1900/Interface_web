<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of ressource_graphique
 *
 * @author paulyves
 */

class Ressource_graphique_model extends CI_Model
{
    public function __construct()
    {
	parent::__construct();

	//Connexion à la base de données
	$this->load->database();

    }
    
    //beware, the arg $ressource should not exist in the database
    public function ajout_ressource (Ressource_graphique $ressource){
        
        $attributeArray = $ressource->get_attributes();
        foreach ($attributeArray as $attribute => $value){
            $dbAttribute = substr($attribute, 1); //we must delete the _ of the _attribute_name
            $this->db->set($dbAttribute,$value);
        }
        
        $this->db->insert('ressource_graphique');
    }
    
    //get first ressource_textuelle from table with $attribute set at $value
    public function get_ressource ($attribute,$value){
            
        $this->db->select('*');
        $this->db->from('ressource_graphique');
        $this->db->where($attribute, $value);
        $query = $this->db->get();
        $result = $query->result_array();
        if (isset($result['0'])){    
            return $result['0'];
        }
            
    }
        
    public function exist($ressource_graph_id){
            
        $this->db->select('ressource_graphique_id');
        $this->db->from('ressource_graphique');
        $this->db->where('ressource_graphique_id', $ressource_graph_id);
        $numberOfInstance = $this->db->count_all_results(); //Renvoie 0 si le $objet_id n'existe pas
         if ($numberOfInstance==0){
            return FALSE;
         } else {
            return TRUE;
        }
    }
        
    public function update_ressource (Ressource_graphique $ressource){
            
        $attributeArray = $ressource->get_attributes();
        foreach ($attributeArray as $attribute => $value){
            $dbAttribute = substr($attribute, 1); //we must delete the _ of the _attribute_name
            $this->db->set($dbAttribute,$value);
        }
        $this->db->where('ressource_textuelle_id',$ressource->get_ressource_textuelle_id());
            
        $this->db->update('ressource_textuelle');
    }
}


/* End of file ressource_graphique_model.php */
/* Location: ./application/models/ressource_graphique_model.php */