<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * abstract class from which every Ressource_*** will inherit
 *
 * @author paulyves
 */
abstract class Ressource {
    protected $_username;
    protected $_titre;
    protected $_description;
    protected $_reference_ressource;
    protected $_disponibilite;
    protected $_theme_ressource;
    protected $_auteurs;
    protected $_editeur;
    protected $_ville_edition;
    protected $_date_debut_ressource;
    protected $_date_precision;
    protected $_archive_ressource;
    protected $_validation;
    protected $_mots_cles;
    protected $_date_creation;
    protected $_date_maj;
    protected $_last_modified;
    
    //with an array of datas (typically the result of a db query), we directly call the hydrate function
    //with a ressource_***_id, we use the ressource_***_model to query the db and hydrate with its answer the new objet entity
    public function __construct($ressourceData) {
        if (is_array($ressourceData)){
            $this->hydrate($ressourceData);
        } else {
            $className = get_class($this);
            $managerName = $className.'_model';
            $ressourceManager = new $managerName();
            if ($ressourceManager->exist($ressourceData)){
                if ($className == 'Ressource_texte')
                    $this->hydrate($ressourceManager->get_ressource('ressource_textuelle_id', $ressourceData));
                }
                if ($className == 'Ressource_graphique'){
                    $this->hydrate($ressourceManager->get_ressource('ressource_graphique_id', $ressourceData));
                }
                if ($className == 'Ressource_video'){
                    $this->hydrate($ressourceManager->get_ressource('ressource_video_id', $ressourceData));
                }
        }
    }
    
    public function hydrate(array $ressourceData) {
        foreach ($ressourceData as $key => $value) { //key correspond to attribute name, value to it's value
            $method = 'set_'.$key;   //we create a set_ method corresponding to the key
            if (method_exists($this, $method)){ //security if wrong key name
                //calling the created setter method
                $this->$method($value);
            }
        }
    }
    
    public  function save(){
        $className = get_class($this);
        $managerName = $className.'_model';
        $ressourceManager = new $managerName(); //to improve
        if ($className=='Ressource_texte'){
            $getRessourceMethod = 'get_ressource_textuelle_id';
        } else {
            $getRessourceMethod = 'get_'.strtolower($className).'_id';
        }
        if ($ressourceManager->exist($this->$getRessourceMethod())){
            $this->set_last_modified(date('Y-m-d H:i:s'));
            $this->_date_maj[] = $this->get_last_modified();
            $ressourceManager->update_ressource($this);
        }
    }
    
    public function validate(){
        $this->set_validation(TRUE);
        $this->save();
    }
    
    //getters and setters
    //
    //return an associative array of all attributes except _ressource_*graphique***_id with their value
    //beware of underscore, attribute name are like _ressource_graphique_id
    public function get_attributes(){
        foreach ($this as $attribute => $value){
            if (isset($value) && (!preg_match("#ressource_[a-z]*_id#", $attribute))){
                $attributeArray[$attribute]=$value;                
            }
        }
        return $attributeArray;
    }
    
    public function get_username() {
        return $this->_username;
    }

    public function set_username($_username) {
        $this->_username = $_username;
    }

    public function get_titre() {
        return $this->_titre;
    }

    public function set_titre($_titre) {
        $this->_titre = $_titre;
    }

    public function get_description() {
        return $this->_description;
    }

    public function set_description($_description) {
        $this->_description = $_description;
    }

    public function get_reference_ressource() {
        return $this->_reference_ressource;
    }

    public function set_reference_ressource($_reference_ressource) {
        $this->_reference_ressource = $_reference_ressource;
    }

    public function get_disponibilite() {
        return $this->_disponibilite;
    }

    public function set_disponibilite($_disponibilite) {
        $this->_disponibilite = $_disponibilite;
    }

    public function get_theme_ressource() {
        return $this->_theme_ressource;
    }

    public function set_theme_ressource($_theme_ressource) {
        $this->_theme_ressource = $_theme_ressource;
    }

    public function get_auteurs() {
        return $this->_auteurs;
    }

    public function set_auteurs($_auteurs) {
        $this->_auteurs = $_auteurs;
    }

    public function get_editeur() {
        return $this->_editeur;
    }

    public function set_editeur($_editeur) {
        $this->_editeur = $_editeur;
    }

    public function get_ville_edition() {
        return $this->_ville_edition;
    }

    public function set_ville_edition($_ville_edition) {
        $this->_ville_edition = $_ville_edition;
    }

    public function get_date_debut_ressource() {
        return $this->_date_debut_ressource;
    }

    public function set_date_debut_ressource($_date_debut_ressource) {
        $this->_date_debut_ressource = $_date_debut_ressource;
    }

    public function get_date_precision() {
        return $this->_date_precision;
    }

    public function set_date_precision($_date_precision) {
        $this->_date_precision = $_date_precision;
    }

    public function get_archive_ressource() {
        return $this->_archive_ressource;
    }

    public function set_archive_ressource($_archive_ressource) {
        $this->_archive_ressource = $_archive_ressource;
    }

    public function get_validation() {
        return $this->_validation;
    }

    public function set_validation($_validation) {
        $this->_validation = $_validation;
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


}

/* End of file ressource.php */
/* Location : ./application/models/ressource.php */

