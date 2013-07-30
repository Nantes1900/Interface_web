<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * used to connect and query the database in order to manipulate annotations
 *
 * @author paulyves
 */
class Annotation_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        //Connexion à la base de données
        $this->load->database();
    }
    
    public function exist($annotation_id){
        $this->db->where('annotation_id', $annotation_id);
        $this->db->from('annotation');
        $numberOfInstance = $this->db->count_all_results(); //Renvoie 0 si le $objet_id n'existe pas
        if ($numberOfInstance == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function ajout_annotation(Annotation $annotation){
        $attributeArray = $annotation->get_attributes();
        foreach ($attributeArray as $attribute => $value){
            $dbAttribute = substr($attribute, 1); //we must delete the _ of the _attribute_name
            $this->db->set($dbAttribute,$value);
        }
        
        $success = $this->db->insert('annotation');
        
        //we update the annotation object
        $annotation_id = $this->db->insert_id();
        $annotation->set_annotation_id($annotation_id);
        
        return $success;
    }
    
    //return an array corresponding to the first annotation matching the arguments
    public function get_annotation($attribute, $value){
        $this->db->select('*');
        $this->db->from('annotation');
        $this->db->where($attribute, $value);
        $query = $this->db->get();
        $result = $query->result_array();
        if (isset($result['0'])) { //vérifier que l'objet existe
            return $result['0'];
        } else {
            return null;
        }
    }
    
    public function update_annotation(Annotation $annotation){
        $attributeArray = $annotation->get_attributes();
        foreach ($attributeArray as $attribute => $value){
            $dbAttribute = substr($attribute, 1); //we must delete the _ of the _attribute_name
            $this->db->set($dbAttribute,$value);
        }
        $this->db->where('annotation_id', $annotation->get_annotation_id());
        return $this->db->update('annotation');
    }
    
    public function delete_annotation($annotation_id){
        $this->db->where('annotation_id', $annotation_id);
        return $this->db->delete('annotation'); 
    }
    
    //get all the parents annotation, then its children, for a specific entity
    //with a specifi id
    public function get_annotation_list($type_entity, $entity_id){
        $this->db->select('*');
        $this->db->from('annotation');
        $this->db->where('parent_id', null);
        $this->db->where('type_target', $type_entity);
        $this->db->where('target_id', $entity_id);
        $query = $this->db->get();
        $tempResult = $query->result_array();
        
        $annotationList = array();
        foreach($tempResult as $result){
            $annotFather = new Annotation($result);
            $childList = $this->get_annotation_children($annotFather->get_annotation_id());
            $annotationList[] = array('father'=>$annotFather, 'children'=>$childList);
        };
        return $annotationList;
    }
    
    //get all the annotation as an array of Annotation where parent_id is in arg
    //order them by date
    public function get_annotation_children($father_id){
        $this->db->select('*');
        $this->db->from('annotation');
        $this->db->order_by('date_creation','asc');
        $this->db->where('parent_id', $father_id);
        $query = $this->db->get();
        $result = $query->result_array();
        
        $annotArray = array();
        foreach ($result as $annotData){
            $annotArray[]= new Annotation($annotData);
        }
        return $annotArray;
    }
    
}

/* End of file annotation_model.php */
/* Location : ./application/models/annotation_model.php */

