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
            if(is_array($textedata)){
                $this->db->set('username', $textedata['username']);
                $this->db->set('titre', $textedata['titre']);
                $this->db->set('reference_ressource', $textedata['reference_ressource']);
                $this->db->set('disponibilite', $textedata['disponibilite']);
                $this->db->set('description', $textedata['description']);
                $this->db->set('theme_ressource', $textedata['theme_ressource']);
                $this->db->set('auteurs', $textedata['auteurs']);
                $this->db->set('editeur', $textedata['editeur']);
                $this->db->set('pagination', $textedata['pagination']);
                $this->db->set('ville_edition', $textedata['ville_edition']);
                $this->db->set('sous_categorie', $textedata['sous_categorie']);
                $this->db->set('mots_cles', $textedata['mots_cles']);
                $this->db->set('date_debut_ressource', $textedata['date']);
                $this->db->set('date_precision', $textedata['date_precision']);
            }elseif($textedata instanceof Ressource_texte ){
                $attributeArray = $textedata->get_attributes();
                foreach ($attributeArray as $attribute => $value){
                    $dbAttribute = substr($attribute, 1); //we must delete the _ of the _attribute_name
                    $this->db->set($dbAttribute,$value);
                }
            }
            return $this->db->insert('ressource_textuelle'); //Exécution            
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
            } else {
                return null;
            }
        }
        
        public function get_ressource_list($orderBy='objet_id', $orderDirection='asc',$speAttribute = null, $speAttributeValue = null, $valid = null, $page = 1){
            $this->db->select('*');
            $this->db->from('ressource_textuelle');
            $this->db->order_by($orderBy,$orderDirection);
            if ($speAttribute!=null && $speAttributeValue!=null){
                $this->db->like('LOWER('.$speAttribute.')', strtolower($speAttributeValue));
            }
            if ($valid!=null){$this->db->where('validation', $valid);}
            $this->db->limit(10,($page-1)*10); //10 ressource per page
            $query = $this->db->get();
            
            //converting to an array of Objet entities
            $tempArray = $query->result_array();
            $resultArray = array();         
            foreach ($tempArray as $objetArray){
                $resultArray[] = new Ressource_texte($objetArray);
            }           
            return $resultArray;
        }
        
        //return the number of pages that we could get with the previous method 
        //depending on the sort option
        public function count_page_ress($speAttribute = null, $speAttributeValue = null, $valid = null) {
            $this->db->from('ressource_textuelle');
            if ($speAttribute != null && $speAttributeValue != null) {
                $this->db->like('LOWER('.$speAttribute.')', strtolower($speAttributeValue));
            }
            if ($valid != null) {
                $this->db->where('validation', $valid);
            }
            $entries = $this->db->count_all_results();
            $pages = ceil($entries/10);

            return $pages;
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
            
            return $this->db->update('ressource_textuelle');
        }
        
        public function add_documentation($objet_id, $ressource_id, $page = 0){
            $this->db->set('objet_id',$objet_id);
            $this->db->set('ressource_textuelle_id', $ressource_id);
            $this->db->set('page_consultee', $page);
            
            return $this->db->insert('documentation_textuelle');
        }
        
        //return a list of associative arrays linked by documentation_textuelle table to the $ressource_id argument
        //arrays are like documentation_textuelle_id, objet_id, nom_objet, username, resume, 
        public function get_linked_objet($ressource_id, $valid = 't'){
            $this->db->select('documentation_textuelle_id AS documentation_id, objet.objet_id AS objet_id, nom_objet, username, resume');
            $this->db->from('objet');
            $this->db->join('documentation_textuelle AS d', 'objet.objet_id=d.objet_id');
            $this->db->order_by('nom_objet','asc');
            $this->db->where('ressource_textuelle_id', $ressource_id);
            if ($valid != null){
                $this->db->where('validation', $valid);
            }
            $query = $this->db->get();
            
            $resultArray = $query->result_array();
            return $resultArray;
        }
        
        
        //return a list of associative arrays linked by the documentation_textuelle table to the $objet_id argument
        //arrays are like documentation_textuelle_id, ressource_textuelle_id, titre, 
        //username, description, reference_ressource, date_debut_ressource
        public function get_linked_ressource($objet_id, $valid = 't'){
            $this->db->select('documentation_textuelle_id, ressource_textuelle.ressource_textuelle_id AS ressource_id, titre,
                ressource_textuelle.username AS username, description, reference_ressource, date_debut_ressource AS date');
            $this->db->from('ressource_textuelle');
            $this->db->join('documentation_textuelle AS d','ressource_textuelle.ressource_textuelle_id=d.ressource_textuelle_id');
            $this->db->order_by('titre','asc');
            $this->db->where('objet_id', $objet_id);
            if ($valid != null){
                $this->db->where('validation', $valid);
            }
            $query = $this->db->get();
            
            $resultArray = $query->result_array();
            return $resultArray;
        }
        
        //simply delete the ressource_textuelle with $ressource_id in the database
        //beware, it will delete all depending infos (some documentation of documentation table for example)
        public function delete($ressource_id){
            //we first delete the annotations
            $this->db->where('type_target','ressource_texte');
            $this->db->where('target_id',$ressource_id);
            $this->db->delete('annotation');
        
            $this->db->where('ressource_textuelle_id',$ressource_id);
            return $this->db->delete('ressource_textuelle'); 
        }
        
        public function delete_documentation($documentation_id){
            $this->db->where('documentation_textuelle_id',$documentation_id);
            return $this->db->delete('documentation_textuelle');
        }
        
        //$data is an associative array
        //output $failure is an array with titles of failed insertion
        public function import_csv($data, $transaction){ 
            $this->load->helper('dates');
            $failure = array();
            $ressource_id_array = array(); //array containing successful id, used for rollback
            
            foreach ($data as $ressourceCsv){
                $ressource = new Ressource_texte($ressourceCsv);
                $ressource->set_username($this->session->userdata('username'));
                if($ressource->get_date_debut_ressource()==null){ //we want to avoid database error if csv file with not date
                    $ressource->set_date_debut_ressource('01/01/1900');
                }
                
                if ($this->ajout_texte($ressource)) { //if there is no error in the insertion
                    $ressource_id_array[] = $this->db->insert_id();
                } else {
                    $failure[] = $ressource->get_titre().' (';  //we want to continue, check $db['default']['db_debug'] = FALSE; in config/database 
                    if($this->get_ressource('titre', $ressource->get_titre()) != null){
                        $errorBegin = array_pop($failure);
                        $failure[] = $errorBegin.$ressource->get_titre().$this->lang->line('csv_ress_already_exist');
                    }
                    if(!valid_DMY($ressource->get_date_debut_ressource())){
                        $errorBegin = array_pop($failure);
                        $failure[] = $errorBegin.$this->lang->line('csv_ress_date_begin');
                    }
                    if(!(is_numeric($ressource->get_pagination())||$ressource->get_pagination()=='')){
                        $errorBegin = array_pop($failure);
                        $failure[] = $errorBegin.$this->lang->line('csv_ress_pagination');
                    }
                    $errorBegin = array_pop($failure);
                    $failure[] = substr($errorBegin,0,-2).')';
                }
            }
            if($transaction && isset($failure['0'])){ //home-made rollback
                foreach ($ressource_id_array as $ressource_id){
                    $this->delete($ressource_id);
                }
            }
            return $failure;
        }

}


/* End of file ressource_texte_model.php */
/* Location: ./application/models/ressource_texte_model.php */