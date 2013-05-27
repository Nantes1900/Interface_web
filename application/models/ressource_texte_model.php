<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ressource_texte_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		//Connexion à la base de données
		$this->load->database();

	}
        
        public function ajout_texte($textedata)
        {
            //Création de la requête
            $this->db->set('username', $textedata['username']);
            $this->db->set('titre', $textedata['titre']);
            $this->db->set('reference_ressource', $textedata['reference_ressource']);
            $this->db->set('disponibilite', $textedata['disponibilite']);
            $this->db->set('description', $textedata['description']);
            $this->db->set('auteurs', $textedata['auteurs']);
            $this->db->set('editeur', $textedata['editeur']);
            $this->db->set('pagination', $textedata['pagination']);
            $this->db->set('ville_edition', $textedata['ville_edition']);
            $this->db->set('sous_categorie', $textedata['sous_categorie']);
            $this->db->set('mots_cles', $textedata['mots_cles']);
            $this->db->set('date_debut_ressource', $textedata['date']);
            $this->db->set('date_precision', $textedata['date_precision']);
            $this->db->insert('ressource_textuelle'); //Exécution            
        }
        
        public function last_insert_id(){
            return $this->db->insert_id();
        }
        
        //get first ressource_textuelle from table with $attribute set at $value
        public function get_ressource ($attribute,$value){
            
            $this->db->select('*');
            $this->db->from('ressource_textuelle');
            $this->db->where($attribute, $value);
            $query = $this->db->get();
            $result = $query->result_array();
            if (isset($result['0'])){    
                return $result['0'];
            }
        }
        
        public function exist($ressource_txt_id){
            
            $this->db->select('ressource_textuelle_id');
            $this->db->from('ressource_textuelle');
            $this->db->where('ressource_textuelle_id', $ressource_txt_id);
            $numberOfInstance = $this->db->count_all_results(); //Renvoie 0 si le $objet_id n'existe pas
            if ($numberOfInstance==0){
                return FALSE;
            } else {
                return TRUE;
            }
        }
        
        public function update_ressource (Ressource_texte $ressource){
            
            $attributeArray = $ressource->get_attributes();
            foreach ($attributeArray as $attribute => $value){
                $dbAttribute = substr($attribute, 1); //we must delete the _ of the _attribute_name
                $this->db->set($dbAttribute,$value);
            }
            $this->db->where('ressource_textuelle_id',$ressource->get_ressource_textuelle_id());
            
            $this->db->update('ressource_textuelle');
        }
        
        public function add_documentation($objet_id, $ressource_id){
            $this->db->set('objet_id',$objet_id);
            $this->db->set('ressource_textuelle_id', $ressource_id);
            $this->db->insert('documentation_textuelle');
        }

}


/* End of file relation_model.php */
/* Location: ./application/models/relation_model.php */