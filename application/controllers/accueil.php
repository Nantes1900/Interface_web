<?php

class Accueil extends CI_Controller
{

	public function index()
	{
		$this->accueil();
	}

	public function __construct()
	{
		parent::__construct();

		//Ce code sera executé charque fois que ce contrôleur sera appelé
		
		$this->load->view('header');
	}

	public function accueil()
	{

		$this->load->library('form_validation');
		$this->load->view('accueil/body');

		if ( ! $this->session->userdata('username') ) //Si l'utilisateur n'est pas loggé, on affiche le formulaire de connexion
		{
			$this->load->view('accueil/login/formulaire_login',array('titre'=>'Connectez-vous :'));
		}
		else //Sinon, on affiche les zones restreintes
		{

			$data = array('username' => $this->session->userdata('username'));

			$this->load->view('accueil/welcome', $data);
                        
                        if ( $this->session->userdata('user_level') == 5)
                        {
                            $this->load->view('accueil/data_center_anchor');
                        }
                        
                        
			$this->load->view('footer');
		}

	}

	public function signin()
	{
		$this->load->library('form_validation');
		$this->load->view('accueil/signin/formulaire_signin');
		$this->load->view('footer');
	}
}

/* End of file accueil.php */
/* Location : ./application/controllers/accueil.php */
