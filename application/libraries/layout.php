<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * This library is used to create layouts, so that you don't have
 * to load multiple views each time (header, main and then footer for example)
 * 
 */

class Layout {

    private $CI;
    private $var = array();
    private $theme = 'main_layout';

    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        $this->CI = get_instance();
        $this->var['output'] = '';
        $this->var['title'] = 'Projet Nantes 1900';
        $this->var['charset'] = $this->CI->config->item('charset');
        $this->var['css'] = array();
        $this->var['js'] = array();
    }

    /*
      |===============================================================================
      | Methods for loading views
      | . view: is the final load and uses the classical load->view
      | . views: to add some views to be rendered later with view method
      |===============================================================================
     */

    public function view($name, $data = array()) {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        $this->CI->load->view('layouts/'.$this->theme, $this->var);
    }

    public function views($name, $data = array()) {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        return $this;
    }
    
     /*
      |===============================================================================
      | Setters for differents parameters of the layout
      | . set_theme
      | . set_title
      | . set_charset
      | . add_css
      | . add_javascript
      |===============================================================================
     */
    
    public function set_theme($theme) {
        if (is_string($theme) AND !empty($theme) AND
             file_exists('./application/views/layouts/' . $theme . '.php')) {
            
            $this->theme = $theme;
            return true;
        }
        return false;
    }
    
    public function set_title($title) {
        if (is_string($title) AND !empty($title)) {
            $this->var['title'] = $title;
            return true;
        }
        return false;
    }
    
    public function set_charset($charset) {
        if (is_string($charset) AND !empty($charset)) {
            $this->var['charset'] = $charset;
            return true;
        }
        return false;
    }
    
    public function add_css($nom) {
        if (is_string($nom) AND !empty($nom) AND file_exists('./assets/css/' . $nom .
                        '.css')) {
            $this->var['css'][] = css_url($nom);
            return true;
        }
        return false;
    }

    public function add_js($nom) {
        if (is_string($nom) AND !empty($nom) AND file_exists('./assets/js/' .
                        $nom . '.js')) {
            $this->var['js'][] = js_url($nom);
            return true;
        }
        return false;
    }

}

/* End of file layout.php */
/* Location : ./application/libraries/layout.php */
