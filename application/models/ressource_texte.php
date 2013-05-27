<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class aims at having more natural representation of ressource_texte object
 * it relies on ressource_texte_model to connect to the database
 * @author paulyves
 */
require ('application/models/ressource.php');

class Ressource_texte extends Ressource {
    protected $_ressource_textuelle_id;
    protected $_sous_categorie;
    protected $_pagination;
    
    
    //getters and setters
    
    
    public function get_ressource_textuelle_id() {
        return $this->_ressource_textuelle_id;
    }

    public function set_ressource_textuelle_id($_ressource_textuelle_id) {
        $this->_ressource_textuelle_id = $_ressource_textuelle_id;
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

