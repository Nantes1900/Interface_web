<?php

/**
 * render the different elements of moderation bundle
 *
 * @author paulyves
 */

class Moderation_center extends CI_Controller{
    public function index(){
        if ( $this->session->userdata('username') ) {
            if ( $this->session->userdata('user_level') >= 5 ){
                $this->moderation_center();                    
            }
        }else{
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }            
    }

    public function __construct(){
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
		
        $this->load->library('form_validation');
        $this->load->view('header');
    }
    
    private function moderation_center(){
        $this->load->view('moderation/moderation_center');
    }
}

/* End of file moderation_center.php */
/* Location : ./application/models/moderation_center.php */

