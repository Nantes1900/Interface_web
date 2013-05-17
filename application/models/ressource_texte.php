<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class aims at having more natural representation of ressource_texte object
 * it relies on ressource_texte_model to connect to the database
 * @author paulyves
 */
class Ressource_texte {
    protected $_ressource_textuelle_id;
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
    protected $_sous_categorie;
    protected $_pagination;
    
    //with an array of datas (typically the result of a db query), we directly call the hydrate function
    //with a ressource_textuelle_id, we use the ressource_texte_model to query the db and hydrate with its answer the new objet entity
    public function __construct($ressourceTxtData) {
        if (is_array($ressourceTxtData)){
            $this->hydrate($ressourceTxtData);
        } else {
            $ressourceTxtManager = new Ressource_texte_model();
            if ($ressourceTxtManager->exist($ressourceTxtData)){
                $this->hydrate($ressourceTxtManager->get_ressource('ressource_textuelle_id', $ressourceTxtData));
            }
        }
    }
    
    public function hydrate(array $ressourceTxtData) {
        foreach ($ressourceTxtData as $key => $value) { //key correspond to attribute name, value to it's value
            $method = 'set_'.$key;   //we create a set_ method corresponding to the key
            if (method_exists($this, $method)){ //security if wrong key name
                //calling the created setter method
                $this->$method($value);
            }
        }
    }
    
    public  function save(){
        $ressourceManager = new Ressource_texte_model();
        if ($ressourceManager->exist($this->get_objet_id())){
            $ressourceManager->update_ressource($this);
        }
    }
    
    public function validate(){
        $this->set_validation(TRUE);
        $this->save();
    }
    
    //getters and setters
    //
    //return an associative array of all attributes except _ressource_textuelle_id with their value
    //beware of underscore, attribute name are like _ressource_textuelle_id
    public function get_attributes(){
        foreach ($this as $attribute => $value){
            if (isset($value) && ($attribute!='_ressource_textuelle_id') ){
                $attributeArray[$attribute]=$value;
            }
        }
        return $attributeArray;
    }
    
    public function get_ressource_textuelle_id() {
        return $this->_ressource_textuelle_id;
    }

    public function set_ressource_textuelle_id($_ressource_textuelle_id) {
        $this->_ressource_textuelle_id = $_ressource_textuelle_id;
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

    public function get_sous_categorie() {
        return $this->_sous_categorie;
    }

    public function set_sous_categorie($_sous_categorie) {
        $this->_sous_categorie = $_sous_categorie;
    }

    public function get_pagination() {
        return $this->_pagination;
    }

    public function set_pagination($_pagination) {
        $this->_pagination = $_pagination;
    }


}

/* End of file ressource_texte.php */
/* Location : ./application/models/ressource_texte.php */

