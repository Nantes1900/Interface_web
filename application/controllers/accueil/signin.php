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
                        $this->load->view('accueil/body');
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
        
        public function check_existence() { //callback function of form_validation that check if a username already exists
            $userName = $this->input->post('username');
            if ($this->signin->check_ifuserexists($userName)==0){
                return TRUE;
            } else {
                $this->form_validation->set_message('check_existence', 'Le nom d\'utilisateur est déjà pris');
                return FALSE;
            }            
        }
}

/* End of file signin.php */
/* Location : ./application/controllers/signin.php */
