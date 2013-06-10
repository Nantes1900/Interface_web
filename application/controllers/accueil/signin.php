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
		
		$this->load->model('user_model');
                require_once ('application/models/user.php');
		$this->load->library('form_validation');
		$this->load->helper(array('form'));
		$this->load->view('header');
	}

	public function check_signin()
	{
		if ($this->form_validation->run('signin') == FALSE) 
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
                        $userdata['email'] = $this->input->post('email');

			$this->user_model->create_user($userdata); //Transmission des données au modèle user_model

			redirect('accueil/','refresh');
			
		}
	}
        
        public function check_existence() { //callback function of form_validation that check if a username already exists
            $userName = $this->input->post('username');
            if ($this->user_model->check_ifuserexists($userName)==0){
                return TRUE;
            } else {
                $this->form_validation->set_message('check_existence', 'Le nom d\'utilisateur est déjà pris');
                return FALSE;
            }            
        }
        
        public function check_unique_mail($mail){
            $userList = $this->user_model->get_user_list(null,'username','asc','email',$mail);
            if(!isset($userList['0'])){
                return TRUE;
            } else {
                $this->form_validation->set_message('check_unique_mail', 'Cette adresse mail est déjà prise');
                return FALSE;
            }  
        }
}

/* End of file signin.php */
/* Location : ./application/controllers/signin.php */
