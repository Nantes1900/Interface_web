<?php

/**
 * data_center class
 * 
 * Accessible uniquement aux utilisateurs autorisés.
 * Menu d'accueil proposant à l'utilisateur d'ajouter objets, relations, ressources à la base, ainsi que d'y importer les données contenues dans un fichier CSV
 * 
 * @author NATIVEL Pierre-Alexandre
 * 
 */

class Data_center extends CI_Controller
{

	public function index()
	{
            if ( $this->session->userdata('username') ) {
                $this->data_center();
            }else{
                $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
            }            
	}

	public function __construct()
	{
            parent::__construct();

            //Ce code sera executé charque fois que ce contrôleur sera appelé
		
            $this->load->library('form_validation');
            $this->load->view('header');
	}
        
        public function data_center()
        {
            $userLevel = $this->session->userdata('user_level');
            $data['userLevel'] = $userLevel;
            $this->load->view('data_center/data_center',$data);
            
        }
        
        
}

/* End of file data_center.php */
/* Location: ./application/controllers/data_center/data_center.php */
