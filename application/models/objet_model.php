<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Objet_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		//Connexion à la base de données
		$this->load->database();

	}
        
        public function ajout_objet($objetdata)
        {
            //Création de la requête
            $this->db->set('username', $objetdata['username']);
            $this->db->set('nom_objet', $objetdata['nom_objet']);
            $this->db->set('resume', $objetdata['resume']);
            $this->db->set('historique', $objetdata['historique']);
            $this->db->set('description', $objetdata['description']);
            $this->db->set('adresse_postale', $objetdata['adresse_postale']);
            $this->db->set('mots_cles', $objetdata['mots_cles']);
            $this->db->insert('objet'); //Exécution
        }

        public function get_objet_list($orderBy='objet_id', $orderDirection='asc',$speAttribute = null, $speAttributeValue = null)
        {
            $this->db->select('*');
            $this->db->from('objet');
            $this->db->order_by($orderBy,$orderDirection);
            if ($speAttribute!=null && $speAttributeValue!=null){
                $this->db->like($speAttribute,$speAttributeValue);
            }
            $query = $this->db->get();
            
            //converting to an array of Objet entities
            $tempArray = $query->result_array();
            $resultArray = array();         
            foreach ($tempArray as $objetArray){
                $resultArray[] = new Objet($objetArray);
            }           
            return $resultArray;
        }
        
        //return objet_id out of the name
        public function get_objet_by_name($name)
        {
            $this->db->select('objet_id');
            $this->db->from('objet');
            $this->db->where('nom_objet', $name);
            
            $query = $this->db->get(); //Exécution

            $result = $query->result_array(); //Récupération des résultats
            $objet_id = $result['0']['objet_id']; //On isole le mot de passe'objet_id
            
            return $objet_id;
        }
        
        public function import_csv($data)
        {
            
            foreach($data as $objetcsv)
            {
                $objetdata['username'] = $this->session->userdata('username');
                $objetdata['nom_objet'] = $objetcsv['Nom de l\'objet'];
                $objetdata['resume'] = $objetcsv['Résumé'];
                $objetdata['historique'] = $objetcsv['Historique'];
                $objetdata['description'] = $objetcsv['Description'];
                $objetdata['adresse_postale'] = $objetcsv['Adresse'];
                $objetdata['mots_cles'] = $objetcsv['Mots-clefs'];
                
                $this->ajout_objet($objetdata);
            }
        }
        
        //get first objet from table as an associative array with $attribute set at $value
        public function get_objet ($attribute,$value){
            
            $this->db->select('*');
            $this->db->from('objet');
            $this->db->where($attribute, $value);
            $query = $this->db->get();
            $result = $query->result_array();
            
            return $result['0'];
            
        }
        
        public function exist($objet_id){
            
            $this->db->select('objet_id');
            $this->db->from('objet');
            $this->db->where('objet_id', $objet_id);
            $numberOfInstance = $this->db->count_all_results(); //Renvoie 0 si le $objet_id n'existe pas
            if ($numberOfInstance==0){
                return FALSE;
            } else {
                return TRUE;
            }
        }
        
        public function update_objet (Objet $objet){
            
            $attributeArray = $objet->get_attributes();
            foreach ($attributeArray as $attribute => $value){
                $dbAttribute = substr($attribute, 1); //we must delete the _ of the _attribute_name
                $this->db->set($dbAttribute,$value);
            }
            $this->db->where('objet_id',$objet->get_objet_id());
            
            $this->db->update('objet');
        }
        
        //return a list of associative arrays linked by the relation table to the $objet_id argument
        //the type of relation is given by a third join on type_relation
        //arrays are like relation_id, objet_id, nom_objet, username, resume, type relation, date_debut_relation, date_fin_relation, parent
        public function get_linked_objet($objet_id){
            $this->db->select('relation_id, objet_id,nom_objet, objet.username AS username, resume, type_relation, date_debut_relation, 
                                date_fin_relation, parent');
            $this->db->from('objet');
            $this->db->join('relation','objet.objet_id=relation.objet_id_1');
            $this->db->join('type_relation','relation.type_relation_id=type_relation.type_relation_id');
            $this->db->order_by('nom_objet','asc');
            $this->db->where('objet_id_2', $objet_id);
            $query = $this->db->get();
            
            $resultArray = $query->result_array();
            
            //second request for inversed roles
            $this->db->select('relation_id, objet_id,nom_objet, objet.username AS username, resume, type_relation, date_debut_relation, 
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
        
    //return a list of associative arrays linked by the documentation_*** table to the $objet_id argument
    //arrays are like documentation_***_id, ressource_***_id, titre, 
    //username, description, reference_ressource, date_debut_ressource
    public function get_linked_ressource($objet_id,$typeRessource){
        $this->db->select('documentation_'.$typeRessource.'_id, ressource_'.$typeRessource.'.ressource_'.$typeRessource.'_id AS ressource_id, 
                            titre, ressource_'.$typeRessource.'.username AS username, description, 
                                reference_ressource, date_debut_ressource AS date');
        
        $this->db->from('ressource_'.$typeRessource);
        $this->db->join('documentation_'.$typeRessource.' AS d',
                        'ressource_'.$typeRessource.'.ressource_'.$typeRessource.'_id=d.ressource_'.$typeRessource.'_id');
        $this->db->order_by('titre','asc');
        $this->db->where('objet_id', $objet_id);
        $query = $this->db->get();
            
        $resultArray = $query->result_array();
        return $resultArray;
    }
        
}

/* End of file objet_model.php */
/* Location: ./application/models/objet_model.php */