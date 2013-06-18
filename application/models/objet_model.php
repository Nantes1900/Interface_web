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
            if(isset($objetdata['resume'])){
                $this->db->set('resume', $objetdata['resume']);
            }if(isset($objetdata['historique'])){
                $this->db->set('historique', $objetdata['historique']);
            }if(isset($objetdata['description'])){
            $this->db->set('description', $objetdata['description']);
            }if(isset($objetdata['adresse_postale'])){
                $this->db->set('adresse_postale', $objetdata['adresse_postale']);
            }if(isset($objetdata['mots_cles'])){
                $this->db->set('mots_cles', $objetdata['mots_cles']);
            }
            $this->db->insert('objet'); //Exécution
        }

        public function get_objet_list($orderBy='objet_id', $orderDirection='asc',$speAttribute = null, $speAttributeValue = null, $valid = null)
        {
            $this->db->select('*');
            $this->db->from('objet');
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
            if(isset($result['0']['objet_id'])){//si l'objet existe
                $objet_id = $result['0']['objet_id']; //On isole objet_id
            }else{
                $objet_id = null; //sinon on renvoie null
            }
            return $objet_id;
        }
        
        public function import_csv($data, $transaction)
        {
            $failure = array();
            $objet_id_array = array();  //will be used in a home made rollback
            foreach($data as $objetcsv){
                $objetdata['username'] = $this->session->userdata('username');
                if(isset($objetcsv['Nom de l\'objet'])){
                    $objetdata['nom_objet'] = $objetcsv['Nom de l\'objet'];
                }
                if(isset($objetcsv['Résumé'])){
                    $objetdata['resume'] = $objetcsv['Résumé'];
                }
                if(isset($objetcsv['Historique'])){
                    $objetdata['historique'] = $objetcsv['Historique'];
                }
                if(isset($objetcsv['Description'])){
                    $objetdata['description'] = $objetcsv['Description'];
                }
                if(isset($objetcsv['Adresse'])){
                    $objetdata['adresse_postale'] = $objetcsv['Adresse'];
                }
                if(isset($objetcsv['Mots-clefs'])){
                    $objetdata['mots_cles'] = $objetcsv['Mots-clefs'];
                }
                $this->ajout_objet($objetdata);
                
                $objet_id = $this->db->insert_id();
                $objet_id_array[] = $objet_id;
                if (($this->db->_error_message())!=null) { //if error we continue and store the name of the failed objet
                    $failure[]=$objetcsv['Nom de l\'objet'];
                }elseif($objetcsv['Latitude']!=null && $objetcsv['Longitude']!=null){ //trying to insert the_geom if coordinate does exist.
                    $geomData['objet_id'] = $objet_id;
                    $geomData['username'] = $this->session->userdata('username');
                    $geomData['the_geom'] = 'ST_SetSRID(ST_MakePoint('.$objetcsv['Longitude'].', '.$objetcsv['Latitude'].'), 4326)';
                    if($objetcsv['Date début']!=null){
                        $geomData['date_debut_geom'] = $objetcsv['Date début'];
                    }
                    if(($objetcsv['Date fin'])!=null){
                        $geomData['date_fin_geom'] = $objetcsv['Date fin'];
                    }
                    if(($objetcsv['Précision'])!=null){
                        $geomData['date_precision'] = $objetcsv['Précision'];
                    }
                    if(($objetcsv['Date de modification'])!=null){
                        $geomData['datation_indication_debut'] = $objetcsv['Date de modification'];
                    }
                    if(($objetcsv['Mots-clefs'])!=null){
                        $geomData['mots_cles'] = $objetcsv['Mots-clefs'];
                    }
                    $this->ajout_geom($geomData);
                    if($this->db->_error_message()!=null){ //if the insertion did not work, we delete the info
                        $failure[]=$objetcsv['Nom de l\'objet'].' (géométrie ou dates)';
                        $this->delete($objet_id);
                    }
                }
            }
            if($transaction && isset($failure['0'])){
                foreach ($objet_id_array as $objet_id){
                    $this->delete($objet_id);
                }
            }
            return $failure;
        }
        
        //get first objet from table as an associative array with $attribute set at $value
        public function get_objet ($attribute,$value){
            
            $this->db->select('*');
            $this->db->from('objet');
            $this->db->where($attribute, $value);
            $query = $this->db->get();
            $result = $query->result_array();
            if(isset($result['0'])){ //vérifier que l'objet existe
                return $result['0'];
            }else{
                return null;
            }
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
    
    //simply delete the objet with $objet_id in the database
    //beware, it will delete all depending infos (some relation of relation table for example)
    public function delete($objet_id){
        $this->db->where('objet_id',$objet_id);
        $this->db->delete('objet'); 
    }
    
    //add a geometry in temp_geom table out of an array of info
    public function ajout_geom($geomData){
        $sql = "INSERT INTO temp_geom (objet_id, username, the_geom";
        if(isset($geomData['date_debut_geom'])){
            $sql .= ", date_debut_geom";
        }
        if(isset($geomData['date_fin_geom'])){
            $sql .= ", date_fin_geom";
        }
        if(isset($geomData['date_precision'])){
            $sql .= ", date_precision";
        }
        if(isset($geomData['datation_indication_debut'])){
            $sql .= ", datation_indication_debut";
        }
        if(isset($geomData['mots_cles'])){
            $sql .= ", mots_cles";
        }
        $sql .= ") VALUES (".$this->db->escape($geomData['objet_id']).",".
                $this->db->escape($geomData['username']).",".$geomData['the_geom'];
        if(isset($geomData['date_debut_geom'])){
            $sql .= ", ".$this->db->escape($geomData['date_debut_geom']);
        }
        if(isset($geomData['date_fin_geom'])){
            $sql .= ", ".$this->db->escape($geomData['date_fin_geom']);
        }
        if(isset($geomData['date_precision'])){
            $sql .= ", ".$this->db->escape($geomData['date_precision']);
        }
        if(isset($geomData['datation_indication_debut'])){
            $sql .= ", ".$this->db->escape($geomData['datation_indication_debut']);
        }
        if(isset($geomData['mots_cles'])){
            $sql .= ", ".$this->db->escape($geomData['mots_cles']);
        }
        $sql .= ")";
        $this->db->query($sql);
    }
        
}

/* End of file objet_model.php */
/* Location: ./application/models/objet_model.php */