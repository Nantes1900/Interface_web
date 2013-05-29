<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Manager of Ressource_graphique, connect to database and interact with Ressource_graphique entities
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
    
    public function last_insert_id(){
        return $this->db->insert_id();
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
        $this->db->where('ressource_graphique_id',$ressource->get_ressource_graphique_id());
            
        $this->db->update('ressource_graphique');
    }
    
    public function add_documentation($objet_id, $ressource_id){
        $this->db->set('objet_id',$objet_id);
        $this->db->set('ressource_graphique_id', $ressource_id);
        $this->db->insert('documentation_graphique');
    }
    
    //return a list of associative arrays linked by the relation table to the $objet_id argument
    //the type of relation is given by a third join on type_relation
    //arrays are like objet_id, nom_objet, username, resume, type relation, date_debut_relation, date_fin_relation, parent
    public function get_linked_objet($ressource_id){
        $this->db->select('objet_id,nom_objet, objet.username AS username, resume, type_relation, date_debut_relation, 
                                date_fin_relation, parent');
        $this->db->from('objet');
        $this->db->join('relation','objet.objet_id=relation.objet_id_1');
        $this->db->join('type_relation','relation.type_relation_id=type_relation.type_relation_id');
        $this->db->order_by('nom_objet','asc');
        $this->db->where('objet_id_2', $objet_id);
        $query = $this->db->get();
            
        $resultArray = $query->result_array();
            
        //second request for inversed roles
        $this->db->select('objet_id,nom_objet, objet.username AS username, resume, type_relation, date_debut_relation, 
                                date_fin_relation, parent');
        $this->db->from('objet');
        $this->db->join('relation','objet.objet_id=relation.objet_id_2');
        $this->db->join('type_relation','relation.type_relation_id=type_relation.type_relation_id');
        $this->db->order_by('nom_objet','asc');
        $this->db->where('objet_id_1', $objet_id);
        $query = $this->db->get();
            
        foreach ($query->result_array() as $row){
            $resultArray[]=$row;
        }
                
        return $resultArray;
        }
}


/* End of file ressource_graphique_model.php */
/* Location: ./application/models/ressource_graphique_model.php */