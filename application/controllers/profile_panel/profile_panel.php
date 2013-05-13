<?php

/**
 * profile_panel class
 * 
 * Accessible à tous les utilisateurs connectés
 * Menu pour changer ses informations
 * 
 * @author LUCAS Paul-Yves
 * 
 */
class Profile_panel extends CI_Controller {
    public function index(){
        if ( $this->session->userdata('username') ) {
            $this->profile_panel();
        }else{
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }
    
    public function __construct() {
	
            parent::__construct();

            //Ce code sera executé charque fois que ce contrôleur sera appelé
            $this->load->model('user_model');
            require ('application/models/user.php');
            $this->load->library('form_validation');
            $this->load->view('header');
    }   
    
    public function profile_panel(){ //render the profile_panel page
        $data = array();
        $userName = $this->session->userdata('username');
        $currentUser = new User($userName);
        $data['user'] = $currentUser;
        $this->load->view('profile_panel/profile_panel', $data);
        $this->load->view('footer');
    }
    
    public function change_profile(){ //change some of the user information
        
        if($this->form_validation->run('change_profile')==TRUE){
            
        }
        redirect('profile_panel/profile_panel', 'refresh');
    }
}

/* End of file profile_panel.php */
/* Location : ./application/controllers/profile_panel/profile_panel.php */