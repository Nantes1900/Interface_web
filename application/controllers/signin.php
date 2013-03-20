<?php

class Signin extends CI_Controller {

	public function index()
	{
		$this->check_signin();
	}

	public function __construct()
	{
		parent::__construct();

		//Ce code sera executé charque fois que ce contrôleur sera appelé
		
		$this->load->model('user_model','signin');
		$this->load->library('form_validation');
		$this->load->helper(array('form'));
		$this->load->view('header');
	}

	public function check_signin()
	{
		
		if ($this->form_validation->run('signin') == FALSE) //TODO : Rajouter dans la validation si le nom d'utilisateur existe déjà ou pas
		{
                        $this->load->view('accueil/signin/formulaire_signin');
			$this->load->view('footer');
                }
		else
		{
			$userdata = array();
			$userdata['username'] = $this->input->post('username');
			$userdata['password'] = $this->input->post('password1');
			$userdata['nom'] = $this->input->post('nom');
			$userdata['prenom'] = $this->input->post('prenom');			

			$this->signin->create_user($userdata); //Transmission des données au modèle user_model

			redirect('accueil/','refresh');
			
		}
	}
}

/* End of file signin.php */
/* Location : ./application/controllers/signin.php */
