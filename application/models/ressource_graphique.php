<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class aims at having more natural representation of ressource_graphique object
 * it relies on ressource_graphique_model to connect to the database
 *
 * @author paulyves
 */
require_once ('application/models/ressource.php');

class Ressource_graphique extends Ressource {
    protected $_ressource_graphique_id;
    protected $_legende;
    protected $_couleur;
    protected $_image;
    protected $_original;
    protected $_pagination;
    protected $_dimension;
    protected $_date_prise_vue;
    protected $_localisation;
    protected $_cote;
    protected $_technique;
    protected $_type_support;
    
   
    //getters and setters
   
    
    public function get_ressource_graphique_id() {
        return $this->_ressource_graphique_id;
    }

    public function set_ressource_graphique_id($_ressource_graphique_id) {
        $this->_ressource_graphique_id = $_ressource_graphique_id;
    }

    public function get_legende() {
        return $this->_legende;
    }

    public function set_legende($_legende) {
        $this->_legende = $_legende;
    }

    public function get_couleur() {
        return $this->_couleur;
    }

    public function set_couleur($_couleur) {
        $this->_couleur = $_couleur;
    }

    public function get_image() {
        return $this->_image;
    }

    public function set_image($_image) {
        $this->_image = $_image;
    }

    public function get_original() {
        return $this->_original;
    }

    public function set_original($_original) {
        $this->_original = $_original;
    }

    public function get_pagination() {
        return $this->_pagination;
    }

    public function set_pagination($_pagination) {
        $this->_pagination = $_pagination;
    }

    public function get_dimension() {
        return $this->_dimension;
    }

    public function set_dimension($_dimension) {
        $this->_dimension = $_dimension;
    }

    public function get_date_prise_vue() {
        return $this->_date_prise_vue;
    }

    public function set_date_prise_vue($_date_prise_vue) {
        $this->_date_prise_vue = $_date_prise_vue;
    }

    public function get_localisation() {
        return $this->_localisation;
    }

    public function set_localisation($_localisation) {
        $this->_localisation = $_localisation;
    }

    public function get_cote() {
        return $this->_cote;
    }

    public function set_cote($_cote) {
        $this->_cote = $_cote;
    }

    public function get_technique() {
        return $this->_technique;
    }

    public function set_technique($_technique) {
        $this->_technique = $_technique;
    }

    public function get_type_support() {
        return $this->_type_support;
    }

    public function set_type_support($_type_support) {
        $this->_type_support = $_type_support;
    }


    
}

/* End of file ressource_graphique.php */
/* Location : ./application/models/ressource_graphique.php */

