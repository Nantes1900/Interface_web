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
            $this->data_center(); /** @todo Déplacer la sécurité par vérification du user_level ici*/
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
            if ( $this->session->userdata('user_level') == 5 || $this->session->userdata('user_level') == 4)
            {
                $this->load->view('data_center/data_center');
            }
            else if ( !$this->session->userdata('username') )
            {
                $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
            }
            
        }
        
        
}

/* End of file data_center.php */
/* Location: ./application/controllers/data_center/data_center.php */
