<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This class aims at having more natural representation of annotation object
 * it relies on annotation_model to connect to the database
 * annotation are comment on historical elements for researchers
 * 
 * @author paulyves
 */
class Annotation {
    protected $_annotation_id;
    protected $_username;
    protected $_type_target;
    protected $_target_id;
    protected $_titre;
    protected $_texte;
    protected $_parent_id;
    protected $_date_creation;
    
    public function hydrate(array $annotData) {
        foreach ($annotData as $key => $value) { //key correspond to attribute name, value to it's value
            $method = 'set_'.$key;   //we create a set_ method corresponding to the key
            if (method_exists($this, $method)){ //security if wrong key name
                //calling the created setter method
                $this->$method($value);
            }
        }
    }
    
    //with an array of datas (typically the result of a db query), we directly call the hydrate function
    //with an annotation_id, we use the objet_model to query the db and hydrate with its answer the new objet entity
    public function __construct($annotData) {
        if (is_array($annotData)){
            $this->hydrate($annotData);
        } else {
            $annotManager = new Annotation_model();
            if ($annotManager->exist($annotData)){
                $this->hydrate($annotManager->get_annotation('annotation_id', $annotData));
            }
        }
    }
    
    //if the annotation already exist un database, it is updated
    //if it doesn't we create it
    public function save(){
        $annotManager = new Annotation_model();
        if ($annotManager->exist($this->get_annotation_id())){
            return $annotManager->update_annotation($this);
        }else{
            return $annotManager->ajout_annotation($this);
        }
    }
    
    public function delete(){
        $annotManager = new Annotation_model();
        if ($annotManager->exist($this->get_annotation_id())){
            return $annotManager->delete_annotation($this->get_annotation_id());
        }else{
            return false;
        }
    }
    
    //return an associative array of all attributes except annotation_id with their value
    //beware, attribute name are like _titre
    public function get_attributes(){
        foreach ($this as $attribute => $value){
            if (isset($value) && ($attribute!='_annotation_id') ){
                $attributeArray[$attribute]=$value;
            }
        }
        return $attributeArray;
    }
    
    public function get_annotation_id() {
        return $this->_annotation_id;
    }

    public function set_annotation_id($_annotation_id) {
        $this->_annotation_id = $_annotation_id;
    }

    public function get_username() {
        return $this->_username;
    }

    public function set_username($_username) {
        $this->_username = $_username;
    }

    public function get_type_target() {
        return $this->_type_target;
    }

    public function set_type_target($_type_target) {
        $this->_type_target = $_type_target;
    }

    public function get_titre() {
        return $this->_titre;
    }

    public function set_titre($_titre) {
        $this->_titre = $_titre;
    }

    public function get_texte() {
        return $this->_texte;
    }

    public function set_texte($_texte) {
        $this->_texte = $_texte;
    }

    public function get_parent_id() {
        return $this->_parent_id;
    }

    public function set_parent_id($_parent_id) {
        $this->_parent_id = $_parent_id;
    }

    public function get_date_creation() {
        return $this->_date_creation;
    }

    public function set_date_creation($_date_creation) {
        $this->_date_creation = $_date_creation;
    }
    public function get_target_id() {
        return $this->_target_id;
    }

    public function set_target_id($_target_id) {
        $this->_target_id = $_target_id;
    }

}

/* End of file annotation.php */
/* Location : ./application/models/annotation.php */

