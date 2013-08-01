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
        
        return $this->db->insert('ressource_graphique');
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
        } else {
            return null;
        }
    }
    
    public function get_ressource_list($orderBy = 'objet_id', $orderDirection = 'asc', $speAttribute = null, $speAttributeValue = null, $valid = null, $page = 1) {
        $this->db->select('*');
        $this->db->from('ressource_graphique');
        $this->db->order_by($orderBy, $orderDirection);
        if ($speAttribute != null && $speAttributeValue != null) {
            $this->db->like('LOWER('.$speAttribute.')', strtolower($speAttributeValue));
        }
        if ($valid != null) {
            $this->db->where('validation', $valid);
        }
        $this->db->limit(10,($page-1)*10); //10 ressource per page
        $query = $this->db->get();

        //converting to an array of Objet entities
        $tempArray = $query->result_array();
        $resultArray = array();
        foreach ($tempArray as $objetArray) {
            $resultArray[] = new Ressource_graphique($objetArray);
        }
        return $resultArray;
    }
    
    //return the number of pages that we could get with the previous method 
    //depending on the sort option
    public function count_page_ress($speAttribute = null, $speAttributeValue = null, $valid = null){
        $this->db->from('ressource_graphique');
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
            
        return $this->db->update('ressource_graphique');
    }
    
    public function add_documentation($objet_id, $ressource_id, $page = 0){
        $this->db->set('objet_id',$objet_id);
        $this->db->set('ressource_graphique_id', $ressource_id);
        $this->db->set('page_consultee', $page);
        
        return $this->db->insert('documentation_graphique');
    }
    
    //return a list of associative arrays linked by documentation_graphique table to the $ressource_id argument
    //arrays are like documentation_graphique_id, objet_id, nom_objet, username, resume, 
    public function get_linked_objet($ressource_id, $valid = 't'){
        $this->db->select('documentation_graphique_id AS documentation_id, objet.objet_id, nom_objet, username, resume');
        $this->db->from('objet');
        $this->db->join('documentation_graphique AS d', 'objet.objet_id=d.objet_id');
        $this->db->order_by('nom_objet','asc');
        $this->db->where('ressource_graphique_id', $ressource_id);
        if ($valid != null) {
            $this->db->where('validation', $valid);
        }
        $query = $this->db->get();
            
        $resultArray = $query->result_array();
        return $resultArray;
    }
    
   //return a list of associative arrays linked by the documentation_graphique table to the $objet_id argument
   //arrays are like documentation_graphique_id, ressource_graphique_id, titre, 
   //username, description, reference_ressource, date_debut_ressource
   public function get_linked_ressource($objet_id, $valid = 't'){
        $this->db->select('documentation_graphique_id, ressource_graphique.ressource_graphique_id AS ressource_id, titre,
                        ressource_graphique.username AS username, description, reference_ressource, date_debut_ressource AS date');
        $this->db->from('ressource_graphique');
        $this->db->join('documentation_graphique AS d','ressource_graphique.ressource_graphique_id=d.ressource_graphique_id');
        $this->db->order_by('titre','asc');
        $this->db->where('objet_id', $objet_id);
        if ($valid != null) {
            $this->db->where('validation', $valid);
        }
        $query = $this->db->get();
            
        $resultArray = $query->result_array();
        return $resultArray;
   }
   
   //simply delete the ressource_graphique with $ressource_id in the database
   //beware, it will delete all depending infos (some documentation of documentation table for example)
    public function delete($ressource_id){
        //we first delete the annotations
        $this->db->where('type_target','ressource_graphique');
        $this->db->where('target_id',$ressource_id);
        $this->db->delete('annotation');
        
        $ressource = new Ressource_graphique($ressource_id);
        if($ressource->get_image()!=null){
            $this->load->helper('file');
            $path=  FCPATH.'assets/images/'.$ressource->get_image();
            if (file_exists($path)){
                unlink($path);
            }
        }
        $this->db->where('ressource_graphique_id',$ressource_id);
        return $this->db->delete('ressource_graphique'); 
    }
    
    public function delete_documentation($documentation_id){
        $this->db->where('documentation_graphique_id',$documentation_id);
        return $this->db->delete('documentation_graphique');
    }
    
    //$data is an associative array
    //output $failure is an array with titles of failed insertion
    public function import_csv($data, $transaction){
        $this->load->helper('dates');
        $failure = array();
        $ressource_id_array = array(); //array containing successful id, used for rollback
        
        foreach ($data as $ressourceCsv){
            $ressource = new Ressource_graphique($ressourceCsv);
            $ressource->set_username($this->session->userdata('username'));
            if($ressource->get_date_debut_ressource()==null){ //we want to avoid database error if csv file with no date
                $ressource->set_date_debut_ressource('01/01/1900');
            }
            if($ressource->get_date_prise_vue()==null){
                $ressource->set_date_prise_vue($ressource->get_date_debut_ressource());
            }
            if($ressource->get_couleur()!='t' || $ressource->get_couleur()!='f'){
                if($ressource->get_couleur()=='TRUE'){
                    $ressource->set_couleur('t');
                }else{
                    $ressource->set_couleur('f');
                }
            }
            
            if ($this->ajout_ressource($ressource)) { //if there is no error in the insertion
                $ressource_id_array[] = $this->db->insert_id();
            } else {
                $failure[] = $ressource->get_titre().' (';  //we want to continue, check $db['default']['db_debug'] = FALSE; in config/database 
                if($this->get_ressource('titre', $ressource->get_titre()) != null){
                    $errorBegin = array_pop($failure);
                    $failure[] = $errorBegin.$ressource->get_titre().$this->lang->line('csv_ress_already_exist');
                }
                if(!valid_MDY($ressource->get_date_debut_ressource())){
                    $errorBegin = array_pop($failure);
                    $failure[] = $errorBegin.$this->lang->line('csv_ress_date_begin');
                }
                if(!valid_MDY($ressource->get_date_prise_vue())){
                    $errorBegin = array_pop($failure);
                    $failure[] = $errorBegin.$this->lang->line('csv_ress_img_date_begin');
                }
                if($ressource->get_couleur()!='t' && $ressource->get_couleur()!='f'){
                    $errorBegin = array_pop($failure);
                    $failure[] = $errorBegin.$this->lang->line('csv_ress_color');
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


/* End of file ressource_graphique_model.php */
/* Location: ./application/models/ressource_graphique_model.php */