<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class aims at having more natural representation of ressource_video object
 * it relies on Ressource_video_model to connect to the database
 *
 * @author paulyves
 */
require_once ('application/models/ressource.php');

class Ressource_video extends Ressource {
    protected $_ressource_video_id;
    protected $_video;
    protected $_date_production;
    protected $_duree;
    protected $_diffusion;
    protected $_versionvideo;
    protected $_distribution;
    protected $_generique;
    protected $_production;
    
    
    //specifics getters and setters
    public function get_ressource_video_id() {
        return $this->_ressource_video_id;
    }

    public function set_ressource_video_id($_ressource_video_id) {
        $this->_ressource_video_id = $_ressource_video_id;
    }

    public function get_video() {
        return $this->_video;
    }

    public function set_video($_video) {
        $this->_video = $_video;
    }

    public function get_date_production() {
        return $this->_date_production;
    }

    public function set_date_production($_date_production) {
        $this->_date_production = $_date_production;
    }

    public function get_duree() {
        return $this->_duree;
    }

    public function set_duree($_duree) {
        $this->_duree = (int) $_duree;
    }

    public function get_diffusion() {
        return $this->_diffusion;
    }

    public function set_diffusion($_diffusion) {
        $this->_diffusion = $_diffusion;
    }

    public function get_versionvideo() {
        return $this->_versionvideo;
    }

    public function set_versionvideo($_versionvideo) {
        $this->_versionvideo = $_versionvideo;
    }

    public function get_distribution() {
        return $this->_distribution;
    }

    public function set_distribution($_distribution) {
        $this->_distribution = $_distribution;
    }

    public function get_generique() {
        return $this->_generique;
    }

    public function set_generique($_generique) {
        $this->_generique = $_generique;
    }

    public function get_production() {
        return $this->_production;
    }

    public function set_production($_production) {
        $this->_production = $_production;
    }


}

/* End of file ressource_video.php */
/* Location : ./application/models/ressource_video.php */

