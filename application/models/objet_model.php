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
        
}

/* End of file objet_model.php */
/* Location: ./application/models/objet_model.php */