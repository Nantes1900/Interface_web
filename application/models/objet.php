<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * creator : Paul-Yves
 * This class aims at having more natural representation of objet object
 * it relies on objet_model to connect to the database
 * 
 */

class Objet{
    protected $_objet_id;
    protected $_username;
    protected $_nom_objet;
    protected $_resume;
    protected $_historique;
    protected $_description;
    protected $_adresse_postale;
    protected $_validation;
    protected $_archive_objet;
    protected $_mots_cles;
    protected $_date_creation;
    protected $_date_maj;
    protected $_last_modified;
    protected $_geom_maquette;
    
    //with an array of datas (typically the result of a db query), we directly call the hydrate function
    //with an objet_id, we use the objet_model to query the db and hydrate with its answer the new objet entity
    public function __construct($objetData) {
        if (is_array($objetData)){
            $this->hydrate($objetData);
        } else {
            $objetManager = new Objet_model();
            if ($objetManager->exist($objetData)){
                $this->hydrate($objetManager->get_objet('objet_id', $objetData));
            }
        }
    }
    
    public function hydrate(array $objetData) {
        foreach ($objetData as $key => $value) { //key correspond to attribute name, value to it's value
            $method = 'set_'.$key;   //we create a set_ method corresponding to the key
            if (method_exists($this, $method)){ //security if wrong key name
                //calling the created setter method
                $this->$method($value);
            }
        }
    }
    
    //return an associative array of all attributes except objet_id with their value
    //beware, attribute name are like _objet_id
    public function get_attributes(){
        foreach ($this as $attribute => $value){
            if (isset($value) && ($attribute!='_objet_id') ){
                $attributeArray[$attribute]=$value;
            }
        }
        return $attributeArray;
    }
    
    public  function save(){
        $objetManager = new Objet_model();
        if ($objetManager->exist($this->get_objet_id())){
            $this->set_last_modified(date('Y-m-d H:i:s'));
            if($this->_date_maj!=null){ //date maj arrays are not true array but string like "{value1, value2, ...}" 
                $this->_date_maj= substr($this->_date_maj, 0,  strlen($this->_date_maj)-1 ).','.$this->get_last_modified().'}';
            }else{
                $this->_date_maj='{'.$this->get_last_modified().'}';
            }
            return $objetManager->update_objet($this);
        } else {
            return FALSE;
        }
    }
    
    public function validate(){
        $this->set_validation('t');
        return $this->save();
    }
    
    //if a geom exist
    public function get_geom(){
        $objetManager = new Objet_model();
        if ($objetManager->exist($this->get_objet_id())){
            $geom = $objetManager->get_objet_geo($this->get_objet_id());
            return $geom;
        } else {
            return null;
        }
    }
    
    //getters and setters
    public function get_objet_id() {
        return $this->_objet_id;
    }

    public function set_objet_id($_objet_id) {
        $this->_objet_id = $_objet_id;
    }

    public function get_username() {
        return $this->_username;
    }

    public function set_username($_username) {
        $this->_username = $_username;
    }

    public function get_nom_objet() {
        return $this->_nom_objet;
    }

    public function set_nom_objet($_nom_objet) {
        $this->_nom_objet = $_nom_objet;
    }

    public function get_resume() {
        return $this->_resume;
    }

    public function set_resume($_resume) {
        $this->_resume = $_resume;
    }

    public function get_historique() {
        return $this->_historique;
    }

    public function set_historique($_historique) {
        $this->_historique = $_historique;
    }

    public function get_description() {
        return $this->_description;
    }

    public function set_description($_description) {
        $this->_description = $_description;
    }

    public function get_adresse_postale() {
        return $this->_adresse_postale;
    }

    public function set_adresse_postale($_adresse_postale) {
        $this->_adresse_postale = $_adresse_postale;
    }

    public function get_validation() {
        return $this->_validation;
    }

    public function set_validation($_validation) {
        $this->_validation = $_validation;
    }

    public function get_archive_objet() {
        return $this->_archive_objet;
    }

    public function set_archive_objet($_archive_objet) {
        $this->_archive_objet = $_archive_objet;
    }

    public function get_mots_cles() {
        return $this->_mots_cles;
    }

    public function set_mots_cles($_mots_cles) {
        $this->_mots_cles = $_mots_cles;
    }

    public function get_date_creation() {
        return $this->_date_creation;
    }

    public function set_date_creation($_date_creation) {
        $this->_date_creation = $_date_creation;
    }

    public function get_date_maj() {
        return $this->_date_maj;
    }

    public function set_date_maj($_date_maj) {
        $this->_date_maj = $_date_maj;
    }

    public function get_last_modified() {
        return $this->_last_modified;
    }

    public function set_last_modified($_last_modified) {
        $this->_last_modified = $_last_modified;
    }

    public function get_geom_maquette() {
        return $this->_geom_maquette;
    }

    public function set_geom_maquette($_geom_maquette) {
        $this->_geom_maquette = $_geom_maquette;
    }
    
    //Get validation status for reviewing process : conservation, public, edition
    //Return True or False
    public function get_validation_status($type_validation) {
        if (file_exists(FCPATH . 'assets/utils/review.json')) {
            $jsonList = file_get_contents(FCPATH . 'assets/utils/review.json');
            $liste = json_decode($jsonList,true);
        
            if ( array_key_exists($type_validation, $liste[$this->_objet_id]) ) {
                return $liste[$this->_objet_id][$type_validation];
            } else { return False; }
        }
        else { return False;}
    }
    
}

/* End of file objet.php */
/* Location : ./application/models/objet.php */

