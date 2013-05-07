<?php

/**
 * admin_panel class
 * 
 * Accessible uniquement aux utilisateurs autorisés.
 * Menu d'administration proposant de gérer les utilisateurs (droits d'accès)
 * 
 * @author LUCAS Paul-Yves
 * 
 */
class Admin_panel extends CI_Controller {
    
    public function index(){
        if ( $this->session->userdata('user_level') == 9 ) {
            $this->admin_panel();
        }else if ( !$this->session->userdata('username') ) {
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }   
        public function __construct() {
	
            parent::__construct();

            //Ce code sera executé charque fois que ce contrôleur sera appelé
            $this->load->model('user_model');
            $this->load->model('user');
            $this->load->library('form_validation');
            $this->load->view('header');
	}   
        
        public function admin_panel(){     
            
            $userManager = new User_model();
            $data = array();
            $data['listUser'] = $userManager->get_user_list();
            $this->load->view('admin_panel/admin_panel', $data);
        }
}

?>
