<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Manager of Ressource_video, connect to database and interact with Ressource_video entities
 *
 * @author paulyves
 */

class Ressource_video_model extends CI_Model
{
    public function __construct()
    {
	parent::__construct();

	//Connexion à la base de données
	$this->load->database();

    }
    
    //beware, the arg $ressource should not exist in the database
    public function ajout_ressource (Ressource_video $ressource){
        
        $attributeArray = $ressource->get_attributes();
        foreach ($attributeArray as $attribute => $value){
            $dbAttribute = substr($attribute, 1); //we must delete the _ of the _attribute_name
            $this->db->set($dbAttribute,$value);
        }
        
        $this->db->insert('ressource_video');
    }
    
    public function last_insert_id(){
        return $this->db->insert_id();
    }
    
    //get first ressource_textuelle from table with $attribute set at $value
    public function get_ressource ($attribute,$value){
            
        $this->db->select('*');
        $this->db->from('ressource_video');
        $this->db->where($attribute, $value);
        $query = $this->db->get();
        $result = $query->result_array();
        if (isset($result['0'])){    
            return $result['0'];
        }
            
    }
    
    public function get_ressource_list($orderBy='objet_id', $orderDirection='asc',$speAttribute = null, $speAttributeValue = null, $valid = null){
            $this->db->select('*');
            $this->db->from('ressource_video');
            $this->db->order_by($orderBy,$orderDirection);
            if ($speAttribute!=null && $speAttributeValue!=null){
                $this->db->like($speAttribute,$speAttributeValue);
            }
            if ($valid!=null){$this->db->where('validation', $valid);}
            
            $query = $this->db->get();
            
            //converting to an array of Objet entities
            $tempArray = $query->result_array();
            $resultArray = array();         
            foreach ($tempArray as $objetArray){
                $resultArray[] = new Ressource_video($objetArray);
            }           
            return $resultArray;
        }
        
    public function exist($ressource_video_id){
            
        $this->db->select('ressource_video_id');
        $this->db->from('ressource_video');
        $this->db->where('ressource_video_id', $ressource_video_id);
        $numberOfInstance = $this->db->count_all_results(); //Renvoie 0 si le $objet_id n'existe pas
         if ($numberOfInstance==0){
            return FALSE;
         } else {
            return TRUE;
        }
    }
        
    public function update_ressource (Ressource_video $ressource){
            
        $attributeArray = $ressource->get_attributes();
        foreach ($attributeArray as $attribute => $value){
            $dbAttribute = substr($attribute, 1); //we must delete the _ of the _attribute_name
            $this->db->set($dbAttribute,$value);
        }
        $this->db->where('ressource_video_id',$ressource->get_ressource_video_id());
            
        $this->db->update('ressource_video');
    }
    
    public function add_documentation($objet_id, $ressource_id){
        $this->db->set('objet_id',$objet_id);
        $this->db->set('ressource_video_id', $ressource_id);
        $this->db->insert('documentation_video');
    }
    
    //return a list of associative arrays linked by documentation_video table to the $ressource_id argument
    //arrays are like documentation_video_id, objet_id, nom_objet, username, resume, 
    public function get_linked_objet($ressource_id){
        $this->db->select('documentation_video_id AS documentation_id, objet.objet_id, nom_objet, username, resume');
        $this->db->from('objet');
        $this->db->join('documentation_video AS d', 'objet.objet_id=d.objet_id');
        $this->db->order_by('nom_objet','asc');
        $this->db->where('ressource_video_id', $ressource_id);
        $query = $this->db->get();
            
        $resultArray = $query->result_array();
        return $resultArray;
    }
    
    //return a list of associative arrays linked by the documentation_video table to the $objet_id argument
    //arrays are like documentation_video_id, ressource_video_id, titre, 
    //username, description, reference_ressource, date_debut_ressource
    public function get_linked_ressource($objet_id){
        $this->db->select('documentation_video_id, ressource_video.ressource_video_id AS ressource_id, titre, 
                            ressource_video.username AS username, description, reference_ressource, date_debut_ressource AS date');
        $this->db->from('ressource_video');
        $this->db->join('documentation_video AS d','ressource_video.ressource_video_id=d.ressource_video_id');
        $this->db->order_by('titre','asc');
        $this->db->where('objet_id', $objet_id);
        $query = $this->db->get();
            
        $resultArray = $query->result_array();
        return $resultArray;
    }
    
    //simply delete the ressource_video with $ressource_id in the database
   //beware, it will delete all depending infos (some documentation of documentation table for example)
    public function delete($ressource_id){
        $this->db->where('ressource_video_id',$ressource_id);
        $this->db->delete('ressource_video'); 
    }
    
    public function delete_documentation($documentation_id){
        $this->db->where('documentation_video_id',$documentation_id);
        $this->db->delete('documentation_video');
    }
}


/* End of file ressource_video_model.php */
/* Location: ./application/models/ressource_video_model.php */